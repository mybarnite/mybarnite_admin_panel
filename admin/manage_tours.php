<? include("header.php");




  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  $succ_del=mysql_query("delete from tbl_tours where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected record is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Static record is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_tours.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_tours set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected record is Activated";
  }
  ?>
	   <script>window.location.href="manage_tours.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_tours set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected record is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_tours.php?msg=<?=$_SESSION['msg'];?>";</script>
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
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>Tour Tabs Management</h2>
					  <div align="right">
                        <a href="add_tours.php" class="btn btn-setting btn-round">Add New</a>
					    	
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
                                   <th width="20">&nbsp;</th>
                                   <th width="24">&nbsp;</th>
								 
                                  <th width="93"> Heading</th>
                                <th width="310">Content</th>
								
							    <th width="67">Status </th>
							  </tr>
						  </thead>   
						  <tbody>
                          <? $sel_page_query= mysql_query("select * from tbl_tours");
						     while($fetch_content=mysql_fetch_array($sel_page_query))
							 {
							
						  ?>
							<tr>
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_content['id']; ?>" /></td>
                            <td> <a class="btn btn-info" href="update_tours.php?page_id=<?=$fetch_content['id']; ?>">
							<i class="icon-pencil" title="Edit"></i></a></td>
                            
                            <td class="center"><?=$fetch_content['news_heading'];?></td>
                            <td class="center"><?=$fetch_content['news_description'];?></td>
                            
                              
								<td class="center">
									<span class="label label-success"><?=$fetch_content['status'];?></span></td>
								
							</tr>
                            <? }?>
							
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

		<? include("footer.php");?>
		
</body>
</html>
