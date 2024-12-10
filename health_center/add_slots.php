<?php 
require('../config/autoload.php'); 
include("header.php");
$dao = new DataAccess();
$vid = $_GET['vid'];
$hid = $_GET['hid'];
$fields = array(
    'c_name',
    'v_name',
);
$condition="c_id=$hid AND v_id=$vid";
$centers = $dao->getData($fields, 'vaccine_stocks',$condition);
$name = $centers[0]['c_name'];
$v_name = $centers[0]['v_name'];

// Define time slots
$time_slots = [
    '09:00 - 11:00',
    '12:00 - 01:00',
    '3:00 - 5:00'
];

$elements = array(
    'vaccine_id'=>"","center_id" => "","date" => "",
    "start_time_1" => "","start_time_2" => "",
    "start_time_3" => ""
);

$form = new FormAssist($elements, $_POST);


$labels = array(
    'vaccine_id' => "Vaccine ID",
    'center_id' => "Center ID",
    'date' => "Date",
    'start_time_1' => "Start Time Slot 1",
    'start_time_2' => "Start Time Slot 2",
  
);

$rules = array(
    "vaccine_id" => array("required" => true),
    "center_id" => array("required" => true),
    "date" => array("required" => true),
    "start_time_1" => array("required" => true),
    "start_time_2" => array("required" => true),
   
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        $date = DateTime::createFromFormat('d-m-Y', $_POST['date']);
        $formatted_date = $date->format('Y-m-d'); 
        // Prepare the data for time slots
        $data = array(
            'v_id' => $vid,
            'c_id' => $hid,
            'date' =>   $formatted_date,
            'time_slot_1' => $_POST['start_time_1'],
            'time_slot_2' => $_POST['start_time_2'],
            'time_slot_3' => isset($_POST['start_time_3'])?$_POST['start_time_3']:null,
            'is_available' => true
        );        
        if($dao->insert($data,"slots1")) {
            echo "<script> alert('New record created successfully');</script> ";
            header("Location: wel_center.php?id=$hid");

        }
        else {
            echo "<script>alert('Error: Failed to insert data.');</script>";
        }
    }
}
?>
<html>
<head>
</head>
<body>

<form action="" method="POST">
    <div class="row">
        <div class="col-md-6">
            Center ID:
            <?= $form->textBox('center_id', array('class' => 'form-control', 'value' => $name, 'placeholder' => '')); ?>
            <?= $validator->error('center_id'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Vaccine ID:
            <?php
            // $options = $dao->createOptions("name", "vid", "b_vaccines");
            // echo $form->dropDownList('vaccine_id', array('class' => 'form-control', 'value' => $v_name), $options);
            ?>
             <?= $form->textBox('vaccine_id', array('class' => 'form-control', 'value' => $v_name, 'placeholder' => '')); ?>
            <?= $validator->error('vaccine_id'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Date:
            <?= $form->textBox('date', array('class' => 'form-control', 'value' => '', 'placeholder' => 'dd-mm-yyyy')); ?>
            <?= $validator->error('date'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Start Time Slot 1:
            <select name="start_time_1" class="form-control">
                <option value="">Select Start Time</option>
                <?php foreach ($time_slots as $slot) : ?>
                    <option value="<?= $slot; ?>"><?= $slot; ?></option>
                <?php endforeach; ?>
            </select>
            <?= $validator->error('start_time_1'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Start Time Slot 2:
            <select name="start_time_2" class="form-control">
                <option value="">Select Start Time</option>
                <?php foreach ($time_slots as $slot) : ?>
                    <option value="<?= $slot; ?>"><?= $slot; ?></option>
                <?php endforeach; ?>
            </select>
            <?= $validator->error('start_time_2'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Start Time Slot 3:
            <select name="start_time_3" class="form-control">
                <option value="">Select Start Time</option>
                <?php foreach ($time_slots as $slot) : ?>
                    <option value="<?= $slot; ?>"><?= $slot; ?></option>
                <?php endforeach; ?>
            </select>
            <?= $validator->error('start_time_3'); ?>
        </div>
    </div>

    <br><br>
    <button type="submit" name="btn_insert">Submit</button>
</form>

</body>
</html>
