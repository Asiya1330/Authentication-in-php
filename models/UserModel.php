<?php

class UserModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function validateUser($username, $password) {
        try {
            // Prepare a SQL statement to fetch user data based on the username
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            // Fetch the user record
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
       
            // Check if the user exists and the password matches (you should hash and salt the passwords)
            if ($user && password_verify($password, $user['password'])) {
                return true; // Valid user

            } else {
                return false; // Invalid user
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            error_log("SQL Query: " . $stmt->queryString);
            return false;
        }
    }

    public function generateToken($username) {
        // Generate and store a token for the user in the database
        // You can use a random string generator or any secure method to create tokens
        $token = bin2hex(random_bytes(16)); // Example: Generate a 32-character hexadecimal token
        try {
            // Prepare a SQL statement to store the token in the database
            $stmt = $this->db->prepare("UPDATE users SET token = :token WHERE username = :username");
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        } catch (PDOException $e) {
            // Handle any database errors here
            // You can log the error or display a generic error message
            return false; // Return false in case of an error
        }
        return $token;
    }


    function sendValidationEmail($username, $token) {
        // Recipient email address (replace with the user's email)
        $recipientEmail = 'gfarhan18@gmail.com';
        
        // Subject of the email
        $subject = 'Validation Email';
        
        // Construct the validation link
        $validationLink = "http://two-fa-authentication.local/views/display.php?username=$username&token=$token";
        
        // Email message
        $message = "Dear $username,\n\nPlease use this link to validate your account:\n$validationLink\n\nAdmin Team";
        
        // Additional headers
        $headers = "From: gfarhan18@gmail.com\r\n";
        $headers .= "Reply-To: gfarhan18@gmail.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Send the email using the PHP mail() function
        if (mail($recipientEmail, $subject, $message, $headers)) {
            $message = "Dear $username,\n\nPlease use this link to validate your account:\n$validationLink\n\nAdmin Team";
            echo $message;
            echo "An email has been sent. Please check your inbox (and spam).";
        } else {
            echo "Email sending failed. Error: " . error_get_last()['message'];
        }
    }


    
}
?>