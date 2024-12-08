<?php 
require('../config/autoload.php'); 
include("header.php");

$file = new FileUpload();
$elements = array(
    "v_name" => "", 
    "age" => "", 
    "doesses" => "", 
    "month_gap" => "", 
    "side" => "", 
    "booster" => "", 
    "v_type" => "",
    "administration_method"=>"",
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array(
    'v_name' => "Vaccine Name",
    'doesses' => "Doses Given",
    'age' => "Age",
    'month_gap' => "Next Dose",
    'side' => "Side Effects",
    'booster' => "Booster Required",
    'v_type' => "Vaccine Type"
);

$rules = array(
    "v_name" => array("required" => true, "minlength" => 3, "maxlength" => 60),
    "age" => array("required" => true, "minlength" => 1, "maxlength" => 60),
    "doesses" => array("required" => true, "minlength" => 1, "maxlength" => 50),
    "month_gap" => array("required" => true, "minlength" => 1, "maxlength" => 50),
    "side" => array("required" => true, "minlength" => 10, "maxlength" => 100),
    "booster" => array("required" => true, "minlength" => 1, "maxlength" => 50),
    "v_type" => array("required" => true, "minlength" => 3, "maxlength" => 30, "alphaspaceonly" => true),
    "administration_method" => array("required" => true, "minlength" => 3, "maxlength" => 30, "alphaspaceonly" => true)
);

$validator = new FormValidator($rules, $labels);

if (isset($_POST["btn_insert"])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'name' => $_POST['v_name'], // Corrected here
            'age_given' => $_POST['age'],
            'doses_required' => $_POST['doesses'],
            'shedule_catagory' => $_POST['month_gap'],
            'side_effects' => $_POST['side'],
            'booster_required' => $_POST['booster'],
            'vaccine_type' => $_POST['v_type'],
            'vacination_method' => $_POST['administration_method'],
           
        );

        // Attempt to insert the data
        if ($dao->insert($data, "b_vaccines")) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: Failed to insert data.');</script>";
        }
    }
}
?>

<html>
<head>
    <title>Vaccine Entry</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                Vaccine Name:
                <?= $form->textBox('v_name', array('class' => 'form-control', 'value' => '')); ?>
                <?= $validator->error('v_name'); ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                Age Given:
                <?= $form->textBox('age', array('class' => 'form-control', 'value' => '')); ?>
                <?= $validator->error('age'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Month Gap:
                <?= $validator->error('month_gap'); ?>
                <?= $form->dropDownList('month_gap', array('class' => 'form-control'), 
            array(
                'none' => 'null', 
                '1.5 month' => '1.5', 
                '2.5 month' => '2.5'
            )); 
        ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Doses Required:
                <?= $form->textBox('doesses', array('class' => 'form-control', 'value' => '')); ?>
                <?= $validator->error('doesses'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Side Effects:
                <?= $form->textBox('side', array('class' => 'form-control', 'value' => '')); ?>
                <?= $validator->error('side'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Booster Required:
                <?= $form->textBox('booster', array('class' => 'form-control', 'value' => '')); ?>
                <?= $validator->error('booster'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                Vaccine Type:
                <?= $form->textBox('v_type', array('class' => 'form-control', 'value' => '')); ?>
                <?= $validator->error('v_type'); ?>
            </div>
        </div>

        <div class="row">
    <div class="col-md-6">
        Administration Method:
        <?= $form->dropDownList('administration_method', array('class' => 'form-control'), 
            array(
                'Injection' => 'Injection', 
                'Oral' => 'Oral', 
                'Subcutaneous' => 'Subcutaneous'
            )); 
        ?>
        <?= $validator->error('administration_method'); ?>
    </div>
</div>


        <br><br>
        <button type="submit" name="btn_insert">Submit</button>
    </form>
</body>
</html>
