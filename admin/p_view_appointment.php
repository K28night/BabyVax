<?php 
require('../config/autoload.php'); 
$pid=$_GET['pid'];
$dao = new DataAccess(); 
?>

<div class="container_gray_bg" id="home_feat_1">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <table border="1" class="table" style="margin-top:100px;">
                    <tr>
                    <th>Apointment Id</th>
                        <th>Parant Name</th>
                        <th>Baby Name</th>
                        <th>Vaccine Name</th>
                        <th>HealthCare Center Name</th>
                        <th>Date</th>
                        <th>Time Slot</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    // Define the actions for edit and delete
                    $actions = array(
                        // 'edit' => array(
                        //     'label' => 'Update',
                        //     'link' => 'editvaccine.php',
                        //     'params' => array('id' => 'id'),
                        //     'attributes' => array('class' => 'btn btn-success')
                        // ),
                        'delete' => array(
                            'label' => 'Cancel',
                            'link' => 'p_cancelappointment.php?pid='.$pid.'&',
                            'params' => array('id' => 'id'),
                            'attributes' => array('class' => 'btn btn-success', 'onclick' => 'return confirmDeletion(this);')
                        )
                    );

                    // Configure the table: auto-increment, images, etc.
                    $config = array(
                        // 'srno' => true,  // serial number
                        // 'hiddenfields' => array('id'), // hidden ID field
                        // enables action buttons in the last column
                    );

                    // Join if needed, else use simple query
                    $fields = array('id','p_name', 'b_name', 'v_name', 'c_name', 'date', 'time_slot', 'status');
                    $vaccines = $dao->selectAsTable($fields, 'appointments', "status='Booked' AND p_id=$pid", null, $actions, $config);
                    if($vaccines)
                    echo $vaccines;
                else
                echo"<table><h3 style='font-size:24px;text-align:center;justify-centents:center'>No Avtive Appointments</h3>";
                    // Display the table with data
                   
                    ?>
                </table>
            </div>    
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_gray_bg -->

<script type="text/javascript">
function confirmDeletion(button) {
    return confirm("Are you sure you want to cancel this appointment?");
}
</script>