<?php
    session_start();
    if(!isset($_SESSION['name']) && !isset($_SESSION['email'])&& !isset($_SESSION['phone']))
    {
        header('location:login.php');
        echo 'login';
        exit(); 
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
   
        

        name : <?php echo $_SESSION['name'] ?><br><br>
        email : <?php echo $_SESSION['email'] ?><br><br>
        phone : <?php echo $_SESSION['phone'] ?><br><br>
        image :<img width="50px" height="50px" src="upload/<?php echo $_SESSION['pp'] ?>" alt="no img"> 
        <form action="profile.php" method="POST">
            
        </form>
        <br><br>
        <a style="color:black; font-size:25px; margin-top:10px; margin-left:10px;text-decoration: none;" href="logout.php">logout</a>
        <a style="color:black; font-size:25px; margin-top:10px; margin-left:10px;text-decoration: none;" href="edit.php">edit profile</a>
    </body>
</html>