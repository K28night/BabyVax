<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['?id'];
    $hid = $_GET['pid'];

    // Prepare the update query
    $condition = "b_id = $id"; 
    $data = array('status' => '0');
    
    // Call the update method
    $vaccines = $dao->update($data, 'baby_details', $condition);

    // Check if the update was successful
    if ($vaccines) {
        echo "<script> window.location.href='p_view_baby.php?pid=" . $hid . "';</script>";
    } else {
        echo "<script>alert('Error Deleting Baby Record...'); window.location.href='p_view_baby.php?pid=" . $hid . "';</script>";
    }
    
    }
?>
