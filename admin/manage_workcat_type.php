<?php  include("header.php");
  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  $succ_del=mysql_query("delete from work_category where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected record is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Selected record is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_workcat_type.php?msg=<?php  echo $_SESSION['msg'];?>";</script>
	  <?php
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update work_category set is_active=1 where id='".$id."'");
   $_SESSION['msg']="Selected record is Activated";
  }
  ?>
	   <script>window.location.href="manage_workcat_type.php?msg=<?php  echo $_SESSION['msg'];?>";</script>
	  <?php
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update work_category set is_active=0 where id='".$id."'");
   $_SESSION['msg']="Selected record is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_workcat_type.php?msg=<?php  echo $_SESSION['msg'];?>";</script>
	  <?php
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
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>Property Type Management</h2>
					  <div align="right">
                        <a href="add_workcat_type.php" class="btn btn-setting btn-round">Add New</a>
					    	
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;">
					<strong>
					<?php //echo $_REQUEST['msg'];?>
					<?php 
							if( isset($_SESSION['msg']) ){
								echo $_SESSION['msg'];
								unset($_SESSION['msg']);
							}
						?>
						
					</strong>
					
					</td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                <th width="10">&nbsp;</th>
                                <th width="10">Edit</th>
								
                                
								<th width="70"> Work/Jobs Categories</th>
								
								
                                
								
							  <th width="20"> Status</th>
								
							  </tr>
						  </thead>   
						  <tbody>
                          <?php 
							$sel_page_query= mysql_query("select * from work_category");
							$num_rows = mysql_num_rows($sel_page_query);
							
							if( $num_rows > 0){
						     while($fetch_content=mysql_fetch_array($sel_page_query))
							 {
								$cont_Id = $fetch_content['id'];
								$status = $fetch_content['is_active'];
								
						/*		echo "<pre>";
								print_r($fetch_content);
								echo "</pre>";*/
						  ?>
							<tr>
								<td><input type="checkbox" name="chk[]" value="<?php  echo $fetch_content['id']; ?>" /></td>
								
								<td> <a class="btn btn-info" href="update_workcategory.php?page_id=<?php  echo $fetch_content['id']; ?>">
								<i class="icon-pencil" title="Edit"></i></a></td>
								
								
								
								<td class="center"><?php  echo ucwords($fetch_content['category']);?></td>
								
								
								
								<!--<td class="center"><?php  //echo $fetch_content['news_description'];?></td>-->
								
								  
								<td class="center">
									<?php 
										if( $status == 1){
									?>
											<span class="label label-success">Active</span></td>
									<?php
										}
										else{
									?>
											<span class="label label-danger">Inactive</span>
									<?php
										}
									?>
								</td>
							
							</tr>
                            <?php 
								}
								
							}//end if
							else{
							?>
								<tr> <td colspan="5" class="center"><span class="label label-danger">Record not found!</span></td> </tr>
							<?php
							}
							?>
							
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
