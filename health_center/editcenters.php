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
    <link rel="stylesheet" href="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #28a745;
        }

        .form-control {
            border-radius: 6px;
        }

        .form-group label {
            font-weight: bold;
        }
.row{
    margin-bottom: 10px;
}
        button[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 14px;
            transition: 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #218838;
            cursor: pointer;
        }

        #displayImage {
        margin-right: 10px;
        margin-top: 10px;
            border: 1px solid #ddd;
          width: 350px;
          height: 150px;
            border-radius: 8px;
            float: right;
            padding: 5px;
        }

        .error {
            color: red;
            font-size: 14px;
        }</style>
</head>
<body>
<img id="displayImage" 
         src="<?= isset($users[0]['img']) && !empty($users[0]['img']) ? '../uploads/' . $users[0]['img'] : ''; ?>" 
         alt="Image" 
         style="max-width: 600px; height: 300px; <?= isset($users[0]['img']) ? '' : 'display: none;' ?>">
 <form action="" method="POST" enctype="multipart/form-data">
 
<div class="row">
                    <div class="col-md-6">
Center Name:

<?= $form->textBox('hname',array('class'=>'form-control','value' => isset($users[0])?$users[0]['hname']:'')); ?>
<?= $validator->error('hname'); ?><br>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
location:

<?= $form->textBox('location',array('class'=>'form-control','value' => isset($users[0])?$users[0]['location']:'')); ?>
<?= $validator->error('location'); ?><br>

</div>
</div>

<div class="row">
                    <div class="col-md-6">
Email:

<?= $form->textBox('email',array('class'=>'form-control','value' => isset($users[0])?$users[0]['email']:'')); ?>
<?= $validator->error('email'); ?><br>

</div>
</div>



<div class="row">
                    <div class="col-md-6">
Pin Code:

<?= $form->textBox('pin',array('class'=>'form-control','value' => isset($users[0])?$users[0]['pin']:'')); ?>
<?= $validator->error('pin'); ?><br>

</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
Phone Number:

<?= $form->textBox('phno',array('class'=>'form-control','value' => isset($users[0])?$users[0]['phno']:'')); ?>
<?= $validator->error('phno'); ?><br>
</div>
 </div>


 <div class="row">
                    <div class="col-md-6">
Password:

<?= $form->textBox('pass',array('class'=>'form-control','value' => isset($users[0])?$users[0]['pass']:'')); ?>
<?= $validator->error('pass'); ?><br>

</div>
 </div>


<div class="row">
        <div class="col-md-6">
image of Center:
<?= $form->fileField('img', array('class' => 'form-control', 'id' => 'imageInput', 'value' => isset($users[0]) ? $users[0]['img'] : '')); ?>
<span style="color:red;"><?= $validator->error('img'); ?></span><br><br>
<button type="submit" name="btn_insert" value="<?php (isset($id))?'Edit':'Submit'?>" >Submit</button>
</form>
<div style="margin-top: 10px;">
    <!-- Container for current or selected image -->
</div>

<script>
    // Get references to input and image elements
    const imageInput = document.getElementById('imageInput');
    const displayImage = document.getElementById('displayImage');

    // Add event listener for file selection
    imageInput.addEventListener('change', function () {
        const file = this.files[0]; // Get the selected file

        if (file) {
            // Create a FileReader instance
            const reader = new FileReader();

            // When the file is loaded, update the display image source
            reader.onload = function (e) {
                displayImage.src = e.target.result; // Set the selected image
                displayImage.style.display = 'block'; // Ensure image is visible
            };

            // Read the file as a Data URL
            reader.readAsDataURL(file);
        } else {
            // If no file selected, revert to the current image (if any exists)
            displayImage.src = "<?= isset($users[0]['img']) && !empty($users[0]['img']) ? '../uploads/' . $users[0]['img'] : ''; ?>";
        }
    });
</script>

</div>
</div>
<br><br>


<script>
    // Get references to the input and image preview elements

    const imagePreview = document.getElementById('imagePreview');

    // Add an event listener to detect when a file is selected
    imageInput.addEventListener('change', function () {
        const file = this.files[0]; // Get the selected file

        if (file) {
            // Create a FileReader to read the file
            const reader = new FileReader();

            // When the file is read, set it as the src of the preview image
            reader.onload = function (e) {
                imagePreview.src = e.target.result; // Set the image source
                imagePreview.style.display = 'block'; // Show the image
            };

            // Read the file as a Data URL (base64 encoded string)
            reader.readAsDataURL(file);
        } else {
            // If no file is selected, hide the preview image
            imagePreview.style.display = 'none';
        }
    });
</script>
</body>

</html>


