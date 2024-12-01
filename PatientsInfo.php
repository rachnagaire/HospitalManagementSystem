<?php include 'db.inc.php'; // Include the database connection file ?>

<h1 class="sr-only">Patient Details</h1>
<h3 class="mt-4">Patient Details</h3>

<!-- Search bar for filtering the table -->
<div class="d-flex align-items-center justify-content-between">
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

<table id="patientTable" class="table bordered highlight responsive-table mb-5 pb-5" cellspacing="0">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th> <!-- New column for edit and delete -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Prepare SQL query to fetch patient data
        $sql = "SELECT patient_id, first_name, last_name, birthDate, gender, email, phone, managing_organization AS address FROM patient";
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

                // Add Edit and Delete buttons
                echo "<td>
                        <a href='edit_patient.php?id=" . $row['patient_id'] . "' class=' text-warning'><i class='fa fa-edit'></i></a>
                        <a onclick='confirmDelete(" . $row['patient_id'] . ")' class='text-danger ml-2'><i class='fa fa-trash'></i></a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No patient records found.</td></tr>";
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

    // Confirm delete action
    function confirmDelete(patientId) {
        if (confirm("Are you sure you want to delete this patient?")) {
            window.location.href = "dashboard-patients.php";
        }
    }
    $(document).ready(function () {
        $('#patientTable').DataTable({            
            
            paging: true, // Enable pagination
            searching: true, // Enable search bar
            ordering: true, // Enable column sorting
            lengthChange: true, // Allow changing the number of rows displayed
            
        });
    });
</script>


