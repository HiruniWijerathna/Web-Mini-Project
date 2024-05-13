<?php
// Retrieve the post_id from the URL
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

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

    // Fetch image data from the database
    $sql = "SELECT image FROM posts WHERE post_id = ?";
    
    // Prepare and bind the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    
    // Execute the statement
    $stmt->execute();
    
    // Bind the result variables
    $stmt->bind_result($image_data);
    
    // Fetch the image data
    if ($stmt->fetch()) {
        // Output the image
        header("Content-type: image/jpeg"); // Change this according to your image type
        echo $image_data;
    } else {
        // If no image found, output a placeholder image or error message
        echo "Image not found";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If post_id is not provided in the URL, show an error message
    echo "Post ID not provided";
}
?>
