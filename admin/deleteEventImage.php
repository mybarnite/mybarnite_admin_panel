<?php

include 'includes/conection.php';

$id = $_POST['id'];
$event_id = $_POST['eventId'];
#echo $q1 = "select * from  tbl_claimbusiness where id = ".$claimId." and bar_id = ".$bar_id;
if($event_id!="")
{		
		$q1 = "select * from  tbl_event_gallery where id = ".$id." and event_id = ".$event_id;
		$exe1 = mysql_query($q1);
		$row = mysql_fetch_assoc($exe1);
		$path = $_SERVER['DOCUMENT_ROOT'].'/business_owner/uploaded_files/'.$row['file_name'];
		unlink($path);
		mysql_query("delete from tbl_event_gallery where id=".$id." and event_id = ".$event_id);
		
}	

?>