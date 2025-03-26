<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminlog_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get admin credentials from the form
$admin_id = $_POST['admin_id'];
$admin_password = $_POST['admin_password'];

// Prevent SQL injection
$admin_id = $conn->real_escape_string($admin_id);
$admin_password = $conn->real_escape_string($admin_password);

$sql = "SELECT * FROM admins WHERE admin_id = '$admin_id' AND admin_password = '$admin_password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Redirect to Google Sheets link after successful login
    header("Location: https://docs.google.com/spreadsheets/d/1z9WnDTn6N4llk5t-ycMzDIhTjpp7XGA0Jhap3TnlKuk/edit?usp=sharing");
    exit();
} else {
    echo "Invalid Admin ID or Password";
}

$conn->close();
?>
