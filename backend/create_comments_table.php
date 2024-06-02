<?php
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

// SQL to create or update the comments table
$sql = "
CREATE TABLE IF NOT EXISTS comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NULL,
    guest_name VARCHAR(255) NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

ALTER TABLE comments
    MODIFY user_id INT NULL,
    ADD COLUMN IF NOT EXISTS guest_name VARCHAR(255) NULL AFTER user_id;
";

if ($conn->multi_query($sql) === TRUE) {
    echo "Table 'comments' created or updated successfully";
} else {
    echo "Error creating or updating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
