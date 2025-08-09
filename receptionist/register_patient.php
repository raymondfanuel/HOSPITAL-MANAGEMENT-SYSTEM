<?php
session_start();

//restrict access to receptionists only
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'receptionist') {
    header('Location: ../index.html');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0
    <title>REGISTER NEW PATIENT</title>
    <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900">
    <link rel="stylesheet" href="receptionist-styles/register_patient.css">
</head>
<body>
    <header>
        <div class="header-description">
            <h1>HOSPITAL MANAGEMENT SYSTEM</h1>
        </div>
    </header>

    <div class="container">
        <p>REGISTER NEW PATIENT</p>
        <form action="register_patient_action.php" method="post">
            <div class="input-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" required>
            </div>
            <div class="input-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="select">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="input-group">
                <label>Phone</label>
                <input type="text" name="phone">
            </div>
            <div class="input-group">
                <label>Address</label>
                <textarea name="address"></textarea>
            </div>
            <button type="submit">Register Patient</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Hospital Management System</p>
        <p>Developed by Raymond</p>
    </footer>
    
</body>
</html>
