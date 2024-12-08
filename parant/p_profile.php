<?php
require('../config/autoload.php'); // Include necessary files and initialize database

// session_start();
// $parentId = $_SESSION['parent_id']; // Assumes the parent ID is stored in the session

$dao = new DataAccess();

// Fetch parent details from the database
$fields = array('pname', 'email', 'phno', 'paddress');
$condition = "pid='7'";
$parentDetails = $dao->getData($fields, 'registration', $condition);

if ($parentDetails) {
    $parent = $parentDetails[0];
} else {
    echo "Error: Unable to retrieve parent details.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .profile-container {
            width: 400px;
            padding: 24px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .profile-container h2 {
            text-align: center;
            color: #28ba07;
        }
        .profile-info {
            margin: 10px 0;
        }
        .profile-info label {
            font-weight: bold;
            color: #555;
        }
        .profile-info p {
            margin: 0;
            color: #333;
        }
        .logout-btn {
            display: block;
            width: 24pc;
            padding: 8px;
            margin-top: 20px;
            text-align: center;
            background-color: #209005;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #157a04;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Parent Profile</h2>
    <div class="profile-info">
        <label>Name:</label>
        <p><?= htmlspecialchars($parent['pname']); ?></p>
    </div>
    <div class="profile-info">
        <label>Email:</label>
        <p><?= htmlspecialchars($parent['email']); ?></p>
    </div>
    <div class="profile-info">
        <label>Phone:</label>
        <p><?= htmlspecialchars($parent['phno']); ?></p>
    </div>
    <div class="profile-info">
        <label>Address:</label>
        <p><?= htmlspecialchars($parent['paddress']); ?></p>
    </div>
    <!-- <div class="profile-info">
        <label>Baby's Name:</label>
        <p><?= htmlspecialchars($parent['baby_name']); ?></p>
    </div>
    <div class="profile-info">
        <label>Baby's Date of Birth:</label>
        <p><?= htmlspecialchars($parent['baby_dob']); ?></p>
    </div> -->

    <a href="logout.php" class="logout-btn">Logout</a>
    <a href="logout.php" class="logout-btn">Edit</a>
</div>

</body>
</html>
