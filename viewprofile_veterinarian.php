<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Profiles | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css\viewprofile.css">
</head>

<body>

    <!-- Header -->
    <div class="container-fluid px-4 border-bottom shadow-bottom" style="background-color: #080433">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="image/logo.png" alt="Your Logo" class="logo">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="home.php#myCarousel" class="nav-link px-2">Home</a></li>
                <li><a href="home.php#services" class="nav-link px-2">Services</a></li>
                <li><a href="home.php#about" class="nav-link px-2">About</a></li>
                <li><a href="help.php" class="nav-link px-2">Help</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <p id="hh" style="color:White;  font-size: 18px">👋 Hi, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></p>

            </div>

        </header>
    </div>
    <!-- Header End -->

    <div class="container mt-5">
        <h2>Veterinarian Profiles</h2>
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "beastbuddy";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch profiles of users with role "Veterinarian"
        $sql = "SELECT * FROM profile_info WHERE role = 'Veterinarian'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card mt-3'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row['first_name'] . " " . $row['last_name'] . "</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>Phone: " . $row['phone_number'] . "</h6>";
                echo "<p class='card-text'>Location: " . $row['location'] . "</p>";
                echo "<p class='card-text'>About: " . $row['self_intro'] . "</p>";

                // Check if image exists for this profile
                if (file_exists("profile_uploads/" . $row['profile_image'])) {
                    // If image exists, display it
                    echo "<img src='profile_uploads/" . $row['profile_image'] . "' class='img-fluid' alt='Profile Image'>";
                } else {
                    // If image doesn't exist, display a default image or a placeholder
                    echo "<img src='image\profilePhotoLogo.jpg' class='img-fluid' alt='Profile Image'>";
                }

                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No Veterinarian profiles found.";
        }

        // Close connection
        $conn->close();
        ?>
    </div>

    <!-- Footer -->
    <div class="container-fluid px-4 " style="background-color: #080433">
        <footer class="py-1">
            <div class="row flex-lg-row-align-items-center g-5 " style="background-color: #080433">

                <div class="col-md-4 offset-md-1 mb-5">
                    <form>
                        <div class="text-white">
                            <h5>BeastBuddy</h5>
                            <p class="descrip">Dedicated to saving lives, one paw at a time. <br>Our passionate team
                                connects animals with loving homes, making a difference in the world of animal rescue.</p>
                        </div>
                    </form>
                </div>

                <div class="col-6 col-md-3 mb-5">
                    <h5 class="text-white">Follow Us On</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Whatsapp</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Intagram</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Youtube</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-5">
                    <h5 class="text-white">Quick Links</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Service</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                    </ul>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-center  border-top">
                    <p class="descrip">© 2024 BeastBuddy, Inc. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- Footer End -->

</body>

</html>
