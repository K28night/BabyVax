
<?php

require('../config/autoload.php');  // Database connection
if(isset($_GET['id']))
$hid=$_GET['id'];
$dao = new DataAccess(); 
$fields = array('hname','lid', 'location', 'phno', 'pin', 'email', 'img', 'approve_ad');
$health_center = $dao->getData($fields, 'hcenters', "hid='$hid'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health Center Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Health Center Profile</h1>
        
        <div class="profile-section">
            <div class="profile-photo">
                <!-- Display the health center's photo -->
               
                    <img src="../uploads/<?php echo htmlspecialchars($health_center[0]['img']); ?>" alt="Health Center Photo" style="width:150px; height:150px; border-radius:50%;">
               
            </div>

            <div class="profile-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($health_center[0]['hname']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($health_center[0]['pin']); ?></p>
                <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($health_center[0]['phno']); ?></p>
                <p><strong>License Number:</strong> <?php echo htmlspecialchars($health_center[0]['lid']); ?></p>
                <div class="butt">
                <button class="btn-back" onclick="window.location.href='wel_center.php?id=<?php echo $hid; ?>'">Bcak to dashboard <span>>></span></button>
                <button class="btn-edit" onclick="window.location.href='editcenters.php?id=<?php echo $hid; ?>'">Edit</button></div>
            </div>
        </div>
    </div>
</body>
</html>




<head>
    
    <meta charset="UTF-8">
    <title>Profile - BabyVax</title>
 <link rel="stylesheet" href="profile.css">
</head>
<body>
    
</body>
</html>
