<? session_start();
session_destroy();
header("Location:../admin/mainloginpage.php");
exit;
?>