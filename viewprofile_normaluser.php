<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("User not logged in. Please log in to access this page.");
}

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'beastbuddy');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch profiles of users with category "Normal User"
$sql = "SELECT * FROM profile_info WHERE user_id IN (SELECT user_id FROM users WHERE category = 'Normal User')";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Normal User Profiles | BeastBuddy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Add your header here -->

<div class="container mt-5">
    <h1>Normal User Profiles</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</h5>";
                echo "<p class='card-text'>Phone Number: " . htmlspecialchars($row['phone_number']) . "</p>";
                echo "<p class='card-text'>Location: " . htmlspecialchars($row['location']) . "</p>";
                echo "<p class='card-text'>Self Introduction: " . htmlspecialchars($row['self_intro']) . "</p>";
                if (!empty($row['profile_image'])) {
                    $imageData = base64_encode($row['profile_image']);
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    echo "<img src='" . $src . "' class='img-fluid' alt='Profile Image'>";
                } else {
                    echo "<img src='image/profilePhotoLogo.jpg' class='img-fluid' alt='Profile Image'>";
                }
                
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No Normal User Profiles found.";
        }

        // Close connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
