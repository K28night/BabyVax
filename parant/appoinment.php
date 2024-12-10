<?php 
require('../config/autoload.php'); 


if(isset($_GET['?id'])){
$vid=$_GET['?id'];
$pid=$_GET['pid'];}
else{
    header("Location: p_login.php");
    
}




$time_slots = [
    '09:00 - 11:00',
    '12:00 - 01:00',
    '03:00 - 05:00'
];

// Form elements for appointment data
$elements = array(
    "p_id" => "",
    "p_name" => "",
    "b_id" => "",
    "b_name" => "",
    "c_id" => "",
    "c_name" => "",
    "v_id" => "",
    "v_name" => "",
    "date" => "",
    "time_slot" => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();
$eva = $dao->getData('*', 'baby_details', "pid='$pid'");
$va=$dao->getData("*",'b_vaccines',"vid='$vid'");
$labels = array(
    "p_id" => "Parent ID",
    "p_name" => "Parent Name",
    "b_id" => "Child ID",
    "b_name" => "Child Name",
    "c_id" => "Center ID",
    "c_name" => "Center Name",
    "v_id" => "Vaccine ID",
    "v_name" => "Vaccine Name112",
    "date" => "Date",
    "time_slot" => "Time Slot"
);

$rules = array(
    "p_id" => array("required" => true),
    "p_name" => array("required" => true),
    "b_id" => array("required" => true),
    "b_name" => array("required" => true),
    "c_id" => array("required" => true),
    "c_name" => array("required" => true),
    "v_id" => array("required" => true),
    "v_name" => array("required" => true),
    "date" => array("required" => true),
    "time_slot" => array("required" => true)
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_book"])) {
    if ($validator->validate($_POST)) {
        // Formatting the date to Y-m-d
        $date = DateTime::createFromFormat('d-m-Y', $_POST['date']);
        $formatted_date = $date->format('Y-m-d'); 
        $center_id = $_POST['c_id'];
        $vaccine_id = $_POST['v_id'];
        $time_slot = $_POST['time_slot'];

        // Check slot availability based on center, vaccine, time slot, and date
        $condition = "c_id=$center_id AND v_id=$vaccine_id  AND is_available=1 AND time_slot_1='$time_slot' OR time_slot_2='$time_slot' OR time_slot_3='$time_slot'"; 
        $availability = $dao->getData($fields='*', 'slots1', $condition);

        if ($availability) {
            // If available, book the slot
            $data = array(
                'p_id' => $_POST['p_id'],
                'p_name' => $_POST['p_name'],
                'b_id' => $_POST['b_id'],
                'b_name' => $_POST['b_name'],
                'v_id' => $vaccine_id,
                'v_name' => $_POST['v_name'],
                'c_id' => $center_id,
                'c_name' => $_POST['c_name'],
                'date' => $formatted_date,
                'time_slot' => $time_slot,
                'status' => "booked"
            );

            if ($dao->insert($data, "appointments")) {
                // Update the slot availability
                // $update_data = array('is_available' => 0); // Mark slot as unavailable
                // $update_condition = "c_id=$center_id AND v_id=$vaccine_id AND time_slot='$time_slot'";
                // $dao->update($update_data, "slots1", $update_condition);
                echo "<script>alert('Appointment booked successfully');</script>";
                header("location:wel_parant.php?id=$pid");
            } else {
                echo "<script>alert('Error: Failed to book appointment.');</script>";
            }
        } else {
            echo "<script>alert('Selected time slot is not available. Please choose a different slot.');</script>";
        }
    }
}
?>

<html>
<head>
    <title>Appointment Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&display=swap" rel="stylesheet">
    <style>
               


        body {
            font-family: Arial, sans-serif;
            background-color: rgb(9 120 212 / 95%);
            
        }
        h2{
    margin-top: 31px;
    margin-bottom: 10px;
    color: white;
    font-size: 28px;
    font-family: "Playfair Display", serif;
  font-optical-sizing: auto;
  font-weight: bold;
  font-style: normal;
}
        h2,.form{
            display: flex;
            justify-content: center;
            align-items: center;
           
        }
        .form1{
            width: 50%;
            filter: drop-shadow(offset-x offset-y blur-radius #333);
            background-color:mediumseagreen;
            border-radius: 80px;
            height: 390px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 4px 8px rgba(0, 0, 0, 0.1);
            position:fixed;
           top:15%;
            left: 25%;
            right: 25%;
            bottom: 25%;
        }
        input[name='p_id']{
            margin-top: 20px;
        }
        input,select,label{
            margin-bottom: 10px;
            width: 50%;
            height: 25px;
            border: none;
            margin-left: 60px;
        }
      
/* CSS */
.button-3 {
  appearance: none;
  background-color: #2ea44f;
  border: 1px solid rgba(27, 31, 35, .15);
  border-radius: 6px;
  box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
  font-size: 14px;
  font-weight: 600;
  line-height: 20px;
  padding: 6px 16px;
  text-align: center;
  text-decoration: none;
  user-select: none;
  position: relative;
  top: 430px;
  left: 0;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  white-space: nowrap;

}

.button-3:focus:not(:focus-visible):not(.focus-visible) {
  box-shadow: none;
  outline: none;
}

.button-3:hover {
  background-color: #2c974b;
}

.button-3:focus {
  box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
  outline: none;
}

.button-3:disabled {
  background-color: #94d3a2;
  border-color: rgba(27, 31, 35, .1);
  color: rgba(255, 255, 255, .8);
  cursor: default;
}

.button-3:active {
  background-color: #298e46;
  box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
}
       


.form__group {
  position: relative;
  padding: 15px 0 0;
  margin-top: 10px;
  width: 50%; /* You can adjust this width based on your layout */
}

.form__field {
  font-family: inherit;
  width: 100%;
  border: 0;
  border-bottom: 2px solid #9b9b9b;
  outline: 0;
  font-size: 1.3rem;
  color: #fff;
  padding: 7px 0;
  background: transparent;
  transition: border-color 0.2s;

  &::placeholder {
    color: transparent;
  }

  &:placeholder-shown ~ .form__label {
    font-size: 1.3rem;
    cursor: text;
    top: 20px;
  }
}

.form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 1rem;
  color: #9b9b9b;
}

.form__field:focus {
  ~ .form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size: 1rem;
    color: #11998e;
    font-weight: 700;
  }
  padding-bottom: 6px;
  font-weight: 700;
  border-width: 3px;
  border-image: linear-gradient(to right, #11998e, #38ef7d);
  border-image-slice: 1;
}

/* Reset input */
.form__field {
  &:required, &:invalid { 
    box-shadow: none; 
  }
}
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Appointment Booking</h2>
    <div class="form">
        <div class="form1">
<form action="" method="POST">
    <!-- Parent ID -->
    <div class="row">
        <div class="col-md-6">
            <label>Parent ID:</label>
            <?= $form->textBox('p_id', array('class'=>'form-control','value'=>($eva[0]['pid'])?$eva[0]['pid']:'','placeholder'=>"Enter parant Id")); ?>
            <?= $validator->error('p_id'); ?>
        </div>
    </div>

    <!-- Parent Name -->
    <div class="row">
        <div class="col-md-6">
        <label> Parent Name:</label>
            <?= $form->textBox('p_name', array('class'=>'form-control','value'=>$eva[0]['parent_names'],'placeholder'=>"Enter Parant Name")); ?>
            <?= $validator->error('p_name'); ?>
        </div>
    </div>

    <!-- Child ID -->
    <div class="row">
        <div class="col-md-6">
        <label>Child ID:</label>
            <?= $form->textBox('b_id', array('class'=>'form-control','value'=>($eva[0]['b_id'])?$eva[0]['b_id']:'whirbvef','placeholder'=>"Enter Baby Id")); ?>
            <?= $validator->error('b_id'); ?>
        </div>
    </div>

    <!-- Child Name -->
    <div class="row">
        <div class="col-md-6">
        <label>Child Name:</label>
            <?= $form->textBox('b_name', array('class'=>'form-control','value'=>$eva[0]['name'],'placeholder'=>"Enter Baby Name")); ?>
            <?= $validator->error('b_name'); ?>
        </div>
    </div>

    <!-- Center ID -->
    <div class="row">
        <div class="col-md-6">
        <label>Center ID:</label>
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
        <label>Center Name:</label>
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
        <label>Vaccine ID:</label>
            <?php
            $options = $dao->createOptions("name", "vid", "b_vaccines");
            $firstOption = array('Select a Vaccine' => '');  // Default first option
            $options = array_merge($firstOption, $options);
            $selectedValue='';

            echo $form->dropDownList(
                'v_id',                    // Name of the dropdown
                $selectedValue, // Default selected value
                $options,                  // Options for the dropdown
                array('class' => 'form-control')); // HTML options
            ?>
            <?= $validator->error('v_id'); ?>
        </div>
    </div>

    <!-- Vaccine Name -->
    <div class="row">
        <div class="col-md-6">
        <label>Vaccine Name:</label>
            <?php
            $options = $dao->createOptions("name", "name", "b_vaccines");
            $firstOption = array('Select a Vaccine' => '');  // Default first option
            $options = array_merge($firstOption, $options);
            $selectedValue = ''; 
            echo $form->dropDownList(
                'v_name',                    // Name of the dropdown
                $selectedValue,            // Default selected value
                $options,                  // Options for the dropdown
                array('class' => 'form-control','value'=>'')); // HTML options
            ?>
            
            <?= $validator->error('v_name'); ?>
        </div>
    </div>

    <!-- Date -->
    <div class="row">
        <div class="col-md-6">
        <label>Date:</label>
            <?= $form->textBox('date', array('class' => 'form-control','value'=>"", 'placeholder' => 'dd-mm-yyyy')); ?>
            <?= $validator->error('date'); ?>
        </div>
    </div>

    <!-- Time Slot -->
    <div class="row">
        <div class="col-md-6">
        <label>Time Slot:</label>
            <select name="time_slot" class="form-control">
                <option value="">Select Time Slot</option>
                <?php foreach ($time_slots as $slot) : ?>
                    <option value="<?= $slot; ?>"><?= $slot; ?></option>
                <?php endforeach; ?>
            </select>
            <?= $validator->error('time_slot'); ?>
        </div>
    </div>

  </div>
    <button type="submit" name="btn_book" class="button-3">Book Appointment</button>
</form>
</div>
<!-- JavaScript to handle real-time form validation -->
<script>
    $(document).ready(function() {
        // Implement real-time data handling here
    });
</script>

</body>
</html>
