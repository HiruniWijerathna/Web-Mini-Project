<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Advice | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="css/animal_Organization.css">
    
</head>
<body style="background-color: rgb(173, 220, 241);">

<?php
session_start(); // Start the session

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = ''; // Set default username if not set
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
        <li><a href="home.php#myCarousel" class="nav-link px-2">Home</a></li>
        <li><a href="home.php#services" class="nav-link px-2">Services</a></li>
        <li><a href="home.php#about" class="nav-link px-2">About</a></li>
        <li><a href="help.php" class="nav-link px-2">Help</a></li>
      </ul>

      <div class="col-md-3 text-end">
      <p id="hh" style="color:White;  font-size: 18px">👋 Hi, <?php echo $username; ?></p>
        
      </div>
   
  </div>
<!-- ......................................header end ...............................-->

   
    <!-- carousel Section -->

    <div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
       
        <div class="carousel-inner">
          <div class="carousel-item active hover-item" >
            <img src="image/VeterinaryDetailsMAinImage.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
              <div class="carousel-caption text-start">
                <h1 style="color: black">Veterinary Details🏥</h1>
                <p class="opacity-75" style="color:black">Get medical advice for your animals from veterinarians themselves</p>
                </div>
            </div>
          </div>
          
        </div>
   
      </div>
       <!-- serveces section -->

       <div>
       

    </div>

    <!-- Content -->
<div class="container mt-4">
    <div class="row gx-4 gy-4">
        <div class="col-md-4">
            <!-- <a href="readMedicalPost.php" class="button-link"> -->
                <button class="serbutt" onclick="window.location.href='posts_veterinary.php';">
                    <img src="image/VeterinaryDetailsPostReadImage.jpg" alt="ManageProfileLogo" width="30%" id="bservice"> <br>Vet Updates
                </button>
            <!-- </a> -->
        </div>
       
        <div class="col-md-4">
            <!-- <a href="VeterinaryDetails.php" class="button-link"> -->
                <button class="serbutt" onclick="window.location.href='viewprofile_veterinarian.php';">
                    <img src="image/VeterinaryDetailsProfilImage.jpg" alt="ReadPost" width="30%" id="bservice"> <br>Veterinary Profile
                </button>
            <!-- </a> -->
        </div>
        
        
    </div>
</div>
<!-- End Content -->
    <!-- End Content -->

    <!-- Footer -->
    <div class="container-fluid px-4 mt-auto" style="background-color: #080433;">
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
    <!-- End Footer -->

</body>
</html>
