<?php
include 'db.inc.php'; // Your database connection file

// Collect data from the form
$identifier = $_POST['identifier'];
$active = $_POST['active'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birthDate = $_POST['dob'];
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

// Prepare SQL query to insert data
$sql = "INSERT INTO patient (identifier, active, first_name, last_name, gender, birthDate, deathDate, phone, email, marital_status, contact_name, contact_relationship, contact_phone, contact_email, communication_language, general_pracitioner, managing_organization)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssssssisssssss", $identifier, $active, $first_name, $last_name, $gender, $birthDate, $deathDate, $phone, $email, $marital_status, $contact_name, $contact_relationship, $contact_phone, $contact_email, $communication_language, $general_practitioner, $managing_organization);

// Execute the statement
if ($stmt->execute()) {
    echo "Patient registered successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
