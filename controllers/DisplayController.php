<?php
require_once 'models/UserModel.php';
require_once 'models/TokenModel.php';

class DisplayController {
    public function showUserDetails($username, $token) {
        $tokenModel = new TokenModel();
        if ($tokenModel->isValidToken($username, $token)) {
            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if ($user) {
                require 'views/display.php';
            } else {
                // Handle user not found
            }
        } else {
            // Handle invalid token
        }
    }
}
?>
