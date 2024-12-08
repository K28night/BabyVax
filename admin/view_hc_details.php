<?php 
require('../config/autoload.php'); 

$file = new FileUpload();
$elements = array(
    "lid" => "", "hname" => "", "location" => "", "pin" => "", "email" => "", "pass" => "", 'img' => "", 'phno' => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array(
    'lid' => "License Id", 'hname' => "Center Name", 'pin' => "Pincode", 
    'location' => "Location", 'email' => "Email", 'pass' => "Password", 
    'img' => "Image", 'phno' => "Phone Number"
);

$rules = array(
    "lid" => array("required" => true, "minlength" => 10, "maxlength" => 15),
    "hname" => array("required" => true, "minlength" => 3, "maxlength" => 80),
    "location" => array("required" => true, "minlength" => 1, "maxlength" => 30),
    "pin" => array("required" => true, "minlength" => 1, "maxlength" => 30),
    "phno" => array("required" => true, "minlength" => 1, "maxlength" => 30),
    "email" => array("required" => true, "minlength" => 10, "maxlength" => 50),
    "pass" => array("required" => true, "minlength" => 5, "maxlength" => 10),
    "img" => array('filerequired' => true),
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        if ($fileName = $file->doUploadRandom($_FILES['img'], array('.jpg', '.png', '.jfif', '.jpeg'), 100000, 2, '../uploads')) {
            $data = array(
                'lid' => $_POST['lid'],
                'hname' => $_POST['hname'],
                'location' => $_POST['location'],
                'pin' => $_POST['pin'],
                'email' => $_POST['email'],
                'phno' => $_POST['phno'],
                'pass' => $_POST['pass'],
                'img' => $fileName,
                'approve_ad' => '0',
            );
            if ($dao->insert($data, "hcenters")) {
                echo "<script> alert('New record created successfully');</script> ";
            }
            else { 
                echo "<script> alert('Error creating new record');</script> ";
            } 
        }
        else{
            echo "<script> alert('Error uploading file');</script> ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Center Registration</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>

<h2>Edit Health Center </h2>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <label for="lid">Center Id (On License):</label>
        <?= $form->textBox('lid', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('lid'); ?></span>
    </div>

    <div class="row">
        <label for="hname">Center Name:</label>
        <?= $form->textBox('hname', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('hname'); ?></span>
    </div>

    <div class="row">
        <label for="location">Location:</label>
        <?= $form->textBox('location', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('location'); ?></span>
    </div>

    <div class="row">
        <label for="email">Email:</label>
        <?= $form->textBox('email', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('email'); ?></span>
    </div>

    <div class="row">
        <label for="pin">Pin Code:</label>
        <?= $form->textBox('pin', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('pin'); ?></span>
    </div>

    <div class="row">
        <label for="phno">Phone Number:</label>
        <?= $form->textBox('phno', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('phno'); ?></span>
    </div>

    <div class="row">
        <label for="pass">Password:</label>
        <?= $form->textBox('pass', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('pass'); ?></span>
    </div>

    <div class="row">
        <label for="img">Image of Center:</label>
        <?= $form->fileField('img', array('class' => 'form-control', 'value' => '')); ?>
        <span class="error"><?= $validator->error('img'); ?></span>
    </div>

    <button type="submit" name="btn_insert">Submit</button>
</form>

</body>
</html>
