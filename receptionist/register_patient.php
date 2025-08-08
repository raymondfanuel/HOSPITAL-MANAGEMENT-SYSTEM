<?php
session_start();

//restrict access to receptionists only
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'receptionist') {
    header('Location: ../index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEW PATIENT</title>
</head>
<body>
    <h2>Register New Patient</h2>
    
</body>
</html>