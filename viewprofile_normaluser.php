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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/viewprofile.css">
</head>
<body>

<!-- Header Section -->
<div class="container-fluid px-4 border-bottom shadow-bottom sticky-top" style="background-color: #080433">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="image/logo.png" alt="Your Logo" class="logo">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="registerUserHomePage.php" class="nav-link px-2">Home</a></li>
            <li><a href="registerUserHomePage.php#ReService" class="nav-link px-2">Services</a></li>
            <li><a href="home.php#about" class="nav-link px-2">About</a></li>
            <li><a href="help.php" class="nav-link px-2">Help</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <p id="hh" style="color:White; font-size: 18px">👋 Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </header>
</div>
<!-- Header End -->

<!-- Carousel Section -->
<div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
    <div class="carousel-inner">
        <div class="carousel-item active hover-item">
            <img src="image/normal_user.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1 style="color: white">Normal User Profiles</h1>
                    <p class="opacity-75" style="color:white"><b>Profiles of dedicated individuals making a difference in animal rescue.</b></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profiles Section -->
<div class="container mt-5">
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']); ?></h5>
                            <?php
                            if (!empty($row['profile_image'])) {
                                $imageData = base64_encode($row['profile_image']);
                                $src = 'data:image/jpeg;base64,' . $imageData;
                                echo "<img src='" . $src . "' class='img-fluid' alt='Profile Image'>";
                            } else {
                                echo "<img src='image/profilePhotoLogo.jpg' class='img-fluid' alt='Profile Image'>";
                            }
                            ?>
                            <br><br>
                            <div class="card-footer">
                                <p class="card-text">Location: <?php echo htmlspecialchars($row['location']); ?></p>
                                <button class="btn btn-primary read-more-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#profileModal" 
                                    data-firstname="<?php echo htmlspecialchars($row['first_name']); ?>" 
                                    data-lastname="<?php echo htmlspecialchars($row['last_name']); ?>" 
                                    data-phone="<?php echo htmlspecialchars($row['phone_number']); ?>" 
                                    data-location="<?php echo htmlspecialchars($row['location']); ?>" 
                                    data-selfintro="<?php echo htmlspecialchars($row['self_intro']); ?>" 
                                    data-profileimage="<?php echo !empty($row['profile_image']) ? 'data:image/jpeg;base64,' . base64_encode($row['profile_image']) : 'image/profilePhotoLogo.jpg'; ?>">
                                    Read more
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
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

<!-- Modal Structure -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="modalFullName"></h5>
                <img id="modalProfileImage" class="img-fluid" alt="Profile Image">
                <p id="modalPhoneNumber"></p>
                <p id="modalLocation"></p>
                <p id="modalSelfIntroduction"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<!-- Populate Modal with Data Script -->
<script>
document.querySelectorAll('.read-more-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const modal = new bootstrap.Modal(document.getElementById('profileModal'));
        document.getElementById('modalFullName').innerText = this.getAttribute('data-firstname') + ' ' + this.getAttribute('data-lastname');
        document.getElementById('modalProfileImage').src = this.getAttribute('data-profileimage');
        document.getElementById('modalPhoneNumber').innerText = 'Phone Number: ' + this.getAttribute('data-phone');
        document.getElementById('modalLocation').innerText = 'Location: ' + this.getAttribute('data-location');
        document.getElementById('modalSelfIntroduction').innerText = 'Self Introduction: ' + this.getAttribute('data-selfintro');
        modal.show();
    });
});
// Refresh content on modal close
document.addEventListener('hidden.bs.modal', function (event) {
    if (event.target.id === 'profileModal') {
        location.reload(); // Refreshes the page
    }
});
</script>

</body>
</html>
