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

// Fetch profiles of users with category "Snake Catcher"
$sql = "SELECT * FROM profile_info WHERE user_id IN (SELECT user_id FROM users WHERE category = 'Snake Catcher')";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake Catcher Profiles | BeastBuddy</title>
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
            <p id="hh" style="color: White; font-size: 18px">👋 Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </header>
</div>
<!-- Header End -->

<!-- Carousel Section -->
<div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
    <div class="carousel-inner">
        <div class="carousel-item active hover-item">
            <img src="image/snake_catcher.jpg" class="d-block w-100" alt="Snake Catcher">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1 style="color: white">Snake Catcher Profiles</h1>
                    <p class="opacity-75" style="color: white"><b>Meet our skilled and dedicated snake catchers, ready to help with safe and humane snake removal.</b></p>
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
                            <?php
                            if (!empty($row['profile_image'])) {
                                $imageData = base64_encode($row['profile_image']);
                                $src = 'data:image/jpeg;base64,' . $imageData;
                                echo "<img src='" . $src . "' class='img-fluid' alt='Profile Image' style='width: 100%; height: auto;'>";
                            } else {
                                echo "<img src='image/profilePhotoLogo.jpg' class='img-fluid' alt='Profile Image' style='width: 100%; height: auto;'>";
                            }
                            ?>
                            <h5 class="card-title mt-3"><?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?></h5>
                            <p class="card-text">Experience: <?php echo htmlspecialchars($row['experience']); ?></p>
                            <button class="btn btn-primary read-more-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#profileModal" 
                                data-name="<?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?>" 
                                data-experience="<?php echo htmlspecialchars($row['experience']); ?>" 
                                data-areas="<?php echo htmlspecialchars($row['areas_of_operation']); ?>" 
                                data-availability="<?php echo htmlspecialchars($row['availability']); ?>" 
                                data-contact="<?php echo htmlspecialchars($row['contact_number']); ?>" 
                                data-services="<?php echo htmlspecialchars($row['services_offered']); ?>" 
                                data-profileimage="<?php echo !empty($row['profile_image']) ? 'data:image/jpeg;base64,' . base64_encode($row['profile_image']) : 'image/profilePhotoLogo.jpg'; ?>">
                                Read more
                            </button>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No Snake Catcher Profiles found.";
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
                <h5 id="modalName"></h5>
                <img id="modalProfileImage" class="img-fluid" alt="Profile Image">
                <p id="modalExperience"></p>
                <p id="modalAreas"></p>
                <p id="modalAvailability"></p>
                <p id="modalContact"></p>
                <p id="modalServices"></p>
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
        document.getElementById('modalName').innerText = this.getAttribute('data-name');
        document.getElementById('modalProfileImage').src = this.getAttribute('data-profileimage');
        document.getElementById('modalExperience').innerText = 'Experience: ' + this.getAttribute('data-experience');
        document.getElementById('modalAreas').innerText = 'Areas of Operation: ' + this.getAttribute('data-areas');
        document.getElementById('modalAvailability').innerText = 'Availability: ' + this.getAttribute('data-availability');
        document.getElementById('modalContact').innerText = 'Contact Number: ' + this.getAttribute('data-contact');
        document.getElementById('modalServices').innerText = 'Services Offered: ' + this.getAttribute('data-services');
        modal.show();
    });
});

// Refresh content on modal close
document.addEventListener('hidden.bs.modal', function (event) {
    location.reload();
});
</script>

</body>
</html>
