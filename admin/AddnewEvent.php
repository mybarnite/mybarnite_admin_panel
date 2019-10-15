<?php
include 'includes/conection.php';
echo "<pre>";
print_r($_POST);
echo "<pre>";
print_r($_FILE);
exit;

$EventName = $_POST['EventName'];
$event_description = $_POST['event_description'];
$event_startdate = $_POST['event_startdate'];
$timepicker1 = $_POST['timepicker1'];
$event_enddate = $_POST['event_enddate'];
$timepicker2 = $_POST['timepicker2'];
$Business_id = $_POST['Business_id'];

$startTimeStemp = date("Y-m-d H:i:s",strtotime($event_startdate . $timepicker1));
$endTimeStemp = date("Y-m-d H:i:s",strtotime($event_enddate . $timepicker2));
$eventtype = $_POST['eventtype'];

$event_price_vip = $_POST['event_price_vip']; 
$event_price_basic = $_POST['event_price_basic']; 
$cancellation_policy = $_POST['cancellation_policy']; 
$free_event  = $_POST['free_event']; 
$sql = "INSERT INTO tbl_events (id,	bar_id,	event_name,event_description,event_start,event_end,event_price_vip,event_price_basic,cancellation_policy,start_time,end_time,event_starttimestamp,event_endtimestamp,eventtype,free_event) VALUES ('','".$Business_id."','".$EventName."','".$event_description."','".$event_startdate."','".$event_enddate."','".$event_price_vip."','".$event_price_basic."','".$cancellation_policy."','".$timepicker1."','".$timepicker2."','".$startTimeStemp."','".$endTimeStemp."','".$eventtype."','".$free_event."')";
mysql_query($sql);

?>










