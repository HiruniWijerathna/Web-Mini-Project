<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BeastBuddy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body" style="background-image: url('image/loginMainImag.jpg'); background-size: cover;">

    <div class="container-fluid px-4 border-bottom shadow-bottom" style="background-color: #080433">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="home.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="image/logo.png" alt="Your Logo" class="logo">
                </a>
            </div>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="home.php#myCarousel" class="nav-link px-2">Home</a></li>
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

    <form id="login_form" action="login_setup.php" method="post">
        <h1 class="login-h1">Login</h1><br>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <button class="login_button btn-primary w-100 py-2" type="submit">Login</button>
        
        <a href="forgot_password_page.php" class="forgot-password-link">Forgot password?</a>
        
        <p class="mt-3 mb-0" style="color: white;">Don't have an account? <a href="register.php">Register here</a></p><br>

        <div class="form-floating">
            <h3 class="img">
                <a href="https://www.facebook.com" target="_blank">
                    <img src="image/fb.png" width="45px">
                </a>
                <a href="https://www.instagram.com" target="_blank">
                    <img src="image/ins.png" width="45px">
                </a>
                <a href="https://www.twitter.com" target="_blank">  
                    <img src="image/twe.png" width="45px">
                </a>
            </h3>
        </div>
    </form>

    <div class="container-fluid px-4" style="background-color: #080433">
        <footer class="py-1">
            <div class="row flex-lg-row-align-items-center g-5" style="background-color: #080433">
                <div class="col-md-4 offset-md-1 mb-5">
                    <div class="text-white">
                        <h5>BeastBuddy</h5>
                        <p class="descrip">Dedicated to saving lives, one paw at a time. Our passionate team connects animals with loving homes, making a difference in the world of animal rescue.</p>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-5">
                    <h5 class="text-white">Follow Us On</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="https://www.facebook.com/profile.php?id=61559491240781&mibextid=ZbWKwL" class="nav-link p-0 text-body-secondary">Facebook</a></li>
                        <li class="nav-item mb-2"><a href="https://www.instagram.com/__beastbuddy__?igsh=MTZtbGp3bmhzNGk3eA==" class="nav-link p-0 text-body-secondary">Instagram</a></li>
                        <li class="nav-item mb-2"><a href="https://youtube.com/@beastbuddy-2024?si=P8ZBuQ0NL2N8WTv6" class="nav-link p-0 text-body-secondary">YouTube</a></li>
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
            </div>
            <div class="d-flex justify-content-between py-1 my-1 border-top" style="background-color: #080433">
                <p style="color: white;">&copy; 2024 BeastBuddy. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
