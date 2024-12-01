<?php include 'backend/header-b.php'; ?>
<?php
// Start session
session_start();

// Include the database connection
include 'db.inc.php';


//fetching the count of each table information
// SQL to fetch counts for patients, doctors, appointments, and staff
$countSql = "
    SELECT 
        (SELECT COUNT(*) FROM patient) AS total_patients,
        (SELECT COUNT(*) FROM practitioner) AS total_doctors,
        (SELECT COUNT(*) FROM appointment) AS total_appointments,
        (SELECT COUNT(*) FROM staff) AS total_staff,
        (SELECT COUNT(*) FROM users) AS total_user;
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
    $totalUser = $counts['total_user'];
} else {
    die("Error fetching counts: " . $conn->error);
}

// Query to fetch patient data (e.g., age and gender)
$sql = "SELECT birthDate, gender FROM patient";
$result = $conn->query($sql);
$ageRanges=[
    '0-9'=>0,
    '10-19'=>0,
    '20-29'=>0,
    '30-39'=>0,
    '40-49'=>0,
    '50-59'=>0,
    '60-69'=>0,
    '70+'=>0
];
$genders = ['male' => 0, 'female' => 0]; // Assuming gender is 'Male' or 'Female'

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $birthDate=$row['birthDate'];
        $birthDate=new DateTime($birthDate);
        $currentDate=new DateTime();
        $age=$birthDate->diff($currentDate)->y;

        if($age>=0 && $age<=9)
        {
            $ageRanges['0-9']++;
        }
        elseif($age>=10 && $age<=19)
        {
            $ageRanges['10-19']++;
        }
        elseif($age>=20 && $age<=29)
        {
            $ageRanges['20-29']++;
        }
        elseif($age >= 30 && $age <= 39) {
            $ageRanges['30-39']++;
        } 
        elseif ($age >= 40 && $age <= 49) {
            $ageRanges['40-49']++;
        } 
        elseif ($age >= 50 && $age <= 59) {
            $ageRanges['50-59']++;
        } 
        elseif ($age >= 60 && $age <= 69) {
            $ageRanges['60-69']++;
        } 
        elseif ($age >= 70) {
            $ageRanges['70+']++;
        }

        
        if ($row['gender'] == 'male') {
            $genders['male']++;
        } elseif ($row['gender'] == 'female') {
            $genders['female']++;
        }
        
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>

<div class="container-fluid display-table">
        <div class="row display-table-row">
           
           <?php  include 'sidebar.php'?>
           
            <div class="col-md-10 col-sm-11 display-table-cell v-align dashboard-main">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                <?php  include 'backend/top-header.php'?>
                </div>
                <div class="user-dashboard">
                    <h3 class="mt-5 mb-5">Welcome back,  <?php echo htmlspecialchars($firstname); ?></h3>
                    <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                            <div class="full counter_section margin_bottom_30 yellow_bg">
                               <a href="dashboard-patient.php" class="overlay"></a>
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
                                    <p class="total_no"><?php echo $totalUser; ?></p>
                                </div>
                            </div>
                        </div>
                        <p class="head_counter">Total User</p>
                           </div>
                        </div>
                     </div>
                    <div class="row">
                    <div class="chart-container">   
                       <div class="card px-5 py-2">
                       <canvas id="ageChart" width="500" height="500"></canvas>
                       </div>
                       <div class="card px-5 py-2">
                       <canvas id="genderChart" width="500" height="500" ></canvas>
                       </div>
                    </div>

                    </div>
                
                    </div>
                    <script>
        // Pass the PHP array to JavaScript
        var ageRanges = <?php echo json_encode($ageRanges); ?>;
        var genderData = <?php echo json_encode($genders); ?>;

      
        // Age distribution chart
        var ageChart = new Chart(document.getElementById('ageChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: Object.keys(ageRanges),
                datasets: [{
                    label: 'Age Distribution (Grouped) of Patients',
                    data: Object.values(ageRanges),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive:false,
                scales: {
                    y: { 
                        beginAtZero: true 
                    }
                },
                plugins:
                {
                    title:
                    {
                        display:true,
                        text:'Age Distribution (Grouped) of Patients',
                        font:{
                            size:16,
                            weight:'bold',
                        },
                        padding:{top:10,bottom:20}
                    }
                }
            }
        });

        // Gender distribution chart
        var genderChart = new Chart(document.getElementById('genderChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: Object.keys(genderData),
                datasets: [{
                    label: 'Gender Distribution of patients',
                    data: Object.values(genderData),
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderColor: ['#36A2EB', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: 
            {
                responsive:false,
                plugins:
                {
                    title:
                    {
                        display:true,
                        text:'Gender Distribution',
                        font:{
                            size:16,
                            weight:'bold',
                        },
                        padding:{top:10,bottom:20}
                    }
                }
            }

        });
    </script>
            </div>
        </div>
        
    </div>
    <?php include 'backend/footer-b.php' ?>


