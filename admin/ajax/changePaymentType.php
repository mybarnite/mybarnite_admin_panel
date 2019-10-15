<?php 

include("../includes/config.cfg");

include("../includes/connection.con");

include("../includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();


$orderids = $_POST['orderids'];
$paymentType = $_POST['paymentType'];

//$ids = explode(",",$eventids);
foreach($orderids as $id)
{	
	
	
	$update = "update tbl_order_history set payment_status = '".$paymentType."' where id=".$id ;
	mysql_query($update);
	$lastAffectedRow = mysql_affected_rows();
	$_SESSION['msg'] = "<div class='alert alert=success'>Data has been updated successfully.</div>";
	//echo ($lastAffectedRow!="")?$lastAffectedRow:"There must be some issue.";
}		
		

?>