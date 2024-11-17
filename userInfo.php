<?php include 'db.inc.php'; // Include the database connection file ?>

<h1 class="sr-only">User Details</h1>
<h3 class="mt-4">User Profile</h3>

<?php
// Assuming session or user info is available, fetch user data (can be fetched from session or user table)
$user_id = 1; // This would be dynamically fetched via session or authentication system
$sql = "SELECT username, email, role, created_date, updated_date FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p><strong>Username:</strong> " . htmlspecialchars($row['username']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
    echo "<p><strong>Role:</strong> " . htmlspecialchars($row['role']) . "</p>";
    echo "<p><strong>Created At</strong> " . htmlspecialchars($row['created_date']) . "</p>";
    echo "<p><strong>Updated At</strong> " . htmlspecialchars($row['updated_date']) . "</p>";
} else {
    echo "<p>No user data found.</p>";
}

$conn->close();
?>
