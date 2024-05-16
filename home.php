<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home|BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css\style.css">
  </head>
  <body style="background-color: #DAF1F5;">
   <!--.......................... Header................................ -->
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
        <li><a href="home.php#myCarousel" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="home.php#services" class="nav-link px-2">Services</a></li>
        <li><a href="home.php#about" class="nav-link px-2">About</a></li>
        <li><a href="home.php#help" class="nav-link px-2">Help</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <button type="button" class="btn btn-outline-primary me-4 btn-custom" onclick="window.location.href='register.php';">Register</button>
        <button type="button" class="btn btn-primary btn-custom" onclick="window.location.href='login.php';">Login</button>
      </div>
    </header>
  </div>
<!-- ......................................header end ...............................-->
   
    <!-- carousel Section -->

    <div id="myCarousel" class="carousel slide mb-6 pointer-event" data-bs-ride="carousel" style="margin-top: -0.1rem">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active hover-item" >
            <img src="image\carousel-img1.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
              <div class="carousel-caption text-start">
                <h1>Discover New Friends!</h1>
                <p class="opacity-75">Explore a world of amazing creatures with BeastBuddy.</p>
                <button type="button" class="btn btn-primary-join btn-lg px-4 gap-3 text-floating" onclick="window.location.href='login.php';">Join with us</button>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="image\carousel-img2.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
              <div class="carousel-caption">
                <h1>Experience the Adventure!</h1>
                <p>Explore the world with our trusted veterinary services.</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="image\carousel-img3.jpg" class="d-block w-100" alt="Image 2">
            <div class="container">
              <div class="carousel-caption text-end">
                <h1>Join the BeastBuddy Community!</h1>
                <p> Connect with fellow adventurers and share your experiences. </p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

  <!-- serveces section -->
<div id="services" class="container-fluid py-5">
    <h1 class="display-5 fw-bold text-body-emphasis" style="text-align: center;">Services</h1>

    <div class="row">
        <div class="col-lg-3 service-item">
            <svg class="bd-placeholder-img rounded-circle" width="220" height="220" xmlns="http://www.w3.org/2000/svg"
                role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                <image href="image\ReadPost.jpeg" width="220" height="220" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal " ></h2>
            <p><a class="btn btn-secondary" href="readpost.php">Read post »</a></p>

        </div><!-- /.col-lg-3 -->
        <div class="col-lg-3 service-item">
            <svg class="bd-placeholder-img rounded-circle" width="220" height="220" xmlns="http://www.w3.org/2000/svg"
                role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                <image href="image\vet.jpeg" width="220" height="220" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal"></h2>
            <p><a class="btn btn-secondary" href="veterinary_advice.php">Veterinary advice »</a></p>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-3 service-item">
            <svg class="bd-placeholder-img rounded-circle" width="220" height="220" xmlns="http://www.w3.org/2000/svg"
                role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                <image href="image\animalOrganization.jpeg" width="220" height="220" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal"></h2>
            <p><a class="btn btn-secondary" href="animal_Organization.php">Animal Organization »</a></p>
        </div><!-- /.col-lg-3 -->
        <div class="col-lg-3 service-item">
            <svg class="bd-placeholder-img rounded-circle" width="220" height="220" xmlns="http://www.w3.org/2000/svg"
                role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                <image href="image\snakeinfor.jpeg" width="220" height="220" fill="var(--bs-secondary-color)" />
            </svg>
            <h2 class="fw-normal"></h2>
            <p><a class="btn btn-secondary" href="snakeInformation.php">Snake Information »</a></p>
        </div>
    </div>
</div>

<!-- About -->
<div id="about" class="px-4 py-5 my-5 text-center">
    <h1 class="display-5 fw-bold text-body-emphasis">About</h1>
    <div class="col-lg-8 mx-auto py-3">
      <p class="lead mb-4 about-text">Certainly! Creating a platform that connects concerned individuals, local authorities, animal welfare organizations, and volunteers can make a big difference for animals in distress worldwide. Let's work together to improve animal welfare!</p>
    </div>
  </div>

  <!-- help -->
  <div id="help" class="px-4 py-5 my-5 text-center">
  <h1 class="display-5 fw-bold text-body-emphasis">Welcome to Our Website Help Center</h1>
  <div class="col-lg-8 mx-auto py-3">
      <p class="lead mb-4 about-text">At BeastBuddy ,If you have any questions or encounter issues, you're in the right place. Below, you'll find helpful resources and answers to common inquiries.</p>
      <h2 style="text-align: left;">Questions </h2>
      <ol class="helpqu"> 
            <li>How do I create an account?</li> 
            <li>I forgot my password. How can I reset it?</li> 
            <li>How to login to the website?</li> 
            <li>How to create posts?</li> 
            <li>How to read posts?</li> 
            <li>How to read posts related to the following categories?
              <ul>
                <li>Vet Updates</li>
                <li>Community Events</li>
                <li>Read Snake Post</li>
              </ul>
            </li> 

            <li>How to view the profiles of the following
            <ul>
                <li>Veterinary Profile</li>
                <li>Animal Organizations Profile</li>
                <li>Snake Catchers Profile</li>
              </ul>
            </li> 
        </ol>  
        <h3><div style="font-size: 22px;">All these questions are answered in the video below, See now...</h3>

        <h3>Video</h3> 
        <iframe width="560" height="315" src="https://www.youtube.com/embed/fcyshDExRuQ?si=ifBXL9-cbdsmbItz" frameborder="0" allowfullscreen></iframe>  
        


      </div>
    </div>


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

          


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>


    
</body>

</html>