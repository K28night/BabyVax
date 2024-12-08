<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['rs_id'];
    $qantity = $_POST['qantity'];
    $newStatus = $_POST['new_status'];

    // Validate inputs
    if (!is_numeric($id) || !is_numeric($qantity) || empty($newStatus)) {
        echo "<script>alert('Invalid input detected.'); window.location.href='ad_view_request_stock.php';</script>";
        exit;
    }

    // Prepare the update query
    $condition = "rs_id = $id"; // Ensure this matches your database schema
    $data = array(
        'ack_stock' => $newStatus,
        'quantity' => $qantity
    );

    // Call the update method
    $vaccines = $dao->update($data, 'request_stock', $condition);

    // Check if the update was successful
    if ($vaccines) {
        echo "<script>alert('Request status updated successfully'); window.location.href='ad_view_request_stock.php';</script>";
    } else {
        echo "<script>alert('Error updating Request status.'); window.location.href='ad_view_request_stock.php';</script>";
    }
}
?>
