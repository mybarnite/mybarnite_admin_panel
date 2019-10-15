<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}
$name = trim($_POST["name"]).'%';
$email = trim($_POST["email"]).'%';
$cid= trim($_POST["cid"]);
$limit  = 10;
$offset = ($pageNo - 1) * $limit;
$query = "select * from user_register where r_id = 1 ";
$countSql = "SELECT COUNT(*) AS count FROM user_register WHERE r_id = 1 ";


 if(strlen($_POST["cid"]) > 0){
		$countSql .= " and id = '$cid' ";
		$query .= " and id = '$cid' ";
}

 if(strlen($_POST["name"]) > 0){
		$countSql .= " and name like '$name' ";
		$query .= " and name like '$name' ";
}

 if(strlen($_POST["email"]) > 0){
		$countSql .= " and email like '$email' ";
		$query .= " and email like '$email' ";
}

$query .= "limit ".$offset.",".$limit;

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
							 $userSql = "select Business_Name from bars_list where Owner_id = ".$fetch_banner['id'];							 
							 $exec = mysql_query($userSql);
							 $getuserData = mysql_fetch_assoc($exec);
							 	?>
							
							<tr>
						
							<td style="text-align:center;"><input type="checkbox" class="chkbox" name="chk[]" id="<?php echo $fetch_banner['id']; ?>" value="<?php echo $fetch_banner['id']; ?>" /></td>
                            <td style="text-align:center;"><a class="btn btn-danger" href="javascript:void(0);" onclick="deleteUserAccount(<?php echo $fetch_banner['id'];?>,<?php echo $fetch_banner['r_id'];?>);">
		<i class="fa fa-user-times" title="Delete user account"></i></a></td>
                            <td> <a class="btn btn-info" href="update_business_owner_list.php?banner_id=<?=$fetch_banner['id']; ?>&t=true">
							<i class="icon-pencil" title="Edit"></i></a></td>
                         		
								
								<td class="center"><?=$fetch_banner['id'];?></td>								
								<td class="center"><?=$fetch_banner['name'];?></td>
								<td class="center"><?=$fetch_banner['email'];?></td>
								<td class="center"><?=$getuserData['Business_Name']?$getuserData['Business_Name']:"-";?></td>
								<td class="center"><?=$fetch_banner['status'];?></td>
								<td class="center" colspan="2"><a href="accountDetailsView.php?id=<?=$fetch_banner['id']; ?>" style="color:#4ba6db;">View</a></td>	
								
							</tr>
                           <?php } ?>