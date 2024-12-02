<?php
  // Include database connection
  include 'db.inc.php';

  // Fetch doctor names from the database
  $doctors = [];
  $sql = "SELECT practitioner_id, CONCAT(first_name, ' ', last_name) AS full_name FROM practitioner";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $doctors[] = $row; // Collect doctor details
      }
  } else {
      echo "<p class='text-danger text-center'>No doctors available. Please add doctors first.</p>";
  }
?>
<?php include 'header.php'; ?>

<div class="container mt-5">
  <h2 class="text-center">Book Appointment</h2>
  <form class="form" method="post" action="save-appointment.php">
    
    <!-- First Name and Last Name -->
    <div class="row mb-3">
      <div class="col">
        <div class="form-outline">
          <input type="text" id="first_name" class="form-control" name="first_name" required />
          <label class="form-label" for="first_name">First Name</label>
        </div>
      </div>
      <div class="col">
        <div class="form-outline">
          <input type="text" id="last_name" class="form-control" name="last_name" required />
          <label class="form-label" for="last_name">Last Name</label>
        </div>
      </div>
    </div>

    <!-- Phone Number -->
    <div class="mb-3">
      <label class="form-label" for="phone_number">Phone Number</label>
      <input type="tel" id="phone_number" class="form-control" name="phone_number" required />
    </div>

    <!-- Email -->
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input type="email" id="email" class="form-control" name="email" required />
    </div>

    <!-- Doctor Selection Dropdown -->
    <div class="mb-3">
      <label class="form-label" for="doctor_id">Select Doctor</label>
      <select id="doctor_id" name="doctor_id" class="form-select" required>
        <option value="" disabled selected>Select a doctor</option>
        <?php foreach ($doctors as $doctor): ?>
          <option value="<?= $doctor['practitioner_id'] ?>"><?= htmlspecialchars($doctor['full_name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Appointment Date -->
    <div class="mb-3">
      <label class="form-label" for="appointment_date">Appointment Date</label>
      <input type="date" id="appointment_date" class="form-control" name="appointment_date" required />
    </div>

    <!-- Appointment Time -->
    <div class="mb-3">
      <label class="form-label" for="appointment_time">Appointment Time</label>
      <input type="time" id="appointment_time" class="form-control" name="appointment_time" required />
    </div>
    <!-- Address -->
    <div class="mb-3">
      <label class="form-label" for="address">Address</label>
      <input type="text" id="address" class="form-control" name="address" required />
    </div>
    <!-- Reason for Appointment -->
    <div class="mb-3">
      <label class="form-label" for="reason">Reason for Appointment</label>
      <textarea id="reason" class="form-control" name="reason" rows="3" placeholder="Optional"></textarea>
    </div>

    

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mt-4" onclick="this.disabled=true;this.form.submit();">Book Appointment</button>
  </form>
</div>
