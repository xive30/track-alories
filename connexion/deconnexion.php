<?php
 session_start();

 //to destroy the coockie
 setcookie ("userinfo", "", time() - 36000);
 
  header("Location: ../public/index.php");
?>