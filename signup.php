<?php
if(isset($_POST['submit'])){
include 'conn-db.php';
 $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
 $email=filter_var($_POST['email'],FILTER_SANITIZE_STRING);
 $phone=$_POST['phone'];
 $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
$errors=[];
//name
if(empty($name)){
    $errors[]="name is required!";
}
else if(strlen($name)>255)
{
    $errors[]="Very long!";

}
//email

if(empty($email)){
    $errors[]="Email is required!";
}
else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
{
    $errors[]="This email is not valid";
}
else if(strlen($email)>255)
{
    $errors[]="Very long!";

}

//phone number
if(empty($phone)){
    $errors[]="Phone number is required!";
}
else if(strlen($phone)>255)
{
    $errors[]="Very long!";

}

// pass
if(empty($password)){
    $errors[]="Password is required!";
}
else if(strlen($password)<6)
{
    $errors[]="week password!";

}
if(empty($errors))
{
    echo 'done';
    $insert= "INSERT INTO user (name,email,phone,password) VALUES ('$name','$email','$phone','$password')";
    //$conn= prepare($insert)-> execute();
    $qu=mysqli_query($conn,$insert);
    if($qu)
    {
        echo 'insert done';
    }
    else echo 'nono';
}
else{
    var_dump($errors);
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
             <form action="signup.php" method="POST">
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
             <div class="button2">
             <input type="submit" name="submit" placeholder="sign up">
             </div>
             </form>
            </div>
        </div>
    </body>
</html>
