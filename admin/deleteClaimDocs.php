<?php

include 'includes/conection.php';

$claimId = $_POST['claimId'];
$bar_id = $_POST['bar_id'];
#echo $q1 = "select * from  tbl_claimbusiness where id = ".$claimId." and bar_id = ".$bar_id;
if($claimId!="")
{		
		$q1 = "select * from  tbl_claimbusiness where id = ".$claimId." and bar_id = ".$bar_id;
		$exe1 = mysql_query($q1);
		$row = mysql_fetch_assoc($exe1);
		$path = $_SERVER['DOCUMENT_ROOT'].'/business_owner/uploaded_claims/'.$row['file_name'];
		unlink($path);
		mysql_query("delete from tbl_claimbusiness where id=".$claimId." and bar_id = ".$bar_id);
		
}	

?>