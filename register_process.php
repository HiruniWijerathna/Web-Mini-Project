<?php
$servername = "localhost"; // Change this if your MySQL server is not on localhost
$username = "root"; // Change this if you have a different MySQL username
$password = ""; // Change this if you have set a password for MySQL
$dbname = "beastbuddy_db"; // Change this to your desired database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$category = $_POST['category'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

// Check if passwords match
if ($password != $repassword) {
    echo "Passwords do not match";
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement based on category
switch ($category) {
    case 'Normal User':
        $table = "normal_users";
        break;
    case 'Veterinarian':
        $table = "veterinarians";
        break;
    case 'Snake Catcher':
        $table = "snake_catchers";
        break;
    case 'Animal Organization':
        $table = "animal_organizations";
        break;
    default:
        echo "Invalid category";
        exit();
}

// SQL to insert data
$sql = "INSERT INTO $table (username, email, password) VALUES (?, ?, ?)";

// Prepare and execute SQL statement
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
