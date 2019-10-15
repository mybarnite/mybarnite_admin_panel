<?
include("../includes/config.cfg");

include("../includes/connection.con");

include("../includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();

mysql_query("truncate table tbl_recent_view");


?>

