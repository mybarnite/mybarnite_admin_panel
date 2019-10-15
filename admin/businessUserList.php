<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}
$name = trim($_POST["name"]).'%';
$email = trim($_POST["email"]).'%';
$barName = trim($_POST["barName"]).'%';

$limit  = 10;
$offset = ($pageNo - 1) * $limit;

$query = "SELECT a.*, GROUP_CONCAT(  b.page_name ) as permissions, c.Business_Name FROM user_register AS a join bars_list as c on c.id = a.bar_id left JOIN  tbl_staffPermission AS b ON FIND_IN_SET( b.subuser_id, a.id ) where a.r_id = 3 ";
$countSql = "SELECT a.*, GROUP_CONCAT(  b.page_name ) as permissions, c.Business_Name FROM user_register AS a join bars_list as c on c.id = a.bar_id left JOIN  tbl_staffPermission AS b ON FIND_IN_SET( b.subuser_id, a.id ) where a.r_id = 3 GROUP BY id ";

 if(strlen($_POST["name"]) > 0){
		$countSql .= " and a.name like '$name' ";
		$query .= " and a.name like '$name' ";
}

 if(strlen($_POST["email"]) > 0){
		$countSql .= " and a.email like '$email' ";
		$query .= " and a.email like '$email' ";
}

if(strlen($_POST["barName"]) > 0){
		$countSql .= " and c.Business_Name like '$barName' ";
		$query .= " and c.Business_Name like '$barName' ";
}

$query .= " GROUP BY id limit ".$offset.",".$limit;

$sel_banner_query= mysql_query($query);
$exe = mysql_query($countSql); 
$countRow = mysql_num_rows($exe);

?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRow; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>

<?php
 
while($res1=mysql_fetch_array($sel_banner_query))
{
/* echo "<pre>";
print_r($res1); */
?>

<tr>
		
	<td width="100"><input type="checkbox" class="chkbox" name="chk[]" id="<?php echo $res1['id']; ?>" value="<?php echo $res1['id']; ?>" /></td>
	<td><?php echo $res1['name'];?></td>
	<td><?php echo $res1['email'];?></td>
	<td><?php echo $res1['Business_Name'];?></td>
	<td width="20"><?php echo $res1['permissions'];?></td>
	<td><?php echo $res1['status'];?></td>
	<td colspan="3">
		<?php /*<a href="javascript:void(0);" class="btn btn-info" onclick="deleteSubUser(<?php echo $res1['id'] ?>);"><i class="icon-trash" title="Edit"></i></a> */?>
		<a href="javascript:void(0);" class="btn btn-danger" onclick="deleteUserAccount(<?php echo $res1['id'];?>,<?php echo $res1['r_id'];?>);"><i class="fa fa-user-times" title="Delete user account"></i></a> 
		
		<a href="addBusinessSubUser.php?id=<?php echo $res1['id'];?>" class="btn btn-info"><i class="icon-pencil" title="Edit"></i></a> 
	</td>
	
</tr>	
<?php } ?>