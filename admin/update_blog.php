<?php 
ob_start();
include("header.php");

include("includes/config.cfg");
include 'includes/conection.php';


$query=mysql_query("select * FROM tbl_manage_blogs where id='".$_REQUEST['id']."'");
$fetch_blog=mysql_fetch_array($query);
if(isset($_POST['addnew']))
{
	#echo "<pre>";
	#print_r($_POST);
	#exit;
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$created_at = date("Y-m-d H:i:s");
	$status = $_POST['status'];
	$excerpt = $_POST['excerpt'];
	
	global $flag;
	$valid_formats = array("png","gif","jpeg","jpg");
	$path = "images/"; // Upload directory
	$count = 0;
	$new_filename = $_FILES['file']['name'];	
	if(!empty($_FILES['file']['name']))
	{
		if( ! in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $valid_formats) ){
			$_SESSION['errmsg']="<div class='alert alert-danger'>File format is invalid.</div>";
			$flag=1;
			 // Skip invalid file formats
		}
		else
		{ // No error found! Move uploaded files 
			if($flag!=1)
			{
				$new_filename = $_FILES['file']['name'];
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $path.$new_filename))
				{
					$file_path = 'images/'.$new_filename;
					$sql = 'INSERT INTO tbl_manage_blogs (title, author_id, created_at, excerpt, content, image_name, image_path, status) VALUES ("'.$title.'",0,"'.$created_at.'","'.$excerpt.'","'.$content.'","'.$new_filename.'","'.$file_path.'","'.$status.'")';
					$flag = 0;
					$_SESSION['errmsg']="<div class='alert alert-success'>Data has been added successfully.</div>";
					
				}	
				else
				{
					$flag = 1;
					$_SESSION['errmsg']="<div class='alert alert-danger'>There is some issue with file uploading.</div>";
				
				}	
			}	
			
			
		}
	}
	else
	{
		$sql = 'INSERT INTO tbl_manage_blogs (title, author_id, created_at, excerpt, content, status) VALUES ("'.$title.'",0,"'.$created_at.'","'.$excerpt.'","'.$content.'","'.$status.'")';
					
	}		
	
	
	$exe = mysql_query($sql);
		
}	
if(isset($_POST['update']))
{
	#echo "<pre>";
	#print_r($_POST);
	#exit;
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$created_at = date("Y-m-d H:i:s");
	$status = $_POST['status'];
	$excerpt = $_POST['excerpt'];
	
	global $flag;
	$valid_formats = array("png","gif","jpeg","jpg");
	$path = "images/"; // Upload directory
	$count = 0;
	$new_filename = $_FILES['file']['name'];	
	if(!empty($_FILES['file']['name']))
	{
		if( ! in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $valid_formats) ){
			$_SESSION['errmsg']="<div class='alert alert-danger'>File format is invalid.</div>";
			$flag=1;
			 // Skip invalid file formats
		}
		else
		{ // No error found! Move uploaded files 
			if($flag!=1)
			{
				$new_filename = $_FILES['file']['name'];
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $path.$new_filename))
				{
					$file_path = 'images/'.$new_filename;
					$sql = 'update tbl_manage_blogs set title = "'.$title.'", author_id = 0, created_at = "'.$created_at.'",excerpt="'.$excerpt.'", content = "'.$content.'", image_name = "'.$new_filename.'", image_path = "'.$file_path.'", status = "'.$status.'" where id='.$_REQUEST['id'];
					
					$flag = 0;
					$_SESSION['errmsg']="<div class='alert alert-success'>Data has updated added successfully.</div>";
					
				}	
				else
				{
					$flag = 1;
					$_SESSION['errmsg']="<div class='alert alert-danger'>There is some issue with file uploading.</div>";
				
				}	
			}	
			
			
		}
	}
	else
	{
		$sql = 'update tbl_manage_blogs set title = "'.$title.'", author_id = 0, created_at = "'.$created_at.'",excerpt="'.$excerpt.'", content = "'.$content.'", status = "'.$status.'" where id='.$_REQUEST["id"];
					
	}		
	//$sql = "update maincontent set heading='".$title."' , message='".$content."' where id='".$_REQUEST['id']."'";
	$exe = mysql_query($sql);
	$lastId = mysql_affected_rows();
	if(isset($lastId)&&$lastId>0)
	{
		header("location:blogs.php?msg=true");
	}	
}	
?>
<!-- script start -->
<script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
<link href="css/Loader.css" rel="stylesheet">


<!-- ajax script ends -->
	
<div class="container-fluid">
	<div class="row-fluid">
				
		<!-- left menu starts -->
		<?php include("left.php");?><!--/span-->
		<!-- left menu ends -->
			
		<noscript>
			<div class="alert alert-block span10">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
			</div>
		</noscript>
			
		<div id="content" class="span10">
		    <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>&nbsp;Add New Page</h2>
						<div class="box-icon">&nbsp;</div>
					</div>
					<div class="box-content">
						<table align="center" width="100%" >
							<tr><td align="center" style="color:#F00;" id="msg"><?php echo $_SESSION['errmsg'];unset($_SESSION['errmsg']);?></td></tr>
						</table>	
						
						<form name="addnewpage" action="" id="addnewpage" method="post" enctype="multipart/form-data">
							<table align="center" width="80%" >
								<tr >
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td ><label class="control-label" for="typeahead">Title <span style="color:#ff0000;">*</span></label></td>
									<td><input type="text" class="span6 typeahead"  name="title" id="title" value="<?php echo $fetch_blog['title']; ?>"  size="40" required></td>
								</tr>
								<tr>
									<td ><label class="control-label" for="typeahead">Upload image</label></td>
									<td><input type="file" name="file" id="blog_img" accept="image/*"><img src="<?php echo $fetch_blog['image_path']; ?>" height="50" width="50"/></td>
								</tr>
								<tr>
									<td ><label class="control-label" for="typeahead">Excerpt <span style="color:#ff0000;">*</span></label></td>
									<td><textarea name="excerpt" id="excerpt" class="span6 typeahead" maxlength="250" required><?php echo $fetch_blog['excerpt']; ?></textarea></td>
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Content </label></td>
									<td>
										<textarea name="content" id="content" class="content" ><?php echo $fetch_blog['content']; ?></textarea>
										
									</td>
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Status </label></td>
									<td>
										<select name="status">
											<option value="Active" <?php if($fetch_blog['status']=="Active"){?> selected="selected" <?php }?> >Active</option>
											<option value="Inactive" <?php if($fetch_blog['status']=="Inactive"){?> selected="selected" <?php }?> >Inactive</option>
											<option value="Reject" <?php if($fetch_blog['status']=="Reject"){?> selected="selected" <?php }?> >Reject</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">&nbsp;</label></td>
									<td>
										<?php 
										if($_REQUEST['id']!="")
										{
										?>	
											<button type="submit" name="update" id="update" class="btn btn-primary" >Update</button>	
										<?php	
										}else{		
										?>
											<button type="submit" name="addnew" id="addnew" class="btn btn-primary" >Add New</button>	
											
										<?php
										}
										?>
											<button type="button" class="btn btn-default" onclick="location.href='blogs.php'">Cancel</button>
									</td>
								</tr>
							</table>
						</form>
					
					</div>
				</div><!--/span-->
			</div>
		</div><!--/#content.span10-->
	</div><!--/fluid-row-->
	<hr>
	<?php include("footer.php");?>
	
	 <script type="text/javascript">                               
	CKEDITOR.replaceAll('content');	
	</script>
</body>
</html>
