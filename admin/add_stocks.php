<?php 
require('../config/autoload.php'); 



// Form elements for appointment data
$elements = array(
    "c_id" => "Center Id",
    "c_name" => "Center Name",
    "v_id" => "Vaccination Id",
    "v_name" => "Vaccine Name",
    "stocks_available" => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array(
    "c_id" => "Center ID",
    "c_name" => "Center Name",
    "v_id" => "Vaccine ID",
    "v_name" => "Vaccine Name",
    "stocks_available" => "Stocks Available"
);

$rules = array(
    "c_id" => array("required" => true, "integeronly" => true),
    "c_name" => array("required" => true),
    "v_id" => array("required" => true, "integeronly" => true),
    "v_name" => array("required" => true),
    "stocks_available" => array("required" => true, "integeronly" => true),
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_stocks"])) {
    if ($validator->validate($_POST)) {
        // Formatting the date to Y-m-
        $center_id = $_POST['c_id'];
        $vaccine_id = $_POST['v_id'];
        // Check slot availability based on center, vaccine, time slot, and date
        // $condition = "c_id=$center_id AND v_id=$vaccine_id AND time_slot_1='$time_slot' AND date='$formatted_date' AND is_available=1"; 
        // $availability = $dao->getData($fields='*', 'slots1', $condition);

        // if ($availability) {
            // If available, book the slot
            $data = array(
                'v_id' => $vaccine_id,
                'v_name' => $_POST['v_name'],
                'c_id' => $center_id,
                'c_name' => $_POST['c_name'],
                'stocks_available' => $_POST['stocks_available'],
                'date_updated' => 'CURRENT_TIMESTAMP',
            );

            if ($dao->insert($data, "vaccine_stocks")) {
                // Update the slot availability
                // $update_data = array('is_available' => 0); // Mark slot as unavailable
                // $update_condition = "c_id=$center_id AND v_id=$vaccine_id AND time_slot='$time_slot'";
                // $dao->update($update_data, "slots1", $update_condition);

                echo "<script>alert('Stocks successfully Added');</script>";
            } else {
                echo "<script>alert('Error: Failed to Add Stocks.');</script>";
            }
        }
    }
// }
?>

<html>
<head>
    <title>Appointment Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .row{
            
            margin: 10px;
            justify-content: center;
            align-items:center;
            display: flex;
        }
     
    </style>
</head>
<body>
<form action="" method="POST">
    <!-- Center ID -->
     <div class="row"><h2>Add Stocks For health Centers</h2></div>
    <div class="row">
        <div class="col-md-6">
            Center ID:
            <?php
            $options = $dao->createOptions("hname", "hid", "hcenters","approve_ad=1");
            $firstOption = array('Select a Center' => '');  // Default first option
            $options = array_merge($firstOption, $options);
            echo $form->dropDownList('c_id', array('class' => 'form-control'), $options);
            ?>
            <?= $validator->error('c_id'); ?>
        </div>
    </div>

    <!-- Center Name -->
    <div class="row">
        <div class="col-md-6">
            Center Name:
            <?php
            $options = $dao->createOptions("hname", "hname", "hcenters","approve_ad=1");
            $firstOption = array('Select a Center' => '');  // Default first option
            $options = array_merge($firstOption, $options);
            echo $form->dropDownList('c_name', array('class' => 'form-control'), $options);
            ?>
            <?= $validator->error('c_name'); ?>
        </div>
    </div>

    <!-- Vaccine ID -->
    <div class="row">
        <div class="col-md-6">
            Vaccine ID:
            <?php
            $options = $dao->createOptions("name", "vid", "b_vaccines");
            $firstOption = array('Select a Vaccine' => '');  // Default first option
            $options = array_merge($firstOption, $options);
            echo $form->dropDownList('v_id', array('class' => 'form-control'), $options);
            ?>
            <?= $validator->error('v_id'); ?>
        </div>
    </div>

    <!-- Vaccine Name -->
    <div class="row">
        <div class="col-md-6">
            Vaccine Name:
            <?php
            $options = $dao->createOptions("name", "name", "b_vaccines");
            $firstOption = array('Select a Vaccine' => '');  // Default first option
            $options = array_merge($firstOption, $options);
            echo $form->dropDownList('v_name', array('class' => 'form-control'), $options);
            ?>
            <?= $validator->error('v_name'); ?>
        </div>
    </div>

    <!-- Date -->
    <div class="row">
        <div class="col-md-6">
            Stocks:
            <?= $form->textBox('stocks_available', array('class' => 'form-control','value'=>'', 'placeholder' => "Add Stocks weigth")); ?>
            <?= $validator->error('stocks_available'); ?>
        </div>
</div>
<div class="row">
    <button type="submit" name="btn_stocks">Add Stocks</button>    </div>
</form>

<!-- JavaScript to handle real-time form validation -->
<script>
    $(document).ready(function() {
        // Implement real-time data handling here
    });
</script>

</body>
</html>
