<?php

include('../../business_owner/common.php');

$id = $_POST['img_id'];
$status = $_POST['status'];
$event_id = $_POST['event_id'];
if(!empty($id))
{
	if($_POST['user']=="Admin")
	{
		if($status==1)
		{
			$published = 'hide from displaying';
			$sql = "UPDATE tbl_event_gallery SET is_published = 0 WHERE id = ".$id." and event_id=".$event_id;
		}
		else
		{
			$published = 'published successfully';	
			$sql = "UPDATE tbl_event_gallery SET is_published = 1 WHERE id = ".$id." and event_id=".$event_id;
		}		
		
		
		mysqli_query($db->myconn,$sql); 
		$is_res = $db->myconn->affected_rows;	
		
		
		$db->select('tbl_event_gallery','bar_id, file_name, file_path',NULL,'id = '.$id.' and event_id='.$event_id,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
		$getBarId = $db->getResult();
		$filepath = $getBarId[0]['file_path'];
		
		if($is_res!=""&&$is_res>0)
		{
			$sql1= "SELECT email FROM user_register AS u JOIN bars_list AS b ON u.id = b.Owner_id WHERE b.id = ".$getBarId[0]['bar_id'];
			$res = $db->myconn->query($sql1);
			$getUserEmail = $res->fetch_assoc();
			$email = $getUserEmail['email'];
			
			$to1 = $email;
			//$to1 = 'vidhi.scrumbees@gmail.com';
			$subject1 = 'Mybarnite - Publish event image ';
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
			$message1 .= "Dear User,<br/><br/>";
			$message1 .= "Your event uploads have been $published, review your event page for published images.<br/><br/>";
			$message1 .= "Thank you for joining our website.<br/><br/>";
			$message1 .= "Mybarnite Limited<br/>EMail: info@mybarnite.com<br/>URL: mybarnite.com<br/><img src='http://mybarnite.com/images/Picture1.png' width='110'>";
			$message1 .= "</body></html>";

			if(mail($to1, $subject1, $message1, $headers1))
			{
				echo $_SESSION['publishmsg']="<div class='alert alert-success'>Data has been modified successfully!</div>";	
			}	
			else
			{
				$_SESSION['publishmsg']="<div class='alert alert-success'>There is some issue while sending email!</div>";
			}	
			
		}
		else
		{
			echo $_SESSION['publishmsg']="<div class='alert alert-danger'>Data can not be modified.</div>";
		}		
	}
		
}	



?>
