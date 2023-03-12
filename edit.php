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
        //echo ' session';
        include 'conn-db.php';
      
            echo
            $iddb=$_SESSION['id'];
            $sqlu = "SELECT * FROM users WHERE id = $iddb";
            $resultu = mysqli_query($conn, $sqlu);
            $rowu = mysqli_fetch_assoc($resultu);
            
            if(isset($_POST['submit']))
            {
                
                echo 'shabak';
                 $namen=$_POST['name'];
                 $emailn=$_POST['email'];
                 $phonen=$_POST['phone'];
                 
                 echo
                 $old_pp = $_POST['old_pp'];
                
            echo " /up/";
            
            if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
                echo "pp";
                
               $img_name = $_FILES['pp']['name'];
               $tmp_name = $_FILES['pp']['tmp_name'];
               $error = $_FILES['pp']['error'];
               
               if($error === 0){
                  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                  $img_ex_to_lc = strtolower($img_ex);
       
                  $allowed_exs = array('jpg', 'jpeg', 'png');
                  if(in_array($img_ex_to_lc, $allowed_exs)){
                     $new_img_name = uniqid($namen, true).'.'.$img_ex_to_lc;
                     $img_upload_path = 'upload/'.$new_img_name;
                     
                    $old_pp_des = "upload/$old_pp";
               if(unlink($old_pp_des)){
               	 
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }else {
                  
               	  move_uploaded_file($tmp_name, $img_upload_path);
               }
                     
                     
                     $sqly = "UPDATE users SET name = '$namen',email = '$emailn' , phone = '$phonen',pp='$new_img_name' WHERE id = $iddb";
                     mysqli_query($conn, $sqly);
        
           }
           else {
               echo "You can't upload files of this type";
               "<script> alert('You can't upload files of this type!'); </script>";

               
            }
       }
       else {
           echo "You can't upload files of this type";
           "<script> alert('You can't upload files of this type!'); </script>";

       }
        }
       else{
        
        echo 'error';
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
             <h2> Edit Profile</h2>
             
             <form action="edit.php" method="POST" enctype="multipart/form-data">
             <div class="username">
             <input type="text" name="name" value="<?php echo $_SESSION['name'] ?>">
             </div>
             <div class="emailuser">
             <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>">
             </div>
             <div class="userphone">
             <input type="number" name="phone" value="<?php echo $_SESSION['phone'] ?>">
             </div>
             
             <div class="p">
             <input type="file" name="pp" >
             </div>
             image :<img width="100px" height="100px"  src="upload/<?php echo $_SESSION['pp'] ?>" alt="no img">
             <input type="text" name="old_pp" value="<?php echo $_SESSION['pp'] ?>">
             <div class="button2">

             <input type="submit" value="update" name="submit" >
             <a style="color:black; font-size:25px; margin-top:10px; margin-left:10px;text-decoration: none;" href="profile.php">home</a>
             </div>
             </form>
            </div>
        </div>
    </body>
</html>