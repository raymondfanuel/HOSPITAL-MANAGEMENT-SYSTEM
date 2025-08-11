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

// Fetch all patients
$sql = "SELECT id, name, dob, gender, phone, address FROM patients ORDER BY name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>VIEW PATIENTS</title>
    <link rel="stylesheet" href="receptionist-styles/view_patients.css" />
    <link rel="stylesheet" href="https://fonts.google.com/share?selection.family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900">
</head>
<body>
    <header>
        <div class="header-description">
            <h1>HOSPITAL MANAGEMENT SYSTEM</h1>
        </div>
    </header>

    <div class="container">
        <p>Patient List</p>
        <a href="dashboard.php">Home Dashboard</a>

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['dob']) ?></td>
                            <td><?= htmlspecialchars(ucfirst($row['gender'])) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                <tr><td colspan="5">No patients found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <footer>
        <p>&copy; 2025 Hospital Management System</p>
        <p>Developed by Raymond</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
