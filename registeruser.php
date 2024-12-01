<?php
include 'db.inc.php'; // Your database connection file

// Collect data from the form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birthDate = $_POST['birthDate'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username']; // Collect the username from the form
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if passwords match
if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit();
}

// Hash the password before saving to the database
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Prepare SQL query to insert data into the users table
$sql = "INSERT INTO users (username, first_name, last_name, gender, birthDate, phone_number, email, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters (match the number of values with the placeholders)
$stmt->bind_param(
    "ssssssss", 
    $username, $first_name, $last_name, $gender, $birthDate, 
    $phone, $email, $password_hash
);

// Execute the query
if ($stmt->execute()) {
    echo "User registered successfully.";
    echo '<a href="/HospitalManagementSystem/signin.php" class="link mx-auto">Go to Sign In page</a>';
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
