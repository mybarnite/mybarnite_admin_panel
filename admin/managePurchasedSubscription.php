<?php
session_start();
include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();


$action = $_POST['action'];
else if($action=="Delete")
{
	$id = $_POST['id'];	
	if($id!="")
	{	
		$sql = "delete from  tbl_businessowner_subscription where id=".$id." and owner_id=".$_SESSION['business_owner_id'];
		mysql_query($sql);
				
	}
}	
?>