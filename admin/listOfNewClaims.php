<?php
include 'includes/conection.php';
if(isset($_POST['pageNo']))
{
	$pageNo = $_POST['pageNo'];
}
$name = trim($_POST["name"]).'%';
$email = trim($_POST["email"]).'%';
$bname = trim($_POST["bname"]).'%';
$limit  = 10;
$offset = ($pageNo - 1) * $limit;
//$query = "select u.id as u_id, u.name, u.email, u.status, u.is_requestedForClaim, b.Business_Name, b.id as b_id from user_register as u join bars_list as b on b.Owner_id = u.id where u.r_id = 1 and u.status='Inactive' and u.is_requestedForClaim != 0";
$query = "select u.id as u_id, u.name, u.email, u.status, b.is_requestedForClaim, b.Business_Name, b.id as b_id from user_register as u join bars_list as b on b.Owner_id = u.id where u.r_id = 1 and b.is_requestedForClaim != 0 and b.is_hide=0";
$countSql = "SELECT COUNT(*) AS count FROM user_register as u join bars_list as b on b.Owner_id = u.id where u.r_id = 1 and b.is_requestedForClaim != 0 and b.is_hide=0";


if(strlen($_POST["bname"]) > 0)
{
	$countSql .= " and b.Business_Name like '$bname' ";
	$query .= " and b.Business_Name like '$bname' ";
}

if(strlen($_POST["name"]) > 0)
{
	$countSql .= " and u.name like '$name' ";
	$query .= " and u.name like '$name' ";
}

if(strlen($_POST["email"]) > 0)
{
	$countSql .= " and u.email like '$email' ";
	$query .= " and u.email like '$email' ";
}

if(isset($_POST['claim_status'])&&$_POST['claim_status']!="")
{
	$query .= " and b.is_requestedForClaim = '".$_POST['claim_status']."'";
	$countSql .= " and b.is_requestedForClaim = '".$_POST['claim_status']."'";
}	

$query .= "  limit ".$offset.",".$limit;

$exe= mysql_query($query);
$countRows= mysql_query($countSql); 
#echo $query;
while($countRow=mysql_fetch_array($countRows))
{
						
?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRow['count']; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>
<?php
} 

while($getClaims=mysql_fetch_array($exe))
{	
	if($getClaims['is_requestedForClaim']==1)
	{
		$status = "Pending";
	}
	else if($getClaims['is_requestedForClaim']==2)
	{
		$status = "Accepted";
	}
	else if($getClaims['is_requestedForClaim']==3)
	{
		$status = "Rejected";
	}	
	
?>
<tr>
	<td style="text-align:center;"><input type="checkbox" class="chkbox" name="chk[]" id="<?=$getClaims['u_id']; ?>" value="<?=$getClaims['u_id']; ?>" /></td>
	<td class="center"><?=$getClaims['Business_Name'];?></td>
	<td class="center"><?=$getClaims['name'];?></td>
	<td class="center"><?=$getClaims['email'];?></td>
	<td class="center" colspan="2"><?=$status;?></td>
	<td class="center" colspan="2">
		<a class="btn btn-info" href="viewBusinessDocuments.php?id=<?php echo $getClaims['b_id'];?>">View documents</a>
	</td>
</tr>
<?php 
} 
?>