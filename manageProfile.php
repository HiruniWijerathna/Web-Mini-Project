<?php
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    die("User not logged in. Please log in to access this page.");
}

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'beastbuddy');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user information
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}

$category = $user['category'] ?? null;

if (!$category) {
    die("User category not defined.");
}

// Retrieve profile information
$query = "SELECT * FROM profile_info WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Profile | BeastBuddy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/manageprofile.css">
</head>
<body style="background-color:rgb(173, 220, 241);">
    <!-- Add your header here -->

        <!--.......................... Header................................ -->
        <?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id']; // Assuming you store user_id in the session
    // Store current page URL in session
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
} else {
    $username = '';
    $user_id = null;
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
        <li><a href="about.php" class="nav-link px-2 ">About</a></li>
        <li><a href="help.php" class="nav-link px-2">Help</a></li>
      </ul>

      <div class="col-md-3 text-end">
      <p id="hh" style="color:White;  font-size: 18px">👋 Hi, <?php echo $username; ?></p>
        
      </div>
   
  </div>
<!-- ......................................header end ...............................-->


    <div class="container mt-5">
        <h1 style="text-align: center;">Manage Profile</h1>
        <div class="col-md-4">
            <div id="descriptionPart">
            <div id="showimg-container">
                                <!-- Display the user's profile image -->
                                <?php if (!empty($profile_data['profile_image']) && file_exists('profile_uploads/' . $profile_data['profile_image'])): ?>
                                    <img id="showimg" src="profile_uploads/<?php echo $profile_data['profile_image']; ?>" alt="Profile Image">
                                <?php else: ?>
                                    <!-- Default profile image if user hasn't uploaded any -->
                                    <img id="showimg" src="image\profilePhotoLogo.jpg" alt="Default Profile Image">
                                <?php endif; ?>
                            </div><br>
                <p><span id="displayText"></span> <span id="displaText"></span></p>
            </div>
        </div>

        <!-- Profile Form -->
        <form id="profile_form" action="manageprofile_setup.php" method="post" enctype="multipart/form-data">
        <div class="formm">
            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">

            


            
            <!-- Category Specific Fields -->
            <?php if ($category == 'Normal User') { ?>
                <!-- Normal User Fields -->
              
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($profile['first_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($profile['last_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($profile['phone_number'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($profile['location'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="self_intro">Self Introduction</label>
                    <textarea class="form-control" id="self_intro" name="self_intro"><?php echo htmlspecialchars($profile['self_intro'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                
                </div>
                
            <?php } elseif ($category == 'Veterinarian') { ?>
                <!-- Veterinarian Fields -->
                
                <div class="form-group">
                    <label for="name_with_initials">Name with Initials</label>
                    <input type="text" class="form-control" id="name_with_initials" name="name_with_initials" value="<?php echo htmlspecialchars($profile['name_with_initials'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="specializations">Specializations</label>
                    <input type="text" class="form-control" id="specializations" name="specializations" value="<?php echo htmlspecialchars($profile['specializations'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="clinic_name">Clinic Name</label>
                    <input type="text" class="form-control" id="clinic_name" name="clinic_name" value="<?php echo htmlspecialchars($profile['clinic_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="license_number">License Number</label>
                    <input type="text" class="form-control" id="license_number" name="license_number" value="<?php echo htmlspecialchars($profile['license_number'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="experience">Experience</label>
                    <textarea class="form-control" id="experience" name="experience"><?php echo htmlspecialchars($profile['experience'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="availability">Availability</label>
                    <input type="text" class="form-control" id="availability" name="availability" value="<?php echo htmlspecialchars($profile['availability'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="services_offered">Services Offered</label>
                    <textarea class="form-control" id="services_offered" name="services_offered"><?php echo htmlspecialchars($profile['services_offered'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                
                </div>
            <?php } elseif ($category == 'Animal Organization') { ?>
                <!-- Animal Organization Fields -->
             
                <div class="form-group">
                    <label for="organization_name">Organization Name</label>
                    <input type="text" class="form-control" id="organization_name" name="organization_name" value="<?php echo htmlspecialchars($profile['organization_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="organization_type">Organization Type</label>
                    <input type="text" class="form-control" id="organization_type" name="organization_type" value="<?php echo htmlspecialchars($profile['organization_type'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="registration_number">Registration Number</label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo htmlspecialchars($profile['registration_number'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo htmlspecialchars($profile['contact_person'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($profile['contact_number'] ?? ''); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="services_offered">Services Offered</label>
                    <textarea class="form-control" id="services_offered" name="services_offered"><?php echo htmlspecialchars($profile['services_offered'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="volunteering_opportunities">Volunteering Opportunities</label>
                    <textarea class="form-control" id="volunteering_opportunities" name="volunteering_opportunities"><?php echo htmlspecialchars($profile['volunteering_opportunities'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="donation_info">Donation Info</label>
                    <textarea class="form-control" id="donation_info" name="donation_info"><?php echo htmlspecialchars($profile['donation_info'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="events">Events</label>
                    <textarea class="form-control" id="events" name="events"><?php echo htmlspecialchars($profile['events'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                
                </div>
            <?php } elseif ($category == 'Snake Catcher') { ?>
                <!-- Snake Catcher Fields -->
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($profile['first_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($profile['last_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="experience">Experience</label>
                    <textarea class="form-control" id="experience" name="experience"><?php echo htmlspecialchars($profile['experience'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="areas_of_operation">Areas of Operation</label>
                    <textarea class="form-control" id="areas_of_operation" name="areas_of_operation"><?php echo htmlspecialchars($profile['areas_of_operation'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="availability">Availability</label>
                    <input type="text" class="form-control" id="availability" name="availability" value="<?php echo htmlspecialchars($profile['availability'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($profile['contact_number'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="services_offered">Services Offered</label>
                    <textarea class="form-control" id="services_offered" name="services_offered"><?php echo htmlspecialchars($profile['services_offered'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" id="profile_img" name="profile_image" accept="image/*" placeholder="Profile_img">
                </div>
                
            <?php } ?>

                 <!-- Common Field for All Categories -->
            
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Save Profile</button><br>
            </div>
            </div>
        </form><br><br><br>
     
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg+pEN4JfE1VV5DEQWlmvYEEeb1DX0J62wWCB+NfEk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-qVBUCqC2H67JbWlkStok4N3sZjktBz+7fvh+AN9An58B2OmPjwlyESa6eRsGM0El" crossorigin="anonymous"></script>

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
