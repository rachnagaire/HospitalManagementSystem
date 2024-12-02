Clinic Information Management System

1. Description
   This project presents the design and implementation of a Clinic Information
   Management System tailored for individual healthcare practitioners and small clinic
   teams. The system aims to streamline administrative and clinical workflows through
   the following core functions:
   ◼ Patient management
   ◼ Practitioner management
   ◼ Appointment scheduling
   ◼ Role-based user management
   ◼ Security with Password Encryption: Ensures secure authentication by storing
   user passwords in an encrypted format.
   ◼ Data Visualization: Offers intuitive charts and graphs to analyze patient trends
   for informed decision-making.
   The database tables are designed following Fast Healthcare Interoperability
   Resources (FHIR) standards, ensuring compatibility with healthcare data exchange
   protocols.
   The system is a web application built with:

2. Team Members
   ◼ Rachana Gaire
   ◼ Isha Bhavsar
   ◼ Junhui Shen

3. Technologies Used
   ◼ Backend: PHP for server-side logic.
   ◼ Database: MySQL for structured data storage and management.
   ◼ Development Environment: XAMPP for local server setup.
   ◼ Standards: FHIR-compliant design for healthcare data exchange.
   ◼ Frontend: HTML5, CSS3, JavaScript for a responsive user interface.
   ◼ Security: Password encryption for secure authentication.
   ◼ Visualization: Chart.js for interactive data visualizations.

4. Prerequisites
   Before running the system, ensure the following are installed and configured:
   ◼ XAMPP (or a similar PHP-MySQL environment)
   ◼ A modern web browser (e.g., Chrome, Firefox)

5. Installation Instructions
   Follow these steps to set up the system:
   ◼ Download and Install XAMPP:
   Visit XAMPP Download Page (https://www.apachefriends.org/ )and install the
   version for your operating system.
   ◼ Clone or Download the Project Repository:
   Clone the repository using git clone
   (https://github.com/rachnagaire/HospitalManagementSystem.git) or download the ZIP
   file and extract it.
   ◼ Move Project Files:
   Place the project folder in the htdocs directory of your XAMPP installation.
   ◼ Import the Database:
   Open phpMyAdmin (http://localhost/phpmyadmin), create a new database
   (named it as “clinic”), and import the provided clinicSQL.sql file.
   ◼ Configure Database Connection:
   Edit the db.inc.php file in the project folder to match your database
   credentials:
   copy code:
   $servername = "localhost";
$username = "root";
   $password = "";
$dbname = "clinic";

6. Execution Instructions
   ◼ Start the XAMPP server: Open the XAMPP Control Panel and start Apache
   and MySQL.
   ◼ Open your browser and navigate to
   http://localhost/HospitalManagementSystem
   ◼ Log in or Register:
   • Log in using the default credentials (if provided) or create a new account.
   • During registration, you can choose between two roles:
    Admin: Has access to all system functionalities, including user
   management and system configuration.
    Normal User: Limited access to core functionalities such as patient
   and appointment management.
   ◼ Start Using the System: Once logged in, you will be redirected to the
   dashboard based on your role.

7. Input/Output Explanation
   ◼ Inputs:
   •Patient information
   •Practitioner details
   •Appointment scheduling data
   ◼ Outputs:
   •Patient records
   •Doctor schedules
   •Confirmation of successful appointment booking
   •Data visualizations of patient trends.

8. Features
   ◼ Patient Management: Add, update, and view patient details.
   ◼ Practitioner Management: Add and manage healthcare practitioners.
   ◼ Appointment Scheduling: Streamlined booking system
   ◼ Role-Based Access Control: Separate access levels for administrators and
   normal users.
   ◼ FHIR-Compliant Database: Ensures consistency with healthcare data exchange
   standards.
   ◼ Security with Password Encryption: User passwords are stored using encryption
   methods to ensure secure authentication.
   ◼ Data Visualization: Provides charts and graphs to analyze patient trends for
   better decision-making.

9. Troubleshooting
   ◼ Database Connection Issues
   •Cause: Incorrect credentials or server not running.
   •Fix: Verify db.inc.php, ensure MySQL is running, and check database
   import in phpMyAdmin.
   ◼ 2. Application Not Loading
   •Cause: Incorrect file placement or server issues.
   •Fix: Ensure the project is in the htdocs folder, and restart Apache.
   ◼ 3. Login or Registration Issues
   •Cause: Errors in user data handling.
   •Fix: Check database entries and ensure encryption functions work
   correctly.
