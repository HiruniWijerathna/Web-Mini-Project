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

// Fetch profiles of users with category "Veterinarian"
$sql = "SELECT * FROM profile_info WHERE user_id IN (SELECT user_id FROM users WHERE category = 'Veterinarian')";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Profiles | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/viewprofile.css">
</head>
<body>

<!-- Header Section -->
<div class="container-fluid px-4 border-bottom shadow-bottom sticky-top" style="background-color: #080433">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="image/logo.png" alt="Your Logo" class="logo">
            </a>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="registerUserHomePage.php" class="nav-link px-2 ">Home</a></li>
            <li><a href="registerUserHomePage.php#ReService" class="nav-link px-2">Services</a></li>
            <li><a href="home.php#about" class="nav-link px-2">About</a></li>
            <li><a href="help.php" class="nav-link px-2">Help</a></li>
        </ul>
        <div class="col-md-3 text-end">
            <p id="hh" style="color:White;  font-size: 18px">👋 Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </header>
</div>

<!-- Carousel Section -->
<div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
    <div class="carousel-inner">
        <div class="carousel-item active hover-item">
            <img src="image/veterinarian_viewprofile.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1 style="color: black">Veterinarian Profiles</h1>
                    <p class="opacity-75" style="color:black"><b>Discover our compassionate veterinarians dedicated to the health and well-being of rescued animals.</b></p>
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
                echo "<div class='col-md-4 mb-3'>";
                echo "<div class='card border-primary'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($row['name_with_initials']) . "</h5>";

                if (!empty($row['profile_image'])) {
                    $imageData = base64_encode($row['profile_image']);
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    echo "<img src='" . $src . "' class='img-fluid' alt='Profile Image'>";
                } else {
                    echo "<img src='image/profilePhotoLogo.jpg' class='img-fluid' alt='Profile Image'>";
                }

                echo "<br><br>";

                echo "<div class='card-footer'>";
                echo "<p class='card-text'>Specializations: " . htmlspecialchars($row['specializations']) . "</p>";
                echo "<p class='card-text'>License Number: " . htmlspecialchars($row['license_number']) . "</p>";
                echo "<button class='btn btn-primary read-more-btn' data-bs-toggle='modal' data-bs-target='#profileModal' 
                    data-name='" . htmlspecialchars($row['name_with_initials']) . "' 
                    data-specializations='" . htmlspecialchars($row['specializations']) . "' 
                    data-clinicname='" . htmlspecialchars($row['clinic_name']) . "' 
                    data-license='" . htmlspecialchars($row['license_number']) . "' 
                    data-experience='" . htmlspecialchars($row['experience']) . "' 
                    data-availability='" . htmlspecialchars($row['availability']) . "' 
                    data-services='" . htmlspecialchars($row['services_offered']) . "' 
                    data-image='" . (!empty($row['profile_image']) ? 'data:image/jpeg;base64,' . base64_encode($row['profile_image']) : 'image/profilePhotoLogo.jpg') . "'>
                    Read more
                </button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No Veterinarian Profiles found.";
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
                <h5 class="modal-title" id="profileModalLabel">Veterinarian Profile Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="profileImage" src="" class="img-fluid" alt="Profile Image">
                    </div>
                    <div class="col-md-8">
                        <h5 id="profileName"></h5>
                        <p><strong>Specializations:</strong> <span id="profileSpecializations"></span></p>
                        <p><strong>Clinic Name:</strong> <span id="profileClinicName"></span></p>
                        <p><strong>License Number:</strong> <span id="profileLicense"></span></p>
                        <p><strong>Experience:</strong> <span id="profileExperience"></span></p>
                        <p><strong>Availability:</strong> <span id="profileAvailability"></span></p>
                        <p><strong>Services Offered:</strong> <span id="profileServices"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script>
    // JavaScript to handle modal data population
    document.addEventListener('DOMContentLoaded', function () {
        var profileModal = document.getElementById('profileModal');
        profileModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var modalTitle = profileModal.querySelector('.modal-title');
            var profileName = profileModal.querySelector('#profileName');
            var profileSpecializations = profileModal.querySelector('#profileSpecializations');
            var profileClinicName = profileModal.querySelector('#profileClinicName');
            var profileLicense = profileModal.querySelector('#profileLicense');
            var profileExperience = profileModal.querySelector('#profileExperience');
            var profileAvailability = profileModal.querySelector('#profileAvailability');
            var profileServices = profileModal.querySelector('#profileServices');
            var profileImage = profileModal.querySelector('#profileImage');

            modalTitle.textContent = button.getAttribute('data-name');
            profileName.textContent = button.getAttribute('data-name');
            profileSpecializations.textContent = button.getAttribute('data-specializations');
            profileClinicName.textContent = button.getAttribute('data-clinicname');
            profileLicense.textContent = button.getAttribute('data-license');
            profileExperience.textContent = button.getAttribute('data-experience');
            profileAvailability.textContent = button.getAttribute('data-availability');
            profileServices.textContent = button.getAttribute('data-services');
            profileImage.src = button.getAttribute('data-image');
        });
    });
</script>

</body>
</html>
