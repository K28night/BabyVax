<?php 
require('../config/autoload.php'); 

// Form elements for login data
$elements = array(
    "email" => "",
    "password" => ""
);

$form = new FormAssist($elements, $_POST);
$dao = new DataAccess();

$labels = array(
    "email" => "",
    "password" => ""
);

$rules = array(
    "email" => array("required" => true),
    "password" => array("required" => true)
);

$validator = new FormValidator($rules, $labels);

// Login functionality
if (isset($_POST["btn_login"])) {
    if ($validator->validate($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data1=array(
            'username' => $email,
            'pass' =>  $password,
            'time'=>'CURRENT_TIMESTAMP',
        );  
        // Query to check user existence
        $condition = "email='$email' AND approve_ad=1";
        $fields = array('hid','email', 'pass');
        $user = $dao->getData($fields, 'hcenters', $condition);

        if ($user) {
            $hashed_password_from_db = $user[0]['pass'];
            $id=$user[0]['hid'];
            if ($hashed_password_from_db==$password) {
                // Login success password_verify($password, $hashed_password_from_db)
                $dao->insert($data1,"hc_login");
                echo "<script>alert('Login successful'); window.location.href='wel_center.php?id=$id';</script>";
                // header("Location: wel_center.php");

                // window.location.href='add_slots.php';
                // Redirect to the dashboard or start a session here
            } else {
                echo "<script>
                alert('Incorrect Password.');
                setTimeout(function() {
                    window.location.href = 'hc_login.php'; // Change 'login.php' to your target page
                }, 2000); // Redirect after 2 seconds
            </script>";
               
            }
        } else {
            echo "<script>alert('Application Pending...!');</script>";
        }
    }
}
?>
<style>
*{
       
    }
    .login{
        /* width: 300px;
        display: flex;
        justify-content: center;
       text-align: center;
       padding: 15em;
       margin: auto;
       background-color: aquamarine;
       width: 100px;
       height: 60px;
      flex-direction: row;
      border-radius: 20px; */
      /* background-image: url(m1.png);
      background-repeat: no-repeat; */
      /* Centers the image */
      
    }
    button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}
form{
    width: 350px;
    top:0;
    height: 350px;
    background-color: rgba(0, 0, 20, 0.5);
    padding: 15px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 20px;
    text-align: center;
    display:block;
    line-height: 1;
    transform: translate(8px, 30%);
 
}
.error{
    color: azure;
    font-size: 15px;
    font-weight: bold;
}
input{
    width: 300px;
    height: 40px;
    border: 2px solid #555;
    font-size: 18px;
}
/* .header{
    position: absolute;
    top:0;
    left: 50%;
    transform: translateX(-50%);
} */
button:hover {
  opacity: 0.8;
}
a{
    text-decoration: none;
    color: aliceblue;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <div class="login">
        <form method="POST">
            <div class="header">
             <h1 style="color:azure;font-size: 40px;">Sign In</h1>
            </div>
            <input type="text" name="email" placeholder="Email" value="">
           <div class="error"><?= $validator->error('email'); ?></div><br><br>
            <input type="password" name="password" placeholder="Password" value="">
            <div class="error"><?= $validator->error('password'); ?></div><br><br>
            <a href="#">Forgot Your Password?</a><br>
            <button type="submit" name="btn_login" name="Login">Login</button>
        </form>
    </div>
</body>
</html>
