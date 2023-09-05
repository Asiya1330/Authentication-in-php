<!DOCTYPE html>
<html>
<head>
    <title>User Display</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php
    require_once '../controllers/DisplayController.php';
    require_once '../db.php'; 
    $username = $_GET['username'];
    $token = $_GET['token'];


    $displayController = new DisplayController($db);

    $userDetails = $displayController->displayUserDetails($username, $token);
    ?>
    <div class="user-details">
        <h1>User Details</h1>
        <?php
        if ($userDetails) {
            echo "<table>";
            echo "<tr><td>Name:</td><td>" . $userDetails['username'] . "</td></tr>";
            echo "<tr><td>Token:</td><td>" . $userDetails['token'] . "</td></tr>";
            echo "</table>";
        } else {
            echo "<p class='error-message'>Token expired or invalid.</p>";
        }
        ?>
    </div>
</body>
</html>
