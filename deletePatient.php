<?php
include 'db.inc.php'; // Include the database connection file

if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // SQL query to delete the patient record
    $sql = "DELETE FROM patient WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patientId);

    if ($stmt->execute()) {
        // Redirect back to the patient list page
        echo "<script>
                alert('Patient record deleted successfully.');
                window.location.href = 'patientList.php'; // Adjust with your list page
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete patient record.');
                window.location.href = 'patientList.php'; // Adjust with your list page
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
