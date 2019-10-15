<?
include("../includes/config.cfg");
include("../includes/connection.con");
include("../includes/funcs_lib.inc.php");
$connection=DB_CONNECTION();



$userID = $_GET['id'];

$sql = 'DELETE FROM tbl_comment where id="'.$userID.'"';
$del=mysql_query($sql);
if($del)
{
	echo "Comment is deleted";
	}
	else
	{
		echo "comment Is not deleted";
		}

?>
 