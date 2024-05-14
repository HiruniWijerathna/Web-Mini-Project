<?php
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

// Create profile_info table
$sql = "CREATE TABLE IF NOT EXISTS profile_info (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    role VARCHAR(100),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    phone_number VARCHAR(20),
    location VARCHAR(255),
    self_intro TEXT,
    profile_image LONGBLOB,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'profile_info' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
?>
