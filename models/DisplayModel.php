<?php

class DisplayModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserDetailsByUsernameAndToken($username, $token) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND token = :token");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>
