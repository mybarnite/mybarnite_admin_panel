<?php session_start();
session_destroy();
header("Location:mainloginpage.php");
exit;
?>