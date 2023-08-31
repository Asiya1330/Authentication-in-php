<?php
require_once 'models/UserModel.php';
require_once 'models/TokenModel.php';

class AuthController {
    public function handleLogin() {
        // Handle login form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $tokenModel = new TokenModel();
                $token = $tokenModel->generateToken($username);
                $tokenModel->saveToken($username, $token);

                // Send email
                $message = "Please use this link to login: http://<ipaddress>/.../validation.php?username=$username&token=$token";
                mail($user['email'], 'Login Link', $message);

                header('Location: validation.php');
                exit();
            } else {
                // Invalid credentials
                // Display an error message
            }
        }

        require 'views/login.php';
    }
}
?>
