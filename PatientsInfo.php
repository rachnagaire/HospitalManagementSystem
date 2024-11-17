
<?php include 'db.inc.php'; // Include the database connection file ?>

<h1 class="sr-only">Patient Details</h1>
<h3 class="mt-4">Patient Details</h3>

<!-- Search bar for filtering the table -->
<div class="d-flex align-item-center justify-content-between">
<div class="input-group mb-3">
  <div class="form-outline w-auto" data-mdb-input-init>
    <input type="search" id="searchInput" class="form-control" placeholder="Search in table..." onkeyup="searchTable()"/>
    
  </div>
  <button type="button" class="btn btn-primary" data-mdb-ripple-init>
    <i class="fa fa-search"></i>
  </button>
</div>
<a href="PatientRegistrationForm.php" class="btn btn-primary">Add new patient</a>
</div>


<table id="patientTable" class="table bordered highlight responsive-table" cellspacing="0">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Prepare SQL query to fetch patient data
        $sql = "SELECT first_name, last_name, birthDate, gender, email, phone, managing_organization AS address FROM patient";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output each row of the patient data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birthDate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No patient records found.</td></tr>";
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
        table = document.getElementById("patientTable");
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
