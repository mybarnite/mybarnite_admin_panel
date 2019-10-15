<?php 

include("../includes/config.cfg");

include("../includes/connection.con");

include("../includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();


$eventids = $_POST['eventids'];
$eventtype = $_POST['eventType'];

//$ids = explode(",",$eventids);
foreach($eventids as $id)
{	
	
	
	$update = "update tbl_events set eventtype = '".$eventtype."' where id=".$id ;
	mysql_query($update);
	$lastAffectedRow = mysql_affected_rows();
	$_SESSION['msg'] = "<div class='alert alert=success'>Data has been updated successfully.</div>";
	//echo ($lastAffectedRow!="")?$lastAffectedRow:"There must be some issue.";
}		
		

?>