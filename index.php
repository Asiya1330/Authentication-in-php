<?php
require_once 'controllers/AuthController.php';
require_once 'models/UserModel.php';
require_once 'db.php'; // Include the database connection file

// Create instances of AuthController and UserModel and pass the database connection
$authController = new AuthController($db);
$userModel = new UserModel($db);

// Now, you can use $authController and $userModel with the database connection.
$authController->handleLogin();
?>
