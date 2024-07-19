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

// Fetch profiles of users with category "Animal Organization"
$sql = "SELECT * FROM profile_info WHERE user_id IN (SELECT user_id FROM users WHERE category = 'Animal Organization')";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Organization Profiles | BeastBuddy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/viewprofile.css">
</head>
<body>

<!-- Add your header here -->
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
<!-- Header End -->

<!-- Carousel Section -->
<div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
    <div class="carousel-inner">
        <div class="carousel-item active hover-item">
            <img src="image/AnimalOrganization.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1 style="color: White">Animal Organizations Profiles</h1>
                    <p class="opacity-75" style="color:white">Explore our committed animal organizations working tirelessly to rescue and protect animals in need.</p>
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
                            <h5 class="card-title"><?php echo htmlspecialchars($row['organization_name']); ?></h5>
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
                            <div class="card-footer" style="background-color:white">
                                
                                    <p class="card-text">Organization Type: <?php echo htmlspecialchars($row['organization_type']); ?></p>
                                    <p class="card-text">Registration Number: <?php echo htmlspecialchars($row['registration_number']); ?></p>
                                    <br>
                                <div class="more-content" style="display: none;">
                                    <p class="card-text">Contact Person: <?php echo htmlspecialchars($row['contact_person']); ?></p>
                                    <p class="card-text">Contact Number: <?php echo htmlspecialchars($row['contact_number']); ?></p>
                                    <p class="card-text">Services Offered: <?php echo htmlspecialchars($row['services_offered']); ?></p>
                                    <p class="card-text">Volunteering Opportunities: <?php echo htmlspecialchars($row['volunteering_opportunities']); ?></p>
                                    <p class="card-text">Donation Info: <?php echo htmlspecialchars($row['donation_info']); ?></p>
                                    <p class="card-text">Events: <?php echo htmlspecialchars($row['events']); ?></p>
                                </div>
                                
                                <button class="read-more-btn">Read more</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No Animal Organization Profiles found.";
        }

        // Close connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<!-- See More in Card Script -->
<script>
document.querySelectorAll('.read-more-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const moreContent = this.previousElementSibling;
        const dots = moreContent.previousElementSibling;
        
        if (moreContent.style.display === "none") {
            moreContent.style.display = "block";
            dots.style.display = "none";
            this.innerHTML = "Read less";
        } else {
            moreContent.style.display = "none";
            dots.style.display = "inline";
            this.innerHTML = "Read more";
        }
    });
});
</script>

<!-- Footer Section -->
<div class="container-fluid px-4" style="background-color: #080433">
    <footer class="py-1">
        <div class="row flex-lg-row-align-items-center g-5" style="background-color: #080433">
            <div class="col-md-4 offset-md-1 mb-5">
                <form>
                    <div class="text-white">
                        <h5>BeastBuddy</h5>
                        <p class="descrip">Dedicated to saving lives, one paw at a time. <br>Our passionate team connects animals with loving homes, making a difference in the world of animal rescue.</p>
                    </div>
                </form>
            </div>
            <div class="col-6 col-md-3 mb-5">
                <h5 class="text-white">Follow Us On</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="https://www.facebook.com/profile.php?id=61559491240781&mibextid=ZbWKwL" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                    <li class="nav-item mb-2"><a href="https://www.instagram.com/__beastbuddy__?igsh=MTZtbGp3bmhzNGk3eA==" class="nav-link p-0 text-body-secondary">Instagram</a></li>
                    <li class="nav-item mb-2"><a href="https://youtube.com/@beastbuddy-2024?si=P8ZBuQ0NL2N8WTv6" class="nav-link p-0 text-body-secondary">Youtube</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-2 mb-5">
                <h5 class="text-white">Quick Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="home.php#myCarousel" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="home.php#services" class="nav-link p-0 text-body-secondary">Service</a></li>
                    <li class="nav-item mb-2"><a href="home.php#about" class="nav-link p-0 text-body-secondary">About</a></li>
                    <li class="nav-item mb-2"><a href="home.php#help" class="nav-link p-0 text-body-secondary">Help</a></li>
                </ul>
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-center border-top">
                <p class="descrip">© 2024 BeastBuddy, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
