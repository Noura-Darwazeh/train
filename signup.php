<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
session_start();
$_SESSION ['users']='';
include 'conn-db.php';
function sendemail_verify($name,$email,$verify_token)
{
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            
        $mail->SMTPAuth   = true;  
        $mail->Host = 'smtp.gmail.com';                            
        $mail->Username   = 'noura.darwazeh11@gmail.com';                     
        $mail->Password   = 'tdfulxokkhczdswp';                               
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;                                     
        $mail->setFrom('noura.darwazeh11@gmail.com', '$name');
        $mail->addAddress($email);               
        $mail->isHTML(true);                                  
        $mail->Subject = 'verifite your account now!';
        $email_template="
        <h2>your account was created</h2>
        <h5>please verify your account</h5>
        <br/><br/>
        <a href='http://localhost/task1/verify-email.php?token=$verify_token'>Click here</a>
        ";
        $mail->Body = $email_template;
        if(!$mail->send()) 
        {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        else 
        {
            echo 'Message has been sent';
        }
}
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];
    $verify_token = md5(rand());
    $errors=[];
//name
    if(empty($name))
    {
        $errors[]="name is required!";
        echo
        "<script> alert('name is required!'); </script>";
    }
    else if(strlen($name)>255)
    {
        $errors[]="Very long!";
        echo "<script> alert('very long!'); </script>";
    }   
//email
if(empty($email))
{
    $errors[]="Email is required!";
    echo "<script> alert('Email is required!'); </script>";
}
else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
{
    $errors[]="This email is not valid";
    echo "<script> alert('This email is not valid'); </script>";
}
else if(strlen($email)>255)
{
    $errors[]="Very long!";
    echo "<script> alert('Very long!'); </script>";
}
$x = "SELECT email from users WHERE email = '$email'";
$q=mysqli_query($conn,$x);
$data = $q->fetch_all();
if($data)
{
    $errors[]="this email is exist!";
    echo "<script> alert('this email is exist!'); </script>";
}
//phone number
if(empty($phone))
{
    $errors[]="Phone number is required!";
    echo "<script> alert('Phone number is required!'); </script>";
}
else if(strlen($phone)>255)
{
    $errors[]="Very long!";
    echo "<script> alert('Very long!'); </script>";
}
// pass
if(empty($password))
{
    $errors[]="Password is required!";
    echo "<script> alert('Password is required!'); </script>";
}
else if(strlen($password)<6)
{
    $errors[]="week password!";
    echo "<script> alert('week password!'); </script>";
}
if(empty($errors))
{
    echo 'done';
    //$password = password_hash($password,PASSWORD_DEFAULT);
    if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) 
    {
         echo "pp";
        $img_name = $_FILES['pp']['name'];
        $tmp_name = $_FILES['pp']['tmp_name'];
        $error = $_FILES['pp']['error'];
        if($error === 0)
        {
           $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
           $img_ex_to_lc = strtolower($img_ex);
           $allowed_exs = array('jpg', 'jpeg', 'png');
            if(in_array($img_ex_to_lc, $allowed_exs))
            {
                $new_img_name = uniqid($name, true).'.'.$img_ex_to_lc;
                $img_upload_path = 'upload/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);
                $verification_code = md5(uniqid(rand(), true));
                // Insert into Database
                $insert= "INSERT INTO users (name,email,phone,password,pp,verify_token) VALUES ('$name','$email','$phone','$password','$new_img_name','$verify_token')";
                $qu=mysqli_query($conn,$insert);
                $_POST['name'] ='';
                $_POST['email'] ='';
                $_POST['phone'] ='';
                if($qu)
                {
                    sendemail_verify("$name","$email","$verify_token");
        
                }
                else echo 'no';
    
                echo
                $_SESSION['name']=$name;
                echo
                $_SESSION['email']=$email;
                echo
                $_SESSION['phone']=$phone;
                echo
                $_SESSION['pp']=$img_upload_path;
                header('location:login.php');
            }
            else 
            {
                echo "You can't upload files of this type";
                "<script> alert('You can't upload files of this type!'); </script>";

            }
        }
        else 
        {
            echo "You can't upload files of this type";
            echo "<script> alert('You can't upload files of this type!'); </script>";

        }
    }
    else
    {
        var_dump($errors);
        $insertx= "INSERT INTO users (name,email,phone,password,verify_token) VALUES ('$name','$email','$phone','$password','$verify_token')";
        $qux=mysqli_query($conn,$insertx);
        if($qux)
        {
        sendemail_verify("$name","$email","$verify_token");
        }
        else echo 'no';
        $_POST['name'] ='';
        $_POST['email'] ='';
        $_POST['phone'] ='';
        header('location:login.php');
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset=""UTF-8>
        <title>Document</title>
        <link rel="stylesheet" href="css/signup.css">
    </head>
    <body>
        <div class="img1">
            <div class="content1">
             <h2> Sign Up</h2>
             
             <form action="signup.php" method="POST" enctype="multipart/form-data">
             <div class="username">
             <input type="text" name="name" placeholder="  User Name">
             </div>
             <div class="emailuser">
             <input type="text" name="email" placeholder="  User Email">
             </div>
             <div class="userphone">
             <input type="number" name="phone" placeholder="  Phone Number">
             </div>
             <div class="userpass">
             <input type="password" name="password" placeholder="  Password">
             </div>
             <div class="p">
             <input type="file" name="pp" >
             </div>
             <div class="button2">
             <input type="submit" name="submit" placeholder="sign up">
             </div>
             </form>
            </div>
        </div>
    </body>
</html>
