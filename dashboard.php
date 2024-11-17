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
    $sql = "SELECT username, first_name, last_name, email, phone_number, address FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username); // Bind the username to the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the username exists in the database
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userName = $user['username'];
            $firstname = $user['first_name'];
            $lastname = $user['last_name'];
            $email = $user['email'];
            $phoneNumber = $user['phone_number'];
            $address = $user['address'];
        } else {
            // Default values if no user is found
            $userName = "Unknown User";
            $firstname = "N/A";
            $lastname = "N/A";
            $email = "N/A";
            $phoneNumber = "N/A";
            $address = "N/A";
        }

        $stmt->close();
    } else {
        // Handle SQL statement preparation error
        die("Error preparing SQL statement: " . $conn->error);
    }
} else {
    // If no session found, set default values
    $userName = "Guest";
    $firstname = "N/A";
    $lastname = "N/A";
    $email = "N/A";
    $phoneNumber = "N/A";
    $address = "N/A";
}
//fetching the count of each table information
// SQL to fetch counts for patients, doctors, appointments, and staff
$countSql = "
    SELECT 
        (SELECT COUNT(*) FROM patient) AS total_patients,
        (SELECT COUNT(*) FROM practitioner) AS total_doctors,
        (SELECT COUNT(*) FROM appointment) AS total_appointments,
        (SELECT COUNT(*) FROM staff) AS total_staff;
";

$countResult = $conn->query($countSql);

// Variables for counts
$totalPatients = $totalDoctors = $totalAppointments = $totalStaff = 0;

if ($countResult && $countResult->num_rows > 0) {
    $counts = $countResult->fetch_assoc();
    $totalPatients = $counts['total_patients'];
    $totalDoctors = $counts['total_doctors'];
    $totalAppointments = $counts['total_appointments'];
    $totalStaff = $counts['total_staff'];
} else {
    die("Error fetching counts: " . $conn->error);
}

// Close the database connection
$conn->close();
?>

<div class="container-fluid display-table">
        <div class="row display-table-row">
           
           <?php  include 'sidebar.php'?>
           
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
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
                                    
                                    <li class="dropdown right">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?php echo htmlspecialchars($userName); ?></span>
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                            <div class="navbar-content">
                                               
                                                
                                                <div class="divider">
                                                </div>
                                                <a href="" class="dropdown-item view  "><?php echo htmlspecialchars($firstname . ' ' . $lastname); ?></a>
                                                <a href="profile.php" class="dropdown-item view  ">View Profile</a>
                                                <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
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
                    <h3 class="mt-5 mb-5">Welcome back,  <?php echo htmlspecialchars($firstname); ?></h3>
                    <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30 yellow_bg">
                             <div class="counter-info">
                             <div class="counter_icon">
                                 <div> 
                                    <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $totalPatients; ?></p>
                                    
                                 </div>
                              </div>
                            </div>
                            <p class="head_counter">Total Patients</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30 blue1_bg">
                              <div class="counter-info">
                              <div class="counter_icon">
                                 <div> 
                                 <i class="fa fa-calendar"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $totalAppointments; ?></p>
                                   
                                 </div>
                              </div>
                              </div>
                              <p class="head_counter">Total Appointments</p>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30 green_bg">
                              <div class="counter-info">
                              <div class="counter_icon">
                                 <div> 
                                 <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $totalDoctors; ?></p>
                                </div>
                                </div>
                              </div>
                            <p class="head_counter">Total Doctors</p>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30 red_bg">
                              <div class="counter-info">
                              <div class="counter_icon">
                                 <div> 
                                 <i class="fa fa-user"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $totalStaff; ?></p>
                                </div>
                            </div>
                        </div>
                        <p class="head_counter">Total Staffs</p>
                           </div>
                        </div>
                     </div>
                    
                </div>
                <?php include 'backend/footer-b.php' ?>
            </div>
        </div>

</div>


