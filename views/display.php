<!DOCTYPE html>
<html>
<head>
    <title>User Display</title>
</head>
<body>
    <?php
    require_once 'controllers/DisplayController.php';

    // Get username and token from query parameters
    $username = $_GET['username'];
    $token = $_GET['token'];

    // Create an instance of the DisplayController
    $displayController = new DisplayController($db);

    // Call the displayUserDetails method to show user details
    $userDetails = $displayController->displayUserDetails($username, $token);

    if ($userDetails) {
        // Display user details if valid
        echo "<h1>User Details</h1>";
        echo "<p>Name: " . $userDetails['Name'] . "</p>";
        echo "<p>Address: " . $userDetails['Address'] . "</p>";
        echo "<p>Balance: " . $userDetails['Balance'] . "</p>";
        echo "<p>Email: " . $userDetails['Email'] . "</p>";
    } else {
        // Display an error message if the token is invalid
        echo "Token expired or invalid.";
    }
    ?>
</body>
</html>
