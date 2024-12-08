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
                        <th>Vaccine ID</th>
                        <th>Vaccine Name</th>
                        <th>Age Given</th>
                        <th>Doses Required</th>
                        <th>Month Gap</th>
                        <th>Side Effects</th>
                        <th>Booster Required</th>
                        <th>Vaccine Type</th>
                        <th>Administration Method</th>
                        <th>Book Vaccine</th>
                    </tr>
                    
                    <?php
                    // Define the actions for edit and delete
                    $actions = array(
                        'edite' => array(
                            'label' => 'Book Now',
                            'link' => 'appoinment.php?pid='.$pid.'&',
                            'params' => array('id' => 'vid'),
                            'attributes' => array('class' => 'btn btn-success')
                        ),
                        
                    );

                    // Configure the table: auto-increment, images, etc.
                    $config = array(
                        // 'srno' => true,  // serial number
                        // 'hiddenfields' => array('id'), // hidden ID field
                        // enables action buttons in the last column
                    );

                    // Join if needed, else use simple query
                    $fields = array('vid','name', 'age_given', 'doses_required', 'shedule_catagory', 'side_effects', 'booster_required', 'vaccine_type', 'vacination_method');
                    $vaccines = $dao->selectAsTable($fields, 'b_vaccines', 1, null, $actions, $config);
                    
                    // Display the table with data
                    echo $vaccines;
                    ?>
                </table>
            </div>    
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_gray_bg -->
