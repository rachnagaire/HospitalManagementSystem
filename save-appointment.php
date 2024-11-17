<?php
// Include the database connection
include 'db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $practitioner_id = $_POST['doctor_id']; // Use doctor_id from the form
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = isset($_POST['reason']) ? $_POST['reason'] : null;

    // Fetch doctor's first and last name from the practitioner table
    $sql_practitioner = "SELECT first_name, last_name FROM practitioner WHERE practitioner_id = ?";
    $stmt_practitioner = $conn->prepare($sql_practitioner);
    $stmt_practitioner->bind_param("i", $practitioner_id);
    $stmt_practitioner->execute();
    $result_practitioner = $stmt_practitioner->get_result();
    $doctor = $result_practitioner->fetch_assoc();

    if ($doctor) {
        $practitioner_first_name = $doctor['first_name'];
        $practitioner_last_name = $doctor['last_name'];

        // Insert or update patient details in the `patient` table
        $sql_patient = "INSERT INTO patient (first_name, last_name, phone, email) 
                        VALUES (?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE 
                        first_name = VALUES(first_name), 
                        last_name = VALUES(last_name), 
                        phone = VALUES(phone)";
        $stmt_patient = $conn->prepare($sql_patient);
        $stmt_patient->bind_param("ssss", $first_name, $last_name, $phone_number, $email);
        if ($stmt_patient->execute()) {
            // Get patient ID (auto-incremented or existing)
            $patient_id = $conn->insert_id ?: $conn->query("SELECT patient_id FROM patient WHERE email = '$email'")->fetch_assoc()['patient_id'];

            // Insert appointment details into the `appointment` table
            $sql_appointment = "INSERT INTO appointment (
                patient_id, practitioner_id, practitioner_first_name, practitioner_last_name, 
                appointment_date, appointment_time, reason, appointment_status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, 'booked')"; // Set status as 'booked'
            $stmt_appointment = $conn->prepare($sql_appointment);
            $stmt_appointment->bind_param(
                "iisssss", 
                $patient_id, $practitioner_id, $practitioner_first_name, $practitioner_last_name, 
                $appointment_date, $appointment_time, $reason
            );

            if ($stmt_appointment->execute()) {
                // Update the status of all rows in the database to 'booked'
                $update_status_sql = "UPDATE appointment SET appointment_status = 'booked' WHERE appointment_status IS NULL OR appointment_status = ''";
                if ($conn->query($update_status_sql) === TRUE) {
                    echo "Appointment booked successfully, and all statuses updated to 'booked'.";
                } else {
                    echo "Error updating status: " . $conn->error;
                }

                echo '<a href="/HospitalManagementSystem/index.php" class="link mx-auto">Go to Landing Page</a>';
            } else {
                echo "Error saving appointment: " . $stmt_appointment->error;
            }
            $stmt_appointment->close();
        } else {
            echo "Error saving patient: " . $stmt_patient->error;
        }
        $stmt_patient->close();
    } else {
        echo "Error: Practitioner not found.";
    }
    $stmt_practitioner->close();
}

$conn->close();
?>
