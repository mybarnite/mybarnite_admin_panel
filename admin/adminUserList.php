<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}
$admin_name = trim($_POST["admin_name"]).'%';
$admin_login_id = trim($_POST["admin_login_id"]).'%';

$limit  = 10;
$offset = ($pageNo - 1) * $limit;

$query = "SELECT a.*, GROUP_CONCAT( DISTINCT b.page_name ) as permissions FROM tbl_admin AS a left JOIN  tbl_adminStaffPermission AS b ON FIND_IN_SET( b.subuser_id, a.id ) where a.r_id = 4 ";
$countSql = "SELECT a.*, GROUP_CONCAT( DISTINCT b.page_name ) as permissions FROM tbl_admin AS a left JOIN  tbl_adminStaffPermission AS b ON FIND_IN_SET( b.subuser_id, a.id ) where a.r_id = 4 GROUP BY id ";

 if(strlen($_POST["admin_name"]) > 0){
		$countSql .= " and a.admin_name like '$admin_name' ";
		$query .= " and a.admin_name like '$admin_name' ";
}

 if(strlen($_POST["admin_login_id"]) > 0){
		$countSql .= " and a.admin_login_id like '$admin_login_id' ";
		$query .= " and a.admin_login_id like '$admin_login_id' ";
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
	<td><?php echo $res1['admin_name'];?></td>
	<td><?php echo $res1['admin_login_id'];?></td>
	<td width="20"><?php echo ($res1['permissions'])?$res1['permissions']:"-";?></td>
	<td><?php echo $res1['admin_status'];?></td>
	<td colspan="3">
		<a href="javascript:void(0);" class="btn btn-info" onclick="deleteAdminSubUser(<?php echo $res1['id'] ?>);"><i class="icon-trash" title="Edit"></i></a> 
		<a href="addAdminSubUser.php?id=<?php echo $res1['id'];?>" class="btn btn-info"><i class="icon-pencil" title="Edit"></i></a> 
	</td>
	
</tr>	
<?php } ?>