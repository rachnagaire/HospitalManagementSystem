<?php
// Start session
session_start();

// Include database connection
include 'db.inc.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Check if patient ID is provided
if (!isset($_GET['id'])) {
    die("Patient ID not provided.");
}

$patient_id = intval($_GET['id']); // Sanitize input

// Fetch patient details
$sql = "SELECT * FROM patient WHERE patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Patient not found.");
}

$patient = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['birthDate'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $marital_status = $_POST['marital_status'];
    $address = $_POST['managing_organization'];
    $contact_name = $_POST['contact_name'];
    $contact_relationship = $_POST['contact_relationship'];
    $contact_phone = $_POST['contact_phone'];
    $contact_email = $_POST['contact_email'];
    $communication_language = $_POST['communication_language'];
    $general_practitioner = $_POST['general_practitioner'];

    // Update query
    $update_sql = "
        UPDATE patient
        SET 
            first_name = ?, last_name = ?, gender = ?, birthDate = ?, phone = ?, email = ?, 
            marital_status = ?, managing_organization = ?, contact_name = ?, contact_relationship = ?, 
            contact_phone = ?, contact_email = ?, communication_language = ?, general_practitioner = ?
        WHERE patient_id = ?
    ";

    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param(
        "ssssssssssssssi",
        $first_name,
        $last_name,
        $gender,
        $birthDate,
        $phone,
        $email,
        $marital_status,
        $address,
        $contact_name,
        $contact_relationship,
        $contact_phone,
        $contact_email,
        $communication_language,
        $general_practitioner,
        $patient_id
    );

    if ($stmt->execute()) {
        header("Location: dashboard-patients.php"); // Redirect to a patient view page
        exit;
    } else {
        $error_message = "Error updating patient: " . $stmt->error;
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
            <?php  include 'backend/top-header.php'?>
            </div>
            <div class="user-dashboard">
                <div class="container">

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <form method="POST" action="edit_patient.php?id=<?php echo $patient_id; ?>" class="pt-5">
    <h5>Update Patient</h5>
        <div class="row mb-3">
            <div class="col">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo htmlspecialchars($patient['first_name']); ?>" required>
            </div>
            <div class="col">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" class="form-control" name="last_name" value="<?php echo htmlspecialchars($patient['last_name']); ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <input type="radio" name="gender" value="male" <?php if ($patient['gender'] === 'male') echo 'checked'; ?>> Male
            <input type="radio" name="gender" value="female" <?php if ($patient['gender'] === 'female') echo 'checked'; ?>> Female
            <input type="radio" name="gender" value="other" <?php if ($patient['gender'] === 'other') echo 'checked'; ?>> Other
        </div>

        <div class="mb-3">
            <label for="birthDate" class="form-label">Date of Birth</label>
            <input type="date" id="birthDate" class="form-control" name="birthDate" value="<?php echo htmlspecialchars($patient['birthDate']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" id="phone" class="form-control" name="phone" value="<?php echo htmlspecialchars($patient['phone']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="email" value="<?php echo htmlspecialchars($patient['email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="marital_status" class="form-label">Marital Status</label>
            <select class="form-control" id="marital_status" name="marital_status" required>
                <option value="single" <?php if ($patient['marital_status'] === 'single') echo 'selected'; ?>>Single</option>
                <option value="married" <?php if ($patient['marital_status'] === 'married') echo 'selected'; ?>>Married</option>
                <option value="divorced" <?php if ($patient['marital_status'] === 'divorced') echo 'selected'; ?>>Divorced</option>
                <option value="widowed" <?php if ($patient['marital_status'] === 'widowed') echo 'selected'; ?>>Widowed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="managing_organization" class="form-label">Address</label>
            <input type="text" id="managing_organization" class="form-control" name="managing_organization" value="<?php echo htmlspecialchars($patient['managing_organization']); ?>" required>
        </div>

        <h6>Emergency Contact</h6>
        <div class="mb-3">
            <label for="contact_name" class="form-label">Contact Name</label>
            <input type="text" id="contact_name" class="form-control" name="contact_name" value="<?php echo htmlspecialchars($patient['contact_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact_relationship" class="form-label">Relationship</label>
            <input type="text" id="contact_relationship" class="form-control" name="contact_relationship" value="<?php echo htmlspecialchars($patient['contact_relationship']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact_phone" class="form-label">Contact Phone</label>
            <input type="text" id="contact_phone" class="form-control" name="contact_phone" value="<?php echo htmlspecialchars($patient['contact_phone']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input type="email" id="contact_email" class="form-control" name="contact_email" value="<?php echo htmlspecialchars($patient['contact_email']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="communication_language" class="form-label">Communication Language</label>
            <input type="text" id="communication_language" class="form-control" name="communication_language" value="<?php echo htmlspecialchars($patient['communication_language']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="general_practitioner" class="form-label">General Practitioner</label>
            <input type="text" id="general_practitioner" class="form-control" name="general_practitioner" value="<?php echo htmlspecialchars($patient['general_practitioner']); ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Update Patient</button>
    </form>
    </div>
            </div>
        </div>
    </div>
</div>