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
                                    
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?php echo htmlspecialchars($userName); ?></span>
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                            <div class="navbar-content">
                                                <span><?php echo htmlspecialchars($userName); ?></span>
                                                <p class="text-muted small">
                                                    <!-- You can add email or other user details here if needed -->
                                                </p>
                                                <div class="divider">
                                                </div>
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
                    
                   
                        <?php include 'patientsInfo.php' ?>
                    </div>
                </div>
            </div>
        </div>

</div>


