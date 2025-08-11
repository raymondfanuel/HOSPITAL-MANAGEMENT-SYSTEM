<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'nurse') {
    header("Location: index.html?error=Access_Denied");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $bp = $_POST['blood_pressure'];
    $temp = $_POST['temperature'];
    $weight = $_POST['weight'];

    $sql = "UPDATE patients SET blood_pressure='$bp', temperature='$temp', weight='$weight' WHERE patient_id='$patient_id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_patients_nurse.php?success=Vitals_Updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM patients WHERE patient_id='$id'";
    $result = mysqli_query($conn, $sql);
    $patient = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Vital Signs</title>
</head>
<body>
    <h2>Update Vitals for <?= $patient['name'] ?></h2>
    <form method="POST">
        <input type="hidden" name="patient_id" value="<?= $patient['patient_id'] ?>">
        <label>Blood Pressure:</label>
        <input type="text" name="blood_pressure" required><br>
        <label>Temperature (°C):</label>
        <input type="text" name="temperature" required><br>
        <label>Weight (kg):</label>
        <input type="text" name="weight" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
