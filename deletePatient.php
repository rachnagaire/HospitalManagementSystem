<?php
include 'db.inc.php'; // Include the database connection file

if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Check if the patientId is valid (numeric)
    if (!is_numeric($patientId)) {
        echo "<script>
                alert('Invalid patient ID.');
                window.location.href = 'dashboard-patient.php'; 
              </script>";
        exit;
    }

    // Begin transaction for consistency
    $conn->begin_transaction();

    try {
        // Step 1: Delete the related user data
        $sql = "DELETE FROM users WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing SQL for deleting user data.");
        }
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new Exception("No user data found for the given patient ID.");
        }
        $stmt->close();

        // Step 2: Delete the patient record from the patient table
        $sql = "DELETE FROM patient WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing SQL for deleting patient record.");
        }
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new Exception("No patient data found for the given patient ID.");
        }
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Redirect with success message
        echo "<script>
                alert('Patient record and related data deleted successfully.');
                window.location.href = 'dashboard-patient.php'; 
              </script>";
    } catch (Exception $e) {
        // Rollback in case of error
        $conn->rollback();

        // Redirect with failure message
        echo "<script>
                alert('Failed to delete patient record and related data. Error: " . $e->getMessage() . "');
                window.location.href = 'dashboard-patient.php'; 
              </script>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "<script>
            alert('No patient ID provided.');
            window.location.href = 'dashboard-patient.php'; 
          </script>";
}
?>
