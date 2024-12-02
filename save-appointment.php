<?php
// Include the database connection
include 'db.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];  // Trim email to remove any extra spaces
    $practitioner_id = $_POST['doctor_id']; // Use doctor_id from the form
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $reason = isset($_POST['reason']) ? $_POST['reason'] : null; // Handle reason properly
    $address = $_POST['address']; // Address field

    // Check if email is empty and handle it accordingly
    if (empty($email)) {
        $email = 'no-email-provided@example.com';  // Replace this with a default email or an error message
    }

    // Check if the email already exists in the patient table
    $sql_check_email = "SELECT patient_id FROM patient WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $result_email = $stmt_check_email->get_result();

    if ($result_email->num_rows > 0) {
        // Email exists, just get the patient_id
        $patient = $result_email->fetch_assoc();
        $patient_id = $patient['patient_id'];
    } else {
        // Insert new patient if email does not exist
        $sql_patient = "INSERT INTO patient (first_name, last_name, phone, email, address) 
                        VALUES (?, ?, ?, ?, ?)";
        $stmt_patient = $conn->prepare($sql_patient);
        $stmt_patient->bind_param("sssss", $first_name, $last_name, $phone_number, $email, $address);

        if ($stmt_patient->execute()) {
            $patient_id = $conn->insert_id; // Get the newly inserted patient_id
        } else {
            echo "Error saving patient: " . $stmt_patient->error;
            exit;
        }
        $stmt_patient->close();
    }

    // Ensure reason is not null and handle it
    $reason = $reason ? $reason : '';
    $reason = 'booked';
    // Insert appointment record with status explicitly set to 'booked'
    $sql_appointment = "INSERT INTO appointment (
        patient_id, practitioner_id, appointment_date, start_time, reason, appointment_status
    ) VALUES (?, ?, ?, ?, ?, ?)"; // Explicitly set status to 'booked'

    $stmt_appointment = $conn->prepare($sql_appointment);
    $stmt_appointment->bind_param(
        "iissss", 
        $patient_id, $practitioner_id, $appointment_date, $appointment_time, $reason,$status
    );

    if ($stmt_appointment->execute()) {
        // Success message
        echo "Appointment booked successfully.";

        // Check if the user is logged in
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // User is logged in, provide link to the booking list
            echo '<a href="dashboard-appointment.php" class="link mx-auto">Go to Booking List</a>';
        } else {
            // User is not logged in, provide link to the landing page
            echo '<a href="index.php" class="link mx-auto">Go to Landing Page</a>';
        }
    } else {
        echo "Error saving appointment: " . $stmt_appointment->error;
    }
    $stmt_appointment->close();
}
var_dump($patient_id, $practitioner_id, $appointment_date, $appointment_time, $reason);

$conn->close();
?>

