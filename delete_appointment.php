<?php
include 'db.inc.php'; // Include database connection

if (isset($_GET['id'])) {
    $appointment_id = intval($_GET['id']); // Get appointment ID and sanitize input

    // Delete query
    $sql = "DELETE FROM appointment WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $appointment_id);

    if ($stmt->execute()) {
        header("Location: dashboard-appointment.php"); // Redirect with success message
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
