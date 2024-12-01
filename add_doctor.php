<?php include 'backend/header-b.php'; ?>
<?php
// Start session
session_start();
include 'db.inc.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userName = $result->num_rows > 0 ? $result->fetch_assoc()['username'] : "Unknown User";
    $stmt->close();
} else {
    $userName = "Guest";
}
$conn->close();
?>

<div class="container-fluid display-table">
    <div class="row display-table-row">
        <?php include 'sidebar.php'; ?>
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
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?php echo htmlspecialchars($userName); ?></span>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                <span><?php echo htmlspecialchars($userName); ?></span>
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
                    <form class="form mt-5 mb-5 pb-5" method="post" action="save_doctor.php" enctype="multipart/form-data">
                        <h5>Register Practitioner</h5>
                        <!-- Basic Details -->
                        <div class="mb-3">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" id="first_name" class="form-control" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text" id="last_name" class="form-control" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="gender">Gender</label>
                            <select id="gender" class="form-control" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="unknown">Unknown</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="birth_date">Birth Date</label>
                            <input type="date" id="birth_date" class="form-control" name="birth_date">
                        </div>
                        <!-- Contact Information -->
                        <div class="mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" id="address" class="form-control" name="address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="city">City</label>
                            <input type="text" id="city" class="form-control" name="city">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="state">State</label>
                            <input type="text" id="state" class="form-control" name="state">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" class="form-control" name="postal_code">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="country">Country</label>
                            <input type="text" id="country" class="form-control" name="country">
                        </div>
                        <!-- Professional Details -->
                        <div class="mb-3">
                            <label class="form-label" for="specialisation">Specialisation</label>
                            <input type="text" id="specialisation" class="form-control" name="specialisation">
                        </div>
                       
                        <!-- Upload Photo -->
                        <div class="mb-3">
                            <label class="form-label" for="photo">Photo</label>
                            <input type="file" id="photo" class="form-control" name="photo">
                        </div>
                        <!-- Active Status -->
                        <div class="mb-3">
                            <label class="form-label" for="active">Active</label>
                            <select id="active" class="form-control" name="active">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <!-- Communication -->
                        <div class="mb-3">
                            <label class="form-label" for="communication">Communication Notes</label>
                            <textarea id="communication" class="form-control" name="communication"></textarea>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add Practitioner</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
