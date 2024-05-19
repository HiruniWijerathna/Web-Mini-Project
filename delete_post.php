<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Check if post_id is provided in the URL
if (!isset($_GET['post_id'])) {
    header("Location: registerUserHomePage.php"); // Redirect to home page if post_id is not provided
    exit();
}

// Include database connection file
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

// Sanitize the post_id parameter
$post_id = filter_input(INPUT_GET, 'post_id', FILTER_SANITIZE_NUMBER_INT);

// Fetch the post from the database based on post_id
$sql = "SELECT * FROM posts WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $post = $result->fetch_assoc();

    // Check if the logged-in user is the owner of the post
    if ($post['user_id'] != $_SESSION['user_id']) {
        // Redirect to home page or display an error message
        header("Location: registerUserHomePage.php");
        exit();
    }
} else {
    // Redirect to home page or display an error message
    header("Location: registerUserHomePage.php");
    exit();
}

// If user confirms deletion, execute SQL DELETE statement to remove the post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Execute SQL DELETE statement to remove the post from the database
    $sql = "DELETE FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    // Redirect to previous page
    if (isset($_SESSION['previous_page'])) {
        header("Location: " . $_SESSION['previous_page']);
    } else {
        header("Location: registerUserHomePage.php"); // Redirect to home page if previous page is not set
    }
    exit();
}

// Close database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post | BeastBuddy</title>
</head>
<body>
    <h1>Delete Post</h1>
    <p>Are you sure you want to delete this post?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?post_id=' . $post_id; ?>" method="post">
        <input type="submit" value="Yes">
        <a href="<?php echo isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : 'registerUserHomePage.php'; ?>">No</a>
    </form>
</body>
</html>
