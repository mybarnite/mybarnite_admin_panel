<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}


$limit  = 15;
$offset = ($pageNo - 1) * $limit;



$query = "select p.* ,u.name as name, case when eventId=0 THEN (SELECT Business_Name FROM bars_list WHERE id = p.barId) ELSE (SELECT event_name from tbl_events WHERE id = p.eventId) END as title from tbl_promotions as p left join user_register as u on u.id=p.ownerId";
//$countSql = "SELECT COUNT(*) AS count FROM tbl_order_history";
$countSql = "select COUNT(*) AS count from tbl_promotions";

/* if(isset($_POST['orderid'])&&$_POST['orderid']!="")
{
	@$query .= " AND o.id = ".$_POST['orderid'];
	@$countSql .= "	AND o.id = ".$_POST['orderid'];
}
if(isset($_POST['name'])&&$_POST['name']!="")
{
	@$query .= " AND o.ordername like '%".$_POST['name']."%'";
	@$countSql .= "	AND o.ordername like '%".$_POST['name']."%'";
}

if(isset($_POST['orderedby'])&&$_POST['orderedby']!="")
{
	@$query .= " AND u.name like '%".$_POST['orderedby']."%'";
	@$countSql .= "	AND u.name like '%".$_POST['orderedby']."%'";
}
if(isset($_POST['payment_status'])&&$_POST['payment_status']!=""&&$_POST['payment_status']!="All")
{
	$query .= " AND payment_status = '".$_POST['payment_status']."'";
	$countSql .= " where payment_status = '".$_POST['payment_status']."'";
}	
 */

$query .= " order by p.id desc limit ".$offset.",".$limit;
$sel_banner_query= mysql_query($query);

#echo $countSql;
$exe= mysql_query($countSql);
$countRows = mysql_fetch_assoc($exe);
?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRows['count']; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>
<?php
$i=1;
while($promotion = mysql_fetch_assoc($sel_banner_query))
{	
	
?>
<tr>
	
	<td><?php echo ($promotion['title']!="")?$promotion['title']:"-";?></td>
	<td><?php echo ($promotion['name']!="")?$promotion['name']:"-";?></td>
	<td><?php echo ($promotion['couponcode']!="")?$promotion['couponcode']:"-";?></td>
	<td><?php echo ($promotion['discount']!="")?$promotion['discount']:"-";?></td>
	<td><?php echo ($promotion['startsat']=="0000-00-00"||$promotion['startsat']=="")?"-":date('m/d/Y',strtotime($promotion['startsat']));?></td>
	<td><?php echo ($promotion['endsat']=="0000-00-00"||$promotion['endsat']=="")?"-":date('m/d/Y',strtotime($promotion['endsat']));?></td>
	<td colspan="2">
		<?php if($promotion['eventId']!=0){?>
		<a href="editPromotion.php?eid=<?php echo $promotion['id']; ?>" class="btn btn-info"><i class="icon-pencil" title="Edit"></i></a>  
		<?php }elseif($promotion['eventId']==0){?>
		<a href="editPromotion.php?bid=<?php echo $promotion['id']; ?>" class="btn btn-info"><i class="icon-pencil" title="Edit"></i></a>  
		<?php }?>
		<a href="javascript:void(0);" onclick="deletePromotion(<?php echo $promotion['id']; ?>);" class="btn btn-info"><i class="icon-trash" title="Trash"></i></a>  
	</td>
</tr>
<?php
	$i++;
}
?>