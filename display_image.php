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

// Retrieve image data from the database based on the post ID
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $sql = "SELECT image FROM posts WHERE post_id = $postId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Check if image data is not empty
        if (!empty($row['image'])) {
            // Get the MIME type of the image
            $finfo = finfo_open();
            $mimeType = finfo_buffer($finfo, $row['image'], FILEINFO_MIME_TYPE);
            finfo_close($finfo);
            // Set the appropriate content-type header
            header("Content-type: $mimeType");
            // Output the image data
            echo $row['image'];
        } else {
            echo "Image data is empty.";
        }
    } else {
        echo "No image found for the given post ID.";
    }
} else {
    echo "No post ID provided.";
}

// Close the connection
$conn->close();
?>
