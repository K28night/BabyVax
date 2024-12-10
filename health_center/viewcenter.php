<?php 
require('../config/autoload.php'); 

if(isset($_GET['pid']))
$pid=$_GET['pid'];
else
$pid=0;
$dao = new DataAccess();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Centers</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
       /* General body styles */
/* General body styles */
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
    margin: 0;
    padding: 0;
    color: #333;
}

/* Main container for the health center cards */
.health-center-profile {
    margin: 50px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    max-width: 1200px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Header styles */
.health-center-profile h1 {
    text-align: center;
    color: #6f6fdc;
    font-size: 28px;
    margin-bottom: 20px;
}

/* Grid container for the health center cards */
.health-center-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive grid */
    gap: 20px; /* Space between cards */
    margin-top: 20px;
}

/* Individual health center card */
.health-center-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow for cards */
    overflow: hidden; /* Ensures content stays inside */
    text-align: center;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth hover effect */
}

.health-center-card:hover {
    transform: translateY(-5px); /* Lift card on hover */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

/* Image in the card */
.health-center-card img {
    width: 100%;
    height: 150px; /* Fixed height for images */
    object-fit: cover; /* Ensures image fills the area */
    border-radius: 8px 8px 0 0; /* Rounded top corners */
    margin-bottom: 15px;
}

/* Health center name */
.health-center-card h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
}

/* Health center details */
.health-center-card p {
    font-size: 14px;
    color: #555;
    margin: 5px 0;
}

/* Button styles */
.health-center-card .btn {
    padding: 10px 15px;
    font-size: 14px;
    text-decoration: none;
    border-radius: 5px;
    margin: 10px 5px;
    display: inline-block;
    transition: background-color 0.3s, color 0.3s;
}

/* Success button */
.health-center-card .btn-success {
    background-color: #28a745;
    color: #ffffff;
}

.health-center-card .btn-success:hover {
    background-color: #218838;
}

/* Danger button */
.health-center-card .btn-danger {
    background-color: #dc3545;
    color: #ffffff;
}

.health-center-card .btn-danger:hover {
    background-color: #c82333;
}

/* Responsive styles for smaller screens */
@media (max-width: 768px) {
    .health-center-card h2 {
        font-size: 18px;
    }

    .health-center-card p {
        font-size: 12px;
    }
}


    </style>
</head>
<body>

<div class="health-center-profile">
    <h1>Health Centers</h1>
    <div class="health-center-grid">
        <!-- Example card -->
    
        <!-- Repeat cards dynamically -->
        <?php
        $actions = array(
            'edit' => array(
                'label' => 'Edit',
                'link' => 'editcenters.php',
                'params' => array('id' => 'hid'),
                'attributes' => array('class' => 'btn btn-success')
            ),
            'delete' => array(
                'label' => 'Delete',
                'link' => 'editstudentsimage.php',
                'link' => 'appoinment.php?pid='.$pid.'&',
                'params' => array('id' => 'hid'),
                'attributes' => array('class' => 'btn btn-danger')
            )
        );

        $config = array(
            'srno' => true, // Enable serial number
            'hiddenfields' => array('hid'),
            'actions_td' => false,
            'images' => array(
                'field' => 'img',
                'path' => '../uploads/',
                'attributes' => array('style' => 'width:170px;')
            )
        );
        $fields = array('hid','lid', 'hname','location','email', 'img');

        $users = $dao->getAllData('hcenters as s');
        
        foreach ($users as $user) {
            echo '<div class="health-center-card">';
            echo '<img src="../uploads/' . $user['img'] . '" alt="Health Center">';
            echo '<h2>' . $user['hname'] . '</h2>';
            echo '<p><strong>License ID:</strong> ' . $user['lid'] . '</p>';
            echo '<p><strong>Location:</strong> ' . $user['location'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $user['email'] . '</p>';
            echo '<a href="../parant/appoinment.php?pid=' . $pid . '" class="btn btn-success">Book Appointment</a>';

            echo '</div>';}
        ?>
    </div>
</div>

        </div>
    </div><!-- End row -->
</div><!-- End container -->
    
</body>
</html>
