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
$username = $_POST['username'];
$email = $_POST['email'];
$category = $_POST['category'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

// Check if passwords match
if ($password != $repassword) {
    die("Passwords do not match");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO users (username, email, password, category) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $hashed_password, $category);

// Execute the statement
if ($stmt->execute() === TRUE) {
    // Registration successful, redirect to login.php
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
} else {
    // Redirect back to register.php
    header("Location: register.php");
    exit(); // Make sure to exit after redirection
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
