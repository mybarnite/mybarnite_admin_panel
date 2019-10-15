<?php 
session_start();
include 'includes/conection.php';
$selectedownerID = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['selectedownerID']))));
$email = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["email"]))));
$contact = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["contact"]))));
$Business_Name = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Business_Name"]))));
$Category = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Category"]))));
$Price_Range = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Price_Range"]))));
$Established_Year = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Established_Year"]))));
$Location = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Location"]))));
$Zipcode = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Zipcode"]))));
$Hours = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Hours"]))));
$latitude = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["latitude"]))));
$longitude = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["longitude"]))));
$Owner_Name = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Owner_Name"]))));
$is_hall_available = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["is_hall_available"]))));
$hall_Fee = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["hall_Fee"]))));
$noofbasicseat = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["noofbasicseat"]))));
$cost_per_seat = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["cost_per_seat"]))));
$bardes = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["bardes"]))));
$Commission = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Commission"]))));
$Discount = mysql_real_escape_string(htmlentities(addslashes(trim($_POST["Discount"]))));
$is_payasyougo  = (isset($_POST['is_payasyougo'])&&$_POST['is_payasyougo']==1)?"1":"";

$sql1="select * from bars_list where Owner_id = ".$selectedownerID;
$exe = mysql_query($sql1);
$count = mysql_num_rows($exe);
$rs_result = mysql_fetch_array($exe);

if($count>0)
{
	if(isset($Commission))
	{
		$sql = 'UPDATE bars_list SET Location_Searched = "'.$Location.'",Category_Searched= "'.$Category.'",Business_Name = "'.$Business_Name.'",Category = "'.$Category.'",Locality = "'.$Location.'",Zipcode="'.$Zipcode.'",PhoneNo="'.$contact.'",	Longitude="'.$longitude.'",Latitude= "'.$latitude.'",Hours="'.$Hours.'",Commission="'.$Commission.'",Price_Range= "'.$Price_Range.'",Established_Year = "'.$Established_Year.'",Owner_Name = "'.$Owner_Name.'",is_hall_available = "'.$is_hall_available.'",hall_Fee = "'.$hall_Fee.'",seat_for_basic = "'.$noofbasicseat.'",cost_per_seat = "'.$cost_per_seat.'",description = "'.$bardes.'",is_payasyougo="1" where Owner_id = "'.$selectedownerID.'"';	
	}	
	elseif(isset($Discount))
	{
		$sql = 'UPDATE bars_list SET Location_Searched = "'.$Location.'",Category_Searched= "'.$Category.'",Business_Name = "'.$Business_Name.'",Category = "'.$Category.'",Locality = "'.$Location.'",Zipcode="'.$Zipcode.'",PhoneNo="'.$contact.'",	Longitude="'.$longitude.'",Latitude= "'.$latitude.'",Hours="'.$Hours.'",Discount="'.$Discount.'",Price_Range= "'.$Price_Range.'",Established_Year = "'.$Established_Year.'",Owner_Name = "'.$Owner_Name.'",is_hall_available = "'.$is_hall_available.'",hall_Fee = "'.$hall_Fee.'",seat_for_basic = "'.$noofbasicseat.'",cost_per_seat = "'.$cost_per_seat.'",description = "'.$bardes.'",is_payasyougo="2" where Owner_id = "'.$selectedownerID.'"';	
	}
	elseif(isset($is_payasyougo))
	{
		$sql = 'UPDATE bars_list SET Location_Searched = "'.$Location.'",Category_Searched= "'.$Category.'",Business_Name = "'.$Business_Name.'",Category = "'.$Category.'",Locality = "'.$Location.'",Zipcode="'.$Zipcode.'",PhoneNo="'.$contact.'",	Longitude="'.$longitude.'",Latitude= "'.$latitude.'",Hours="'.$Hours.'",Price_Range= "'.$Price_Range.'",Established_Year = "'.$Established_Year.'",Owner_Name = "'.$Owner_Name.'",is_hall_available = "'.$is_hall_available.'",hall_Fee = "'.$hall_Fee.'",seat_for_basic = "'.$noofbasicseat.'",cost_per_seat = "'.$cost_per_seat.'",description = "'.$bardes.'",is_payasyougo="'.$is_payasyougo.'" where Owner_id = "'.$selectedownerID.'"';	
	}
	else
	{
		echo $sql = 'UPDATE bars_list SET Location_Searched = "'.$Location.'",Category_Searched= "'.$Category.'",Business_Name = "'.$Business_Name.'",Category = "'.$Category.'",Locality = "'.$Location.'",Zipcode="'.$Zipcode.'",PhoneNo="'.$contact.'",	Longitude="'.$longitude.'",Latitude= "'.$latitude.'",Hours="'.$Hours.'",Price_Range= "'.$Price_Range.'",Established_Year = "'.$Established_Year.'",Owner_Name = "'.$Owner_Name.'",is_hall_available = "'.$is_hall_available.'",hall_Fee = "'.$hall_Fee.'",seat_for_basic = "'.$noofbasicseat.'",cost_per_seat = "'.$cost_per_seat.'",description = "'.$bardes.'",is_payasyougo="" where Owner_id = "'.$selectedownerID.'"';	
	}	
	
	mysql_query($sql);	
	$lastInserid = mysql_affected_rows();
	if($lastInserid>0)
	{
		echo $_SESSION['message']="Data has been updated successfully.";
	}	
	else
	{
		echo $_SESSION['message']="Data has not been updated.";
	}	
	
}
else
{
	
	if(isset($Commission))
	{
		$sql = 'insert into bars_list (Owner_id,Location_Searched,Category_Searched,Business_Name,Category,Locality,Zipcode,PhoneNo,Longitude,Latitude,Hours,Commission,Price_Range,Established_Year,Owner_Name,is_hall_available,hall_Fee,cost_per_seat,seat_for_basic,description,is_payasyougo) values ('.$selectedownerID.',"'.$Location.'","'.$Category.'","'.$Business_Name.'","'.$Category.'","'.$Location.'","'.$Zipcode.'","'.$contact.'","'.$longitude.'","'.$latitude.'","'.$Hours.'","'.$Commission.'","'.$Price_Range.'","'.$Established_Year.'","'.$Owner_Name.'","'.$is_hall_available.'","'.$hall_Fee.'","'.$cost_per_seat.'","'.$noofbasicseat.'","'.$bardes.'","1")';
	}	
	elseif(isset($Discount))
	{
		$sql = 'insert into bars_list (Owner_id,Location_Searched,Category_Searched,Business_Name,Category,Locality,Zipcode,PhoneNo,Longitude,Latitude,Hours,Discount,Price_Range,Established_Year,Owner_Name,is_hall_available,hall_Fee,cost_per_seat,seat_for_basic,description) values ('.$selectedownerID.',"'.$Location.'","'.$Category.'","'.$Business_Name.'","'.$Category.'","'.$Location.'","'.$Zipcode.'","'.$contact.'","'.$longitude.'","'.$latitude.'","'.$Hours.'","'.$Discount.'","'.$Price_Range.'","'.$Established_Year.'","'.$Owner_Name.'","'.$is_hall_available.'","'.$hall_Fee.'","'.$cost_per_seat.'","'.$noofbasicseat.'","'.$bardes.'","2")';
	}
	elseif(isset($is_payasyougo))
	{
		$sql = 'insert into bars_list (Owner_id,Location_Searched,Category_Searched,Business_Name,Category,Locality,Zipcode,PhoneNo,Longitude,Latitude,Hours,Price_Range,Established_Year,Owner_Name,is_hall_available,hall_Fee,cost_per_seat,seat_for_basic,description,is_payasyougo) values ('.$selectedownerID.',"'.$Location.'","'.$Category.'","'.$Business_Name.'","'.$Category.'","'.$Location.'","'.$Zipcode.'","'.$contact.'","'.$longitude.'","'.$latitude.'","'.$Hours.'","'.$Commission.'","'.$Price_Range.'","'.$Established_Year.'","'.$Owner_Name.'","'.$is_hall_available.'","'.$hall_Fee.'","'.$cost_per_seat.'","'.$noofbasicseat.'","'.$bardes.'","'.$is_payasyougo.'")';
	}
	else
	{
		$sql = 'insert into bars_list (Owner_id,Location_Searched,Category_Searched,Business_Name,Category,Locality,Zipcode,PhoneNo,Longitude,Latitude,Hours,Price_Range,Established_Year,Owner_Name,is_hall_available,hall_Fee,cost_per_seat,seat_for_basic,description,is_payasyougo) values ('.$selectedownerID.',"'.$Location.'","'.$Category.'","'.$Business_Name.'","'.$Category.'","'.$Location.'","'.$Zipcode.'","'.$contact.'","'.$longitude.'","'.$latitude.'","'.$Hours.'","'.$Price_Range.'","'.$Established_Year.'","'.$Owner_Name.'","'.$is_hall_available.'","'.$hall_Fee.'","'.$cost_per_seat.'","'.$noofbasicseat.'","'.$bardes.'"."")';
	}
	
	mysql_query($sql);
	$lastInserid = mysql_insert_id();
	if($lastInserid>0)
	{
		echo $_SESSION['message']="Data has been inserted successfully.";	
	}
	else	
	{
		echo $_SESSION['message']="Data has not been inserted.";	
	}	
	
}	
//"(".$selectedownerID.",'".$Location."','".$Category."','".$Business_Name."','".$Category."','".$Location."','".$Zipcode."','".$contact."','".$longitude."','".$latitude."','".$Hours."','".$Price_Range."','".$Established_Year."','".$Owner_Name."','".$basicfees."','".$vipfees."','".$bardes."')"


