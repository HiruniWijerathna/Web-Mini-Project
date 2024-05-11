<?php
$servername = "localhost"; // Change this if your MySQL server is not on localhost
$username = "root"; // Change this if you have a different MySQL username
$password = ""; // Change this if you have set a password for MySQL
$dbname = "beastbuddy_db"; // Change this to your desired database name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Close connection to create new connection to the created database
$conn->close();

// Create new connection to the created database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create tables
$sql_normal_user = "CREATE TABLE IF NOT EXISTS normal_users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$sql_veterinarian = "CREATE TABLE IF NOT EXISTS veterinarians (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$sql_snake_catcher = "CREATE TABLE IF NOT EXISTS snake_catchers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$sql_animal_organization = "CREATE TABLE IF NOT EXISTS animal_organizations (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

// Execute SQL to create tables
if ($conn->query($sql_normal_user) === TRUE && $conn->query($sql_veterinarian) === TRUE && $conn->query($sql_snake_catcher) === TRUE && $conn->query($sql_animal_organization) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

// Close connection
$conn->close();
?>
