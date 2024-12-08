<?php 

 require('../config/autoload.php'); 
// include("oghead.php");

$file=new FileUpload();
$elements=array(
        "sname"=>"","simage"=>"");


$form=new FormAssist($elements,$_POST);



$dao=new DataAccess();

$labels=array('sname'=>"Department Name","simage"=>"Department Image" );

$rules=array(
    "sname"=>array("required"=>true,"minlength"=>3,"maxlength"=>30),
    
"simage"=> array('filerequired'=>true)
     
);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{
	
if($fileName=$file->doUploadRandom($_FILES['simage'],array('.jpg','.png','.jpeg'),100000,1,'../uploads'))
		{

$data=array(

        'sname'=>$_POST['sname'],
        
          'simage'=>$fileName,
		
    );
  
    if($dao->insert($data,"student05"))
    {
        echo "<script> alert('New record created successfully');</script> ";
header('location:category.php');
    }
    else
        {$msg="Registration failed";} ?>

<span style="color:red;"><?php echo $msg; ?></span>

<?php
    
}
else
echo $file->errors();
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

<?= $form->textBox('sname',array('class'=>'form-control')); ?>
<?= $validator->error('sname'); ?>

</div>
</div>



<div class="row">
                    <div class="col-md-6">
IMAGE:

<?= $form->fileField('simage',array('class'=>'form-control')); ?>
<span style="color:red;"><?= $validator->error('simage'); ?></span>

</div>
</div>






<button type="submit" name="btn_insert"  >Submit</button>
</form>


</body>

</html>


