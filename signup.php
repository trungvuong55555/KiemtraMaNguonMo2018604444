<?php
require_once './db.php';
session_start();
$errors = array();

if (isset($_POST['register'])) {

    $masv = $_POST['masv'];
    $name = trim($_POST['name']);
    $mail = trim($_POST['mail']);
    $password = $_POST['password'];
    $confirmPass = $_POST['password_confirm'];

    if (empty($mail)) {
        $errors['mail'] = 'Mail is required';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'] = 'Mail address is not valid';
    } elseif (strlen($mail) > 255) {
        $errors['mail'] = 'Mail is limited to 255 characters in length';
    }

    if (empty($name)) {
        $errors['name'] = 'Name is required';
    } elseif (strlen($name) < 6 || strlen($name) > 200) {
        $errors['name'] = 'Name is between 6 and 200 characters long';
    }

    if (empty($password)) {
        $errors['pass'] = 'Password is required';
    } elseif (strlen($password) < 6 || strlen($password) > 100) {
        $errors['pass'] = 'Password is between 6 and 100 characters long';
    } elseif (empty($confirmPass)) {
        $errors['pass'] = 'Confirm password is required';
    } elseif ($password !== $confirmPass) {
        $errors['pass'] = 'Confirm password is not same as password';
    }

    if (empty($errors)) {
        try {
            $password = md5($password);
            $sql = "INSERT INTO users (masv , email,`name`, `password`) values ('$masv','$mail', '$name', '$password')";
            $user = exeQuery($sql, false);

            $_SESSION['success'] = 'Sign Up Success';
            header('Location:signin.php');
        } catch (PDOException $e) {
            echo "PDO error" . $e->getMessage();
        }
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Đăng ký tài khoản</title>
    <style>
                *{
            margin:0;
            padding:0;
            border:none;
            font-family: 'Open Sans', sans-serif;
        }
        body {
            overflow: hidden;
            background-color: #ededed;
        }
        .to {
            display: grid;
            grid-template-columns: repeat(12,1fr);
            grid-template-rows: minmax(100px,auto);
        }
        
        .form {
            border: 1px solid #80808000;
            grid-column: 6/9;
            grid-row: 3;
            height: 470px;
            width: 292px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            border-radius: 15px;
            box-shadow: 0px 0px 14px 0px grey;
            background-color: white;
        }
        h2 {
            margin-top: 50px;
            margin-bottom: 30px;
        }
        i.fab.fa-app-store-ios {
            display: block;
            margin-bottom: 50px;
            font-size: 28px;
        }
        
        label {
            margin-left: -126px;
            display: block;
            font-weight: lighter;
        
        }
        input{
            display: block;
            border-bottom: 2px solid #00BCD4;
            margin-top: 6px;
            margin-bottom: 10px;
            outline-style: none;
        }
        input[type="text"] {
            padding: 5px;
            width: 70%;
        }
        
        input#submit {
            padding: 7px;
            width: 50%;
            border-radius: 10px;
            border: none;
            position: absolute;
            bottom: 10px;
            cursor: pointer;
            background: linear-gradient(to right, #fc00ff, #00dbde);
        }
        input#submit:hover{
        
            background: linear-gradient(to right, #fc466b, #3f5efb); 
        }
    </style>
</head>
<body>
    <div class="to">
                   <form action="" method="post" class= "form">
                   
                        
                           
                                <label for="" >Mã sinh viên</label>
                                
                                    
                                <input type="text" name="masv"  placeholder="2018604444">
                                
                            
                        
                                <label for="" >Họ và tên</label>
                                
                                <input type="text" name="name"  placeholder="Đình Văn Quân">
                                
                       
                                <label for="" >Email</label>
                                
                                <input type="email"  name="mail" >
                           
                        
                                <label for="" >Mật khẩu</label>
                                
                                    
                                <input type="password"  name="password" placeholder="************">
                              
                        
                            
                                <label for="" >Xác nhận mật khẩu</label>
                                
                                    
                                <input type="password"  name="password_confirm" placeholder="************">
                          
                       
                                <button  name="register" >Đăng ký</button>
                      
                   </form>
    </div>           
               
</body>
</html>