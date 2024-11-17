<?php include 'db.inc.php'; // Include the database connection file ?>

<h1 class="sr-only">Staff Details</h1>
<h3 class="mt-4">Staff Details</h3>

<!-- Search bar for filtering the table -->
<div class="d-flex align-item-center justify-content-between">
    <div class="input-group mb-3">
        <div class="form-outline w-auto" data-mdb-input-init>
            <input type="search" id="searchStaffInput" class="form-control" placeholder="Search in table..." onkeyup="searchStaffTable()" />
        </div>
        <button type="button" class="btn btn-primary" data-mdb-ripple-init>
            <i class="fa fa-search"></i>
        </button>
    </div>
</div>

<table id="staffTable" class="table bordered highlight responsive-table" cellspacing="0">
    <thead>
        <tr>
            <th>Staff ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Birth Date</th>
            <th>Created Date</th>
            <th>Updated Date</th>
            <th>Designation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Prepare SQL query to fetch staff data
        $sql = "SELECT staff_id, first_name, last_name, gender, phone, email, birthDate, created_date, updated_date, designation FROM staff";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output each row of the staff data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['staff_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birthDate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['created_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['updated_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No staff records found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>

<script>
    // JavaScript function to filter/search staff table
    function searchStaffTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchStaffInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("staffTable");
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
