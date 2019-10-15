<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}


$limit  = 15;
$offset = ($pageNo - 1) * $limit;


$query = "select DISTINCT f.bar_id, f.*,b.Business_Name,b.id as bar_id from tbl_barfoodmenu_uploads as f join bars_list as b on f.bar_id = b.id group by f.bar_id";

$countSql = "select COUNT(*) AS count from tbl_barfoodmenu_uploads as f join bars_list as b on f.bar_id = b.id";

$query .= " limit ".$offset.",".$limit;
$result= mysql_query($query);

#echo $countSql;
$exe= mysql_query($countSql);
$countRows = mysql_fetch_assoc($exe);
?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRows['count']; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>
<?php
$i=1;
while($menu = mysql_fetch_assoc($result))
{	
	/* echo "<pre>";
	print_r($menu); */
?>
<tr>
	
	<td><?php echo ($menu['Business_Name']!="")?$menu['Business_Name']:"-";?></td>
	<td colspan="2">
		<a class="btn btn-info" href="viewMenu.php?id=<?php echo $menu['bar_id']; ?>">View Menu</a>
	</td>
</tr>
<?php
	$i++;
}
?>