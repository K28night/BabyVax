<?php
require('../config/autoload.php'); 

$dao = new DataAccess();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $hid=$_GET['hid'];
    $fields = array('v_id');
    $con="s_id='$id'";
    $vaccines = $dao->getData($fields, 'vaccine_stocks', $con);
    $v_id=$vaccines[0]['v_id'];
    $data = array(
        'c_id' => $hid,
        'v_id' => $v_id,
        'stock_id' => $id,
        'time'=>'CURRENT_TIMESTAMP',
        
    );
    // Check if the update was successful
    if ($dao->insert($data, "request_stock")) {
        echo "<script>alert('Requested successfully'); window.location.href='wel_center.php?id=$hid';</script>";
    } else {
        echo "<script>alert('Error In Sending.'); window.location.href='wel_center.php?id=$hid';</script>";
    }
}
else
echo"sfverg";
?>
