<?php
session_start();

if (isset($_POST['comment']) && isset($_POST['post_id'])) {
    // Get form data
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $guest_name = isset($_POST['guest_name']) ? $_POST['guest_name'] : null;

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

    // Insert comment into the database
    $sql = "INSERT INTO comments (post_id, user_id, guest_name, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $post_id, $user_id, $guest_name, $comment);

    if ($stmt->execute()) {
        // Close the connection
        $stmt->close();
        $conn->close();

        // Redirect back to the previous page
        $previous_page = isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : 'readpost.php';

        // Check which page the user commented on
        if (strpos($previous_page, 'posts_events.php') !== false) {
            header("Location: posts_events.php#comments$post_id");
            exit();
        } elseif (strpos($previous_page, 'posts_petsearch.php') !== false) {
            header("Location: posts_petsearch.php#comments$post_id");
            exit();
        } elseif (strpos($previous_page, 'posts_snakes.php') !== false) {
            header("Location: posts_snakes.php#comments$post_id");
            exit();
        } elseif (strpos($previous_page, 'posts_veterinary.php') !== false) {
            header("Location: posts_veterinary.php#comments$post_id");
            exit();
        } else {
            header("Location: $previous_page#comments$post_id");
            exit();
        }
    } else {
        // Close the connection
        $stmt->close();
        $conn->close();

        // Redirect back to the previous page
        $previous_page = isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : 'readpost.php';
        header("Location: $previous_page#comments$post_id");
        exit();
    }
} else {
    // Invalid request
    header("Location: readpost.php");
    exit();
}
?>
