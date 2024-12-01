<footer class="dashboard-footer">
        <p>&copy; <?php echo date("Y"); ?> Clinic Information Management System. All Rights Reserved.</p>
    </footer>
<!-- Add MDB Bootstrap JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script> -->

<?php
// Check if the current page is the patient info page
if (basename($_SERVER['PHP_SELF']) == 'patient_info.php') {
    echo '<script src="../Assets/JS/main.js"></script>'; // Adjust the path to main.js
}
?>
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/chart_custom_style1.js"></script>
      <script src="js/custom.js"></script>
</body>
</html>
