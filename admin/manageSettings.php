<?php
session_start();
include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();


$comission = $_POST['comission'];
$discount = $_POST['discount'];

if($comission!=""&&$discount!="")
{
	
		$sql = "update tbl_settings set commision='".$comission."',discount='".$discount."' where id=1";
		mysql_query($sql);
		$lastId = mysql_affected_rows();
		if($lastId>0)
		{
			echo "Settings has been updated succesfully.";
		}else
		{
			echo "Error occured";
		}	
	
}



?>