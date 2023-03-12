<?php
session_start();
if(isset($_POST['submit'])){
include 'conn-db.php';
$email=$_POST['email'];
$password=$_POST['password']; 
$errors=[];
if(empty($email)){
    $errors[]="Email is required!";
}
// pass
if(empty($password)){
    $errors[]="Password is required!";
}
if(empty($errors))
{
    echo 'done';
    $sel = "SELECT  * FROM users WHERE email='$email' and password='$password'";
    $qu=mysqli_query($conn,$sel);
    $row_count=mysqli_num_rows($qu);
    
    if($row_count==1)
    {
        echo "1";
        while($row=mysqli_fetch_array($qu))
        {
            echo 'ro';
       
        echo
        $_SESSION['name']=$row['name'];
        echo
        $_SESSION['phone']=$row['phone'];
        echo
        $_SESSION['pp']=$row['pp'];
        
        echo
        $_SESSION['email']=$row['email'];
        echo
        $_SESSION['id']=$row['id'];
        header('location:profile.php');
        }
    }
    else echo "no";
    
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
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
    <div class="img">
        <div class="content">
            <h2> Login</h2>
            <form action="login.php" method="POST">
                <div class="username">
                    <input type="text" name="email" required placeholder="      Enter user email">
                    
                </div>
                <div class="pass">
                    <input type="password" name="password" class="pass-key" required placeholder="      Enter password">
                    <span class="show">show</span>
                </div>
                <div class="button1">
                    <input name="submit" type="submit" value="login">

                </div>
            </form>
            <div class="signup">

                <p class="p1">Don't have an account?</p>
                <a href="signup.php"> create one </a>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>

