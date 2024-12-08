
<?php

require('../config/autoload.php');  // Database connection
if(isset($_GET['hid']))
$hid=$_GET['hid'];

$fields = array('s_id', 'v_name', 'v_id', 'c_id', 'c_name', 'stocks_available', 'date_updated');
$vaccines = $dao->getData($fields, 'hcenters', "c_id='$hid'");
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
                <?php if ($health_center['img']): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($health_center['img']); ?>" alt="Health Center Photo" style="width:150px; height:150px; border-radius:50%;">
                <?php else: ?>
                    <img src="default.jpg" alt="Default Profile Photo" style="width:150px; height:150px; border-radius:50%;">
                <?php endif; ?>
            </div>

            <div class="profile-details">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($health_center['name']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($health_center['address']); ?></p>
                <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($health_center['contact_number']); ?></p>
                <p><strong>License Number:</strong> <?php echo htmlspecialchars($health_center['license_number']); ?></p>
            </div>
        </div>
    </div>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - BabyVax</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f7f6;
    color: #333;
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
    <h1>Parent Profile</h1>
    <div class="profile-section">
        <h2>Parent Details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($parent_result['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($parent_result['email']); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($parent_result['contact_number']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($parent_result['address']); ?></p>
    </div>

    <div class="profile-section">
        <h2>Baby Details</h2>
        <?php while ($baby = $babies->fetch_assoc()) { ?>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($baby['name']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($baby['dob']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($baby['gender']); ?></p>
            <p><strong>Health Notes:</strong> <?php echo htmlspecialchars($baby['health_notes']); ?></p>
            <hr>
        <?php } ?>
    </div>

    <div class="profile-section">
        <h2>Vaccination History</h2>
        <table>
            <thead>
                <tr>
                    <th>Baby ID</th>
                    <th>Vaccine Name</th>
                    <th>Vaccination Date</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($vaccination = $vaccinations->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($vaccination['baby_id']); ?></td>
                        <td><?php echo htmlspecialchars($vaccination['vaccine_name']); ?></td>
                        <td><?php echo htmlspecialchars($vaccination['vaccination_date']); ?></td>
                        <td><?php echo htmlspecialchars($vaccination['remarks']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
