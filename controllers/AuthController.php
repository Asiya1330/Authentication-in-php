<?php
require_once 'models/UserModel.php';
class AuthController {
    private $db; 

    public function __construct(PDO $db) {
        $this->db = $db; 
    }
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel($this->db);

            if ($userModel->validateUser($username, $password)) {


                $token = $userModel->generateToken($username);
                $userModel->sendValidationEmail($username, $token);
                header('Location: views/validation.php');
                exit;
            } else {
                $errorMessage = 'Invalid username or password';
                header('Location: views/login.php?error=' . urlencode($errorMessage));
                exit;
            }
        } else {
            include 'views/login.php';
        }
    }
}
?>
