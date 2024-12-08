<?php 

 require('../config/autoload.php'); 


$file=new FileUpload();
$elements=array(
        "sname"=>"",
        "sage"=>"",
        "ssex"=>"",
        "sdob"=>"",
        "simage"=>"",
        "did"=>"");

$form=new FormAssist($elements,$_POST);



$dao=new DataAccess();

$labels=array('sname'=>"ename",'sage'=>"sage",'ssex'=>"ssex",'sdob'=>"sdob",'siamge'=>"simge",'did'=>"did");

$rules=array(
    "sname"=>array("required"=>true,"minlength"=>3,"maxlength"=>30,"alphaspaceonly"=>true),
    "sage"=>array("required"=>true,"minlength"=>2,"maxlength"=>2,"integeronly"=>true),

);
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	


$data=array(

        'sname'=>$_POST['sname'],
        'sage'=>$_POST['sage'],
        'ssex'=>$_POST['ssex'],
        'sdob'=>$_POST['sdob'],
        'simage'=>$_POST['simage'],
        'did'=>$_POST['did'],
       
         
    );
  
    if($dao->insert($data,"staudent"))
    {
        echo "<script> alert('New record created successfully');</script> ";
header('location:employee.php');


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
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>

 <form action="" method="POST" enctype="multipart/form-data">
 
 
<div class="row">
                    <div class="col-md-6">
Name:

<?= $form->textBox('sname',array('class'=>'form-control')); ?>
<?= $validator->error('sname'); ?>
</div>
</div>
<div class="row">
                    <div class="col-md-6">
employee age:
<?= $form->textBox('sage',array('class'=>'form-control')); ?>
<?= $validator->error('sage'); ?>

</div>
</div>

<br>
<br>

<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


