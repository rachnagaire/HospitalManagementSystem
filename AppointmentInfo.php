<?php include 'db.inc.php'; // Include the database connection file ?>

<h1 class="sr-only">Appointment Details</h1>
<h3 class="mt-4">Appointment Details</h3>

<!-- Search bar for filtering the table -->
<div class="d-flex align-item-center justify-content-between">
    <div class="input-group mb-3">
        <div class="form-outline w-auto" data-mdb-input-init>
            <input type="search" id="searchInput" class="form-control" placeholder="Search in table..." onkeyup="searchTable()" />
        </div>
        <button type="button" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fa fa-search"></i>
        </button>
    </div>
    <a href="appointment.php" class="btn btn-primary">Add new appointment</a>
</div>

<table id="appointmentTable" class="table bordered highlight responsive-table" cellspacing="0">
    <thead>
        <tr>
            <th>Appointment ID</th>
            <th>Patient Name</th>
            <th>Doctor Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Prepare SQL query to fetch appointment data with patient and doctor names
        $sql = "
        SELECT 
            a.appointment_id, 
            CONCAT(p.first_name, ' ', p.last_name) AS patient_name,
            CONCAT(d.first_name, ' ', d.last_name) AS doctor_name,
            a.appointment_date,
            a.appointment_time,
            a.appointment_status
           
        FROM 
            appointment a
        JOIN 
            patient p ON a.patient_id = p.patient_id
        JOIN 
            practitioner d ON a.practitioner_id = d.practitioner_id
        ";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output each row of the appointment data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['appointment_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['patient_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['doctor_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>";
                echo "<td>" . htmlspecialchars($row['appointment_status']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No appointments found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>

<script>
    // JavaScript function to filter/search table
    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("appointmentTable");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) { // Start from row 1, skip the header
            tr[i].style.display = "none"; // Initially hide the row
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break; // Exit inner loop if match is found
                    }
                }
            }
        }
    }
</script>

<?php include 'footer.php'; ?> 
