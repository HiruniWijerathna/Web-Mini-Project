<?php
date_default_timezone_set('America/New_York'); // Set your desired timezone

require 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify the token
    $stmt = $conn->prepare("SELECT email, reset_token_expiry FROM users WHERE reset_token = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $expiry = $row['reset_token_expiry'];

        if (new DateTime() < new DateTime($expiry)) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && isset($_POST['confirm_password'])) {
                $new_password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
                    if (!$stmt) {
                        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                    }
                    $stmt->bind_param('ss', $hashed_password, $token);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "Your password has been reset successfully.";
                    } else {
                        echo "Failed to update the password.";
                    }
                } else {
                    echo "Passwords do not match.";
                }
            } else {
                // Display reset password form
                echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | BeastBuddy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body" style="background-image: url(\'image/login.jpg\'); background-size:cover; position:relative;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title">Reset Password</h2>
                        <form method="post">
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Re-enter New Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>';
            }
        } else {
            echo "Token has expired.";
        }
    } else {
        echo "Invalid token.";
    }
    $stmt->close();
} else {
    echo "No token provided.";
}
$conn->close();
?>

