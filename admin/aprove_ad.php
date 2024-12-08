<?php
require('../config/autoload.php'); 

$dao = new DataAccess();
$id = $_GET['id'];
    // Prepare the update query
    $condition = "hid = $id"; 
    $data = array('approve_ad' => '1');
    
    // Call the update method
    $stocks = $dao->update($data, 'hcenters', $condition);
    // Check if the update was successful
    if ($stocks) {
        echo "<script>alert('Approved successfully'); window.location.href='viewcenter.php';</script>";
    } else {
        echo "<script>alert('Error Approving...'); window.location.href='viewcenter.php';</script>";
    }
?>
