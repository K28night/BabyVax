<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['?id'];
    $hid = $_GET['pid'];

    // Prepare the update query
    $condition = "id = $id"; 
    $data = array('status' => '0');
    
    // Call the update method
    $vaccines = $dao->update($data, 'reported_side_effects', $condition);

    // Check if the update was successful
    if ($vaccines) {
        echo "<script> window.location.href='viewside.php?pid=" . $hid . "';</script>";
    } else {
        echo "<script>alert('Error updating appointment status...'); window.location.href='viewside.php?pid=" . $hid . "';</script>";
    }
    
    }
?>
