<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['slot_id'];
    $vid=$_POST['vaccine_id'];
    $hid = $_POST['c_id'];
    $newStatus = $_POST['is_available'];

    if ($id == '0') {
        echo "<script>alert('Enter the Time slots..!'); window.location.href='add_slots.php?hid=" . htmlspecialchars($hid) ."&vid=" . htmlspecialchars($vid) . "';</script>";
    } else {
        // Prepare the update query
        $condition = "slot_id = " . intval($id); // Use intval to sanitize the input
        $data = array('is_available' => '1');
        
        // Call the update method
        $stocks = $dao->update($data, 'slots1', $condition);

        // Check if the update was successful
        if ($stocks) {
            echo "<script>window.location.href='wel_center.php?id=" . htmlspecialchars($hid) . "';</script>";
        } else {
            echo "<script>alert('Error: Update failed..!'); window.location.href='wel_center.php?id=" . htmlspecialchars($hid) . "';</script>";
        }
    }
} else {
    // Handle unexpected requests more clearly
    echo "<script>alert('Invalid request method.'); window.location.href='wel_center.php';</script>";
}
?>
