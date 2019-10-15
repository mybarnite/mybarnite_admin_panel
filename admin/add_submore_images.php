<? include("header.php");

 if(isset($_REQUEST['add_new_product']))
 {   
 
     
	 
	  
	  if($_FILES['product_image1']['name']!='')
	  {
		  
	  $product_image1 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['product_image1']['name']);
       move_uploaded_file($_FILES["product_image1"]["tmp_name"],"product_images/".$product_image1);
		   mysql_query("insert into tbl_subcategory_images set product_image='".$product_image1."',subcategory_id='".$_REQUEST['subcatt_id']."'");
	   $_SESSION['msg']="Images are Successfully Added";
	  }
	  
		  
		   ?>
		  <script>window.location.href="add_submore_images.php?cat_id=<?php echo $_REQUEST['cat_id'] ?>&subcat_id=<?php echo $_REQUEST['subcat_id'] ?>&subcatt_id=<?php echo $_REQUEST['subcatt_id'] ?>&msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 
  if($_GET['flag']=='delete')
  {
     $id=$_GET['id'];
	$tmp_img_qury= mysql_query("select * from tbl_subcategory_images where id='".$id."'");
	$fetch_img_name=mysql_fetch_array($tmp_img_qury);
	$file_to_delete="product_images/".$fetch_img_name['product_image'];
	unlink($file_to_delete);
  $succ_del=mysql_query("delete from tbl_subcategory_images where id='".$id."'");
  
   if($succ_del)
  {
  $_SESSION['msg']="Image is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Image is not successfully deleted";
  }
  ?>
	   <script>window.location.href="add_submore_images.php?cat_id=<?php echo $_REQUEST['cat_id'] ?>&subcat_id=<?php echo $_REQUEST['subcat_id'] ?>&subcatt_id=<?php echo $_REQUEST['subcatt_id'] ?>&msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
?>
	<!-- topbar ends -->
    <script>
	
	function company_valid()
	{
		var company_name=document.getElementById('company_name').value;

          if(company_name=='')
		{
	  alert('Please Enter Company Name');
	  document.getElementById('company_name').focus();
	  return false;
	  }
	 
	return true;
	}
       
	</script>
    	<!-- ajax script start -->
      
        	<!-- ajax script ends -->
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
			
			<div id="content" class="span10" >
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
                
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Manage Subcategory Image</h2>
						<div align="right">
							<!--<a href="manage_product.php" class="btn btn-setting btn-round">Back To Product List</a>-->
							 <a href="manage_clasified.php?cat_id=<?php echo $_REQUEST['cat_id'] ?>&subcat_id=<?php echo $_REQUEST['subcat_id'] ?>" class="btn btn-setting btn-round">Back</a>
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="80%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_product" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="100%" >
                         <tr>
                        <td align="middle" colspan="2"><h2>You can add Sub Category Images</h2></td>
                       
                            </tr>
                             <tr>
                        <td align="middle" colspan="2">&nbsp;</td>
                       
                            </tr>
						 <tr>
                        <td align="middle"><label class="control-label" for="typeahead">Product other image</label></td>
                        <td><input type="file" class="span6 typeahead"  name="product_image1" /></td>
                            </tr>
                              <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>&nbsp;</td>
                         </tr>
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_product" value="Add Product Images" class="btn btn-primary" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

					</div>
				</div>

			</div>
				
			
			

		
			</div>
            <div id="content" class="span10" style="margin-left:225px;">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>ALL Images</h2>
						<div align="right">
							<!--<a href="manage_product.php" class="btn btn-setting btn-round">Back To Product List</a>-->
							
						</div>
					</div>
					<div class="box-content">
                   
                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  
						  </thead>   
						  <tbody>
                          <tr>
                          <?
						    $j=0;
						    $sel_query= mysql_query("select * from tbl_subcategory_images where subcategory_id='".$_REQUEST['subcatt_id']."'");
						    
							 while($fetch_product=mysql_fetch_array($sel_query))
							 {
								 $j++;
							
						  ?>
							
                            
                              <td align="center"><img src="product_images/<?=$fetch_product['product_image'];?>" width="100" height="100"/> <br />
                              <a href="add_submore_images.php?cat_id=<?=$_GET['cat_id']?>&subcat_id=<?=$_REQUEST['subcat_id'];?>&subcatt_id=<?=$_REQUEST['subcatt_id'];?>&id=<?php echo $fetch_product['id'];?> &flag=delete" onclick="return confirmSubmit()" style="text-decoration:none;"><strong  style="color:#F00;">Delete</strong></a>
                              </td>
                                  
                            <? if($j%6==0){ echo "</tr><tr>";} }?>
							
							</tr>
						  </tbody>
					  </table> 
                       
                      </form>    

					</div>
				</div>

			</div>
				
			
			

		
			</div>
            
            
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
