<?php
include("includes/config.cfg");
include 'includes/conection.php';
include('includes/funcs_lib.inc.php');
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO user_register (r_id, name, email,password,status,activation_key)
VALUES (1, '$name', '$email','$password','Active','')";
if(mysql_query($sql))
{
$last_insertes_owner = mysql_insert_id($connection);
$sqlOwner = "INSERT INTO bars_list (id, Owner_id)
VALUES ('','$last_insertes_owner')";
mysql_query($sqlOwner);
		$msg = " Your account has been activated , please click on this link:\n\n";
		$msg .= SITE_PATH . 'usersignin.php';
		$subj = 'Account Confirmation';
		$to = $email;
		$from = 'vidhi.scrumbees@gmail.com';
		$appname = 'Mybarnite';
		
		
		$headers = 'From: Mybarnite <vidhi.patel@scrumbees.com>' . "\r\n";	
		if (mail($to,$subj,$msg,$headers)) 
		{
			
			
			echo "<script>window.location.href='business_owener_list.php?msg=successs'</script>";
			
		} 
		else 
		{
			
			echo "<script>window.location.href='business_owener_list.php?msg=error'</script>";
		}
							
}
?>