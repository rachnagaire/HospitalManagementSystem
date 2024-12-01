<?php include 'backend/header-b.php'; ?>

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


// Close the database connection
$conn->close();
?>

<!-- Start of the dashboard -->
<div class="container-fluid display-table">
    <div class="row display-table-row">
        <?php include 'sidebar.php'; ?>
        
        <div class="col-md-10 col-sm-11 display-table-cell v-align dashboard-main">
            <div class="row">
            <?php  include 'backend/top-header.php'?>
            </div>
            <div class="user-dashboard">
                <?php include 'appointmentInfo.php'; ?>
            </div>
        </div>
    </div>
</div>
<script>
    // Confirm delete function
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this appointment?')) {
            window.location.href = 'delete_appointment.php?id=' + id;
        }
    }
</script>
<?php include 'backend/footer-b.php' ?>
