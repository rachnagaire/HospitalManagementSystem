<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
<<<<<<< HEAD
$dbname = "cims"; // Your database name

// Create a connection
$port=3307;
=======
$dbname = "HospitalManagementSystem"; // Your database name

// Create a connection
$port=3308;
>>>>>>> ceaf0d168c6562778983b733f3e5e18f2dbef745
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>