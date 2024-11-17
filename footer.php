<footer>
<<<<<<< HEAD
        <p>&copy; <?php echo date("Y"); ?> Clinic Information Management System. All Rights Reserved.</p>
=======
        <p>&copy; <?php echo date("Y"); ?> Hospital Management System. All Rights Reserved.</p>
>>>>>>> ceaf0d168c6562778983b733f3e5e18f2dbef745
    </footer>
<!-- Add MDB Bootstrap JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script> -->

<?php
// Check if the current page is the patient info page
if (basename($_SERVER['PHP_SELF']) == 'patient_info.php') {
    echo '<script src="../Assets/JS/main.js"></script>'; // Adjust the path to main.js
}
?>
</body>
</html>
