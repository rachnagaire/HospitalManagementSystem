<?php 
// Database connection
include 'db.inc.php';

// Fetch appointment details
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    $sql = "SELECT 
                appointment.appointment_id, 
                appointment.appointment_status, 
                appointment.appointment_type,
                appointment.reason,
                appointment.priority,
                CONCAT(practitioner.first_name, ' ', practitioner.last_name) AS doctor, 
                CONCAT(patient.first_name, ' ', patient.last_name) AS patient,
                start_time,
                end_time,
                location,
                price,
                appointment.patient_id, 
                appointment.practitioner_id
            FROM 
                appointment
            JOIN 
                patient ON appointment.patient_id = patient.patient_id
            JOIN 
                practitioner ON appointment.practitioner_id = practitioner.practitioner_id
            WHERE 
                appointment.appointment_id = '$appointment_id';";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        die("Appointment not found.");
    }
} else {
    die("No appointment ID provided.");
}

// Fetch patients and doctors for dropdown options
$patients_sql = "SELECT patient_id, CONCAT(first_name, ' ', last_name) AS patient_name FROM patient";
$patients_result = $conn->query($patients_sql);

$doctors_sql = "SELECT practitioner_id, CONCAT(first_name, ' ', last_name) AS doctor_name FROM practitioner";
$doctors_result = $conn->query($doctors_sql);

// Status options (from the enum definition)
$status_options = [
'pending', 'booked', 'arrived', 'fulfilled', 'cancelled',
     'waitlist'
];

// Handle form submission (if any)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_status = $_POST['appointment_status'] ?? null;
    $appointment_type = $_POST['appointment_type'] ?? null;
    $reason = $_POST['reason'] ?? null;
    $priority = $_POST['priority'] ?? null;
    $start_time = $_POST['start_time'] ?? null;
    $end_time = $_POST['end_time'] ?? null;
    $location = $_POST['location'] ?? null;
    $charge = $_POST['charge'] ?? null;
    $patient_id = $_POST['patient_id'] ?? null;
    $practitioner_id = $_POST['practitioner_id'] ?? null;

    // Validate required fields
    if ($appointment_status && $appointment_type && $start_time && $end_time && $patient_id && $practitioner_id) {
        // Update query
        $update_sql = "UPDATE appointment SET
                            appointment_status = '$appointment_status',
                            appointment_type = '$appointment_type',
                            reason = '$reason',
                            priority = '$priority',
                            start_time = '$start_time',
                            end_time = '$end_time',
                            location = '$location',
                            price = '$charge',
                            patient_id = '$patient_id',
                            practitioner_id = '$practitioner_id'
                        WHERE appointment_id = '$appointment_id'";

        if ($conn->query($update_sql) === TRUE) {
            // Redirect to the appointment list page after successful update
            header("Location: dashboard-appointment.php");
            exit; // Make sure to call exit after header to stop further script execution
        } else {
            echo "<div class='alert alert-danger'>Error updating appointment: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Please fill in all required fields.</div>";
    }
}

$conn->close();
?>
