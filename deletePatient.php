<?php
include 'db.inc.php'; // Include the database connection file

if (isset($_GET['id'])) {
    $patientId = $_GET['id'];

    // Begin transaction for consistency
    $conn->begin_transaction();

    try {
        // Step 1: Delete related records manually if not set to cascade (you can add more dependent tables here if necessary)
        
        // Check and delete from the address table (if foreign key is not cascading)
        $sql = "DELETE FROM address WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        $stmt->close();

        // You can also add other dependent tables like `appointment`, `invoice`, `users` (based on your structure)
        
        // Example for other dependent tables:
        $sql = "DELETE FROM appointment WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        $stmt->close();

        $sql = "DELETE FROM invoice WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        $stmt->close();

        $sql = "DELETE FROM users WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
        $stmt->close();

        // Step 2: Delete the patient record from the patient table
        $sql = "DELETE FROM patient WHERE patient_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patientId);
        $stmt->execute();
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
