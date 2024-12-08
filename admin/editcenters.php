<?php 

 require('../config/autoload.php'); 


$file=new FileUpload();
$elements=array(
        "hname"=>"","location"=>"","pin"=>"","email"=>"","pass"=>"",'img'=>"",'phno'=>"");
        


$form=new FormAssist($elements,$_POST);
$dao=new DataAccess();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $condition="hid=$id"; // Retrieve the 'id' from the URL
    // You can now use $id in your logic
    $users=$dao->getData($fields='*','hcenters',$condition);
    
}



$labels=array('hname'=>"Student Name",'pin'=>"Pincode",'location'=>"Location",'email'=>"Email",'pass'=>" password",'img'=>"image");

$rules=array(
    "hname"=>array("required"=>true,"minlength"=>3,"maxlength"=>80,"alphaspaceonly"=>true),
    "location"=>array("required"=>true,"minlength"=>1,"maxlength"=>30),
    "pin"=>array("required"=>true,"minlength"=>1,"maxlength"=>30),
    "phno"=>array("required"=>true,"minlength"=>1,"maxlength"=>30),
    "email"=>array("required"=>true,"minlength"=>10,"maxlength"=>50),
    "pass"=>array("required"=>true,"minlength"=>5,"maxlength"=>10),
    "img"=>array('filerequired'=>true),
    // "ssex"=>array("required"=>true,"minlength"=>1,"maxlength"=>1,"alphaonly"=>true),
   

);
    
    
$validator = new FormValidator($rules,$labels);

if(isset($_POST["btn_insert"]))
{

if($validator->validate($_POST))
{

if($fileName=$file->doUploadRandom($_FILES['img'],array('.jpg','.png','.jfif','.jpeg'),100000,2,'../uploads'))
    {
$data=array(

        'hname'=>$_POST['hname'],
        'location'=>$_POST['location'],
        'pin'=>$_POST['pin'],
        'email'=>$_POST['email'],
        'phno'=>$_POST['phno'],
        'pass'=>$_POST['pass'],
        'img'=>$fileName,
      
         
    );
    // $condition="hid='$id'";
    if($dao->update($data, 'hcenters', $condition))
    {
        echo "<script> alert('New record created successfully');</script> ";

    }
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

<?= $form->textBox('hname',array('class'=>'form-control','value' => isset($users[0])?$users[0]['hname']:'')); ?>
<?= $validator->error('hname'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
location:

<?= $form->textBox('location',array('class'=>'form-control','value' => isset($users[0])?$users[0]['location']:'')); ?>
<?= $validator->error('location'); ?>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
Email:

<?= $form->textBox('email',array('class'=>'form-control','value' => isset($users[0])?$users[0]['email']:'')); ?>
<?= $validator->error('email'); ?>

</div>
</div>



<div class="row">
                    <div class="col-md-6">
Pin Code:

<?= $form->textBox('pin',array('class'=>'form-control','value' => isset($users[0])?$users[0]['pin']:'')); ?>
<?= $validator->error('pin'); ?>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
Phone Number:

<?= $form->textBox('phno',array('class'=>'form-control','value' => isset($users[0])?$users[0]['phno']:'')); ?>
<?= $validator->error('phno'); ?>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
Password:

<?= $form->textBox('pass',array('class'=>'form-control','value' => isset($users[0])?$users[0]['pass']:'')); ?>
<?= $validator->error('pass'); ?>

</div>
 </div>


<div class="row">
        <div class="col-md-6">
image of Center:
<?= $form->fileField('img',array('class'=>'form-control','value' => isset($users[0])?$users[0]['img']:'')); ?>
<span style="color:red;"><?= $validator->error('img'); ?></span>
    <?php if (isset($users[0]['img']) && !empty($users[0]['img'])): ?>
            <div style="margin-top: 10px;">
                <p>Current Image:</p>
                <img src="<?= '../uploads/'. $users[0]['img']; ?>" alt="Center Image" style="max-width: 600px; height: 300px;">
            </div>
    <?php endif; ?>
        </div>
</div>
<br><br>
<button type="submit" name="btn_insert" value="<?php (isset($id))?'Edit':'Submit'?>" >Submit</button>
</form>


</body>

</html>


