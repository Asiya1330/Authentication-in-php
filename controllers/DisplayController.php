<?php
require_once 'models/UserModel.php';
require_once 'models/TokenModel.php';

class DisplayController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function displayUserDetails($username, $token) {
        // Validate the token and retrieve user details from the database
        if ($this->isValidToken($username, $token)) {
            // Token is valid, retrieve user details (replace with your database code)
            $userDetails = $this->getUserDetailsByUsername($username);

            // Load the display view and pass user details to it
            include 'views/display.php';
        } else {
            // Token is not valid or expired, show an error message (replace with appropriate error handling)
            echo "Token expired or invalid.";
        }
    }

    // Placeholder function for token validation (implement your own logic)
    public function isValidToken($username, $token) {
        try {
            // Query the database to check if the token is valid for the given username
            $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username AND token = :token");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Token is valid, you can return true
                return true;
            } else {
                // Token is not valid or doesn't exist in the database
                return false;
            }
        } catch (PDOException $e) {
            // Handle database connection or query errors here
            // You can log the error or display a generic error message
            return false;
        }
    }

    // Placeholder function to retrieve user details by username (implement your own database code)
    private function getUserDetailsByUsername($username) {
        // Implement your database query to retrieve user details by username
        // Replace this with your actual database code
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
