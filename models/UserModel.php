<?php
require_once 'db.php';

class UserModel {
    public function getUserByUsername($username) {
        global $conn;
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        
        return null;
    }
    
    // Other methods...
}
?>
