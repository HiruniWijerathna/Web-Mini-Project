<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection details
$servername = "localhost"; // Change this to your server name if it's not localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "beastbuddy"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$category = $_POST['category'];
$user_id = $_SESSION['user_id'];

// Initialize variables for all possible fields to avoid undefined index errors
$first_name = $last_name = $phone = $location = $about = "";
$name_with_initials = $specializations = $clinic_name = $license_number = $experience = "";
$availability = $services_offered = $organization_name = $organization_type = $registration_number = "";
$contact_person = $contact_number = $volunteering_opportunities = $donation_info = $events = "";
$areas_of_operation = "";

// Set up the variables based on the category
if ($category == 'Normal User') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone_number'];
    $location = $_POST['location'];
    $about = $_POST['self_intro'];
} elseif ($category == 'Veterinarian') {
    $name_with_initials = $_POST['name_with_initials'];
    $specializations = $_POST['specializations'];
    $clinic_name = $_POST['clinic_name'];
    $license_number = $_POST['license_number'];
    $experience = $_POST['experience'];
    $availability = $_POST['availability'];
    $services_offered = $_POST['services_offered'];
} elseif ($category == 'Animal Organization') {
    $organization_name = $_POST['organization_name'];
    $organization_type = $_POST['organization_type'];
    $registration_number = $_POST['registration_number'];
    $contact_person = $_POST['contact_person'];
    $contact_number = $_POST['contact_number'];
    $services_offered = $_POST['services_offered'];
    $volunteering_opportunities = $_POST['volunteering_opportunities'];
    $donation_info = $_POST['donation_info'];
    $events = $_POST['events'];
} elseif ($category == 'Snake Catcher') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $experience = $_POST['experience'];
    $areas_of_operation = $_POST['areas_of_operation'];
    $availability = $_POST['availability'];
    $contact_number = $_POST['contact_number'];
    $services_offered = $_POST['services_offered'];
}

// Upload profile image
$image_filename = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['size'] > 0) {
    $image = file_get_contents($_FILES['profile_image']['tmp_name']);
    // Debugging: Check if image is read correctly
    if ($image === false) {
        echo "Failed to read image file.";
        exit();
    }

    // Generate a unique filename for the uploaded image
    $image_filename = uniqid() . '_' . $_FILES['profile_image']['name'];
    // Move the uploaded image to the profile_uploads directory
    $upload_path = 'profile_uploads/' . $image_filename;
    if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
        echo "Failed to move uploaded file.";
        exit();
    }
} else {
    echo "No image uploaded or image size is 0.";
    exit();
}


// Check if a profile exists for this user
$sql_check = "SELECT * FROM profile_info WHERE user_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $user_id);
$stmt_check->execute();
$result = $stmt_check->get_result();


    if ($result->num_rows > 0) {
        // If profile exists, update the record
        if ($category == 'Normal User') {
            $sql = "UPDATE profile_info SET category=?, first_name=?, last_name=?, phone_number=?, location=?, self_intro=?, profile_image=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $category, $first_name, $last_name, $phone, $location, $about, $image, $user_id);
        } elseif ($category == 'Veterinarian') {
            $sql = "UPDATE profile_info SET category=?, name_with_initials=?, specializations=?, clinic_name=?, license_number=?, experience=?, availability=?, services_offered=?, profile_image=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssi", $category, $name_with_initials, $specializations, $clinic_name, $license_number, $experience, $availability, $services_offered, $image, $user_id);
        } elseif ($category == 'Animal Organization') {
            $sql = "UPDATE profile_info SET category=?, organization_name=?, organization_type=?, registration_number=?, contact_person=?, contact_number=?, services_offered=?, volunteering_opportunities=?, donation_info=?, events=?, profile_image=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssi", $category, $organization_name, $organization_type, $registration_number, $contact_person, $contact_number, $services_offered, $volunteering_opportunities, $donation_info, $events, $image, $user_id);
        } elseif ($category == 'Snake Catcher') {
            $sql = "UPDATE profile_info SET category=?, first_name=?, last_name=?, experience=?, areas_of_operation=?, availability=?, contact_number=?, services_offered=?, profile_image=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssssssi', $category, $first_name, $last_name, $experience, $areas_of_operation, $availability, $contact_number, $services_offered, $image, $user_id);
        }
        
        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Profile info updated successfully, redirect to profile page or home page
            header("Location: manageProfile.php");
            exit();
        } else {
            // Error in updating profile info
            echo "Error: " . $stmt->error;
            exit();
        }
    }
    else {
        // If profile doesn't exist, insert a new record
        if ($category == 'Normal User') {
            $sql = "INSERT INTO profile_info (user_id, category, first_name, last_name, phone_number, location, self_intro, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssssss", $user_id, $category, $first_name, $last_name, $phone, $location, $about, $image);
        } elseif ($category == 'Veterinarian') {
            $sql = "INSERT INTO profile_info (user_id, category, name_with_initials, specializations, clinic_name, license_number, experience, availability, services_offered, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssssssss", $user_id, $category, $name_with_initials, $specializations, $clinic_name, $license_number, $experience, $availability, $services_offered, $image);
        }
        elseif ($category == 'Animal Organization') {
            $sql = "INSERT INTO profile_info (user_id, category, organization_name, organization_type, registration_number, contact_person, contact_number, services_offered, volunteering_opportunities, donation_info, events, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssssssssss", $user_id, $category, $organization_name, $organization_type, $registration_number, $contact_person, $contact_number, $services_offered, $volunteering_opportunities, $donation_info, $events, $image);
        }
        elseif ($category == 'Snake Catcher') {
            $sql = "INSERT INTO profile_info (user_id, category, first_name, last_name, experience, areas_of_operation, availability, contact_number, services_offered, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('isssssssss', $user_id, $category, $first_name, $last_name, $experience, $areas_of_operation, $availability, $contact_number, $services_offered, $image);
        }
        
        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Profile info added successfully, redirect to profile page or home page
            header("Location: registerUserHomePage.php");
            exit();
        } else {
            // Error in adding profile info
            echo "Error: " . $stmt->error;
            exit();
        }
    }
    
// Close statement and connection
$stmt->close();
$stmt_check->close();
$conn->close();
?>
