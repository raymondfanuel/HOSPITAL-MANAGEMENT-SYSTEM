<?php
session_start();

// Restrict access to nurses only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'nurse') {
    header('Location: ../index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NURSE</title>
    <link rel="stylesheet" href="nurse-styles/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-description">
            <h1>HOSPITAL MANAGEMENT SYSTEM</h1>
        </div>
    </header>

    <div class="container">
        <p>Welcome, Nurse</p>
        <ul>
            <li>
                <button onclick="viewAssignedPatients()">
                    View Assigned Patients
                </button>
            </li>
            <li>
                <button onclick="recordVitals()">
                    Record Vital Signs
                </button>
            </li>
            <li>
                <button onclick="viewPatientHistory()">
                    View Patient History
                </button>
            </li>
        </ul>
    </div>

    <footer>
        <p>&copy; 2025 Hospital Management System</p>
        <p>Developed by Raymond</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
