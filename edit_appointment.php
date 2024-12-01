<?php
// Start session
session_start();
// Include the database connection
include 'db.inc.php';
// Check if the user is logged in (assuming the username is stored in the session after login)
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Username from session

    // Prepare SQL to fetch user details
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Bind the username to the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the username exists in the database
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userName = $user['username']; // Fetch the username
    } else {
        // Default value if no user is found (you might want to handle this case differently)
        $userName = "Unknown User";
    }

    $stmt->close();
} else {
    // If no session found, set a default username
    $userName = "Guest";
}

// Validate appointment ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $appointment_id = intval($_GET['id']);

    // Fetch appointment details
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
                appointment.appointment_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        die("Appointment not found.");
    }
    $stmt->close();
} else {
    die("Invalid or no appointment ID provided.");
}

// Fetch patients and doctors for dropdown options
$patients_sql = "SELECT patient_id, CONCAT(first_name, ' ', last_name) AS patient_name FROM patient";
$patients_result = $conn->query($patients_sql);

$doctors_sql = "SELECT practitioner_id, CONCAT(first_name, ' ', last_name) AS doctor_name FROM practitioner";
$doctors_result = $conn->query($doctors_sql);

// Status options (from the enum definition)
$status_options = ['pending', 'booked', 'arrived', 'fulfilled', 'cancelled', 'waitlist'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_status = $_POST['appointment_status'];
    $appointment_type = $_POST['appointment_type'];
    $reason = $_POST['reason'];
    $priority = $_POST['priority'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $location = $_POST['location'];
    $price = $_POST['charge'];
    $patient_id = $_POST['patient_id'];
    $practitioner_id = $_POST['practitioner_id'];

    // Update query
    $update_sql = "UPDATE appointment SET
                        appointment_status = ?,
                        appointment_type = ?,
                        reason = ?,
                        priority = ?,
                        start_time = ?,
                        end_time = ?,
                        location = ?,
                        price = ?,
                        patient_id = ?,
                        practitioner_id = ?
                    WHERE appointment_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param(
        "ssssssssiii",
        $appointment_status,
        $appointment_type,
        $reason,
        $priority,
        $start_time,
        $end_time,
        $location,
        $price,
        $patient_id,
        $practitioner_id,
        $appointment_id
    );

    if ($stmt->execute()) {
        // Redirect to the appointment list page after successful update
        header("Location: dashboard-appointment.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error updating appointment: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

$conn->close();
?>
<?php include 'backend/header-b.php' ?>



<div class="container-fluid display-table">
    <div class="row display-table-row">
        <?php include 'sidebar.php'?>
        <div class="col-md-10 col-sm-11 display-table-cell v-align dashboard-main">
            <div class="row">
                <header class="dashboard-header">
                    <div class="col-md-7">
                        <nav class="navbar-default pull-left">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="form-control input-lg" placeholder="Type to search..." />
                                        <span class="input-group-btn">
                                            <button class="btn btn-info btn-lg" type="button">
                                            <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span><?php echo htmlspecialchars($userName); ?></span>
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                        <div class="navbar-content">
                                            <span><?php echo htmlspecialchars($userName); ?></span>
                                            <p class="text-muted small"></p>
                                            <div class="divider"></div>
                                            <a href="profile.php" class="view btn-sm active">View Profile</a>
                                            <a class="dropdown-item" href="#"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                        </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
            <div class="user-dashboard">
                <div class="container">
<form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($appointment_id); ?>">

                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="practitioner_id" class="form-label">Doctor:</label>
                        <select name="practitioner_id" id="practitioner_id" class="form-select" required>
                            <?php
                            while ($doctor = $doctors_result->fetch_assoc()) {
                                $selected = ($appointment['practitioner_id'] == $doctor['practitioner_id']) ? "selected" : "";
                                echo "<option value='" . htmlspecialchars($doctor['practitioner_id']) . "' $selected>" . htmlspecialchars($doctor['doctor_name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="patient_id" class="form-label">Patient:</label>
                        <select name="patient_id" id="patient_id" class="form-select" required>
                            <?php
                            while ($patient = $patients_result->fetch_assoc()) {
                                $selected = ($appointment['patient_id'] == $patient['patient_id']) ? "selected" : "";
                                echo "<option value='" . htmlspecialchars($patient['patient_id']) . "' $selected>" . htmlspecialchars($patient['patient_name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="appointment_status" class="form-label">Status:</label>
                        <select name="appointment_status" id="appointment_status" class="form-select" required>
                            <?php
                            foreach ($status_options as $status) {
                                $selected = ($appointment['appointment_status'] === $status) ? "selected" : "";
                                echo "<option value='" . htmlspecialchars($status) . "' $selected>" . htmlspecialchars($status) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="appointment_type" class="form-label">Appointment Type:</label>
                        <input type="text" name="appointment_type" id="appointment_type" class="form-control" value="<?php echo htmlspecialchars($appointment['appointment_type']); ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Reason:</label>
                    <input type="text" name="reason" id="reason" class="form-control" value="<?php echo htmlspecialchars($appointment['reason']); ?>" required>
                </div>

                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control" value="<?php echo htmlspecialchars($appointment['start_time']); ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="end_time" class="form-label">End Time:</label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control" value="<?php echo htmlspecialchars($appointment['end_time']); ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-6">
                        <label for="location" class="form-label">Location:</label>
                        <input type="text" name="location" id="location" class="form-control" value="<?php echo htmlspecialchars($appointment['location']); ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="charge" class="form-label">Charge:</label>
                        <input type="number" step="0.01" name="charge" id="charge" class="form-control" value="<?php echo htmlspecialchars($appointment['price']); ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Appointment</button>
                <a href="dashboad-appointment.php" class="btn btn-secondary">Cancel</a>
            </form>
            </div>
            </div>
        </div>
    </div>
</div>


