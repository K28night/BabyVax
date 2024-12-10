<?php 
require('../config/autoload.php'); 
$hid=$_GET['hid'];
$dao = new DataAccess(); 
?>
<link rel="stylesheet" href="./assets/css/table.css">
<div class="container_gray_bg" id="home_feat_1">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <table border="1" class="table" style="margin-top:100px;">
                    <th>Apointment Id</th>
                        <th>Parant Name</th>
                        <th>Baby Name</th>
                        <th>Vaccine Name</th>
                        <th>Administered Date</th>
                        <th>Date Of Birth</th>
                        <th>Gender</th>
                        <th>Blood Group</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Medical Condition</th>
                        <th>Time Slot</th>
                        <th colspan='2'>Vaccination Status</th>
                    </tr>

                    <?php

                    // Define the actions for edit and delete
                    $actions = array(
                        'edit' => array(
                            'label' => 'Edit',
                            'link' => 'editvaccine.php',
                            'params' => array('id' => 'vid'),
                            'attributes' => array('class' => 'btn btn-success')
                        ),
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
                        'baby_details' => array('appointments.b_id = baby_details.b_id', 'innerjoin')
                    );
        
                    // Join if needed, else use simple query
                    $fields = array('id',
                    'appointments.p_name',
                     'appointments.b_name',
                      'appointments.v_name',
                       'appointments.c_name',
                        'appointments.date',
                        'appointments.time_slot',
                        'appointments.status',
                    'baby_details.date_of_birth',
                'baby_details.gender','baby_details.blood_group','baby_details.height','baby_details.weight','baby_details.medical_conditions');
                    $vaccines = $dao->getDataJoin($fields, 'appointments',"c_id='$hid' AND appointments.status='Booked'", $join);

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
                            echo "<td>" . htmlspecialchars($row['date_of_birth']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['blood_group']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['height']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['weight']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['medical_conditions']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['time_slot']) . "</td>";
                            // echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                          

                              // Action button for updating status
                              
                            echo "<td>";
                            echo "<form  action='update_status.php' method='post' onsubmit='return confirmUpdate();'>"; // Add the onsubmit event
                            echo "<input type='hidden' name='appointment_id' value='" . htmlspecialchars($row['id']) . "'>";
                            echo "<input type='hidden' name='c_id' value='" . htmlspecialchars($hid) . "'>";
                            echo "<input type='hidden' name='new_status' value='Completed'>"; // Set the new status value
                            echo "<button type='submit'>Update Status</button>"; // Button to submit the form
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "</table><h3 style='text-align:center;'>No records found</h3>";
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