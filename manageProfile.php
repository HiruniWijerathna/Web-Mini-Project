<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
    <link rel="stylesheet" href="css\manageprofile.css">
    
    <script src="js\manageprofile.js"></script>

</head>
<body style ="background-color: rgb(173, 220, 241);">
<div>

   <!-- header begin -->
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
        <li><a href="contact.php" class="nav-link px-2">Contact</a></li>
      </ul>

      <div class="col-md-3 text-end">
      <p id="hh" style="color:White;  font-size: 18px">👋 Hi, <?php echo $username; ?></p>
        
      </div>
   
  </div>
<!-- ......................................header end ...............................-->
<div>

  <!-- content begin-->
  <div class="container" style=" margin-bottom: 45px; margin-left: 0px; padding-left: 0px;">
    <div class="row">
        <!-- Image Upload -->
        <div class="col-md-6">
            <div id="descriptionPart">
                <!-- <h3>Add Your Photo</h3> -->
                <input type="file" id="uploadInput" accept="image/*" onchange="previewImage(event)">
                <button onclick="removePhoto()">Remove Photo</button>
                <img id="preview" src="image/profilePhotoLogo.jpg" alt="Preview Image">
                <p><span id="displayText"></span> <span id="displaText"></span></p>
            </div>
        </div>

        <!-- Profile Settings --> 
      
        <div class="col-md-6" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="detailpart">
                <h2>Profile Setting</h2>
                <form action="/action">
                    <input type="text" id="fname" name="firstname" placeholder="First Name" onkeyup="updateText()">
                    <br>
                    <input type="text" id="lname" name="lastname" placeholder="Last Name" onkeyup="updatText()">
                    <br>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number">
                    <br>
                    <input type="text" id="country" name="country" placeholder="Country">
                    <br>
                    <input type="text" id="state" name="state" placeholder="State">
                    <br>
                    <textarea id="about" name="about" placeholder="Write something about yourself.." rows="4"></textarea>
                    <br>
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- content end -->
       
</div>  
    <!-- footer begin -->
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
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Whatsapp</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Intagram</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Youtube</a></li>
              </ul>
          </div>

          <!-- <div class="col mb-3"></div> -->

          <div class="col-6 col-md-2 mb-5">
              <h5 class="text-white">Quick Links</h5>
              <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Service</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
              </ul>
          </div>

          <!-- <div class="col mb-3"> </div> -->

          <div class="d-flex flex-column flex-sm-row justify-content-center  border-top">
              <p class="descrip">© 2024 BeastBuddy, Inc. All rights reserved.</p>
          </div>
      </div>
  </footer>
</div>


    <!-- footer end -->
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


</body>
</html>