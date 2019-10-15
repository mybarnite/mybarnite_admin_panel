<?php 
	
	
	include("header.php");

	if(isset($_REQUEST['delete']))
	{
	  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			$tmp_img_qury= mysql_query("select * from maincontent where id='".$id."'");
			$fetch_img_name=mysql_fetch_array($tmp_img_qury);
			$file_to_delete="images/sliderimages/".$fetch_img_name['banner_image'];
			unlink($file_to_delete);
			$succ_del=mysql_query("delete from maincontent where id='".$id."'");
		}
		if($succ_del)
		{
			//$_SESSION['msg']="<div class='alert alert-success'>Successfully deleted!</div>";
		?>	
			<script>window.location.href="maincontent.php?msg=Deleted";</script>
		<?php	
		}
		else
		{
		?>	
			<script>window.location.href="maincontent.php?msg=Error";</script>
		<?php	
			//$_SESSION['msg']="<div class='alert alert-danger'>There is some error!</div>";
		}
	
	}
	  
	if(isset($_REQUEST['active']))
	{
  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			mysql_query("update maincontent set status='Active' where id='".$id."'");
			//$_SESSION['msg']="<div class='alert alert-success'>Successfully activated!</div>";
		?>	
			<script>window.location.href="maincontent.php?msg=Activated";</script>
		<?php	
		}
	
	}
  
	if(isset($_REQUEST['inactive']))
	{
  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			mysql_query("update maincontent set status='Inactive' where id='".$id."'");
		?>	
			<script>window.location.href="maincontent.php?msg=Inactivated";</script>
		<?php	
			//$_SESSION['msg']="<div class='alert alert-success'>Successfully inactivated!</div>";
		}
	}
  
 
?>
	<!-- topbar ends -->
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
			<!-- content starts -->
			

				<div class="row-fluid sortable">		
				<div class="box span12">
                 <script src="js/functionsforcheckall.js"></script>
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>Manage Mybarnite Contents</h2>
                         <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Main Content</span></a></li><?php
						}
						?>
						<div align="right">
							<a href="update_maincontent.php" class="btn btn-primary">Add New</a>
						</div>
					</div>
					<div class="box-content">
						<?php
						if($_REQUEST['msg']=="true")
						{	
						?>
							<table align="center" width="100%" >
								<tr><td align="center" class="alert alert-success"><strong>Data has been updated successfully!</strong></td></tr>
							</table>
						<?php
						}
						if($_REQUEST['msg']=="Error")
						{	
						?>
							<table align="center" width="100%" >
								<tr><td align="center"><div class='alert alert-danger'>There is some error!</div></td></tr>
							</table>
						<?php
						}
						if($_REQUEST['msg']=="Deleted")
						{	
						?>
							<table align="center" width="100%" >
								<tr><td align="center"><div class='alert alert-success'>Successfully deleted!</div></td></tr>
							</table>
						<?php
						}
						if($_REQUEST['msg']=="Activated")
						{	
						?>
							<table align="center" width="100%" >
								<tr><td align="center"><div class='alert alert-success'>Successfully activated!</div></td></tr>
							</table>
						<?php
						}
						if($_REQUEST['msg']=="Inactivated")
						{	
						?>
							<table align="center" width="100%" >
								<tr><td align="center"><div class='alert alert-success'>Successfully inactivated!</div></td></tr>
							</table>
						<?php
						}
						?>	
                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                            
                                <th><input type="checkbox" id="selecctall" onClick="selectAll(this)"/></th>
                            	<th>Edit</th>
								<th>Heading</th>
								<th>Description</th>
								<th>Status</th> 
							  </tr>
						  </thead>   
						  <tbody>
                          <?php $sel_banner_query= mysql_query("select * from maincontent ");
							
						     while($fetch_banner=mysql_fetch_array($sel_banner_query))
							 {
							
									  ?>
							<tr>
								
								<td><input type="checkbox" name="chk[]" value="<?=$fetch_banner['id']; ?>" /></td>
								<td>
									<a class="btn btn-info" href="update_maincontent.php?eid=<?=$fetch_banner['id']; ?>&t=true">
										<i class="icon-pencil" title="Edit"></i>
									</a>
								</td>
								<td class="center"><?=$fetch_banner['heading'];?></td>
								<td class="center"><?=$fetch_banner['message'];?></td>
								<td class="center"><?=$fetch_banner['status'];?></td>
                             		
                            <?php
							
							}?>
							
							</tr>
						  </tbody>
					  </table> 
                      <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <tr>
								<td>&nbsp;</td>
								<td class="center">&nbsp;</td>
								<td  align="right">
                                	<input type="submit" name="active" value="Acitve" class="input btn btn-danger" />
									<input type="submit" name="inactive" value="Inactive" class="input btn btn-danger" />
									<input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>
								</td>
                      </table> 
                      </form>          
					</div>
				</div><!--/span-->
			
			</div>
				
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<?php include("footer.php");?>
		
</body>
</html>
