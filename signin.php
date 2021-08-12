<?php
require_once './db.php';
session_start();
$errors = array();

if (isset($_GET['logout'])) {
    setcookie('user', null, -1);
    unset($_SESSION['user']);
    header("Location:signin.php");
    exit;
}

if (isset($_POST['login'])) {
    $masv = $_POST['masv'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors['masv'] = 'masv is required';
    } elseif (strlen($username) > 255) {
        $errors['masv'] = 'masv is limited to 255 characters in length';
    }

    if (empty($password)) {
        $errors['pass'] = 'Password is required';
    } elseif (strlen($password) < 6 || strlen($password) > 100) {
        $errors['error'] = 'Password is between 6 and 100 characters long';
    }

    $getUserByMaSV = "select * from users where masv = '$masv' ";
    $user = exeQuery($getUserByMaSV, false);
    if($user && md5($password) == $user['password']){
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('location:dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    
    <title>Đăng nhập</title>

    <style>
        body {
        padding: 50px;
        }
        * {
        margin: 0;
        padding: 0;
        }
        .form-tt {
        width: 400px;
        border-radius: 10px;
        overflow: hidden;
        padding: 55px 55px 37px;
        background: #9152f8;
        background: -webkit-linear-gradient(top,#7579ff,#b224ef);
        background: -o-linear-gradient(top,#7579ff,#b224ef);
        background: -moz-linear-gradient(top,#7579ff,#b224ef);
        background: linear-gradient(top,#7579ff,#b224ef);
        text-align: center;
        }
        .form-tt h2 {
        font-size: 30px;
        color: #fff;
        line-height: 1.2;
        text-align: center;
        text-transform: uppercase;
        display: block;
        margin-bottom: 30px;
        }

        .form-tt input[type=text], .form-tt input[type=password] {
        font-family: Poppins-Regular;
        font-size: 16px;
        color: #fff;
        line-height: 1.2;
        display: block;
        width: calc(100% - 10px);
        height: 45px;
        background: 0 0;
        padding: 10px 0;
        border-bottom: 2px solid rgba(255,255,255,.24)!important;
        border: 0;
        outline: 0;
        }
        .form-tt input[type=text]::focus, .form-tt input[type=password]::focus {
        color: red;
        }
        .form-tt input[type=password] {
        margin-bottom: 20px;
        }
        .form-tt input::placeholder {
        color: #fff;
        }
        .checkbox {
        display: block;
        }
        .form-tt input[type=submit] {
        font-size: 16px;
        color: #555;
        line-height: 1.2;
        padding: 0 20px;
        min-width: 120px;
        height: 50px;
        border-radius: 25px;
        background: #fff;
        position: relative;
        z-index: 1;
        border: 0;
        outline: 0;
        display: block;
        margin: 30px auto;
        }
        #checkbox {
        display: inline-block;
        margin-right: 10px;
        }
        .checkbox-text {
        color: #fff;
        }
        .psw-text {
        color: #fff;
        }
</style>

</head>
<body>
    <div class="form-tt">
        <h2>Đăng nhập</h2>
                  <form action="" method="post">
                  
                            <input type="text" name="masv" placeholder="4444">
                               
                            <input type="password" name="password"  placeholder="************">
                         
                            <button name="login" >Đăng nhập</button>
                       
                  </form>
        </div>
                
</body>
</html>