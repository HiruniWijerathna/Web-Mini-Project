// backend\profileinfo_table_setup.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "beastbuddy";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create profile_info table
$sql = "CREATE TABLE IF NOT EXISTS profile_info (
    profile_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    category VARCHAR(100),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    phone_number VARCHAR(20),
    location VARCHAR(100),
    self_intro TEXT,
    name_with_initials VARCHAR(100),
    specializations VARCHAR(100),
    clinic_name VARCHAR(100),
    license_number VARCHAR(50),
    experience TEXT,
    availability VARCHAR(100),
    services_offered TEXT,
    organization_name VARCHAR(100),
    organization_type VARCHAR(100),
    registration_number VARCHAR(50),
    contact_person VARCHAR(100),
    contact_number VARCHAR(20),
    mission_statement TEXT,
    volunteering_opportunities TEXT,
    donation_info TEXT,
    events TEXT,
    certification_details TEXT,
    areas_of_operation TEXT,
    profile_image LONGBLOB,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'profile_info' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
?>
