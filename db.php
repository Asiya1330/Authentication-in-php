<?php
$host = 'localhost';  // Your local host
$dbname = 'login_db'; // Your database name
$username = 'root';   // Your database username
$password = '';       // Leave password empty for no password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
