<?php
include 'includes/conection.php';
$userId = $_POST['userId'];
$rId = $_POST['rId'];

if($rId==1){
	$getUserAccountDetailQry = "select u.id as user_id, u.name as user_name, u.email as email, b.id as bar_id, b.Business_Name as bar_name from user_register as u join bars_list as b on u.id = b.Owner_id where u.id = ".$userId;
	
}elseif($rId==3){
	$getUserAccountDetailQry = "select u.id as user_id, u.name as user_name, u.email as email, b.id as bar_id, b.Business_Name as bar_name from user_register as u join bars_list as b on u.bar_id = b.id where u.id = ".$userId;
	
}else{
	$getUserAccountDetailQry = "select u.id as user_id, u.name as user_name, u.email as email from user_register as u where u.id = ".$userId;
	
}
$exeQry = mysql_query($getUserAccountDetailQry);
$getUserAccountDetails = mysql_fetch_assoc($exeQry);
$userName = $getUserAccountDetails['user_name'];
$email = $getUserAccountDetails['email'];
if($rId==1||$rId==3){
	$barId = $getUserAccountDetails['bar_id'];
	$barName = $getUserAccountDetails['bar_name'];
	$role = "Business user";
}else{
	$role = "Non business user";
}	
if($rId==2){
	
	//Non Business user 
	mysql_query("delete from user_register where id=".$userId);
	$countSql = "SELECT * FROM social_media_user_account where user_id=".$userId;
	$exe= mysql_query($countSql); 
	$numOfRows = mysql_num_rows($exe);
	if($numOfRows>0){
		mysql_query("delete from social_media_user_account where user_id=".$userId);	
	}
	
}else{
	//Business user / Sub business user
	if($rId==1){
		mysql_query("delete from user_register where id=".$userId." and r_id = 1");
		mysql_query("delete from user_register where bar_id=".$barId." and r_id = 3");	
		mysql_query("delete from bars_list where id=".$barId);	
		mysql_query("delete from tbl_events where bar_id=".$barId);	
		mysql_query("delete from tbl_promotions where barId=".$barId);
		mysql_query("delete from tbl_manage_blogs where author_id=".$userId);
		mysql_query("delete from tbl_barfoodmenu_uploads where bar_id=".$barId);
		mysql_query("delete from tbl_businessowner_subscription where bar_id=".$barId);
	}else{
		mysql_query("delete from user_register where id=".$userId." and r_id = 3");
	
	}
	
}
/* mysql_query("delete from tbl_delete_account_request where user_id=".$userId);	
 */
$queryStr = "SELECT * FROM user_register where id=".$userId;
$exeQryStr= mysql_query($queryStr); 
$isAvailable = mysql_num_rows($exeQryStr);

 $isAvailable=0;
 if($isAvailable<1){
	
	//$to = $order['email'];
	$from = "info@mybarnite.com";
	$subject = 'Mybarnite - Delete Account Confirmation!';
	$to = $email;
	 
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 
	// Create email headers
	$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	 
	// Compose a simple HTML email message
	// Compose a simple HTML email message
	$message = "<html>";
	$message .= "<head><title>Delete Account Confirmation!</title></head>";
	$message .= "<body>";
	$message .= "<p>Dear User,</p>";
	$message .= "<p>Your Mybarnite account has been deleted successfully!</p><br/><br/>";
	$message .= "<p>Thank you for using our website</p><p>Mybarnite Limited</p><p>Email: info@mybarnite.com</p><p>URL: mybarnite.com</p><p><img src='https://mybarnite.com/images/Picture1.png' width='110'></p>";
	$message .= "</body></html>";
	if(mail($to, $subject, $message, $headers)){
		
		//$to = $order['email'];
		$to1 = "info@mybarnite.com";
		$subject1 = 'Mybarnite - Delete Account Confirmation!';
		$from1 = $email;
		 
		// To send HTML mail, the Content-type header must be set
		$headers1  = 'MIME-Version: 1.0' . "\r\n";
		$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers1 .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
		// Compose a simple HTML email message
		$message1 = "<html>";
		$message1 .= "<head><title>Notification!</title></head>";
		$message1 .= "<body>";
		$message1 .= "<p>Dear Admin,</p>";
		$message1 .= "<p>User with below details has been proceeded for delete account.</p><br/><br/>";
		$message1 .= "<table>";
		$message1 .= "	
						<tr><th>Name :</th><td>$userName </td></tr>
						<tr><th>Email :</th><td>$email</td></tr>
						<tr><th>Role :</th><td>$role</td></tr>
					";	
		$message1 .= "</table><br/><br/>";
		$message1 .= "<p>Thank you for using our website</p><p>Mybarnite Limited</p><p>Email: info@mybarnite.com</p><p>URL: mybarnite.com</p><p><img src='https://mybarnite.com/images/Picture1.png' width='110'></p>";
		$message .= "</body></html>";
		mail($to1, $subject1, $message1, $headers1);
		
		echo '<div class="alert alert-success">User account has been deleted successfully. Confirmation email will be sent shortly.</div>';	
	}else{
		echo '<div class="alert alert-danger">There is some issue while sending confirmation email.</div>';
	}	

}else{
	echo '<div class="alert alert-danger">There is some error. Please try again later</div>';
}
?>