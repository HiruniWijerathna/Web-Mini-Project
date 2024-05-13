<?php
session_start(); // Start the session if not already started

// Check if the user is logged in, assuming user_id is stored in $_SESSION
if (!isset($_SESSION['user_id'])) {
    // Redirect user to the login page if not logged in
    header("Location: login.php"); // Change this to your login page
    exit();
}

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
$title = $_POST['title'];
$category = $_POST['category'];
$about = $_POST['about'];
$location = $_POST['location'];

// Retrieve user_id from session
$user_id = $_SESSION['user_id'];

// Upload image
$image = $_FILES['image']['name'];
$temp_name = $_FILES['image']['tmp_name'];
$folder = "uploads/"; // Create a folder named "uploads" in your project directory

// Move uploaded image to the uploads folder
move_uploaded_file($temp_name, $folder.$image);

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO posts (user_id, title, category, content, image, location) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $user_id, $title, $category, $about, $image, $location);

// Execute the statement
if ($stmt->execute() === TRUE) {
    // Post created successfully, redirect to home.php or post details page
    header("Location: readpost.php"); // Change this to the appropriate page
    exit();
} else {
    // Error in creating post, redirect back to createPost.php
    header("Location: createPost.php?error=upload_failed"); // Optionally, you can pass an error parameter
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
