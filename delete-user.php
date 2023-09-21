<?php
   require_once("functions/function.php");

   $id = $_GET['d'];

   $delete = "DELETE FROM `users` WHERE user_id = '$id'";
   if(mysqli_query($con,$delete)){
      echo "Delete info successfully.";
      header("Location: all-user.php");
      
   }