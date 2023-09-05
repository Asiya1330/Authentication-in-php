<?php
require_once 'controllers/AuthController.php';
require_once 'models/UserModel.php';
require_once 'db.php'; 

$authController = new AuthController($db);
$userModel = new UserModel($db);

$authController->handleLogin();
?>
