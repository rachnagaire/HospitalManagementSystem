<?php include 'db.inc.php'; // Include the database connection file ?>

<h1 class="sr-only">User Details</h1>
<h3 class="mt-4">User Details</h3>

<!-- Search bar for filtering the table -->
<div class="d-flex align-items-center justify-content-between">
    <div class="input-group mb-3">
        <div class="form-outline w-auto" data-mdb-input-init>
            <input type="search" id="searchInput" class="form-control" placeholder="Search in table..." onkeyup="searchTable()" />
        </div>
        <button type="button" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>

<table id="userTable" class="table bordered highlight responsive-table" cellspacing="0">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
    <?php
// Query to join `users` and `patient` tables based on patient_id
$sql = "
    SELECT 
        users.username, 
        COALESCE(users.email, patient.email, practitioner.email, staff.email, 'N/A') AS email,
        users.role, 
        users.updated_date,
        -- You can also include any other necessary fields from the patient, practitioner, and staff tables
        patient.first_name AS patient_first_name,
        patient.last_name AS patient_last_name,
        practitioner.first_name AS practitioner_first_name,
        practitioner.last_name AS practitioner_last_name,
        staff.first_name AS staff_first_name,
        staff.last_name AS staff_last_name
    FROM 
        users
    LEFT JOIN 
        patient 
    ON 
        users.patient_id = patient.patient_id
    LEFT JOIN 
        practitioner 
    ON 
        users.practitioner_id = practitioner.practitioner_id
    LEFT JOIN 
        staff 
    ON 
        users.staff_id = staff.staff_id
";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
        echo "<td>" . htmlspecialchars($row['updated_date']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No user data found.</td></tr>";
}
?>

    </tbody>
</table>

<script>
    // JavaScript function to filter/search table
    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("userTable");
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
