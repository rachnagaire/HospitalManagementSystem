<?php
include 'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Input username
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate inputs
    if (empty($username) || empty($newPassword) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif ($newPassword !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Hash the new password using bcrypt
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the password directly for the provided username
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param('ss', $hashedPassword, $username);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $success = "Password updated successfully.";
            } else {
                $error = "User not found or no changes made.";
            }
        } else {
            $error = "Failed to update password. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome -->

<!-- MDB -->
<!-- <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.0.0/mdb.min.css"
  rel="stylesheet"
/> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/HospitalManagementSystem/Assets/css/main.css">
</head>
<body>
    <h2 class="sr-only">Update Password</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <section class="signin">
        <div class="signin-content">
        <div class="img-holder">
                <figure><img src="/HospitalManagementSystem/Assets/Images/signin.jpg" class="img signin-img" alt="sign up image"></figure>
            </div>
            <form method="post" class="signin-form" action="">
                <a class="navbar-brand" href="/HospitalManagementSystem/index.php">
                    <img src="/HospitalManagementSystem/Assets/Images/LOGO.png" alt="" width="50">
                    <span class="logo-text text-primary font-weight-bold">CIMS</span>
                </a>
                <h3>Update Password</h3>
                
                <!-- Display success or error messages -->
                <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
                <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
                
                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" required />
                    <label class="form-label" for="username">Username</label>
                </div>

                <!-- New Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required />
                    <label class="form-label" for="password">New Password</label>
                </div>

                <!-- Confirm Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Update</button>
                <a href="/HospitalManagementSystem/index.php" class="link mx-auto">Go to Landing Page</a>
            </form>
        </div>
    </section>
</body>
</html>
