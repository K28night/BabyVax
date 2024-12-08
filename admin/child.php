<?php 

require('../config/autoload.php'); 
$pid=$_GET['pid'];

// Initialize form elements
$elements = array(
    "name" => "",
    "date_of_birth" => "",
    "gender" => "",
    "parent_names" => "",
    "blood_group" => "",
    "height" => "",
    "weight" => "",
    "medical_conditions" => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();
$parent = $dao->getData("pname", 'registration', "pid='$pid'"); 
// Labels for form fields
$labels = array(
    'name' => "Baby Name",
    'date_of_birth' => "Date of Birth",
    'gender' => "Gender",
    'parent_names' => "Parent Names",
    'blood_group' => "Blood Group",
    'height' => "Height (cm)",
    'weight' => "Weight (kg)",
    'medical_conditions' => "Medical Conditions"
);

// Validation rules
$rules = array(
    "name" => array("required" => true, "minlength" => 2, "maxlength" => 100, "alphaspaceonly" => true),
    "date_of_birth" => array("required" => true, "date" => true),
    "gender" => array("required" => true, "maxlength" => 10), // Modify as needed for options like "Male", "Female"
    "parent_names" => array("required" => true, "minlength" => 2, "maxlength" => 200),
    "blood_group" => array("required" => true, "maxlength" => 10),
    "height" => array("required" => true,),
    "weight" => array("required" => true,),
    "medical_conditions" => array("maxlength" => 255) // Optional field
);

$validator = new FormValidator($rules, $labels);


// Handle form submission
if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'name' => $_POST['name'],
            'date_of_birth' => $_POST['date_of_birth'],
            'gender' => $_POST['gender'],
            'parent_names' => $_POST['parent_names'],
            'pid'=>$pid,
            'blood_group' => $_POST['blood_group'],
            'height' => $_POST['height'],
            'weight' => $_POST['weight'],
            'medical_conditions' => $_POST['medical_conditions']
        );

        if ($dao->insert($data, "baby_details")) {
            echo "<script>alert('New baby record created success fully');</script>";
            header('location:wel_parant.php?id='.$pid);
        } else {
            echo "<script>alert('Error: Failed to insert data.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Baby Details</title>
    <style>
        .row{
            margin-bottom: 10px;
            font-size: 20px;
        }
        button{
            background-color:cadetblue;  
        }
        textarea{
            width: 85%;
            height: 100px;
            font-size: 18px;
        }
        input[type=text]{
            width: 80%;
            height: 20px;
            font-size: 18px;
        }
        select{
            width: 80%;
            height: 30px;
            font-size: 18px;
        }
        form{
            background-color: #fff; /* Background color for the form */
            padding: 20px; /* Padding around the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            width: 400px; 
        }
       
    </style>
</head>
<body style="align-items:center;justify-content:center;display:flex;height:100vh;background-color:chartreuse ">

<form  method="POST" enctype="multipart/form-data">
    <div class="row" >
        <div class="col-md-6">
            Baby Name:
            <?= $form->textBox('name', array('class'=>'form-control', 'value'=>'','placeholder'=>'baby name')); ?>
            <?= $validator->error('name'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Date of Birth:
            <?= $form->textBox('date_of_birth', array('class'=>'form-control', 'type' => 'date', 'value'=>'','placeholder'=>'0000-00-00')); ?>
            <?= $validator->error('date_of_birth'); ?>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
        Gender:<br>
        <?= $form->dropDownList('gender', 
            array('class' => 'form-control'), 
            array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other')); ?>
        <?= $validator->error('gender'); ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-6">
            Parent Names:
            <?= $form->textBox('parent_names', array('class'=>'form-control', 'value'=>$parent[0]['pname'])); ?>
            <?= $validator->error('parent_names'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Blood Group:
            <?= $form->dropDownList('blood_group', 
                array('class' => 'form-control'), 
                array(
                    'select' => '', 
                    'A+' => 'A+', 
                    'A-' => 'A-', 
                    'B+' => 'B+', 
                    'B-' => 'B-', 
                    'AB+' => 'AB+', 
                    'AB-' => 'AB-', 
                    'O+' => 'O+', 
                    'O-' => 'O-'
                )); ?>
            <?= $validator->error('blood_group'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Height (cm):
            <?= $form->dropDownList('height', 
                array('class' => 'form-control'), 
                array_combine(range(50, 100), range(50, 100))); ?>
            <?= $validator->error('height'); ?>
        </div>
    </div>  

<div class="row">
    <div class="col-md-6">
        Weight (kg):
        <?= $form->dropDownList('weight', 
            array('class' => 'form-control'), 
            array_combine(range(3, 20), range(3, 20))); ?>
        <?= $validator->error('weight'); ?>
    </div>
</div>
    <div class="row">
        <div class="col-md-6">
            Medical Conditions:
            <?= $form->textArea('medical_conditions', array('class'=>'form-control', 'value'=>'')); ?>
            <?= $validator->error('medical_conditions'); ?>
        </div>
    </div>

    <button type="submit" name="btn_insert" class="btn btn-primary">Submit</button>
</form>

</body>
</html>
