<?php
require_once 'model/pdo.php';
require_once 'model/taikhoan.php';

echo "Testing select by email for admin@travelplus.com:\n";
$user = taikhoan_select_by_email('admin@travelplus.com');
print_r($user);

if ($user) {
    echo "\nTesting forgot password temp generation:\n";
    $new_plain_password = 'temp_' . rand(100000, 999999);
    echo "Generated password: " . $new_plain_password . "\n";
    
    // Save original password to restore it later
    $original_hash = $user['password'];
    $original_username = $user['username'];
    $original_email = $user['email'];
    $original_phone = $user['phone'];
    $original_id = $user['id'];
    
    echo "Updating password...\n";
    taikhoan_update($original_id, $original_username, $new_plain_password, $original_email, $original_phone);
    
    // Verify updated user
    $updated_user = taikhoan_select_by_id($original_id);
    echo "Verifying check with temp password: ";
    $check_new = taikhoan_check($original_username, $new_plain_password);
    if ($check_new) {
        echo "SUCCESS!\n";
    } else {
        echo "FAILED!\n";
    }
    
    echo "Restoring original hash...\n";
    // Directly update hash in DB to avoid double-hashing using pdo execute
    $sql = "UPDATE taikhoan SET password = ? WHERE id = ?";
    Database::execute($sql, [$original_hash, $original_id]);
    
    echo "Restored and verified: ";
    $check_old = taikhoan_check($original_username, 'admin'); // Assuming original password of admin was checkable
    // Or just check if the hash matches:
    $restored_user = taikhoan_select_by_id($original_id);
    if ($restored_user['password'] === $original_hash) {
        echo "SUCCESS!\n";
    } else {
        echo "FAILED to restore hash!\n";
    }
} else {
    echo "User not found by email.\n";
}
?>
