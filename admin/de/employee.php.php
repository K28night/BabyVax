<?php 

 require('../config/autoload.php'); 
include("header.php");

$file=new FileUpload();
$elements=array(
        "ename"=>"","eage"=>"");


$form=new FormAssist($elements,$_POST);



$dao=new DataAccess();

$labels=array('ename'=>"eame",'eage'=>"eage" );

$rules=array(
    "ename"=>array("required"=>true,"minlength"=>3,"maxlength"=>30,"alphaspaceonly"=>true),
    "eage"=>array("required"=>true,"minlength"=>2,"maxlength"=>3,"intergeronly"=>true),

);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	


$data=array(

        'cname'=>$_POST['cname'],
        'eage'=>$_POST['eage'],
        
         
    );
  
    if($dao->insert($data,"category"))
    {
        echo "<script> alert('New record created successfully');</script> ";
header('location:category.php');


    }
    else
        {$msg="Registration failed";} ?>

<span style="color:red;"><?php echo $msg; ?></span>

<?php
    


}

}
?>
<html>
<head>
</head>
<body>

 <form action="" method="POST" enctype="multipart/form-data">
 
 
<div class="row">
                    <div class="col-md-6">
Name:

<?= $form->textBox('ename',array('class'=>'form-control')); ?>
<?= $validator->error('ename'); ?>
age:
<?= $form->textBox('eage',array('class'=>'form-control')); ?>
<?= $validator->error('ename'); ?>
</div>
</div>



<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


