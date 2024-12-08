<?php 

require('../config/autoload.php'); 

$file = new FileUpload();
$elements = array(
    "pname" => "", 
    "address" => "", 
    "pin" => "", 
    "city" => "taluk", 
    "phno" => "", 
    "email" => "", 
    "password" => ""  // Added password field
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array(
    'pname' => "Parent Name", 
    'pin' => "Pincode", 
    'phno' => "Phone Number", 
    'email' => "Email", 
    'address' => "Address", 
    'password' => "Password" // Added label for password
);

$rules = array(
    "pname" => array("required" => true, "minlength" => 3, "maxlength" => 30, "alphaspaceonly" => true),
    "address" => array("required" => true, "minlength" => 1, "maxlength" => 30),
    "pin" => array("required" => true, "minlength" => 1, "maxlength" => 20),
    "phno" => array("required" => true, "minlength" => 10, "maxlength" => 10, "integeronly" => true),
    "email" => array("required" => true, "maxlength" => 50),
    "city" => array("required" => true, "minlength" => 4, "maxlength" => 50),
    "password" => array("required" => true, "minlength" => 8, "maxlength" => 20) // Added validation for password
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'pname' => $_POST['pname'],
            'paddress' => $_POST['address'],
            'email' => $_POST['email'],
            'phno' => $_POST['phno'],
            'pin' => $_POST['pin'],
            'city' => $_POST['city'],
            'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT) // Hashing the password before storing
        );

        if ($dao->insert($data, "registration")) {
            echo "<script> alert('New record created successfully');</script> ";
            header("location:p_login.php");
        }
    }
}
?>

<html>
<head>
    <style>
        h2{
            text-align: center;
            margin-top: 20px;
            font-size: 30px;
        }
        body {
            font-family: Arial, sans-serif;
            align-items: center;
        }
        form{
         
        }
        input{
            margin-bottom: 10px;

        }
        select{
            margin-bottom: 10px;
        }
        .form{
            display: flex;
          align-items: center;
          justify-content: center;
        }
        button{
            place-items: center;
        }
    </style>
</head>
<body>
<div class="form">
<form action="" method="POST" enctype="multipart/form-data">
<h2>Parent Registration</h2>
    <div class="row">
        <div class="col-md-6">
            Parent Name:
            <?= $form->textBox('pname', array('class' => 'form-control', 'value' => '')); ?>
            <?= $validator->error('pname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Address:
            <?= $form->textBox('address', array('class' => 'form-control', 'value' => '')); ?>
            <?= $validator->error('address'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Email:
            <?= $form->textBox('email', array('class' => 'form-control', 'value' => '')); ?>
            <?= $validator->error('email'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Phone Number:
            <?= $form->textBox('phno', array('class' => 'form-control', 'value' => '')); ?>
            <?= $validator->error('phno'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Pin Code:
            <?= $form->textBox('pin', array('class' => 'form-control', 'value' => '')); ?>
            <?= $validator->error('pin'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Taluk:
            <?php
            $options = $dao->createOptions("location", "location", "hcenters");
            echo $form->dropDownList('city', array('class' => 'form-control', 'value' => '','selected'=>'svefvwv'), $options);
            ?>
            <?= $validator->error('city'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Password:  <!-- New password field -->
            <?= $form->textBox('password', array('class' => 'form-control', 'type' => 'password', 'value' => '')); ?>
            <?= $validator->error('password'); ?>
        </div>
    </div>

    <button type="submit" name="btn_insert">Submit</button>
</form>
</div>
</body>
</html>
