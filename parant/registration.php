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
    "pin" => array("required" => true, "minlength" => 4, "maxlength" => 20, "integeronly" => true),
    "phno" => array("required" => true, "minlength" => 10, "maxlength" => 10, "integeronly" => true),
    "email" => array("required" => true, "maxlength" => 50,"email"=>true),
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
       h2 {
            text-align: center;
            margin-top: 20px;
            font-size: 30px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex; /* Flexbox for vertical and horizontal alignment */
            justify-content: center;
            align-items: center;
            
        }
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .form {
            width: 500px;
            background: #f9f9f9;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 14px;
            background-color: #28a745;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
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
            <?= $form->textBox('pname', array('class' => 'form-control', 'value' => '',"placeholder"=>'Enter Name')); ?>
            <?= $validator->error('pname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Address:
            <?= $form->textArea('address', array('class' => 'form-control', 'placeholder' => 'Enter address', 'rows' => 4)); ?>
            <?= $validator->error('address'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Email:
            <?= $form->textBox('email', array('class' => 'form-control', 'value' => '',"placeholder"=>'Enter Email')); ?>
            <?= $validator->error('email'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Phone Number:
            <?= $form->textBox('phno', array('class' => 'form-control', 'value' => '',"placeholder"=>'Enter Phone Number')); ?>
            <?= $validator->error('phno'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Pin Code:
            <?= $form->textBox('pin', array('class' => 'form-control', 'value' => '',"placeholder"=>'Enter Pin code')); ?>
            <?= $validator->error('pin'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Taluk:
            <?php
            $options = $dao->createOptions("location", "location", "hcenters");
            $options = array('Select City' => '') + $options;
            echo $form->dropDownList('city', array('class' => 'form-control', 'value' => '','selected'=>'svefvwv'), $options);
            ?>
            <?= $validator->error('city'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            Password:  <!-- New password field -->
            <?= $form->textBox('password', array('class' => 'form-control', 'type' => 'password', 'value' => '',"placeholder"=>'Enter Password')); ?>
            <?= $validator->error('password'); ?>
        </div>
    </div>

    <button type="submit" name="btn_insert">Submit</button>
</form>
</div>
</body>
</html>
