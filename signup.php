<?php
if(isset($_POST['submit'])){
include 'conn-db.php';
echo $name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
echo $email=filter_var($_POST['email'],FILTER_SANITIZE_STRING);
echo $phone=$_POST['phone'];
echo $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
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





<form action="signup.php" method="POST">
<input type="text" name="name" placeholder="name"><br><br>
<input type="text" name="email" placeholder="email"><br><br>
<input type="number" name="phone" placeholder="phone number"><br><br>
<input type="password" name="password" placeholder="password"><br><br>
<input type="submit" name="submit" placeholder="sign up">


</form>