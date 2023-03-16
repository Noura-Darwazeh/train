<?php
include 'conn-db.php';
if(isset($_GET['token']))
{
    $token = $_GET['token'];
    $vq = "SELECT verify_token,verify_status FROM users WHERE verify_token = '$token' LIMIT 1 ";
    $vqr = mysqli_query($conn,$vq);
    if(mysqli_num_rows($vqr)>0)
    {
        $row= mysqli_fetch_array($vqr);
       // echo $row['verify_token'];
       if($row['verify_status']=="0")
       {
            $clicked_token= $row['verify_token'];
            $uq="UPDATE users SET verify_status='1' WHERE verify_token= '$clicked_token'LIMIT 1 ";
            $uqr=mysqli_query($conn,$uq);
            if($uqr)
            {
                echo "ver done";
            }
            else{
                echo "ver non !!";
            }
       }
       else{
        echo "email already verified, login now";
       }
    }
    else
    {
        echo "this token does not exist";
    }
}

else
{
    echo "not allowed";
}



?>