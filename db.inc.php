<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "HospitalManagementSystem"; // Your database name

// Create a connection
$port=3308;
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>