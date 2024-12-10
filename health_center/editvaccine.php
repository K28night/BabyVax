<?php 

 require('../config/autoload.php'); 


$file=new FileUpload();
$elements=array(
        "name"=>"","age_given"=>"","doses_required"=>"","shedule_catagory"=>"","side_effects"=>"",'booster_required'=>"",'vaccine_type'=>"",'vacination_method'=>"");

$form=new FormAssist($elements,$_POST);
$dao=new DataAccess();
if (isset($_GET['?id'])) {
    $id = $_GET['?id'];
    $hid=$_GET['hid'];
    $condition="vid=$id"; // Retrieve the 'id' from the URL
    // You can now use $id in your logic
    $users=$dao->getData('*','b_vaccines',$condition);
    
}



$labels=array('name'=>"Student Name",'doses_required'=>"doses_required",'age_given'=>"age_given",'side_effects'=>"side_effects",'booster_required'=>" booster_required",'vacination_method'=>"",'vaccine_type'=>"");

$rules=array(
    "name"=>array("required"=>true,"alphaspaceonly"=>true),
    "age_given"=>array("required"=>true),
    "doses_required"=>array("required"=>true,),
    "shedule_catagory"=>array("required"=>true),
    "side_effects"=>array("required"=>true),
    "booster_required"=>array("required"=>true),
    "vacination_method"=>array("required"=>true),
    "vaccine_type"=>array("required"=>true),
    // "ssex"=>array("required"=>true,"minlength"=>1,"maxlength"=>1,"alphaonly"=>true),
   

);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{


$data=array(

        'name'=>$_POST['name'],
        'age_given'=>$_POST['age_given'],
        'doses_required'=>$_POST['doses_required'],
        'side_effects'=>$_POST['side_effects'],
        'shedule_catagory'=>$_POST['shedule_catagory'],
        'booster_required'=>$_POST['booster_required'],
        'vacination_method'=>$_POST['vacination_method'],
        'vaccine_type'=>$_POST['vaccine_type'],
      
         
    );
    // $condition="hid='$id'";
    if($dao->update($data, 'b_vaccines', $condition))
    {
        echo "<script> alert('New record created successfully');</script> ";
        header('location:view_vaccine.php?hid='.$hid);

    }
}
}
?>
<html>
<head>
<link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>

 <form action="" method="POST" enctype="multipart/form-data">
 
<div class="row">
                    <div class="col-md-6">
Center Name:

<?= $form->textBox('name',array('class'=>'form-control','value' => isset($users[0])?$users[0]['name']:'fgnrn')); ?>
<?= $validator->error('name'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
age_given:

<?= $form->textBox('age_given',array('class'=>'form-control','value' => isset($users[0])?$users[0]['age_given']:'')); ?>
<?= $validator->error('age_given'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
side_effects:

<?= $form->textBox('side_effects',array('class'=>'form-control','value' => isset($users[0])?$users[0]['side_effects']:'')); ?>
<?= $validator->error('side_effects'); ?>

</div>
</div>



<div class="row">
                    <div class="col-md-6">
doses_required:

<?= $form->textBox('doses_required',array('class'=>'form-control','value' => isset($users[0])?$users[0]['doses_required']:'')); ?>
<?= $validator->error('doses_required'); ?>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
shedule_catagory:

<?= $form->textBox('shedule_catagory',array('class'=>'form-control','value' => isset($users[0])?$users[0]['shedule_catagory']:'')); ?>
<?= $validator->error('shedule_catagory'); ?>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
booster_required:

<?= $form->textBox('booster_required',array('class'=>'form-control','value' => isset($users[0])?$users[0]['booster_required']:'')); ?>
<?= $validator->error('booster_required'); ?>

</div>
 </div>


<div class="row">
        <div class="col-md-6">
vacination_method:

<?= $form->textBox('vacination_method',array('class'=>'form-control','value' => isset($users[0])?$users[0]['vacination_method']:'')); ?>
<?= $validator->error('vacination_method'); ?>

        </div>
</div>
<div class="row">
        <div class="col-md-6">
Vaccine Type:
<?= $form->textBox('vaccine_type',array('class'=>'form-control','value' => isset($users[0])?$users[0]['vaccine_type']:'')); ?>
<?= $validator->error('vaccine_type'); ?>

        </div>
</div>
<br><br>
<button type="submit" name="btn_insert" value="<?php (isset($id))?'Edit':'Submit'?>" >Submit</button>
</form>


</body>

</html>


