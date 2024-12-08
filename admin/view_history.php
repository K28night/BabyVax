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
                        <th>Appointmet ID</th>
                        <th>Parant Name</th>
                        <th>Baby Name</th>
                        <th>Center Name</th>
                        <th>Vaccine Name</th>
                        <th>Date of Vaccination</th>
                        <th>Status</th>
                        <th>Next Vaccination Date</th>
                    </tr>

                    <?php
                    // Define the actions for edit and delete
                    $actions = array(
                        // 'edit' => array(
                        //     'label' => 'Edit',
                        //     'link' => 'editvaccine.php',
                        //     'params' => array('id' => 'vid'),
                        //     'attributes' => array('class' => 'btn btn-success')
                        // ),
                        // 'delete' => array(
                        //     'label' => 'Delete',
                        //     'link' => 'deletevaccine.php',
                        //     'params' => array('id' => 'vid'),
                        //     'attributes' => array('class' => 'btn btn-success')
                        // )
                    );

                    // Configure the table: auto-increment, images, etc.
                    $config = array(
                        // 'srno' => true,  // serial number
                        // 'hiddenfields' => array('id'), // hidden ID field
                        // enables action buttons in the last column
                    );

                    // Join if needed, else use simple query
                    $fields = array('id','p_name', 'b_name', 'c_name', 'v_name', 'date', 'status');
                    $vaccines = $dao->selectAsTable($fields, 'appointments', "p_id='$pid' AND status='Completed'", null, $actions, $config);
                    
                    // Display the table with data
                    if ($vaccines) {
                    echo $vaccines;
                    }
                    else
                    echo"</table><h3>No Records...! Book Vaccination</h3>";
                    ?>
                </table>
            </div>    
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_gray_bg -->