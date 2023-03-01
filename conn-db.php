<?php
$host='localhost';
$user='root';
$pass='';
$db='task';
$conn= mysqli_connect($host,$user,$pass,$db);
if($conn)
      {
        echo 'yes';
      }
      else{
      echo 'no';
      
      }
?>