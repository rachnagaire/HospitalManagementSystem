<?php include 'backend/header-b.php'; ?>
<?php include 'db.inc.php'; // Include the database connection file ?>

<!-- Start of the dashboard -->
<div class="container-fluid display-table">
    <div class="row display-table-row">
        <?php include 'sidebar.php'; ?>
        
        <div class="col-md-10 col-sm-11 display-table-cell v-align">
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
                                        <span>Welcome, User</span> 
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                <span>Welcome, User</span>
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
                <?php include 'appointmentInfo.php'; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
