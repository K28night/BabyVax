<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['?id'];
    $pid = $_GET['pid'];
        // Prepare the update query
        $condition = "id=" . intval($id); // Use intval to sanitize the input
        $data = array('status' => 'Canceled');
        
        // Call the update method
        $stocks = $dao->update($data, 'appointments', $condition);

        // Check if the update was successful
        if ($stocks) {
            echo "<script>alert('Apppoinment Canceled...!'); window.location.href='p_view_appointment.php?pid=$pid';</script>";
        } else {
            echo "<script>alert('Error: Canceling failed..!'); window.location.href='p_view_appointment.php?pid=$pid';</script>";
        }
    }
 else {
    // Handle unexpected requests more clearly
    echo "<script>alert('Invalid request method.'); window.location.href='p_view_appointment.php?pid=$pid';</script>";
}
?>
