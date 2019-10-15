<? include("header.php");
	include("pagination-script/pagination.class.php");
  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
	  $tmp_img_qury= mysql_query("select * from tbl_adver where id='".$id."'");
	$fetch_img_name=mysql_fetch_array($tmp_img_qury);
	$file_to_delete="product_images/".$fetch_img_name['image'];
	unlink($file_to_delete);
  $succ_del=mysql_query("delete from tbl_adver where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected Record is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Record is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_adver.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_adver set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected Record is Activated";
  }
  ?>
	   <script>window.location.href="manage_adver.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_adver set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected Record is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_adver.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
?>

<link rel="stylesheet" type="text/css" href="pagination-script/pagination-css/pagination.css" />
  
  
                  
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
			

				<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>Advertisement Management</h2>
						
                       
                        
                        
                      <div align="right">
						<a href="add_new_adver.php" class="btn btn-setting btn-round">Add New Advertisement</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%">
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    
                    </table>
                    <form action="" name="listing_form" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                   <th width="20">&nbsp;</th>
                                   <th width="12">&nbsp;</th>
								  
                                  <th width="199">Advertisement Image</th>
								   <th width="175">  Category</th>
                                   
								  <th width="82">Status </th>
							  </tr>
						  </thead>   
						  <tbody>
                          <? 
						  
						  
						
						      $s_se = mysql_query("select * from tbl_adver ");
							 $cnt_rec = mysql_num_rows($s_se);
							 $page_no = (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:1;
							 $start = ($page_no-1)*10;
						
							 //$query="SELECT * FROM tbl_product order by id desc limit $start,10";
							 $query="SELECT * FROM tbl_adver ";
							 
							
							 $query .=" order by id desc limit $start,10";
							 $result = mysql_query($query);
			
							 while($fetch_product=mysql_fetch_array($result))
							 {
							
							$query_cat1=mysql_query("select * from tbl_main_category where id='".$fetch_product['category_id']."'");
							$fetch_cat1=mysql_fetch_array($query_cat1);
							  ?>
							<tr>
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_product['id']; ?>" /></td>
                            <td> <a class="btn btn-info" href="add_new_adver.php?id=<?=$fetch_product['id']; ?>&flag=edit">
							<i class="icon-pencil" title="Edit"></i></a></td>
								
                     <td class="center"><img src="product_images/<?=$fetch_product['image'];?>" width="100" height="100"/></td>
                                 <td class="center"><?=$fetch_cat1['category_name'];?> </td>
                                
							   
                           
						  <td width="82" class="center">
									<?=$fetch_product['status'];?></td>
								
							    </tr>
                            <? }?>
							
							</tr>
						  </tbody>
					  </table> 
                      <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      
                      <tr>
                      	<td align="left">
                        <?php
								$p = new pagination;
								$p->Items($cnt_rec);
								$p->limit(10);
								$p->currentPage($page_no);
								$p->show();
                            ?>
                        </td>
                      </tr>
              <tr>
							
								<td  align="right">
								<input type="submit" name="active" value="Acitve" class="input btn btn-danger" />
                              <input type="submit" name="inactive" value="Inactive" class="input btn btn-danger" />
                            <input type="submit" name="delete" value="Delete" class="input btn btn-danger" />
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

		<? include("footer.php");?>
		
</body>
</html>
