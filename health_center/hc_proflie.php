<?php
// Start the session

require('../config/autoload.php'); 

// Include database connection


// Check if the user is logged in
if (!isset($_GET['id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}
$hid=$_GET['id'];
// Get the Health Center ID from the session


// Fetch Health Center Profile Details
$dao = new DataAccess(); // Create a DataAccess object

// Fetch health center details from the database
$fields = array('hname', 'location', 'phno', 'pin', 'email', 'img', 'approve_ad');
$health_center = $dao->getData($fields, 'hcenters', "hid = $hid");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Health Center Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #28ba07;
        }
        .profile-info {
            margin: 20px 0;
        }
        .profile-info label {
            font-weight: bold;
            color: #555;
        }
        .profile-info p {
            margin: 5px 0 15px;
            color: #333;
        }
        .btn-edit {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background: #28ba07;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-edit:hover {
            background: #209005;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Health Center Profile</h1>
        <div class="profile-info">
            <label>Name:</label>
            <p><?php echo htmlspecialchars($health_center['hname']); ?></p>

            <label>Address:</label>
            <p><?php echo htmlspecialchars($health_center['location']); ?></p>

            <label>Contact Number:</label>
            <p><?php echo htmlspecialchars($health_center[0]['lid']); ?></p>

            <label>Email:</label>
            <p><?php echo htmlspecialchars($health_center['email']); ?></p>

            <label>License Number:</label>
            <p><?php echo htmlspecialchars($health_center['license_number']); ?></p>

            <label>Opening Hours:</label>
            <p><?php echo htmlspecialchars($health_center['opening_hours']); ?></p>
        </div>
        <a href="edit_profile.php" class="btn-edit">Edit Profile</a>
    </div>
</body>
</html>
