<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}
$ownername = $_POST['ownername'];
$businessownername = $_POST['businessownername'];
$location = $_POST['location'];
$category = $_POST['category'];
$Commission = $_POST['Commission'];
$cid= $_POST['cid'];
$limit  = 10;
$offset = ($pageNo - 1) * $limit;
$query = "SELECT bl.id as listid,ur.id as cid,ur.name,ur.email as Email,bl.Owner_id,bl.Business_Name,bl.Locality,bl.PhoneNo,bl.Hours,bl.Commission,bl.Price_Range,bl.Established_Year,bl.Category,bl.description 
FROM bars_list as bl
LEFT JOIN user_register as ur
ON bl.Owner_id = ur.id and bl.Business_Name!=''";

$countSql = "SELECT count(bl.id) as count, bl.id as listid,ur.id as cid,ur.email as Email,ur.name,bl.Owner_id,bl.Business_Name,bl.Locality,bl.PhoneNo,bl.Hours,bl.Commission,bl.Price_Range,bl.Established_Year,bl.Category,bl.description 
FROM bars_list as bl
LEFT JOIN user_register as ur
ON bl.Owner_id = ur.id  and bl.Business_Name!=''";
$flag = 0;$flag2=0;$flag3=0;$flag4=0;$flag5=0;$flag6=0;

 if (strlen($_POST['ownername'])>0 || strlen($_POST['businessownername'])>0 ||strlen($_POST['location'])>0 ||strlen($_POST['category'])>0 ||strlen($_POST['Commission'])>0 || strlen($_POST['cid'])>0) {
	$flag = 1;
	$query .= " where ";
	$countSql .= " where ";
}

if(strlen($_POST['ownername']) > 0)
 {
		$countSql .= "  name like '" .$ownername."%'" ;
		$query .= "   name like '".$ownername."%'" ;
		$flag2 = 1;
}
if(strlen($_POST['businessownername']) > 0){
		if ($flag2 ==1) {
			
			$countSql .= "   and Business_Name like '$businessownername%' ";
			$query .= "   and Business_Name like '$businessownername%' ";
		}
		else
		{
			$flag3 = 1;
				$countSql .= "    Business_Name like '$businessownername%' ";
			$query .= "    Business_Name like '$businessownername%' ";
		}
			
	}
if (strlen($_POST['location'])>0) {
	if ($flag2 == 1 || $flag3 == 1) {
		
		$countSql .= "   and Locality like '$location%' ";
			$query .= "   and Locality like '$location%' ";
	}
	else
	{
		$flag4 =1;
		$countSql .= "    Locality like '$location%' ";
			$query .= "    Locality like '$location%' ";
	}
}

if (strlen($_POST['category'])>0) {
	if ($flag2 == 1 || $flag3 == 1 || $flag4 == 1) {
		
		$countSql .= "   and Category like '$category%' ";
			$query .= "   and Category like '$category%' ";
	}
	else
	{
		$flag5 =1;
		$countSql .= "    Category like '$category%' ";
			$query .= "    Category like '$category%' ";
	}
}

if (strlen($_POST['Commission'])>0) {
	if ($flag2 == 1 || $flag3 == 1 || $flag4 == 1|| $flag5 == 1) {
		
		$countSql .= "   and Commission = '$Commission' ";
		$query .= "   and Commission = '$Commission' ";
	}else
	{
		$flag6 =1;	
		$countSql .= "  Commission = '$Commission' ";
		$query .= "  Commission = '$Commission' ";
	}
	
}
if (strlen($_POST['cid'])>0) {
	if ($flag2 == 1 || $flag3 == 1 || $flag4 == 1|| $flag5 == 1|| $flag6 == 1) {
		
		$countSql .= "   and ur.id = '$cid' ";
		$query .= "   and ur.id = '$cid' ";
	}else
	{
		
		$countSql .= "  ur.id = '$cid' ";
		$query .= "  ur.id = '$cid' ";
	}
}

$query .= " order by ur.id DESC limit ".$offset.",".$limit;
$sel_banner_query= mysql_query($query);
echo mysql_error();
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
		?>
	
	<tr>
		<td><input type="checkbox" name="chk[]" value="<?=$fetch_banner['listid']; ?>" /></td>
		<td> <a class="btn btn-info" href="bar_list_update.php?banner_id=<?=$fetch_banner['listid']; ?>&t=true&owner_id=<?=$fetch_banner['Owner_id']; ?>">
			<i class="icon-pencil" title="Edit"></i></a>
		</td>
		<td class="center"><?=($fetch_banner['cid'])?$fetch_banner['cid']:"-";?></td>		
		<td class="center"><?=($fetch_banner['name'])?$fetch_banner['name']:"-";?></td>
		<td class="center"><?=($fetch_banner['Email'])?$fetch_banner['Email']:"-";?></td>
		<td class="center"><?=$fetch_banner['Business_Name'];?></td>
		<td class="center"><?=($fetch_banner['Locality'])?$fetch_banner['Locality']:"-";?></td>
		<td class="center"><?=($fetch_banner['PhoneNo'])?$fetch_banner['PhoneNo']:"-";?></td>
		<td class="center"><?=($fetch_banner['Category'])?$fetch_banner['Category']:"-";?></td>
		<td class="center"><?=($fetch_banner['Commission'])?$fetch_banner['Commission']:"-";?></td>
		<td colspan="2"><a style="color:#4ba6db;" href="barDetailsView.php?id=<?=$fetch_banner['listid']; ?>">View sales report</a></td>
	</tr>
   <?php } ?>