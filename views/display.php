<!DOCTYPE html>
<html>
<head>
    <title>User Display</title>
</head>
<body>
    <?php
    // Include the DisplayController class
    require_once '../controllers/DisplayController.php';
    require_once '../db.php'; // Adjust the path as needed

    // Get username and token from query parameters
    $username = $_GET['username'];
    $token = $_GET['token'];

    // Include the existing database connection

    // Create an instance of the DisplayController and pass the database connection
    $displayController = new DisplayController($db);

    // Call the displayUserDetails method to show user details
    $userDetails = $displayController->displayUserDetails($username, $token);

    if ($userDetails) {
        // Display user details if valid
        echo "<h1>User Details</h1>";
        echo "<p>Name: " . $userDetails['username'] . "</p>";
        echo "<p>Token: " . $userDetails['token'] . "</p>";
        // echo "<p>Balance: " . $userDetails['Balance'] . "</p>";
        // echo "<p>Email: " . $userDetails['Email'] . "</p>";
    } else {
        echo "Token expired or invalid.";
    }
    ?>
</body>
</html>
