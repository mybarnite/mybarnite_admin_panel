<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}
$title = trim($_POST["title"]).'%';
//$author = trim($_POST["author"]);
$limit  = 10;
$offset = ($pageNo - 1) * $limit;
$query = "select * from tbl_manage_blogs";
$countSql = "SELECT COUNT(*) AS count FROM tbl_manage_blogs";

if(strlen($_POST["title"]) > 0){
		$countSql .= " and title like '$title' ";
		$query .= " and title like '$title' ";
}

/*  if(strlen($_POST["email"]) > 0){
		$countSql .= " and email like '$email' ";
		$query .= " and email like '$email' ";
}
 */
$query .= " limit ".$offset.",".$limit;

$exe= mysql_query($query);
 $countRows= mysql_query($countSql); 
 while($countRow=mysql_fetch_array($countRows))
							 {
						
							?>
							<input type='hidden' id='totaluserCount' value='<?php echo $countRow['count']; ?>'/>
						<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>
						
						<?php
							} 
						while($fetch_blogs=mysql_fetch_array($exe))
							 {
								 if($fetch_blogs['author_id']==0)
								 {
										$fetch_blogs['author_id']='Admin';
								 }
								 else
								 {
										$query1 = "select * from user_register where id=".$fetch_blogs['author_id'];
										$exe1= mysql_query($query1);
										$getAuthor = mysql_fetch_array($exe1);
										$fetch_blogs['author_id']=$getAuthor['name'];
								 }	 
							 	?>
							
							<tr>
							
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_blogs['id']; ?>" /></td>
                            <td> <a class="btn btn-info" href="update_blog.php?id=<?=$fetch_blogs['id']; ?>">
							<i class="icon-pencil" title="Edit"></i></a></td>
                         		
								
								
								<td class="center"><?=$fetch_blogs['title'];?></td>
								<td class="center"><?=$fetch_blogs['author_id'];?></td>
								 <td class="center"><?=date('m-d-Y g:i a',strtotime($fetch_blogs['created_at']));?></td> 
								<td class="center"><?=$fetch_blogs['status'];?></td>
								
								
							</tr>
                           <?php } ?>