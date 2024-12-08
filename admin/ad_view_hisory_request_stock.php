<?php 
require('../config/autoload.php'); 
$hid=2;
$dao = new DataAccess(); 
?>
<h2 style="display:flex;text-align:center;justify-content:center;margin-top:50px">Request For Stocks</h2>
<div class="container_gray_bg" id="home_feat_1">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <table border="1" class="table" style="margin-top:30px;text-align:center;margin: left 200em;margin-right:25px">
                    <tr>
                    <th>Request Id</th>
                        <th>health Center Name</th>
                        <th>Vaccine Name</th>
                        <th>Request status</th>
                        <th>Date Of Request</th>
                        <th>Quantity</th>
                       
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
                        'vaccine_stocks' => array('vaccine_stocks.c_id = request_stock.c_id', 'innerjoin')
                    );
        
                    // Join if needed, else use simple query
                    $fields = array('request_stock.rs_id',
                    'vaccine_stocks.v_name',
                     'vaccine_stocks.c_name',
                    'request_stock.ack_stock', 'request_stock.quantity',
                'request_stock.time');
                    $vaccines = $dao->getDataJoin($fields, 'request_stock',"ack_stock='Recived'", $join);
                   
                    // Check if data is available
                    if (!empty($vaccines)) {
                        // Loop through the fetched data and display it in table rows
                        foreach ($vaccines as $row) {
                            $qu=($row['quantity'])?$row['quantity']:'Null';
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['rs_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['c_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['v_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ack_stock']) . "</td>";
                             echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                             echo "<td>" . $qu . "</td>";
                           
                              // Action button for updating status
                              
                    
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

