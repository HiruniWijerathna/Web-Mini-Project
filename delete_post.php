<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Check if post_id is provided in the URL
if (!isset($_GET['post_id'])) {
    header("Location: registerUserHomePage.php"); // Redirect to home page if post_id is not provided
    exit();
}

// Include database connection file
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

// Sanitize the post_id parameter
$post_id = filter_input(INPUT_GET, 'post_id', FILTER_SANITIZE_NUMBER_INT);

// Fetch the post from the database based on post_id
$sql = "SELECT * FROM posts WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $post = $result->fetch_assoc();

    // Check if the logged-in user is the owner of the post
    if ($post['user_id'] != $_SESSION['user_id']) {
        // Redirect to home page or display an error message
        header("Location: registerUserHomePage.php");
        exit();
    }
} else {
    // Redirect to home page or display an error message
    header("Location: registerUserHomePage.php");
    exit();
}

// If user confirms deletion, execute SQL DELETE statement to remove the post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Execute SQL DELETE statement to remove the post from the database
    $sql = "DELETE FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    // Redirect to previous page
    if (isset($_SESSION['previous_page'])) {
        header("Location: " . $_SESSION['previous_page']);
    } else {
        header("Location: registerUserHomePage.php"); // Redirect to home page if previous page is not set
    }
    exit();
}

// Close database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="css/editPost.css">
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
           <img src="image/DeletePostMainImage.jpg" class="d-block w-100" alt="Image 2">
           <div class="container">
             <div class="carousel-caption text-start">
               <h1 style="color: white">Are you sure you want to delete this post?
             <br>This action cannot be undone.</h1>
               
               </div>
           </div>
         </div>
         
       </div>
  
     </div>
      <!-- serveces section -->


<div id="formm">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?post_id=' . $post_id; ?>" method="post">
    <input type="submit" value="Yes">
</form>
<br>
<form action="<?php echo isset($_SESSION['previous_page']) ? $_SESSION['previous_page'] : 'registerUserHomePage.php'; ?>" method="get">
    <button id="bno" type="submit">No</button>
</form>

    </div>

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
</body>
</html>
