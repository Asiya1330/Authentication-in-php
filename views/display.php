<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>User Details</h1>
    <p><strong>Name:</strong> <?php echo $user['username']; ?></p>
    <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
    <p><strong>Balance:</strong> $<?php echo $user['balance']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
