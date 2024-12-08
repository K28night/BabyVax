<?php 
require('../config/autoload.php'); 

// Form elements for login data
$elements = array(
    "email" => " ",
    "password" => " "
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
  header("location:ad_dashboard.php");}
    if ($validator->validate($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to check user existence
        $condition = "email='$email'";
        $fields = array('email', 'password');
        $user = $dao->getData($fields, 'registration', $condition);

        if ($user) {
            $hashed_password_from_db = $user[0]['password'];
            if (password_verify($password, $hashed_password_from_db)) {
                // Login success
                echo "Login successful!";
                header("location:ad_dashboard.php");
                // Redirect to the dashboard or start a session here
            } else {
                echo "<script>alert('Incorrect Password.');</script>";
              
            }
        } else {
            echo "<script>alert('Invalid Username.');</script>";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
  </head>
<style>
  
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 450px;
    /* max-width: 100%; */
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background-color: #2da0a8;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
    width: 450px;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}
.login-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .login-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}


.login {
    background-size: cover; 
    background-position: center bottom; 
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .login{
    transform: translateX(50%);
}

.login-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.login-left{
    transform: translateX(-200%);
}

.container.active .login-left{
    transform: translateX(0);
}

.login-right{
    right: 0;
    transform: translateX(0);
}

.container.active .login-right{
    transform: translateX(200%);
}
</style>
  <body>
    <div class="container" id="container">
      <div class="form-container sign-in">
        <form method="POST">
          <h1>Sign In</h1>
          <span>or use your email and password</span>
          <?= $form->textBox('email', array('class' => 'form-control', 'placeholder' => "Email",'value'=>"")); ?>
          <?= $validator->error('email'); ?>
          <?= $form->passwordBox('password', array('class' => 'form-control', 'placeholder' => "Password",'value'=>"")); ?>
          <?= $validator->error('password'); ?>
          <a href="#">Forgot Your Password?</a>
          <button type="submit" name="btn_login">Sign In</button>
        </form>
      </div>
    </div>

  </body>
</html>
