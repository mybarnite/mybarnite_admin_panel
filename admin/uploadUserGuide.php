<?php 
include("header.php");
if(isset($_POST['addNew']))
{
	
	global $flag;
	$valid_formats = array("pdf");
	$path = "../business_owner/user_guide/"; // Upload directory
	$count = 0;
	
		$new_filename = $_FILES['file']['name'];		   
		if ($_FILES['file']['error'] == 0) {	           
			if( ! in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $valid_formats) ){
				$_SESSION['msg']="<div class='alert alert-danger'>File format is invalid.</div>";
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
						$q1 = "update tbl_user_guide set file_name = '".$new_filename."',file_path = 'user_guide/".$new_filename."' where id=1";
						$e1 = mysql_query($q1);
						$lastInsertedId = mysql_affected_rows();
						$flag = 0;
						$_SESSION['msg']="<div class='alert alert-success'>File Uploaded successfully.</div>";
						
					}	
					else
					{
						$flag = 1;
						$_SESSION['msg']="<div class='alert alert-danger'>There is some issue with file uploading.</div>";
					
					}	
				}	
				
				
			}
		}
	
	
}	
?>
	<!-- topbar ends -->
   
    	<!-- ajax script start -->
        <script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
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
								<h2><i class="icon-edit"></i>&nbsp;User guide</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="menu_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg"><?php echo $_SESSION['msg'];unset($_SESSION['msg']);?></td></tr>
								</table>
								<form role="form" method="post" class="form-horizontal" enctype="multipart/form-data">
									<table align="center" width="80%" >
										<tbody>
											<input type="hidden" name="action" id="action" value="Add"/>
										
											<tr>
												<td><label class="control-label" for="typeahead">Upload file : <span style="color:red;">*</span></label></td>
												<td><input type="file" id="file" name="file" multiple="multiple" accept="image/*" /></td>
											</tr>
											<tr>
												<td><label class="control-label" for="typeahead">&nbsp;</label></td>
												<td>
													<input type="submit" id="addNew" name="addNew" value="Upload" class="btn btn-primary" />
													<button class="btn" onclick="resetFields();">Reset</button>
												</td>
											</tr>
										</tbody>	
									</table>
								</form>
								<?php 
								$q2 = "select * from tbl_user_guide where id = 1";
								$e2 = mysql_query($q2);
								$getRow = mysql_fetch_assoc($e2);
								
								?>
								<table align="center" width="80%" class="table table-striped bootstrap-datatable datatable">
									<tr>
										<td style="text-align:center;"><label class="control-label" for="typeahead">User guide :</label></td>
										<td colspan="2"><a href="../business_owner/<?php echo $getRow['file_path'];?>" class="btn btn-info" target="_blank">View guide</a></td>
									</tr>
								</table>
								
							</div>
						</div><!--/span-->
					</div>
					
				
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 
 <script>
 function resetFields()
 {
	window.location.href = 'menuList.php';
 }
 
 

$(document).ready(function(){
	$('#addNew').click(function(){
		 var fileName = $("#file").val();
		 
		if ($('#bar').val() == '0') {
			$("#msg").html('Please fill all fields marked as (*).');
			return false;
		}
		if (!fileName) {
			$("#msg").html('Please select any file.');
			return false;
		}
		
		else
		{
			return true;
		}
	});  
});
</script> 	
		<?php include("footer.php");?>
		
</body>
</html>
