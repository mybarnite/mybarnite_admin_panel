<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}


$limit  = 10;
$offset = ($pageNo - 1) * $limit;
$query = "SELECT e.*, b.Business_Name from tbl_events as e join bars_list as b on e.bar_id = b.id where e.eventtype = 'Upcoming'" ;
$countSql = "SELECT COUNT(*) AS count from tbl_events as e join bars_list as b on e.bar_id = b.id where e.eventtype = 'Upcoming'";

if(isset($_POST['EventName'])&&$_POST['EventName']!="")
{
	$query .= " AND e.event_name like '%".trim($_POST['EventName'])."%'";
	$countSql .= " AND e.event_name like '%".trim($_POST['EventName'])."%'";
}
if(isset($_POST['BarName'])&&$_POST['BarName']!="")
{
	$query .= " AND b.Business_Name like '%".trim($_POST['BarName'])."%'";
	$countSql .= " AND b.Business_Name like '%".trim($_POST['BarName'])."%'";
}
	
if(isset($_POST['startDate'])&&$_POST["startDate"] != 0)
{
	$query .= " AND e.event_start = '".$_POST['startDate']."'";
	$countSql .= " AND e.event_start = '".$_POST['startDate']."'";
}	

if(isset($_POST['endDate'])&&$_POST["endDate"]!=0)
{
	$query .= " AND e.event_end = '".$_POST['endDate']."'";
	$countSql .= " AND e.event_end = '".$_POST['endDate']."'";
}	


$query .= " limit ".$offset.",".$limit;
$sel_banner_query= mysql_query($query);

#echo $countSql;
$exe= mysql_query($countSql);
$countRows = mysql_fetch_assoc($exe);

?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRows['count']; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>
<?php
if($countRows['count'] >0)
{	
	$i=1;
	while($fetch_banner=mysql_fetch_assoc($sel_banner_query))
	{
		
	?>
		<tr>
				<td style="text-align:center;"><input type="checkbox" name="chk[]" value="<?=$fetch_banner['id']; ?>" /></td>
				<td> <a class="btn btn-info" href="update_event.php?event_id=<?=$fetch_banner['id']; ?>&t=true"><i class="icon-pencil" title="Edit"></i></a></td>
				<td><?=$fetch_banner['event_name'];?></td>
				<td><?=$fetch_banner['Business_Name'];?></td>
				<td class="center"><?=date("m/d/Y", strtotime($fetch_banner['event_start']));?></td>
				<td class="center"><?=date("m/d/Y", strtotime($fetch_banner['event_end']));?></td>
				
				<td><a class="btn btn-info" href="javascript:void(0);" onclick="deleteEvent(<?=$fetch_banner['id']; ?>)" ><i class="icon-trash" title="Trash"></i></a></td>
				
				
		</tr>
	<?php
		
	$i++;
	}
}
else
{
	echo "<tr><td colspan='7'><center><div class='alert alert-danger'>No records found.</div></center></td></tr>";
}	
?>