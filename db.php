<?php
$servername = "127.0.0.1";
$username = 'root';
$password = ""; // Use an empty string for no password
$dbname = "login_db"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
