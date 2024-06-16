<?php
require 'config.php';

if (isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Retrieve the user by token
    $stmt = $conn->prepare('SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Update the password
        $stmt = $conn->prepare('UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE user_id = ?');
        if (!$stmt) {
            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
        $stmt->bind_param('si', $newPassword, $user['user_id']);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Your password has been updated.";
        } else {
            echo "Failed to update the password.";
        }
    } else {
        echo "Invalid or expired token.";
    }
    $stmt->close();
}
$conn->close();
?>

