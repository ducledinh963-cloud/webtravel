<?php
require_once 'model/pdo.php';
require_once 'model/taikhoan.php';
$email = 'admin@fpt.edu.vn';
$user = taikhoan_select_by_email($email);
if ($user) {
    echo "Found user: ";
    print_r($user);
} else {
    echo "User NOT found for email $email\n";
    echo "Here are all emails in the database:\n";
    $users = taikhoan_select_all();
    foreach ($users as $u) {
        echo "- Username: " . $u['username'] . " | Email: " . $u['email'] . "\n";
    }
}
?>
