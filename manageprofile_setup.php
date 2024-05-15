<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection details
$servername = "localhost"; // Change this to your server name if it's not localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "beastbuddy"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$category = $_POST['category']; // Changed from role to category
$about = $_POST['about'];

// Retrieve user_id from session
$user_id = $_SESSION['user_id'];

// Upload profile image
$image = $_FILES['profile_image']['name'];
$temp_name = $_FILES['profile_image']['tmp_name'];
$folder = "profile_uploads/"; // Create a folder named "uploads" in your project directory

// Check if a profile exists for this user
$sql_check = "SELECT * FROM profile_info WHERE user_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $user_id);
$stmt_check->execute();
$result = $stmt_check->get_result();
if ($result->num_rows > 0) {
    // If profile exists, update the record
    $sql = "UPDATE profile_info SET role=?, first_name=?, last_name=?, phone_number=?, location=?, self_intro=?, profile_image=? WHERE user_id=?";
} else {
    // If profile doesn't exist, insert a new record
    $sql = "INSERT INTO profile_info (user_id, role, first_name, last_name, phone_number, location, self_intro, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
}

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
if ($result->num_rows > 0) {
    $stmt->bind_param("sssssssi", $category, $first_name, $last_name, $phone, $location, $about, $image, $user_id);
} else {
    $stmt->bind_param("isssssss", $user_id, $category, $first_name, $last_name, $phone, $location, $about, $image);
}

// Move uploaded image to the uploads folder
if (move_uploaded_file($temp_name, $folder.$image)) {
    // File uploaded successfully
} else {
    // Error uploading file
    header("Location: manageprofile.php?error=upload_failed");
    exit();
}

// Execute the statement
if ($stmt->execute() === TRUE) {
    // Profile info added or updated successfully, redirect to profile page or home page
    header("Location: registerUserHomePage.php");
    exit();
} else {
    // Error in adding or updating profile info, redirect back to manage profile page
    header("Location: manageprofile.php?error=upload_failed");
    exit();
}

// Close statement and connection
$stmt->close();
$stmt_check->close();
$conn->close();
?>
