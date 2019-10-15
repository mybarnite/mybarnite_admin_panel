<? ob_start();
 include("header.php");
	include("pagination-script/pagination.class.php");
	if($_GET['flag']=='change' && $_GET['prdid']!='')
	{  
	   $qty=$_GET['qty'];
	   $prdId=$_GET['prdid'];
		mysql_query("update tbl_product set qty='".$qty."' where id='".$prdId."'");
	    header("location:manage_product.php");
		}
  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
	  $tmp_img_qury= mysql_query("select * from tbl_product where id='".$id."'")or die(mysql_error());
	$fetch_img_name=mysql_fetch_array($tmp_img_qury);
	
	$fetch_img_name['prod_image'];
	 $fetch_img_name['prod_image1'];
	 $fetch_img_name['prod_image2'];
    $file_to_delete="../product_images/".$fetch_img_name['prod_image'];
	$file_to_delete2="../product_images/".$fetch_img_name['prod_image1'];
    $file_to_delete3="../product_images/".$fetch_img_name['prod_image2'];
	unlink($file_to_delete) or die('error');
	unlink($file_to_delete2) or die('error');
	unlink($file_to_delete3) or die('error');
  $succ_del=mysql_query("delete from tbl_product where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected Product is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Product is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  
  if(isset($_REQUEST['product_hot']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_product set product_hot='Yes' where id='".$id."'");
   
    $_SESSION['msg']="Selected product is set as a hot product";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['remove_product_hot']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_product set product_hot='No' where id='".$id."'");
  $_SESSION['msg']="Selected product is remove from hot product";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['product_featured']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_product set product_featured='Yes' where id='".$id."'");
   
    $_SESSION['msg']="Selected product is set as a featured product";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['remove_product_featured']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_product set product_featured='No' where id='".$id."'");
  $_SESSION['msg']="Selected product is remove from featured product";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_product set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected Product is Activated";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_product set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected Product is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
?>

<link rel="stylesheet" type="text/css" href="pagination-script/pagination-css/pagination.css" />
   <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
        </script> 
  
                  
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
						<h2><i class="icon-list"></i>Product Management</h2>
						
                       
                        
                        
                      <div align="right">
						<a href="add_new_product.php" class="btn btn-setting btn-round">Add New Product</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%">
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                     <tr>
                       <td align="center" valign="middle" style="color:#F00;">
                      
                       <form action=""  name="search_form" method="post">
                       <input type="text" name="search" id="search" value="Search Product Name/SKU..."  onFocus="if(this.value=='Search Product Name/SKU...')this.value=''" onblur="if(this.value=='Search Product Name/SKU...')this.value=''"/>
                       
                       <input type="submit" value="Search" name="search_btn" id="search_btn" class="input btn btn-danger" onclick="search_newvalidation()" />
                       
                       <a href="">Show All</a>
						</form>
                        </td>
                     </tr>
                    </table>
                    <form action="" name="listing_form" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                   <th width="20">&nbsp;</th>
                                   <th width="12">&nbsp;</th>
								  <th width="130">Product Name</th>
                                    <th width="60">Product Type</th>
                                  <th width="190">Product Images</th>
								   <th width="120"><center> Product Categories</center></th>
                                   <!--th width="141">Stock Status</th-->
                                   <th width="126">New Price / Old Price</th>
                                   <!--<th width="59">Discount</th>-->
								  <th width="82">Status </th>
							  </tr>
						  </thead>   
						  <tbody>
                          <? 
						  
						  
						
						      $s_se = mysql_query("select * from tbl_product order by id desc");
							 $cnt_rec = mysql_num_rows($s_se);
							 $page_no = (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:1;
							 $start = ($page_no-1)*10;
						
							 //$query="SELECT * FROM tbl_product order by id desc limit $start,10";
							 $query="SELECT * FROM tbl_product ";
							 
							 if(isset($_REQUEST['search_btn'])){
							 
							 $query .="where  prod_name like'%$_REQUEST[search]%' or sku like '%$_REQUEST[search]%' ";
							 
							 }
							 $query .=" order by qty asc limit $start,10";
							 $result = mysql_query($query);
			
							 while($fetch_product=mysql_fetch_array($result))
							 {
							
							$query_cat1=mysql_query("select * from tbl_main_category where id='".$fetch_product['category_id']."'");
							$fetch_cat1=mysql_fetch_array($query_cat1);
							$query_cat2=mysql_query("select * from tbl_subcategory where id='".$fetch_product['subcategory_id']."'");
							$fetch_cat2=mysql_fetch_array($query_cat2);
							 
							  ?>
                               <script>
                                function showDiv<?=$fetch_product['id'];?>() {
									   document.getElementById('show<?=$fetch_product['id'];?>').style.display = "block";
									}
									 function hideDiv<?=$fetch_product['id'];?>() {
									   document.getElementById('show<?=$fetch_product['id'];?>').style.display = "none";
									}
                                </script>
							<tr>
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_product['id']; ?>" /></td>
                            <td> <a class="btn btn-info" href="update_product.php?prod_id=<?=$fetch_product['id']; ?>">
							<i class="icon-pencil" title="Edit"></i></a></td>
								<td class="center"><center><?=$fetch_product['prod_name'];?></center></td>
								<td class="center"></center><?=$fetch_product['sku'];?></center></td>
                     <td class="center"><center><img src="../product_images/<?=$fetch_product['prod_image'];?>" width="80" height="80"/> <img src="../product_images/<?=$fetch_product['prod_image1'];?>" width="80" height="80"/> <img src="../product_images/<?=$fetch_product['prod_image2'];?>" width="80" height="80"/></center></td>
                                 <td class="center"><?=$fetch_product['category_id'];?> </td>
                                 <!--td class="center">
                                 <p>
                                 <? if($fetch_product['qty']==0){?><strong style="color:#F00;">Out Of Stock</strong><? }else{ echo $fetch_product['qty']; ?> Products<? }?>
                                 <br />  <strong style="color:#333; cursor:pointer;" onclick="showDiv<?=$fetch_product['id'];?>()">Add Stock</strong></p>
                                    <p style="display:none;" id="show<?=$fetch_product['id'];?>"> 
                                      <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
                                        <option value="">Select quantity</option>
                                       <?
									   $stck=range(0,100);
									   foreach($stck as $v)
									   {
						?>
                       
                        <option value="?prdid=<?=$fetch_product['id'];?>&qty=<?=$v;?>&flag=change"><?=$v;?></option>
                        <? }?>
                                        
                                      </select>
                    <br /><strong style="color:#F00; cursor:pointer;" onclick="hideDiv<?=$fetch_product['id'];?>()">Cancel</strong></p>  </td -->
								
								
								<td ><center>
									$  <?=$fetch_product['price']; ?> / 
								   
									<s class="entry-discount">$  <?=$fetch_product['qty']; ?></s>
								   </center></td>
								   
								    
								<!--<td class="center">
									Rs.<?=$fetch_product['discount']; ?>
								   </td>-->
							   
                           
						  <td width="82" class="center ">
									<span class="label label-success"><?=$fetch_product['status'];?> </span></td>
								
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
