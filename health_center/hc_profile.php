
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
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7f6;
    color: #333;
}
.butt{
    display: flex;
   
}
.btn-edit{
    display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #28ba07;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
}
.btn-edit:hover{
    background-color: #049F42;
}
.btn-back {
            display: block;
            width: 200px;
            margin: 20px 10px;
            padding: 10px;
            background-color: #28ba07;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .btn-back:hover {
            background-color: #049F42;
            
            span{
                color:#333;
               
            }
        }
.container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #28ba07;
}

.profile-section {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    width:600px;
    height: 200px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
}

.profile-photo {
    margin-right: 20px;
}

.profile-details p {
    margin: 5px 0;
    color: #555;
}

.profile-photo img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
}

    </style>
</head>
<body>
    
</body>
</html>
