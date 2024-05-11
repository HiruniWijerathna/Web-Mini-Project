<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user data based on category
    $sql = "SELECT id, email, password, 'Normal User' AS category FROM normal_users WHERE email = ?
            UNION
            SELECT id, email, password, 'Veterinarian' AS category FROM veterinarians WHERE email = ?
            UNION
            SELECT id, email, password, 'Snake Catcher' AS category FROM snake_catchers WHERE email = ?
            UNION
            SELECT id, email, password, 'Animal Organization' AS category FROM animal_organizations WHERE email = ?";
    
    // Prepare and execute SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $email, $email, $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['category'] = $row['category'];

                // Redirect to registerUserHomePage.php or any other page you want after login
                header("Location: registerUserHomePage.php");
                exit();
            } else {
                // Password is incorrect
                echo "Invalid email or password";
            }
        } else {
            // User not found
            echo "Invalid email or password";
        }
        $stmt->close();
    }

    $conn->close();
}
?>
