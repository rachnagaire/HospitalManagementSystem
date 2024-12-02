<?php
include 'db.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['birth_date'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalCode = $_POST['postal_code'];
    $country = $_POST['country'];
    $specialisation = $_POST['specialisation'];
    $active = isset($_POST['active']) ? $_POST['active'] : 1;
    $communication = $_POST['communication'];

    // Handle file upload
    $photo = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = file_get_contents($_FILES['photo']['tmp_name']);
    }

    // Insert into database (omit practitioner_id as it's auto-incremented)
    $sql = "INSERT INTO practitioner (
                active, first_name, last_name, gender, birthDate, photo, 
                specialisation, phone, email, address, city, state, postal_code, 
                country,communication_languages
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "issssssssssssss",
        $active, $firstName, $lastName, $gender, $birthDate,
        $photo, $specialisation, $phone, $email, $address, $city, $state,
        $postalCode, $country, $communication
    );

    if ($stmt->execute()) {
        echo "Practitioner added successfully!";
        echo '<a href="dashboard-doctors.php" class="link mx-auto">Go to Doctors List</a>';

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
