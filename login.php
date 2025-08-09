<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$role = $_POST['role'] ?? '';
$userid = trim($_POST['userid'] ?? '');
$password_input = $_POST['password'] ?? '';

// Prepare and bind
$stmt = $conn->prepare("SELECT id, password_hash, role FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $userid, $role);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    // Bind to new variables so we don't overwrite POST ones
    $db_userid = null;
    $db_password_hash = null;
    $db_role = null;

    $stmt->bind_result($db_userid, $db_password_hash, $db_role);
    $stmt->fetch();

    if (password_verify($password_input, $db_password_hash)) {
        // Password is correct
        $_SESSION['user_id'] = $db_userid; // Store numeric ID from DB
        $_SESSION['username'] = $userid;   // Store typed username
        $_SESSION['role'] = $db_role;

        // Redirect based on role
        switch ($db_role) {
            case 'receptionist':
                header("Location: receptionist/dashboard.php");
                break;
            case 'nurse':
                header("Location: nurse/dashboard.php");
                break;
            case 'doctor':
                header("Location: doctor/dashboard.php");
                break;
            case 'laboratory':
                header("Location: laboratory/dashboard.php");
                break;
            case 'pharmacy':
                header("Location: pharmacy/dashboard.php");
                break;
            case 'accountant':
                header("Location: accountant/dashboard.php");
                break;
            default:
                session_destroy();
                header("Location: index.html?error=Invalid_role");
                break;
        }
        exit;
    } else {
        // Wrong password
        header("Location: index.html?error=Invalid_password");
        exit;
    }
} else {
    // User not found
    header("Location: index.html?error=User_not_found");
    exit;
}

$stmt->close();
$conn->close();

?>