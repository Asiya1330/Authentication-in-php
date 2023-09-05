<?php

class UserModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function validateUser($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
       
            if ($user && password_verify($password, $user['password'])) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            error_log("SQL Query: " . $stmt->queryString);
            return false;
        }
    }

    public function generateToken($username) {
        $token = bin2hex(random_bytes(16)); 
        try {
            $stmt = $this->db->prepare("UPDATE users SET token = :token WHERE username = :username");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        } catch (PDOException $e) {
            return false; 
        }
        return $token;
    }


    function sendValidationEmail($username, $token) {
        $recipientEmail = 'parass@utas.edu.au';
        
        $subject = 'Validation Email';
        
        $validationLink = "http://two-fa-authentication.local/views/display.php?username=$username&token=$token";
        
        $message = "Dear $username,\n\nPlease use this link to validate your account:\n$validationLink\n\nAdmin Team";
        
        if (mail($recipientEmail, $subject, $message)) {
            echo "An email has been sent. Please check your inbox (and spam).";
        } else {
            echo "Email sending failed. Error: " . error_get_last()['message'];
        }
    }


    
}
?>