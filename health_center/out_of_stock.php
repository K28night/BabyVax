<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['slot_id'];
    $hid=$_POST['c_id'];
    $newStatus = $_POST['is_available'];

    // Prepare the update query
    $condition = "slot_id = $id"; 
    $data = array('is_available' => '0');
    
    // Call the update method
    $stocks = $dao->update($data, 'slots1', $condition);

    // Check if the update was successful
    if ($stocks) {
        echo "<script> window.location.href='wel_center.php?id=$hid';</script>";
    } else {
        echo "<script>alert('Error updating.'); window.location.href='wel_center.php?id=$hid';</script>";
    }
}
?>
