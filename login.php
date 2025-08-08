<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$role = $_POST['role'] ?? '';
$userid = trim($_POST['userid'] ?? '');
$password = $_POST['password'] ?? '';

//prepare and bind
$stmt = $conn->prepare("SELECT id, password_hash, role FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $userid, $role);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    $stmt->bind_result($user_id, $password_hash, $user_role);
    $stmt->fetch();

    if (password_verify($password, $password_hash)) {
        //password is correct
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $userid;
        $_SESSION['role'] = $user_role;

        //redirect based on role
        switch ($user_role) {
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
        //wrong password
        header("Location: index.html?error=Invalid_password");
        exit;
    }
} else {
    //user not found
    header("Location: index.html?error=User_not_found");
    exit;
}

$stmt->close();
$conn->close();
?>