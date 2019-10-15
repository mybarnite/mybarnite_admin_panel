<?php
include("../includes/config.cfg");
include("../includes/connection.con");
include("../includes/funcs_lib.inc.php");
$connection=DB_CONNECTION();



$id = $_POST['id'];

$sql = 'DELETE FROM tbl_events where id="'.$id.'"';
$del=mysql_query($sql);
if($del)
{
	echo "Data has been deleted successfully.";
}
else
{
	echo "There is some issue.";
}

?>
 