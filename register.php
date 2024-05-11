<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BeastBuddy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body" style="background-image: url('image/login.jpg'); background-size: cover;">

    <!-- Load the header -->
    <div id="header"></div>
    <script src="js/includeContent.js"></script>

    <!-- register form -->
    <form id="register_form" action="register_process.php" method="post" style="height: 700px;">

        <h1 class="login-h1">Register</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Username" required>
            <label for="floatingUsername">Username</label>
        </div>

        <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
            <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating">
            <select class="form-select" id="floatingCategory" name="category" required>
                <option selected disabled>Select Category</option>
                <option value="Normal User">Normal User</option>
                <option value="Veterinarian">Veterinarian</option>
                <option value="Snake Catcher">Snake Catcher</option>
                <option value="Animal Organization">Animal Organization</option>
            </select>
            <label for="floatingCategory">Category</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
            <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="floatingRePassword" name="repassword" placeholder="Re-enter Password" required>
            <label for="floatingRePassword">Re-enter Password</label>
        </div>

        <button class="login_button btn-primary w-100 py-2" type="submit">Register</button>
        
        <a href="#" class="forgot-password-link">Forgot password?</a>
        
        <p class="mt-3 mb-0">You have an account? <a href="login.html">Login here</a></p>

        <div class="form-floating">
            <h3 class="img">
                <a href="https://www.facebook.com" target="_blank">
                    <img src="image/fb.png" width="70px">
                </a>
                <a href="https://www.instagram.com" target="_blank">
                    <img src="image/ins.png" width="60px">
                </a>
                <a href="https://www.twitter.com" target="_blank">	
                    <img src="image/twe.png" width="70px">
                </a>
            </h3>
        </div>	
    </form>

    <!-- Load the footer -->
    <div id="footer"></div>
    <script src="js/includeFooter.js"></script>

</body>
</html>
