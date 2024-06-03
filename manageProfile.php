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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Add your header here -->

    <div class="container mt-5">
        <h1>Manage Profile</h1>

        <!-- Profile Form -->
        <form id="profile_form" action="manageprofile_setup.php" method="post" enctype="multipart/form-data">
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
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                </div>
            <?php } ?>

            <!-- Common Field for All Categories -->
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Save Profile</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg+pEN4JfE1VV5DEQWlmvYEEeb1DX0J62wWCB+NfEk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-qVBUCqC2H67JbWlkStok4N3sZjktBz+7fvh+AN9An58B2OmPjwlyESa6eRsGM0El" crossorigin="anonymous"></script>
</body>
</html>
