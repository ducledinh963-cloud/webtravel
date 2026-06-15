<?php
/**
 * Controller xử lý Giỏ hàng và Thanh toán đặt tour du lịch
 */

// Đảm bảo session được khởi động
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/**
 * Thêm sản phẩm (tour) vào giỏ hàng
 */
function add_to_cart() {
    if (isset($_POST['addtocart'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $image = $_POST['image'];
        $price = (double)$_POST['price'];
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
        if ($quantity <= 0) $quantity = 1;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $found = false;
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                $_SESSION['cart'][$key]['quantity'] += $quantity;
                $_SESSION['cart'][$key]['subtotal'] = $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
                $found = true;
                break;
            }
        }

        // Nếu chưa có, thêm mới vào giỏ hàng
        if (!$found) {
            $item = [
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $price * $quantity
            ];
            $_SESSION['cart'][] = $item;
        }
    }
    header('Location: index.php?act=viewcart');
    exit();
}

/**
 * Hiển thị giỏ hàng
 */
function view_cart() {
    global $list_danhmuc;
    
    require_once 'view/header.php';
    require_once 'view/cart/viewcart.php';
    require_once 'view/footer.php';
}

/**
 * Xóa sản phẩm khỏi giỏ hàng hoặc xóa toàn bộ giỏ hàng
 */
function delete_cart() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        // Khởi động lại chỉ mục mảng
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    } else {
        $_SESSION['cart'] = [];
    }
    header('Location: index.php?act=viewcart');
    exit();
}

/**
 * Trang điền thông tin thanh toán đặt tour
 */
function checkout() {
    global $list_danhmuc;
    
    if (empty($_SESSION['cart'])) {
        header('Location: index.php');
        exit();
    }
    
    $thongbao = '';
    
    // Nếu người dùng đã đăng nhập, lấy thông tin mặc định của họ
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    
    if (isset($_POST['booking'])) {
        $bill_name = trim($_POST['bill_name']);
        $bill_email = trim($_POST['bill_email']);
        $bill_phone = trim($_POST['bill_phone']);
        $bill_address = trim($_POST['bill_address']);
        $bill_pttt = (int)$_POST['bill_pttt'];
        
        if (empty($bill_name) || empty($bill_email) || empty($bill_phone) || empty($bill_address)) {
            $thongbao = 'Vui lòng nhập đầy đủ thông tin giao dịch bắt buộc.';
        } elseif (!filter_var($bill_email, FILTER_VALIDATE_EMAIL)) {
            $thongbao = 'Địa chỉ Email không đúng định dạng.';
        } elseif (!preg_match('/^[0-9]{10,11}$/', $bill_phone)) {
            $thongbao = 'Số điện thoại không hợp lệ (phải là số từ 10 đến 11 chữ số).';
        } else {
            // Tính tổng tiền đơn hàng
            $bill_total = 0;
            foreach ($_SESSION['cart'] as $item) {
                $bill_total += $item['subtotal'];
            }
            
            $bill_code = 'TOUR-' . time() . '-' . rand(100, 999);
            $id_user = $user ? $user['id'] : null;
            $date_booking = date('H:i d/m/Y');
            
            try {
                // Thêm đơn hàng chính
                $id_bill = BillModel::insert($bill_code, $id_user, $bill_name, $bill_email, $bill_phone, $bill_address, $bill_pttt, $bill_total, $date_booking);
                
                if ($id_bill > 0) {
                    // Thêm chi tiết đơn hàng
                    foreach ($_SESSION['cart'] as $item) {
                        BillModel::insertDetail($id_bill, $item['id'], $item['name'], $item['image'], $item['price'], $item['quantity'], $item['subtotal']);
                    }
                    
                    // Xóa giỏ hàng sau khi đặt thành công
                    $_SESSION['cart'] = [];
                    
                    header("Location: index.php?act=checkout_success&id=" . $id_bill);
                    exit();
                } else {
                    $thongbao = 'Đã xảy ra lỗi hệ thống khi lưu hóa đơn.';
                }
            } catch (Exception $e) {
                $thongbao = 'Lỗi xử lý đặt tour: ' . $e->getMessage();
            }
        }
    }
    
    require_once 'view/header.php';
    require_once 'view/cart/checkout.php';
    require_once 'view/footer.php';
}

/**
 * Trang thông báo đặt tour thành công
 */
function checkout_success() {
    global $list_danhmuc;
    
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $bill = BillModel::selectById($_GET['id']);
        if ($bill) {
            $bill_details = BillModel::selectDetails($_GET['id']);
            
            require_once 'view/header.php';
            require_once 'view/cart/checkout_success.php';
            require_once 'view/footer.php';
            return;
        }
    }
    header('Location: index.php');
    exit();
}

/**
 * Danh sách tour đã đặt của người dùng
 */
function my_bookings() {
    global $list_danhmuc;
    
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?act=dangnhap');
        exit();
    }
    
    $user_id = $_SESSION['user']['id'];
    $list_bill = BillModel::selectByUser($user_id);
    
    require_once 'view/header.php';
    require_once 'view/cart/my_bookings.php';
    require_once 'view/footer.php';
}
?>
