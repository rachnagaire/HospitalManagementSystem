<form method="post" action="register_patient.php">
    <h3>Patient Information</h3>
    <label>First Name</label><input type="text" name="first_name" required><br>
    <label>Last Name</label><input type="text" name="last_name" required><br>
    <label>Gender</label><input type="text" name="gender" required><br>
    <label>Date of Birth</label><input type="date" name="birthDate" required><br>
    <label>Phone</label><input type="text" name="phone" required><br>
    <label>Email</label><input type="email" name="email" required><br>
    <!-- Add other patient-related fields here -->

    <h3>Doctor Information</h3>
    <label>Specialization</label><input type="text" name="specialization"><br>
    <label>License Number</label><input type="text" name="license_number"><br>
    <!-- Add other doctor-related fields here -->

    <button type="submit">Register Patient and Doctor</button>
</form>