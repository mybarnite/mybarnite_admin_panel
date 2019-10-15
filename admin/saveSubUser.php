<?php
include 'includes/conection.php';
echo "<pre>";
print_r($_POST);
exit;
$name = $_POST['name'];
$email = $_POST['email'];
$q = "select * from user_register where name = '".$name."' and r_id = 3";
$exe = mysql_query($q);
$is_userExists = mysql_num_rows($exe);
if($is_userExists>0)
{
	echo $userExists = 1;	
}
else
{
	echo $userExists = 0;
	$q = "select * from user_register where email = '".$email."' and r_id = 3";
	$exe = mysql_query($q);
	$is_userExists = mysql_num_rows($exe);
}	
?>