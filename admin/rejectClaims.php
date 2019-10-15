<?php
include 'includes/conection.php';
$ids = $_POST['Ids'];
$user_ids = explode(";",$ids);
/* echo "<pre>";
print_r($user_ids); */

foreach($user_ids as $user_id)
{
		$query2 = "update bars_list set is_requestedForClaim = 3 where Owner_id = ".$user_id;
		$exec2= mysql_query($query2);
		
		$query3 = "delete from tbl_businessowner_subscription where owner_id = ".$user_id;
		$exec3= mysql_query($query3);
	
		$query = "update user_register set status = 'Inactive' where id = ".$user_id;
		$exec = mysql_query($query);
		$lastInsertedId = mysql_affected_rows();
		if($lastInsertedId>0)
		{
			$query1 = "select u.*,b.id as bar_id from  user_register as u join bars_list as b on u.id = b.Owner_id where u.id = ".$user_id;
			$exec1 = mysql_query($query1);
			$getUserDetails = mysql_fetch_assoc($exec1);
			
			$bar_id = $getUserDetails['bar_id'];
			$name = $getUserDetails['name'];
			$email = $getUserDetails['email'];
			
			
			$to1 = $email;
			$subject1 = 'Mybarnite - Confirmation for Claim ';
			$from1 = 'info@mybarnite.com';
			 
			// To send HTML mail, the Content-type header must be set
			$headers1  = 'MIME-Version: 1.0' . "\r\n";
			$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers1 .= 'From: '.$from1."\r\n".
				'Reply-To: '.$from1."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message1 = "<html>";
			$message1 .= "<head><title>Mybarnite</title></head>";
			$message1 .= "<body>";
			$message1 .= "Dear $name,<br/><br/>";
			$message1 .= "Your Business claim has been rejected! For further details you can contact to barnite team.<br/><br/>";
			$message1 .= "<p>Thank you for using our website</p><p>Mybarnite Limited</p><p>EMail: info@mybarnite.com</p><p>URL: mybarnite.com</p><p><img src='http://mybarnite.com/images/Picture1.png' width='110'></p>";
			$message1 .= "</body></html>";

			mail($to1, $subject1, $message1, $headers1);
	
		}
}

?>