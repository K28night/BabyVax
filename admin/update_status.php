<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['appointment_id'];
    $hid=$_POST['c_id'];
    $newStatus = $_POST['new_status'];

    // Prepare the update query
    $condition = "id = $id"; 
    $data = array('status' => 'Completed');
    
    // Call the update method
    $vaccines = $dao->update($data, 'appointments', $condition);

    // Check if the update was successful
    if ($vaccines) {
        echo "<script>alert('Appointment status updated successfully'); window.location.href='c_view_appointment.php?hid=" . $hid . "';</script>";
    } else {
        echo "<script>alert('Error updating appointment status...'); window.location.href='c_view_appointment.php?hid=" . $hid . "';</script>";
    }
    
    }
?>
