<?php

include 'includes/conection.php';

$img_id = $_POST['img_id'];
$bar_id = $_POST['bar_id'];

if($img_id!="")
{
		mysql_query("delete from tbl_barfoodmenu_uploads where id=".$img_id." and bar_id = ".$bar_id);
		
}	

?>