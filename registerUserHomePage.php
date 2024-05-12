<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegisteredUserHome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style ="background-color: rgb(173, 220, 241);">
    <!-- Header -->
    <div class="container-fluid px-4 border-bottom shadow-bottom" style="background-color: #080433">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom ">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="image/logo.png" alt="Your Logo" class="logo">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2">Services</a></li>
                <li><a href="#" class="nav-link px-2">About</a></li>
                <li><a href="#" class="nav-link px-2">Contact</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-4 btn-custom" onclick="window.location.href='register.html';">Register</button>
                <button type="button" class="btn btn-primary btn-custom" onclick="window.location.href='login.html';">Login</button>
            </div>
        </header>
    </div>
    <!-- End Header -->

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col">
                <ul>
                    <div class="button-container1">
                        <button class="serbutt"><img src="image/ManageProfileLogo.png" alt="ManageProfileLogo" width="45%" height="45%" id="bservice"> <br>Manage Profile</button>
                    </div>
                    <div class="button-container2">
                        <button class="serbutt"><img src="image/createPostLogo.jpg" alt="createPostLogo" width="45%" height="45%" id="bservice"> <br>Create Post</button>
                    </div>
                    <div class="button-container3">
                        <button class="serbutt"><img src="image/ReadPost.jpeg" alt="ReadPost" width="45%" height="45%" id="bservice"> <br>Read Post</button>
                    </div>
                    <div class="button-container4">
                        <button class="serbutt"><img src="image/vet.jpeg" alt="vet" width="45%" height="45%" id="bservice"> <br>Veterinary Advice</button>
                    </div>
                    <div class="button-container5">
                        <button class="serbutt"><img src="image/animalOrganization.jpeg" alt="animalOrganization" width="45%" height="45%" id="bservice"> <br>Animal Organization</button>
                    </div>
                    <div class="button-container6">
                        <button class="serbutt"><img src="image/snakeinfor.jpeg" alt="snakeinfor" width="45%" height="45%" id="bservice"> <br>Snake Information</button>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Footer -->
    <div class="container-fluid px-4 " style="background-color: #080433; margin-top: auto;">
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
    <!-- End Footer -->

</body>
</html>