<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();

$action = $_POST['action'];

if($action=="Add")
{
	$optradio = @$_POST['optradio'];
    $bar = @$_POST['bar'];
    $event = @$_POST['event'];
    $code = @$_POST['code'];
    $discount = @$_POST['discount'];
    $startsat = @$_POST['startsat'];
    $endsat = @$_POST['endsat'];
    $description = @$_POST['description'];
	
		if($event==0)
		{	
			$query = "select Owner_id from bars_list where id=".$bar;
			$getOwner = mysql_query($query);
			$res = mysql_fetch_assoc($getOwner);
			$ownerid = $res['Owner_id'];
			
			$sql1='select * from tbl_promotions where barId='.$bar.' and ownerId='.$ownerid;
			$exe = mysql_query($sql1);
			$isExist = mysql_fetch_array($exe);
			if(isset($isExist))
			{
				$update = 'update tbl_promotions set status="Inactive" where barId='.$bar.' and ownerId='.$ownerid;
				mysql_query($update);
				
			}	
			$sql = "insert into tbl_promotions (barId,ownerId,eventId,couponcode,discount,description,status,userCount,startsat,endsat) values(".$bar.",".$ownerid.",0,'".$code."','".$discount."','".$description."','Active',0,'".$startsat."','".$endsat."')";	
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
		else	
		{
			
			$query = "select bar_id from tbl_events where id=".$event;
			$getBarId = mysql_query($query);
			$res = mysql_fetch_assoc($getBarId);
			$bar1 = $res['bar_id'];
			
			$query1 = "select Owner_id from bars_list where id=".$bar1;
			$getOwner = mysql_query($query1);
			$res = mysql_fetch_assoc($getOwner);
			$ownerid1 = $res['Owner_id'];
			
			$sql1='select * from tbl_promotions where barId='.$bar1.' and ownerId='.$ownerid1.' and eventId='.$event;
			$exe = mysql_query($sql1);
			$isExist = mysql_fetch_array($exe);
			
			if(isset($isExist))
			{
				$update = 'update tbl_promotions set status="Inactive" where barId='.$bar1.' and ownerId='.$ownerid1.' and eventId='.$event;
				mysql_query($update);
						
			}
			$sql = "insert into tbl_promotions (barId,ownerId,eventId,couponcode,discount,description,status,userCount,startsat,endsat) values(".$bar1.",".$ownerid1.",".$event.",'".$code."','".$discount."','".$description."','Active',0,'".$startsat."','".$endsat."')";	
			mysql_query($sql);
			$lastId = mysql_insert_id();
			if($lastId>0)
			{
				echo "Data has been inserted succesfully.";
			}else
			{
				echo "Error occured";
			}
			
		}
		
		
		
}
else if($action=="Update")
{
	$eid  = $_POST['eid'];
	$optradio = $_POST['optradio'];
    $bar = @$_POST['bar'];
    $event = @$_POST['event'];
    $code = $_POST['code'];
    $discount = $_POST['discount'];
    $startsat = $_POST['startsat'];
    $endsat = $_POST['endsat'];
    $description = $_POST['description'];
	$sql = "update tbl_promotions set couponcode='".$code."',discount='".$discount."',description='".$description."',startsat='".$startsat."',endsat='".$endsat."' where id=".$eid;
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
else if($action=="Delete")
{
	$id = $_POST['id'];	
	if($id!="")
	{	
		$sql = "delete from tbl_promotions where id=".$id;
		mysql_query($sql);
				
	}
}		



?>