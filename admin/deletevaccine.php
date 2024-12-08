<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['?id'];
    $hid = $_GET['hid'];

    // Prepare the update query
    $condition = "vid = $id"; 
    $data = array('status' => '0');
    
    // Call the update method
    $vaccines = $dao->update($data, 'b_vaccines', $condition);

    // Check if the update was successful
    if ($vaccines) {
        echo "<script> window.location.href='view_vaccine.php?hid=" . $hid . "';</script>";
    } else {
        echo "<script>alert('Error updating appointment status...'); window.location.href='view_vaccine.php?hid=" . $hid . "';</script>";
    }
    
    }
?>
