<?php 
require('../config/autoload.php'); 
$hid=$_GET['hid'];
$dao = new DataAccess(); 
?>
<link rel="stylesheet" href="./assets/css/table.css">
<div class="container_gray_bg" id="home_feat_1">

    <div class="container">
    <h2 style="margin-top:50px;text-align:center;margin-bottom:40px;font-size:28px;">Appointment History</h2>
        <div class="row">
            <div class="col-md-10">
                <table border="1" class="table" >
                    <tr>
                    <th>Apointment Id</th>
                        <th>Parant Name</th>
                        <th>Baby Name</th>
                        <th>Vaccine Name</th>
                        <th>Vaccination Date</th>
                        <th>Time Slot</th>
                        <th>Status</th>
                        <!-- <th colspan='2'>Vaccination Status</th> -->
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
                        //     'label' => 'Cancel',
                        //     'link' => 'deletevaccine.php',
                        //     'params' => array('id' => 'id'),
                        //     'attributes' => array('class' => 'btn btn-success')
                        // )
                    );

                    // Configure the table: auto-increment, images, etc.
                    $config = array(
                        // 'srno' => true,  // serial number
                        // 'hiddenfields' => array('id'), // hidden ID field
                        // enables action buttons in the last column
                    );
                    $join = array(
                        // 'baby_details' => array('appointments.b_id = baby_details.b_id', 'innerjoin')
                    );
        
                    // Join if needed, else use simple query
                    $fields = array('id',
                    'p_name',
                     'b_name',
                      'v_name',
                       'c_name',
                        'date',
                        'time_slot',
                        'status',
                  
              );
                    $vaccines = $dao->getData($fields, 'appointments',"c_id='$hid' AND status='Completed'");

                    // Check if data is available
                    if (!empty($vaccines)) {
                        // Loop through the fetched data and display it in table rows
                        foreach ($vaccines as $row) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['p_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['b_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['v_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['time_slot']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        }
                    } else {
                        echo "</table><h3 style='text-align:center;margin-top:30px;font-size:20px'>No Records Found</h3>";
                    }
                    ?>
                </table>
            </div>    
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_gray_bg -->

<script>
function confirmUpdate(form) {
    if (confirm("Are you sure you want to update the vaccination status to 'Completed'?")) {
        return true;
        // Allow form submission
    } else {
        return false; // Prevent form submission
    }
}
</script>