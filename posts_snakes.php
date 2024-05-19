<?php
session_start();
// Start session at the beginning of the file if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Store the current page in the session
$_SESSION['previous_page'] = 'posts_snakes.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snakes Posts | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="css/readspost.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <!--.......................... Header................................ -->
    <?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id']; // Assuming you store user_id in the session
} else {
    $username = '';
    $user_id = '';
}
?>

   <!-- <div id="header"></div> -->
   <!-- Header -->
 <div class="container-fluid px-4 border-bottom shadow-bottom" style="background-color: #080433">
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
      <p id="hh" style="color:White;  font-size: 18px">👋 Hi, <?php echo $username; ?></p>
        
      </div>
   
  </div>
<!-- ......................................header end ...............................-->

      <!-- carousel Section -->
<div style="background-color:rgb(173, 220, 241);">
   <div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
       
       <div class="carousel-inner">
         <div class="carousel-item active hover-item" >
           <img src="image/snakeInformatonMainImage.jpg" class="d-block w-100" alt="Image 2">
           <div class="container">
             <div class="carousel-caption text-start">
               <h1 style="color: black">Read Snake Post🧾📚</h1>
               <p class="opacity-75" style="color:black">Come read, Be aware of snakes.🚀</p>
               </div>
           </div>
         </div>
         
       </div>
  
     </div>
      <!-- serveces section -->
    

    <!-- Content Section -->
    <div class="container mt-5">
        <!-- Display Veterinary Information Posts Section -->
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

            // Fetch veterinary posts
            $sql = "SELECT posts.post_id, posts.user_id, posts.title, posts.content, posts.location, posts.image, users.username 
                    FROM posts 
                    INNER JOIN users ON posts.user_id = users.user_id 
                    WHERE posts.category = 'category3'";

            $result = $conn->query($sql);

            // Check if there are posts
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-6 mb-4'>
                            <div class='card'>
                                <p class='card-text'><small class='text-muted'><img src='image/location.png' class='location_img' alt='location Image'> " . $row["location"] . "</small></p>
                                <img src='uploads/" . $row['image'] . "' class='card-img-top' alt='Post Image'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row["title"] . "</h5>
                                    <p class='card-text'>" . $row["content"] . "</p>
                                    <p class='card-text'><small class='text-muted'>Posted by: " . $row["username"] . "</small></p>";
                    // Show edit and delete buttons if the logged-in user is the owner of the post
                    if ($row["user_id"] == $user_id) {
                        echo "<a href='edit_post.php?post_id=" . $row['post_id'] . "' class='btn btn-primary'>Edit</a>
                              <a href='delete_post.php?post_id=" . $row['post_id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this post?\");'>Delete</a>";
                    }
                    echo "</div></div></div>";
                }
            } else {
                echo "<div class='col-md-12'><p>No veterinary information posts found.</p></div>";
            }

            // Close the connection
            $conn->close();
            ?>
        </div>
        <!-- End Display Veterinary Information Posts Section -->
    </div>
    <!-- End Content Section -->

   <!--...................... Footer............................................. -->
<!-- <div id="footer"></div> -->

<!-- Load Combined JavaScript -->
<!-- <script src="js/includeContent.js"></script> -->
<!-- Footer -->

<div class="container-fluid   px-4   " style="background-color: #080433">
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

            <!-- <div class="col mb-3"> </div> -->

            <div class="col-6 col-md-3 mb-5">
                <h5 class="text-white">Follow Us On</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="https://www.facebook.com/profile.php?id=61559491240781&mibextid=ZbWKwL" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                    <li class="nav-item mb-2"><a href="https://www.instagram.com/__beastbuddy__?igsh=MTZtbGp3bmhzNGk3eA==" class="nav-link p-0 text-body-secondary">Instagram</a></li>
                    <li class="nav-item mb-2"><a href="https://youtube.com/@beastbuddy-2024?si=P8ZBuQ0NL2N8WTv6" class="nav-link p-0 text-body-secondary">Youtube</a></li>
                </ul>
            </div>

            <!-- <div class="col mb-3"></div> -->

            <div class="col-6 col-md-2 mb-5">
                <h5 class="text-white">Quick Links</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="home.php#myCarousel" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="home.php#services" class="nav-link p-0 text-body-secondary">Service</a></li>
                    <li class="nav-item mb-2"><a href="home.php#about" class="nav-link p-0 text-body-secondary">About</a></li>
                    <li class="nav-item mb-2"><a href="home.php#help" class="nav-link p-0 text-body-secondary">Help</a></li>
                </ul>
            </div>

            <!-- <div class="col mb-3"> </div> -->

            <div class="d-flex flex-column flex-sm-row justify-content-center  border-top">
                <p class="descrip">© 2024 BeastBuddy, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>


<!-- ........................footer end ..................................-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <!--.post color change. -->
    <script>
    function changePostColors() {
  const posts = document.querySelectorAll('.card');

  // Choose a logic for color changes (replace with your desired logic)
  // Here, we use a repeating value based on current time (every 5 seconds)
  const currentTime = Math.floor(Date.now() / 1000) % 3; // Repeating value between 0, 1, and 2 every 3 seconds

  for (const post of posts) {
    // Remove existing color classes (optional, ensures only one color is applied)
    post.classList.remove('card-red', 'card-blue', 'card-green');

    // Apply new color class based on chosen logic
    if (currentTime === 0) {
      post.classList.add('card-red');
    } else if (currentTime === 1) {
      post.classList.add('card-blue');
    } else {
      post.classList.add('card-green');
    }
  }
}

// Call the function initially to set initial colors (if not set by PHP)
changePostColors();

// Set an interval to call the function repeatedly (adjust the interval as needed)
setInterval(changePostColors, 5000); // Change color every 5 seconds
</script>
<!--.post color change end -->

</body>
</html>
