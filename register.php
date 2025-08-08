<?php
// DB connection params
$servername = "localhost";
$username = "root";  // your DB username
$password = "";      // your DB password
$dbname = "hms_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data and sanitize
$user = trim($_POST['username'] ?? '');
$pass = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if (empty($user) || empty($pass) || empty($role)) {
    die("Please fill all fields");
}

// Check if username already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Username already taken. Please choose another.");
}
$stmt->close();

// Hash the password
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user, $pass_hash, $role);

if ($stmt->execute()) {
    echo "User registered successfully.";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
