<?php include 'header.php'?>
    <div class="container mt-5">
      <h2 class="text-center">Patient Registration Form</h2>
      <form class="form" method="post" action="register_patient.php">
        <!-- 2 column grid layout with text inputs for the first and last names -->
        <div class="row">
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <input
                type="text"
                id="form6Example1"
                class="form-control"
                name="first_name"
                required
              />
              <label class="form-label" for="form6Example1">First name</label>
            </div>
          </div>
          <div class="col">
            <div data-mdb-input-init class="form-outline">
              <input
                type="text"
                id="form6Example2"
                class="form-control"
                name="last_name"
                required
              />
              <label class="form-label" for="form6Example2">Last name</label>
            </div>
          </div>
        </div>

        <!-- Address input -->
        <div data-mdb-input-init class="form-outline">
          <input
            type="text"
            id="form6Example4"
            class="form-control"
            name="address"
            required
          />
          <label class="form-label" for="form6Example4">Address</label>
        </div>
        <!-- DOB input -->
        <div data-mdb-input-init class="form-outline">
          <input
            type="date"
            id="dob"
            class="form-control"
            name="dob"
            required
          />
          <label class="form-label" for="dob">Date of Birth</label>
        </div>

        <!-- Email input -->
        <div data-mdb-input-init class="form-outline">
          <input
            type="email"
            id="form6Example5"
            class="form-control"
            name="email"
            required
          />
          <label class="form-label" for="form6Example5">Email</label>
        </div>

        <!-- Phone number input -->
        <div data-mdb-input-init class="form-outline">
          <input
            type="number"
            id="form6Example6"
            class="form-control"
            name="phone"
            required
          />
          <label class="form-label" for="form6Example6">Phone</label>
        </div>

        <!-- Gender radio buttons -->
        <div class="mb-4">
          <label class="form-label">Gender</label><br />
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="gender1"
              value="Male"
              required
            />
            <label class="form-check-label" for="gender1">Male</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="gender2"
              value="Female"
              required
            />
            <label class="form-check-label" for="gender2">Female</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              name="gender"
              id="gender3"
              value="Other"
              required
            />
            <label class="form-check-label" for="gender3">Other</label>
          </div>
        </div>

        <!-- Checkbox for account creation -->
        <div class="form-check d-flex justify-content-center">
          <input
            class="form-check-input me-2"
            type="checkbox"
            value="create_account"
            id="form6Example8"
            checked
          />
          <label class="form-check-label" for="form6Example8">
            Create an account?
          </label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">
          Register Patient
        </button>
      </form>
    </div>

    <?php include 'footer.php'?>
