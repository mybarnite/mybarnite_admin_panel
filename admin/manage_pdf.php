<? include("header.php");


  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
	  $tmp_img_qury= mysql_query("select * from tbl_pdf where id='".$id."'");
	$fetch_img_name=mysql_fetch_array($tmp_img_qury);
	$file_to_delete="product_images/".$fetch_img_name['pdf_image'];
	unlink($file_to_delete);
  $succ_del=mysql_query("delete from tbl_pdf where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected Banner is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Banner is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_pdf.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_pdf set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected Banner is Activated";
  }
  ?>
	   <script>window.location.href="manage_pdf.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_pdf set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected Banner is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_pdf.php?msg=<?=$_SESSION['msg'];?>";</script>
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
						<h2><i class="icon-list"></i>Banner Management</h2>
						<!--<div align="right">
							<a href="add_new_pdf.php" class="btn btn-setting btn-round">Upload New PDF</a>
							
						</div>-->
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
                                    <th width="214">PDF</th>
                              
								   <th width="59">Status </th>
							  </tr>
						  </thead>   
						  <tbody>
                          <? $sel_banner_query= mysql_query("select * from tbl_pdf where status ='Active'");
						     while($fetch_banner=mysql_fetch_array($sel_banner_query))
							 {
							
								$query_company=mysql_query("select * from tbl_company where id='".$fetch_banner['company_id']."'");
						  $fetch_company= mysql_fetch_array($query_company);
						  
							$query_category=mysql_query("select * from tbl_main_category where id='".$fetch_banner['category_id']."'");
						  $fetch_category= mysql_fetch_array($query_category);
						  ?>
							<tr>
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_banner['id']; ?>" /></td>
                            <td> <a class="btn btn-info" href="update_pdf.php?id=<?=$fetch_banner['id']; ?>">
							<i class="icon-pencil" title="Edit"></i></a></td>
                          
								<td class="center"><a href="product_images/<?php echo $fetch_banner['pdf']; ?>"><img src="img/pdf.png" /></a> </td>
                                 
									<td class="center">
									<span class="label label-success"><?=$fetch_banner['status'];?></span></td>
								
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
                                 <!--<input type="submit" name="at_home" value="Set At Home Page" class="input btn btn-danger" />
                                <input type="submit" name="remove_from_home" value="Remove Home Page" class="input btn btn-danger" />-->
								<input type="submit" name="active" value="Acitve" class="input btn btn-danger" />
                              <input type="submit" name="inactive" value="Inactive" class="input btn btn-danger" />
                           <!-- <input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>-->
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
