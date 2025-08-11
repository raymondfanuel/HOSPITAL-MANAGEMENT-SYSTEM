<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'nurse') {
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

// Get all patients for now (later filter by assigned nurse)
$sql = "SELECT id, name, dob, gender, phone, address FROM patients";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Patients</title>
    <link rel="stylesheet" href="nurse-styles/patients.css">
</head>
<body>
    <header>
        <h1>Assigned Patients</h1>
        <a href="dashboard.php">Home Dashboard</a>
    </header>

    <main>
        <?php if ($result->num_rows > 0): ?>
            <table border="1" cellpadding="8">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['dob']) ?></td>
                        <td><?= htmlspecialchars($row['gender']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td><?= htmlspecialchars($row['address']) ?></td>
                        <td>
                            <a href="record-vitals.php?patient_id=<?= $row['id'] ?>">Record Vitals</a>
                            |
                            <a href="patient-history.php?patient_id=<?= $row['id'] ?>">View History</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No patients found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
<?php $conn->close(); ?>
