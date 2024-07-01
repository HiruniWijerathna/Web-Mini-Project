<?php
require '../config.php'; // Adjust the path as needed to locate your config.php file

// Function to check if a column exists
function columnExists($conn, $column, $table) {
    $result = $conn->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
    return $result->num_rows > 0;
}

// Add columns if they don't already exist
$queries = [];

if (!columnExists($conn, 'reset_token', 'users')) {
    $queries[] = "ALTER TABLE users ADD COLUMN reset_token VARCHAR(255) AFTER created_at";
}

if (!columnExists($conn, 'token_expiry', 'users')) {
    $queries[] = "ALTER TABLE users ADD COLUMN token_expiry DATETIME AFTER reset_token";
}

if (!columnExists($conn, 'reset_token_expiry', 'users')) {
    $queries[] = "ALTER TABLE users ADD COLUMN reset_token_expiry DATETIME AFTER token_expiry";
}

foreach ($queries as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Column added successfully: $query<br>";
    } else {
        echo "Error adding column: " . $conn->error . "<br>";
    }
}

// Close connection
$conn->close();
?>

