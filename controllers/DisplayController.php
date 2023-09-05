<?php
require_once '../models/UserModel.php';
require_once '../models/TokenModel.php';
require_once '../models/DisplayModel.php';


class DisplayController {
    private $model;

    public function __construct($db) {
        $this->model = new DisplayModel($db);
    }

    public function displayUserDetails($username, $token) {
        $userDetails = $this->model->getUserDetailsByUsernameAndToken($username, $token);

        return $userDetails;
    }

    public function isValidToken($username, $token) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND token = :token");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    private function getUserDetailsByUsername($username) {
        $userDetails = [
            'Name' => 'John Doe',
            'Address' => '123 Main St',
            'Balance' => '$1000.00',
            'Email' => 'john@example.com',
        ];

        return $userDetails;
    }
}

?>
