<?php
include 'common.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}


$limit  = 15;
$offset = ($pageNo - 1) * $limit;
$sql = "SELECT bs . * , s.title, u.name, u.email FROM tbl_businessowner_subscription AS bs JOIN tbl_subscription AS s ON bs.subscription_id = s.id JOIN user_register AS u ON bs.owner_id = u.id";
$sql .= " order by id DESC limit ".$offset.",".$limit;
$res = $db->myconn->query($sql);
$num_rows1 = $res->num_rows;

$countres = $db->myconn->query($sql);
$num_rows = $countres->num_rows;
#echo $countSql;


?>
	<input type='hidden' id='totalCount' value='<?php echo $num_rows; ?>'/>
	<input type='hidden' id='Page' value='<?php echo "$pageNo" ?>'/>
<?php	
for($i = 1; $i <= $num_rows1; $i++)
{
	$res1 = $res->fetch_array();
	$start = date('d-m-Y',strtotime($res1['start_date'])) ;
	$end = date('d-m-Y',strtotime($res1['end_date'])) ;
	$status = ($res1['is_active'])?"Active":"";
?>	
	<tr>
		
		<td><?php echo $i;?></td>
		<td><?php echo $res1['name'];?></td>
		<td><?php echo $res1['email'];?></td>
		<td><?php echo $res1['title'];?></td>
		<td>From <?php echo $start. " Till ".$end ;?></td>
		<td><?php echo $res1['amount'];?></td>
		<td><?php echo $status;?></td>
		<td colspan="2">
			<a href="javascript:void(0);" onclick="delete_subscription(<?php echo $res1['id'] ?>,<?php echo $_SESSION['business_owner_id']?>);"><i class="icon-trash" title="Edit"></i></a> 
		</td>
		
	</tr>	
<?php	

}
?>