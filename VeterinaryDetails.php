<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VeterinaryDetails</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
           
            .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
            }

            .title {
            color: grey;
            font-size: 18px;
            }

            button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            }

            a {
            text-decoration: none;
            font-size: 22px;
            color: black;
            }

            button:hover, a:hover {
            opacity: 0.7;
            }

            * {
            box-sizing: border-box;
            }

            body {
            font-family: Arial, Helvetica, sans-serif;
            }

            /* Float four columns side by side */
            .column {
            float: left;
            width: 25%;
            padding: 0 10px;
            }

            /* Remove extra left and right margins, due to padding */
            .row {margin: 0 -5px;}

            /* Clear floats after the columns */
            .row:after {
            content: "";
            display: table;
            clear: both;
            }

            /* Responsive columns */
            @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
            }

            /* Style the counter cards */
            .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            text-align: center;
            background-color: #f1f1f1;
            }
      
            .body{
                padding: 50px;
            }
    </style>
    
    </head>
    <body style="background-color: #DAF1F5;">
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
        <!--Body of the page-->
        <div class="body">

            <div>
            <div>
                <h1 class="login-h1">Veterinary Details</h1>
               
            </div>
            <div>
                <label for="Location">Location</label>

                <select name="Location" id="Location">
                <option value="Colombo">Colombo</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kaluthara">Kaluthara</option>
                <option value="Kandy">Kandy</option>
                </select>
            </div>
            <br>
            </div>

            <!--Profile Cart-->
            <div class="row">
                <!--First Column-->
                <div class="column">
                    <div class="card">
                        <img src="image/ManageProfileLogo.png" alt="John" style="width:100%">
                        <h1>John Doe</h1>
                        <p class="title">Doctor</p>
                        <p>Sabaragamuwa University</p>
                        <div style="margin: 24px 0;">
                            <a href="#"><i class="fa fa-dribbble"></i></a> 
                            <a href="#"><i class="fa fa-twitter"></i></a>  
                            <a href="#"><i class="fa fa-linkedin"></i></a>  
                            <a href="#"><i class="fa fa-facebook"></i></a> 
                        </div>
                        <p><button>Contact</button></p>
                        </div>
                </div>
                <!--Second Column-->
                <div class="column">
                        <div class="card">
                            <img src="image/ManageProfileLogo.png" alt="John" style="width:100%">
                            <h1>John Doe</h1>
                            <p class="title">Doctor</p>
                            <p>Sabaragamuwa University</p>
                            <div style="margin: 24px 0;">
                                <a href="#"><i class="fa fa-dribbble"></i></a> 
                                <a href="#"><i class="fa fa-twitter"></i></a>  
                                <a href="#"><i class="fa fa-linkedin"></i></a>  
                                <a href="#"><i class="fa fa-facebook"></i></a> 
                            </div>
                            <p><button>Contact</button></p>
                        </div>
                </div>
                <!--Third Column-->
                <div class="column">
                        <div class="card">
                            <img src="image/ManageProfileLogo.png" alt="John" style="width:100%">
                            <h1>John Doe</h1>
                            <p class="title">Doctor</p>
                            <p>Sabaragamuwa University</p>
                            <div style="margin: 24px 0;">
                                <a href="#"><i class="fa fa-dribbble"></i></a> 
                                <a href="#"><i class="fa fa-twitter"></i></a>  
                                <a href="#"><i class="fa fa-linkedin"></i></a>  
                                <a href="#"><i class="fa fa-facebook"></i></a> 
                            </div>
                            <p><button>Contact</button></p>
                            </div>
                </div>
                <!--Fourth Column-->
                <div class="column">
                    <div class="card">
                        <img src="image/ManageProfileLogo.png" alt="John" style="width:100%;">
                        <h1>John Doe</h1>
                        <p class="title">Doctor</p>
                        <p>Sabaragamuwa University</p>
                        <div style="margin: 24px 0;">
                            <a href="#"><i class="fa fa-dribbble"></i></a> 
                            <a href="#"><i class="fa fa-twitter"></i></a>  
                            <a href="#"><i class="fa fa-linkedin"></i></a>  
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </div>
                        <p><button>Contact</button></p>
                    </div>
                </div>
                
            </div>
        </div>
        <br><br>
        <!--Footer-->
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
          
    </body>
</html>