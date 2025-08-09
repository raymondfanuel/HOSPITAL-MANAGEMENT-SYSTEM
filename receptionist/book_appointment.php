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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'] ?? '';
    $doctor_id = $_POST['doctor_id'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    // Basic validation
    if ($patient_id && $doctor_id && $date && $time) {
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, date, time, status) VALUES (?, ?, ?, ?, 'scheduled')");
        $stmt->bind_param("iiss", $patient_id, $doctor_id, $date, $time);

        if ($stmt->execute()) {
            $success = "Appointment booked successfully!";
        } else {
            $error = "Error booking appointment: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Please fill in all fields.";
    }
}

// Fetch patients and doctors for dropdowns
$patients_result = $conn->query("SELECT id, name FROM patients ORDER BY name ASC");
$doctors_result = $conn->query("SELECT id, username FROM users WHERE role = 'doctor' ORDER BY username ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Book Appointment</title>
    <link rel="stylesheet" href="receptionist-styles/dashboard.css" />
</head>
<body>
    <h1>Book Appointment</h1>
    <a href="dashboard.php">Back to Dashboard</a>

    <?php if (!empty($success)): ?>
        <p style="color:green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="patient_id">Patient:</label>
        <select name="patient_id" id="patient_id" required>
            <option value="">Select patient</option>
            <?php while ($patient = $patients_result->fetch_assoc()): ?>
                <option value="<?= $patient['id'] ?>"><?= htmlspecialchars($patient['name']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="doctor_id">Doctor:</label>
        <select name="doctor_id" id="doctor_id" required>
            <option value="">Select doctor</option>
            <?php while ($doctor = $doctors_result->fetch_assoc()): ?>
                <option value="<?= $doctor['id'] ?>"><?= htmlspecialchars($doctor['username']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required /><br><br>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required /><br><br>

        <button type="submit">Book Appointment</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
