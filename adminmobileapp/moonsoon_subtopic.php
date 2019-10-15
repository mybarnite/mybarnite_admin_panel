<? include("header.php");


  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
	  $tmp_img_qury= mysql_query("select * from slider_tbl where id='".$id."'");
	$fetch_img_name=mysql_fetch_array($tmp_img_qury);
	$file_to_delete="images/sliderimages/".$fetch_img_name['banner_image'];
	unlink($file_to_delete);
  $succ_del=mysql_query("delete from slider_tbl where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected Image is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Image is not successfully deleted";
  }
  ?>
	   <script>window.location.href="latest_features.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update slider_tbl set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected Image is Activated";
  }
  ?>
	   <script>window.location.href="latest_features.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update slider_tbl set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected Image is Inactivated";
  }
  ?>
	   <script>window.location.href="latest_features.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?
  }
  
 
?>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<? include("left.php");?><!--/span-->
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
						<h2><i class="icon-list"></i>Welcome MoonSoon Message</h2>
                         <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Profit Mate Work</span></a></li><?php
						}
						?>
						<div align="right">
							<!--<a href="add_new_latestfeatures.php?t=true" class="btn btn-setting btn-round">Add New Image</a>-->
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                   <th width="20"><input type="checkbox" name="checkall" id="checkall" onclick="check_all(this.form)"/></th>
                                   <th width="24">Edit</th>
                                  
                                
								<th>Heading</th>
								<th>Description</th>
								  
							  </tr>
						  </thead>   
						  <tbody>
                          <? $sel_banner_query= mysql_query("select * from moonsoon_subtopic");
						     while($fetch_banner=mysql_fetch_array($sel_banner_query))
							 {
							
									  ?>
							<tr>
                           <?php /*?> <td><input type="checkbox" name="chk[]" value="<?=$fetch_banner['id']; ?>" /></td><?php */?>
                            <td> <a class="btn btn-info" href="update_moonsoon_subtopic.php?banner_id=<?=$fetch_banner['id']; ?>&t=true">
							<i class="icon-pencil" title="Edit"></i></a>
								<td class="center"><?=$fetch_banner['heading'];?></td>
								<td class="center"><?=$fetch_banner['message'];?></td>
                             		
                            <? }?>
							
							</tr>
						  </tbody>
					  </table> 
                      <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <tr>
								<td>&nbsp;</td>
								<td class="center">&nbsp;</td>
								<td  align="right">
                                	<!--<input type="submit" name="active" value="Acitve" class="input btn btn-danger" />
                              <input type="submit" name="inactive" value="Inactive" class="input btn btn-danger" />
                            <input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>-->
						</td>
                      </table> 
                      </form>          
					</div>
				</div><!--/span-->
			
			</div>
				
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
