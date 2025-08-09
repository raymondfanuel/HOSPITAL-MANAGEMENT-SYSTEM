<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'receptionist') {
    header('Location: ../index.html');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//sanitize input
$name = trim($_POST['name']);
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);

//insert into database
$stmt = $conn->prepare("INSERT INTO patients (name, dob, gender, phone, address) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $dob, $gender, $phone, $address);

if ($stmt->execute()) {
    echo "Patient registered successfully. <a href='dashboard.php'>Go back to dashboard</a>";
} else {
    echo "Error: " . $stmt->error . ". <a href='dashboard.php'>Go back to dashboard</a>";
}

$stmt->close();
$conn->close();

?>