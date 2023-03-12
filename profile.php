<?php
  session_start();
if (isset($_SESSION['last_login_time'])) {
    $last_login_time = $_SESSION['last_login_time'];
} else {
    $last_login_time = time();
    $_SESSION['last_login_time'] = $last_login_time;
}
if (time() - $last_login_time > 86400) {
    session_unset();
    session_destroy();
    $_SESSION = array();
    header('location:login.php');

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