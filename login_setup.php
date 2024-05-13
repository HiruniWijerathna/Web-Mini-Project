<?php
// Establish database connection
$servername = "localhost"; // Change this to your server name if it's not localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "beastbuddy"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute SQL statement
$stmt = $conn->prepare("SELECT user_id, username, email, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];
    // Verify password
    if (password_verify($password, $hashed_password)) {
        // Password is correct, set session variables and redirect to registerUserHomePage.php
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        header("Location: registerUserHomePage.php"); // Change this to the appropriate page
        exit();
    } else {
        // Password is incorrect, redirect back to login.php
        header("Location: login.php?error=password"); // Optionally, you can pass an error parameter
        exit();
    }
} else {
    // User not found, redirect back to login.php
    header("Location: login.php?error=user_not_found"); // Optionally, you can pass an error parameter
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
