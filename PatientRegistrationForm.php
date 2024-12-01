<?php include 'backend/header-b.php' ?>
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
                    <form class="form mt-5 mb-5 pb-5" method="post" action="register_patient.php">
                        <h5>Register Patient</h5>

                        <!-- Patient Details -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-0">
                                    <label class="form-label" for="first_name">First Name</label>
                                    <input type="text" id="first_name" class="form-control" name="first_name" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-0">
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <input type="text" id="last_name" class="form-control" name="last_name" required />
                                </div>
                            </div>
                        </div>

                        <!-- Gender Radio Buttons -->
                        <div class="mb-3">
                            <label class="form-label">Gender</label><br />
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="male" required />
                                <label class="form-check-label" for="gender_male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="female" required />
                                <label class="form-check-label" for="gender_female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="other" required />
                                <label class="form-check-label" for="gender_other">Other</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="unknown" required />
                                <label class="form-check-label" for="gender_unknown">Unknown</label>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-3">
                            <label class="form-label" for="birthDate">Date of Birth</label>
                            <input type="date" id="birthDate" class="form-control" name="birthDate" required />
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control" name="phone" required />
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" required />
                        </div>

                        <!-- Marital Status -->
                        <div class="mb-3">
                            <label class="form-label" for="marital_status">Marital Status</label>
                            <select class="form-control" id="marital_status" name="marital_status" required>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label" for="managing_organization">Address</label>
                            <input type="text" id="managing_organization" class="form-control" name="managing_organization" required />
                        </div>

                        <!-- Emergency Contact Details -->
                        <h6>Emergency Contact</h6>
                        <div class="mb-3">
                            <label class="form-label" for="contact_name">Contact Name</label>
                            <input type="text" id="contact_name" class="form-control" name="contact_name" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="contact_relationship">Relationship</label>
                            <input type="text" id="contact_relationship" class="form-control" name="contact_relationship" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="contact_phone">Contact Phone</label>
                            <input type="text" id="contact_phone" class="form-control" name="contact_phone" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="contact_email">Contact Email</label>
                            <input type="email" id="contact_email" class="form-control" name="contact_email" required />
                        </div>

                        <!-- Communication Language -->
                        <div class="mb-3">
                            <label class="form-label" for="communication_language">Communication Language</label>
                            <input type="text" id="communication_language" class="form-control" name="communication_language" required />
                        </div>

                        <!-- General Practitioner -->
                        <div class="mb-3">
                            <label class="form-label" for="general_practitioner">General Practitioner</label>
                            <input type="text" id="general_practitioner" class="form-control" name="general_practitioner" required />
                        </div>

                        

                        

                        <!-- Submit Button -->
                        <div class="form-outline">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

