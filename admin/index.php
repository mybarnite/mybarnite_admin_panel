<?php
include("includes/config.cfg");
include("includes/connection.con");
//include("includes/funcs_lib.inc.php");
$connection=DB_CONNECTION();
if(!empty($_SESSION['ID']))
	{
		header("Location:welcome.php");
	
	}


else if($connection)
	{
	header("Location:mainloginpage.php");
	}

?>
