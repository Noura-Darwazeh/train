<?php
    session_start();
    if(!isset($_SESSION['user']))
    {
        header('location:login.php');
        exit(); //stop any script
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
        name : <?php echo $_SESSION['user']['name'] ?><br><br>
        email : <?php echo $_SESSION['user']['email'] ?><br><br>
        phone : <?php echo $_SESSION['user']['phone'] ?><br><br>
        

        <a href="logout.php">logout</a>
    </body>
</html>