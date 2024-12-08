<?php 

 require('../config/autoload.php'); 


$file=new FileUpload();
$elements=array(
        "name"=>"","date_of_birth"=>"","gender"=>"","parent_names"=>"","blood_group"=>"",'height'=>"",'weight'=>"",'medical_conditions'=>"");
$form=new FormAssist($elements,$_POST);
$dao=new DataAccess();
if (isset($_GET['?id'])) {
    $id = $_GET['?id'];
    $hid=$_GET['pid'];
    $condition="b_id='$id'"; // Retrieve the 'id' from the URL
    // You can now use $id in your logic
    $users=$dao->getData('*','baby_details',$condition);
    
}
$labels=array('name'=>"Student Name",'gender'=>"gender",'date_of_birth'=>"date_of_birth",'blood_group'=>"blood_group",'height'=>" height",'medical_conditions'=>"",'weight'=>"");
$rules=array(
    "name"=>array("required"=>true,"alphaspaceonly"=>true),
    "date_of_birth"=>array("required"=>true),
    "gender"=>array("required"=>true,),
    "parent_names"=>array("required"=>true),
    "blood_group"=>array("required"=>true),
    "height"=>array("required"=>true),
    "medical_conditions"=>array("required"=>true),
    "weight"=>array("required"=>true),
    // "ssex"=>array("required"=>true,"minlength"=>1,"maxlength"=>1,"alphaonly"=>true),
   

);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{


$data=array(

        'name'=>$_POST['name'],
        'date_of_birth'=>$_POST['date_of_birth'],
        'gender'=>$_POST['gender'],
        'blood_group'=>$_POST['blood_group'],
        'parent_names'=>$_POST['parent_names'],
        'height'=>$_POST['height'],
        'medical_conditions'=>$_POST['medical_conditions'],
        'weight'=>$_POST['weight'],
      
         
    );
    $condition="b_id='$id'";
    if($dao->update($data, 'baby_details', $condition))
    {
        echo "<script> alert('New record created successfully');</script> ";
        header('location:p_view_baby.php?pid='.$hid);

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
    <style>
        body{
            align-items: center;
            justify-content: center;
            display: flex;
        }
        .row{
            margin-bottom: 10px;
            font-size: 20px;
        }
        button{
            background-color:cadetblue; 
            margin-top: 10px; 
            width: 120px;
            height: 40px;
            border-radius: 10px;
            border-color:cadetblue ;
           margin-left: 120px;
            align-items: center;
            justify-content: center;
           font-size: 20px;
        }
        button:hover{
        background-color:cadetblue;
        transform: translateY(-2px);
       box-shadow: offsetX offsetY blur-radius spread-radius #333;
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
<body>

 <form action="" method="POST" enctype="multipart/form-data">
 
<div class="row">
                    <div class="col-md-6">
Baby Name:

<?= $form->textBox('name',array('class'=>'form-control','value' => isset($users[0])?$users[0]['name']:'fgnrn')); ?>
<?= $validator->error('name'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
Date Of Birth:

<?= $form->textBox('date_of_birth',array('class'=>'form-control','value' => isset($users[0])?$users[0]['date_of_birth']:'')); ?>
<?= $validator->error('date_of_birth'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
Blood Group:

<?= $form->textBox('blood_group',array('class'=>'form-control','value' => isset($users[0])?$users[0]['blood_group']:'')); ?>
<?= $validator->error('blood_group'); ?>

</div>
</div>



<div class="row">
                    <div class="col-md-6">
Gender:

<?= $form->textBox('gender',array('class'=>'form-control','value' => isset($users[0])?$users[0]['gender']:'')); ?>
<?= $validator->error('gender'); ?>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
Parent Names:

<?= $form->textBox('parent_names',array('class'=>'form-control','value' => isset($users[0])?$users[0]['parent_names']:'')); ?>
<?= $validator->error('parent_names'); ?>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
Height:<br>

<?= $form->textBox('height',array('class'=>'form-control','value' => isset($users[0])?$users[0]['height']:'')); ?>
<?= $validator->error('height'); ?>

</div>
 </div>
 <div class="row">
        <div class="col-md">
 weight(kg):
<?= $form->textBox('weight',array('class'=>'form-control','value' => isset($users[0])?$users[0]['weight']:'')); ?>
<?= $validator->error('weight'); ?>

        </div>
</div>

<div class="row">
        <div class="col-md">
Medical Conditions:

<?= $form->textBox('medical_conditions',array('class'=>'form-control','name'=>'teaxarea','value' => isset($users[0])?$users[0]['medical_conditions']:'')); ?>
<?= $validator->error('medical_conditions'); ?>

        </div>
</div>
<div class="row">
        <div class="col-md-6">


<button type="submit" name="btn_insert" value="<?php (isset($id))?'Edit':'Submit'?>" >Submit</button>
</form>


</body>

</html>


