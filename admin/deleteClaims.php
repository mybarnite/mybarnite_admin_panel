<?php
include 'includes/conection.php';
$ids = $_POST['Ids'];
$user_ids = explode(";",$ids);
/* echo "<pre>";
print_r($user_ids); */

foreach($user_ids as $user_id)
{
		
		$query1 = "select id from  bars_list where Owner_id = ".$user_id;
		$exec1 = mysql_query($query1);
		$getBarDetails = mysql_fetch_assoc($exec1);
		$bar_id = $getBarDetails['id'];
		
		$query2 = "update bars_list set is_hide = 1 where id = ".$getBarDetails['id']." and Owner_id = ".$user_id;
		$exec2 = mysql_query($query2);
	
		$lastInsertedId = mysql_affected_rows();
		if($lastInsertedId>0)
		{
			$q1 = "select * from  tbl_claimbusiness where bar_id = ".$bar_id;
			$exe1 = mysql_query($q1);
			$row = mysql_fetch_assoc($exe1);
			$path = $_SERVER['DOCUMENT_ROOT'].'/business_owner/uploaded_claims/'.$row['file_name'];
			unlink($path);
			mysql_query("delete from tbl_claimbusiness where bar_id = ".$bar_id);
	
		}
}

?>