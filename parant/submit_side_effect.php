<?php 
require('../config/autoload.php'); 

$dao = new DataAccess();
if(isset($_GET['pid'])){
$pid=$_GET['pid'];}
else{
    header("Location: p_login.php");
}

if (empty($dao->count('id', 'appointments', "status='completed' AND p_id=$pid"))) {
    echo "<script>alert('First Take vaccination Then Send Report');</script>";
    echo "<script>window.location.href='wel_parant.php?id=$pid';</script>";
    exit; // Ensure no further script execution
}
// Form elements for appointment data
$elements = array(
    "p_id" => "",
    "b_id" => "",
    "v_id" => "",
  "side_effects" => "",
  
   
);
$form = new FormAssist($elements, $_POST);

$eva = $dao->getData('*', 'baby_details', "pid='$pid'");

$labels = array(
    "p_id" => "Parent ID",
    "b_id" => "Child ID",
    "c_id" => "Center ID",
    "v_id" => "Vaccine ID",
    "side_effects" => " Side Effects"
);

$rules = array(
    "p_id" => array("required" => true),
    "b_id" => array("required" => true),
    "v_id" => array("required" => true),
    "side_effects" => array("required" => true)
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_book"])) {
    if ($validator->validate($_POST)) {
        // Formatting the date to Y-m-d
      
      
        $vaccine_id = $_POST['v_id'];
     
    
$vname=$dao->getData("name",'b_vaccines',"vid='$vaccine_id'");

        // Check slot availability based on center, vaccine, time slot, and date
       

      
            // If available, book the slot
            $data = array(
                'parent_id' => $_POST['p_id'],
                'baby_id' => $_POST['b_id'],
                'vaccine_id' => $vaccine_id,
                'side_effects' => $_POST['side_effects'],
                'report_date'=>'CURRENT_TIMESTAMP',
            );

            if ($dao->insert($data, "reported_side_effects")) {
                // Update the slot availability
                // $update_data = array('is_available' => 0); // Mark slot as unavailable
                // $update_condition = "c_id=$center_id AND v_id=$vaccine_id AND time_slot='$time_slot'";
                // $dao->update($update_data, "slots1", $update_condition);
                echo "<script>alert('Successfully Added');</script>";
                header("location:wel_parant.php?id=$pid");
            } else {
                echo "<script>alert('Error: Execution Failed.');</script>";
            }}
        // } else {
        //     echo "<script>alert('Selected slot is not available. Please choose a different slot.');</script>";
        // }
    }

?>

<html>
<head>
    <title>Send A report</title>
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
            width: 60%;
            filter: drop-shadow(offset-x offset-y blur-radius #333);
            background-color:mediumseagreen;
            border-radius: 80px;
            height: 60%;
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
  top: 320px;
  left: 50px;
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
text{
    margin-left: 10px;
}
textarea{
    margin-left: 20%;
    margin-top: 2%;
    height: 40%;
    width: 60%;
    border: none;
}
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&display=swap" rel="stylesheet">
</head>
<body>
   
    <h2>Send A Side-Effect Report</h2>
    <div class="form">
        <div class="form1">
<form  id="appointmentForm" action="" method="POST">
    <!-- Parent ID -->
    <div class="row">
        <div class="col-md-6">
            <label>Parent ID:</label>
            <?= $form->textBox('p_id', array('class'=>'form-control','value'=>($eva[0]['pid'])?$eva[0]['pid']:'','placeholder'=>"Enter parant Id")); ?>
            <?= $validator->error('p_id'); ?>
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



    <!-- Vaccine ID -->
    <div class="row">
    <div class="col-md-6">
        <label>Vaccine Name:</label>
        <?php
        $v=$dao->getData('v_id','appointments',"p_id=$pid");
        $vi=$v[0]['v_id'];
        $options = $dao->createOptions("name", "vid", "b_vaccines","vid=$vi");
        $firstOption = array('Select a Vaccine' => '');  // Default first option
        $options = array_merge($firstOption, $options);
        echo $form->dropDownList('v_id', array('class' => 'form-control'), $options);
        ?>
        <?= $validator->error('v_id'); ?>
    </div>
</div>




    <!-- Time Slot -->
    <div class="row">
        <div class="col-md-6">
      
        <?= $form->textArea('side_effects', array('class'=>'form-control','value'=>'','placeholder'=>"Enter Side Effects",'col'=>5)); ?>
            <?= $validator->error('side_effects'); ?>
        </div>
    </div>

  </div>
    <button type="submit" name="btn_book" class="button-3">Submit Report</button>
</form>
</div>
<!-- JavaScript to handle real-time form validation -->

   <script>
    document.getElementById('appointmentForm').addEventListener('submit', function (e) {
        var appointmentDate = new Date(document.getElementById('date').value);
        var currentDate = new Date();

        // Check if the appointment date is in the past
        if (appointmentDate < currentDate) {
            alert("The appointment date cannot be in the past");
            e.preventDefault(); // Prevent form submission
        }
    });

</script>

</body>
</html>
