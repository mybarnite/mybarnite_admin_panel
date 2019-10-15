<?php
include 'includes/conection.php';
$email = $_POST['email'];


$checkClaimNo = "select email from user_register where email = '$email'";

$FireQuery = mysql_query($checkClaimNo);
$CountClaim = mysql_fetch_row($FireQuery);

if($CountClaim>0)
{
	$chk = 1;
	echo $chk;	
}
else
{
	$chk = 2;
	echo $chk;
}
?>