<?php
session_start();
include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();


$action = $_POST['action'];
if($action=="Add")
{
	$title = $_POST['title'];
	$type = $_POST['type'];
	$duration = $_POST['duration'];
	$price = $_POST['price'];
	
	if($type!=""&&$price!="")
	{	
		$sql = "insert into tbl_subscription (title,type,duration,price) values('".$title."','".$type."','".$duration."','".$price."')";
		mysql_query($sql);
		$lastId = mysql_insert_id();
		if($lastId>0)
		{
			echo "Data has been inserted succesfully.";
		}
		else
		{
			echo "Error occured";
		}	
	}	
}

else if($action=="Edit")
{
	$title = $_POST['title'];
	$type = $_POST['type'];
	$duration = $_POST['duration'];
	$price = $_POST['price'];
	$eid = $_POST['eid'];	
	
	if($eid!="")
	{	
		$sql = "update tbl_subscription set title='".$title."',type='".$type."',duration='".$duration."',price='".$price."' where id=".$eid;
		mysql_query($sql);
		$lastId = mysql_affected_rows();
		if($lastId>0)
		{
			echo "Data has been updated succesfully.";
		}else
		{
			echo "Error occured";
		}	
		
	}
}

else if($action=="Delete")
{
	$id = $_POST['id'];	
	if($id!="")
	{	
		$sql = "delete from tbl_subscription where id=".$id;
		mysql_query($sql);
		$lastId = mysql_affected_rows();
		if($lastId>0)
		{
			echo "Data has been deleted succesfully.";
		}else
		{
			echo "Error occured";
		}	
				
	}
}	
else if($action=="DeleteOwnerSubscription")
{
	$id = $_POST['id'];	
	if($id!="")
	{	
		echo $sql = "delete from tbl_businessowner_subscription where id=".$id;
		mysql_query($sql);
		$lastId = mysql_affected_rows();
		if($lastId>0)
		{
			echo "Data has been deleted succesfully.";	
		}else
		{
			echo "Error occured";
		}	
				
	}
}	
	





?>