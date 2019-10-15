<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}
// $name = trim($_POST["name"]).'%';
$EventName = trim($_POST["EventName"]).'%';
$BarName = trim($_POST["BarName"]).'%';
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
// $email = trim($_POST["email"]).'%';
$limit  = 10;
$offset = ($pageNo - 1) * $limit;
$query = "select e.id,e.event_name,e.event_start,e.event_end,e.event_description,e.eventtype,e.is_availableForBooking,e.free_event,b.Business_name from tbl_events as e join bars_list as b on e.bar_id = b.id " ;
 $countSql = "SELECT COUNT(*) AS count FROM tbl_events as e join bars_list as b on e.bar_id = b.id  ";
$flag = 0;$flag1=0;$flag2=0;

$currentDateTimestamp = strtotime(date("m/d/Y"));	
if (strlen($_POST["EventName"]) >0 || $_POST['startDate'] != 0 || $_POST['endDate'] !=0 ||$_POST['searchEventType']!="0" || strlen($_POST["BarName"]) >0) {
	$countSql .= " where  ";
		$query .= " where  ";
		$flag = 1;
}

 if(strlen($_POST["EventName"]) > 0){
 	if ($flag == 1) {
 		$flag1 = 1;
 		$countSql .= "  e.event_name like '$EventName' ";
		$query .= "  e.event_name like '$EventName' ";
 	}
 }
 

		
if(strlen($_POST["startDate"]) > 0){
 	if ($flag1 == 1) {
 		$flag2 = 1;
 		$countSql .= "  and DATE(e.event_start) = '".$_POST['startDate']."'";
		$query .= "  and DATE(e.event_start) = '".$_POST['startDate']."' ";
 	}
 	else
 	{
 			$countSql .= "   DATE(e.event_start) = '".$_POST['startDate']."' ";
		$query .= "   DATE(e.event_start) ='".$_POST['startDate']."' ";
		$flag2 = 1;
 	}
}

if($_POST["endDate"] != 0){
 	if ($flag1 == 1 || $flag2 == 1) {
 		
 		$countSql .= "  and DATE(e.event_end) = '".$_POST['endDate']."' ";
		$query .= "  and DATE(event_end) = '".$_POST['endDate']."' ";
 	}
 	else
 	{
 		$countSql .= " DATE(e.event_end)= '".$_POST['endDate']."' ";
		$query .= " DATE(event_end) = '".$_POST['endDate']."' ";
 	}
	$flag2 == 1;
}

if($_POST['searchEventType']!="0")
{	
	if($_POST['searchEventType']=="1")
	{
		if ($flag1 == 1 || $flag2 == 1) 
		{
 			$countSql .= " and e.is_availableForBooking = 'Available' ";
			$query .= " and e.is_availableForBooking = 'Available' ";
			//$countSql .= " and event_starttimestamp >= '".$currentDateTimestamp."' order by event_start DESC ";
			//$query .= " and event_starttimestamp >= '".$currentDateTimestamp."' order by event_start DESC ";
		}
		else
		{
			$countSql .= "  e.is_availableForBooking = 'Available' ";
			$query .= "  e.is_availableForBooking = 'Available' ";
			//$countSql .= "  event_starttimestamp >= '".$currentDateTimestamp."' order by event_start DESC ";
			//$query .= "  event_starttimestamp >= '".$currentDateTimestamp."' order by event_start DESC ";
		}
		$flag2 == 1;	
	}	
	
	if($_POST['searchEventType']=="2")
	{
		
		if ($flag1 == 1 || $flag2 == 1) 
		{
 			//$countSql .= " and event_start > NOW()";
			//$query .= " and event_start > NOW()";
			$countSql .= " and e.is_availableForBooking = 'Booked' ";
			$query .= " and e.is_availableForBooking = 'Booked' ";
		}
		else
		{
			//$countSql .= "  event_start > NOW() ";
			//$query .= "  event_start > NOW() ";
			$countSql .= "  e.is_availableForBooking = 'Booked' ";
			$query .= "  e.is_availableForBooking = 'Booked' ";
		}
		$flag2 == 1;	
	}
	
}

 if(strlen($_POST["BarName"]) > 0){
 	if ($flag1 == 1 || $flag2 == 1) 
 	{	
 		$countSql .= " and  b.Business_name like '$BarName' ";
		$query .= " and  b.Business_name like '$BarName' ";
 	}
	else
 	{
 			$countSql .= " b.Business_name like '$BarName' ";
		$query .= " b.Business_name like '$BarName' ";
		
 	}
	$flag2 == 1;	
 }	

$query .= " order by e.event_start DESC limit ".$offset.",".$limit;

$sel_banner_query= mysql_query($query);
 $countRows= mysql_query($countSql); 
 while($countRow=mysql_fetch_array($countRows))
{

	?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRow['count']; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>

<?php
} 
						
						while($fetch_banner=mysql_fetch_array($sel_banner_query))
						 {
							$today = time();
							$end = strtotime($fetch_banner['event_end']);
							/* if($today<$end)
							{ */		
							 	
							?>
							<tr>
								<td style="text-align:center;"><input type="checkbox" name="chk[]" value="<?=$fetch_banner['id']; ?>" /></td>
								<?php
								$originalDateforStart = $fetch_banner['event_start'];
								$newDateforStart = date("m/d/Y", strtotime($originalDateforStart));

								$originalDateforEnd = $fetch_banner['event_end'];
								$newDateforEnd = date("m/d/Y", strtotime($originalDateforEnd));
								?>
								<td class="center"><?=$fetch_banner['event_name'];?></td>
								<td class="center"><?=$fetch_banner['Business_name'];?></td>
								<td class="center"><?=$newDateforStart;?></td>
								<td class="center"><?=$newDateforEnd;?></td> 
								<td class="center" width="20"><?= ($fetch_banner['free_event']==1)?"Yes":"No";?></td> 
								<td><?php echo ($fetch_banner['eventtype']=="Normal")?"-":$fetch_banner['eventtype'];?></td>
								<td class="center"><?=$fetch_banner['is_availableForBooking'];?></td> 
								<td colspan="3">
									<a class="btn btn-info" href="update_event.php?event_id=<?=$fetch_banner['id']; ?>&t=true"><i class="icon-pencil" title="Edit"></i></a>
									<a class="btn btn-info" href="javascript:void(0);" onclick="deleteEvent(<?=$fetch_banner['id']; ?>)" ><i class="icon-trash" title="Trash"></i></a>
									<a style="color:#4ba6db;" href="viewEventUploads.php?id=<?php echo $fetch_banner['id'];?>">View</a>
								</td>
							</tr>
							 <?php //}
							 } ?>