<?php
require_once 'models/UserModel.php';
class AuthController {
    private $db; // Add a private property to store the database connection

    public function __construct(PDO $db) {
        $this->db = $db; // Store the database connection in the property
    }
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel($this->db);

            if ($userModel->validateUser($username, $password)) {

                // User credentials are valid
                $token = $userModel->generateToken($username);
                $userModel->sendValidationEmail($username, $token);
                include 'views/validation.php';
            } else {
                // Invalid credentials
                $errorMessage = 'Invalid username or password';
                include 'views/login.php';
            }
        } else {
            // Display login form
            include 'views/login.php';
        }
    }
}
?>
