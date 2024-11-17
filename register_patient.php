<?php
include 'db.inc.php'; // Your database connection file

// Collect data from the form
<<<<<<< HEAD
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birthDate = $_POST['birthDate'];
=======
$identifier = $_POST['identifier'];
$active = $_POST['active'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birthDate = $_POST['dob'];
>>>>>>> ceaf0d168c6562778983b733f3e5e18f2dbef745
$phone = $_POST['phone'];
$email = $_POST['email'];
$marital_status = $_POST['marital_status'];
$contact_name = $_POST['contact_name'];
$contact_relationship = $_POST['contact_relationship'];
$contact_phone = $_POST['contact_phone'];
$contact_email = $_POST['contact_email'];
$communication_language = $_POST['communication_language'];
$general_practitioner = $_POST['general_practitioner'];
$managing_organization = $_POST['managing_organization'];

<<<<<<< HEAD
// Check if deathDate is provided, if not, set it to NULL
$deathDate = isset($_POST['deathDate']) && !empty($_POST['deathDate']) ? $_POST['deathDate'] : NULL;

// Set status as "active" by death field
$active = $deathDate ? 0 : 1;

// Prepare SQL query to insert data (no need to include `identifier` as it is auto-generated)
$sql = "INSERT INTO patient (active, first_name, last_name, gender, birthDate, deathDate, phone, email, marital_status, contact_name, contact_relationship, contact_phone, contact_email, communication_language, general_practitioner, managing_organization)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters (match the number of values with the placeholders)
$stmt->bind_param(
    "ssssssssssssssss", 
    $active, $first_name, $last_name, $gender, $birthDate, 
    $deathDate, $phone, $email, $marital_status, $contact_name, 
    $contact_relationship, $contact_phone, $contact_email, 
    $communication_language, $general_practitioner, $managing_organization
);

// Execute the query
=======
// Prepare SQL query to insert data
$sql = "INSERT INTO patient (identifier, active, first_name, last_name, gender, birthDate, deathDate, phone, email, marital_status, contact_name, contact_relationship, contact_phone, contact_email, communication_language, general_pracitioner, managing_organization)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssssssisssssss", $identifier, $active, $first_name, $last_name, $gender, $birthDate, $deathDate, $phone, $email, $marital_status, $contact_name, $contact_relationship, $contact_phone, $contact_email, $communication_language, $general_practitioner, $managing_organization);

// Execute the statement
>>>>>>> ceaf0d168c6562778983b733f3e5e18f2dbef745
if ($stmt->execute()) {
    echo "Patient registered successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
