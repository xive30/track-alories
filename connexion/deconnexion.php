<?php
 session_start();

 //unsetcookie('mail');
 setcookie ("userinfo", "", time() - 36000);
 
  // détruit la session
  header("Location: ../public/index.php");
?>