<? include("header.php");




  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  $succ_del=mysql_query("delete from tbl_subcategory where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected SubCategory is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="SubCategory is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_subcategory.php?cat_id=<?=$_REQUEST['cat_id'];?>&msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_subcategory set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected SubCategory is Activated";
  }
  ?>
	   <script>window.location.href="manage_subcategory.php?cat_id=<?=$_REQUEST['cat_id'];?>&msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_subcategory set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected Category is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_subcategory.php?cat_id=<?=$_REQUEST['cat_id'];?>&msg=<?=$_SESSION['msg'];?>";</script>
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
						<h2><i class="icon-list"></i>SubCategory Management</h2>
						<div align="right">
                        <a href="add_new_subcategory.php?cat_id=<?=$_REQUEST['cat_id'];?>" class="btn btn-setting btn-round">Add New</a>
					    <a href="manage_elearning_cpd.php" class="btn btn-setting btn-round">Back</a>
								
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
                                   <th width="20">S no.</th>
                                   <th width="24">Edit</th>
								 <th width="157">SubCategory Name</th>
                                  <th width="156">Main Category</th>
                                  <th width="156">Clasified</th>
								   
                                  <!--<th width="156">Sub-Sub-Category</th><th width="182">Subsub Category(Third Layer)</th>-->
								  <th width="78">Status </th>
							  </tr>
						  </thead>   
						  <tbody>
                          <? 
						  $i=0;
						  $sel_cat_query= mysql_query("select * from tbl_elearning_cpd as c,tbl_subcategory as sc where c.id=sc.category_id and sc.category_id='".$_REQUEST['cat_id']."'");
						     while($fetch_category=mysql_fetch_array($sel_cat_query))
							 {
							$i++;
						  ?>
							<tr>
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_category['id']; ?>" /> <?=$i;?></td>
                            <td> <a class="btn btn-info" href="update_subcategory.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$fetch_category['id']; ?>">
							<i class="icon-pencil" title="Edit"></i></a></td>
								<td class="center"><?=$fetch_category['subcategory_name'];?></td>
                               
								<td class="center"><?=$fetch_category['category_name'];?></td>
                                
                                
                                <!--<td class="center">
                               <a class="btn btn-info" href="manage_subsubcategory.php?subcat_id=<?=$fetch_category['id']; ?>">Add/View Packages</a>
                               <!-- <?php
                                if($fetch_category['category_image']!='')
								{
								?>
                                <img src="product_images/<?=$fetch_category['category_image'];?>" width="100" height="100" />
                                <?
                                }
								else
								{
								?>
                                <img src="NO_IMAGE.jpg" width="100" height="100" />
                                <?
                                }
								?>                              
                                </td>-->
                                
                                <td align="center">
                                <p><a class="btn btn-info" href="manage_clasified.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$fetch_category['id']; ?>">Add /View Services</a></p>
                                <p> <a class="btn btn-info" href="add_more_images.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$fetch_category['id']; ?>">Add /View More Images</a></p>
                            <p>&nbsp;</p></td>
								<td class="center">
									<span class="label label-success"><?=$fetch_category['status'];?></span></td>
								
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
