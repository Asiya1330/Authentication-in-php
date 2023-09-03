<!DOCTYPE html>
<html>
<head>
    <title>User Display</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
    ?>
    <div class="user-details">
        <h1>User Details</h1>
        <?php
        if ($userDetails) {
            echo "<table>";
            echo "<tr><td>Name:</td><td>" . $userDetails['username'] . "</td></tr>";
            echo "<tr><td>Token:</td><td>" . $userDetails['token'] . "</td></tr>";
            // Add more details as needed
            echo "</table>";
        } else {
            echo "<p class='error-message'>Token expired or invalid.</p>";
        }
        ?>
    </div>
</body>
</html>
