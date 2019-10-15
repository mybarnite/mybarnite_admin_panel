<?php
include 'includes/conection.php';
$EventName = $_POST['EventName'];
$event_description = $_POST['event_description'];
$event_startdate = $_POST['event_startdate'];
$timepicker1 = $_POST['timepicker1'];
$event_enddate = $_POST['event_enddate'];
$timepicker2 = $_POST['timepicker2'];
$event_id = $_POST['event_id'];
$Business_id = $_POST['Business_id'];
$availBooking = $_POST['availBooking'];
$startTimeStemp = strtotime($event_startdate . $timepicker1);
$endTimeStemp = strtotime($event_enddate . $timepicker2);
$eventtype = $_POST['eventtype'];

$event_price_vip = $_POST['event_price_vip']; 
$event_price_basic = $_POST['event_price_basic']; 
$cancellation_policy = $_POST['cancellation_policy']; 
$free_event = $_POST['free_event']; 

$sql = 'UPDATE tbl_events SET bar_id= '.$Business_id.',event_name= "'.$EventName.'",event_description= "'.$event_description.'",event_start= "'.$event_startdate.'",	event_end= "'.$event_enddate.'",start_time= "'.$timepicker1.'",end_time= "'.$timepicker2.'",event_starttimestamp= "'.$startTimeStemp.'",event_endtimestamp= "'.$endTimeStemp.'",event_price_vip="'.$event_price_vip.'",event_price_basic="'.$event_price_basic.'",cancellation_policy="'.$cancellation_policy.'",eventtype="'.$eventtype.'",is_availableForBooking="'.$availBooking.'", free_event = "'.$free_event.'" WHERE id = '.$event_id;
mysql_query($sql);

?>










