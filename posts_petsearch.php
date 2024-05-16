<!-- snake_information.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Search & Rescue | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="css/readpost.css">
</head>
<body>

    <!-- Header Section -->
    <div class="container-fluid px-4 border-bottom shadow-bottom" style="background-color: #080433">
        <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-0 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="image/logo.png" alt="Your Logo" class="logo">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="home.php#myCarousel" class="nav-link px-4 link-secondary">Home</a></li>
                <li><a href="home.php#services" class="nav-link px-4">Services</a></li>
                <li><a href="home.php#about" class="nav-link px-4">About</a></li>
                <li><a href="help.php" class="nav-link px-2">Help</a></li>
            </ul>
        </header>
    </div>
    <!-- End Header Section -->
    <div class="topic"><h3>Pet Search & Rescue</h3></div>

    <!-- Content Section -->
    <div class="container mt-5">
        <!-- Display Snake Information Posts Section -->
        <div class="row">
            <?php
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

            // Fetch snake_information posts from the snake_catchers category
            $sql = "SELECT posts.post_id, posts.title, posts.content, posts.location, posts.image, users.username 
                    FROM posts 
                    INNER JOIN users ON posts.user_id = users.user_id 
                    WHERE posts.category = 'category1'";

            $result = $conn->query($sql);

            // Check if there are posts
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-6 mb-4'>
                            <div class='card'>
                            <img src='uploads/" . $row['image'] . "' class='card-img-top' alt='Post Image'>

                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row["title"] . "</h5>
                                    <p class='card-text'>" . $row["content"] . "</p>
                                    <p class='card-text'><small class='text-muted'>Location: " . $row["location"] . "</small></p>
                                    <p class='card-text'><small class='text-muted'>Posted by: " . $row["username"] . "</small></p>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<div class='col-md-12'><p>No snake information posts found.</p></div>";
            }

            // Close the connection
            $conn->close();
            ?>
        </div>
        <!-- End Display Snake Information Posts Section -->
    </div>
    <!-- End Content Section -->

    <!-- Footer Section -->
    <div class="container-fluid px-4 mt-auto" style="background-color: #080433;">
        <footer class="py-1">
            <div class="row flex-lg-row-align-items-center g-5 " style="background-color: #080433">
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
                        <li class="nav-item mb-2"><a href="https://www.facebook.com/" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                        <li class="nav-item mb-2"><a href="https://www.whatsapp.com/" class="nav-link p-0 text-body-secondary">Whatsapp</a></li>
                        <li class="nav-item mb-2"><a href="https://www.instagram.com/" class="nav-link p-0 text-body-secondary">Instagram</a></li>
                        <li class="nav-item mb-2"><a href="https://www.youtube.com/" class="nav-link p-0 text-body-secondary">Youtube</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-5">
                    <h5 class="text-white">Quick Links</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="home.php#myCarousel" class="nav-link p-0 text-body-secondary">Home</a></li>
                        <li class="nav-item mb-2"><a href="home.php#services" class="nav-link p-0 text-body-secondary">Service</a></li>
                        <li class="nav-item mb-2"><a href="home.php#about" class="nav-link p-0 text-body-secondary">About</a></li>
                    </ul>
                </div>
                <div class="col-12">
                    <p class="text-center descrip">© 2024 BeastBuddy, Inc. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Footer Section -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>
</html>
