<? include("header.php");

$banner_query=mysql_query("select * from products where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
$_SESSION['productid'] = $_REQUEST['banner_id'];
$_SESSION['productimage1'] = $fetch_banner['product_image1'];
$_SESSION['productimage2'] = $fetch_banner['product_image2'];
$_SESSION['productimage3'] = $fetch_banner['product_image3'];
 if(isset($_REQUEST['add_new_banner']))
 {
	
	 $productname=mysql_real_escape_string(trim(addslashes($_REQUEST['productname'])));
	   $productdescription=mysql_real_escape_string(trim(addslashes($_REQUEST['productdescription'])));
	   $producttitle=mysql_real_escape_string(trim(addslashes($_REQUEST['producttitle'])));
	   $manufacturer=mysql_real_escape_string(trim(addslashes($_REQUEST['manufacturer'])));
	   $modelnumber=mysql_real_escape_string(trim(addslashes($_REQUEST['modelnumber'])));
	   $productcolor=mysql_real_escape_string(trim(addslashes($_REQUEST['productcolor'])));
	   $productoldprice=mysql_real_escape_string(trim(addslashes($_REQUEST['productoldprice'])));
	   $productnewprice=mysql_real_escape_string(trim(addslashes($_REQUEST['productnewprice'])));
	   $productimage1=md5(uniqid(rand(), true)).'.'.file_ext($_FILES['productimage1']['name']);
	   $productimage2=md5(uniqid(rand(), true)).'.'.file_ext($_FILES['productimage2']['name']);
	   $productimage3=md5(uniqid(rand(), true)).'.'.file_ext($_FILES['productimage3']['name']);
	   $dateofcreate = date("Y-m-d H:i:s");
	   $date = date("Y-m-d");
	   $time = date("H:i:s");
	   
	   if($_FILES['productimage1']['name'] != "")
	  {
       move_uploaded_file($_FILES["productimage1"]["tmp_name"],"images/productimages/".$productimage1);
	  }
	  if($_FILES['productimage2']['name'] != "")
	  {
       move_uploaded_file($_FILES["productimage2"]["tmp_name"],"images/productimages/".$productimage2);
	  }
	  if($_FILES['productimage3']['name'] != "")
	  {
       move_uploaded_file($_FILES["productimage3"]["tmp_name"],"images/productimages/".$productimage3);
	  }
	  
	  if($_FILES['productimage1']['name'] == "")
	  {
       $productimage1 = $_SESSION['productimage1'];
	  }
	  if($_FILES['productimage2']['name'] == "")
	  {
       $productimage2 = $_SESSION['productimage2'];
	  }
	  if($_FILES['productimage3']['name'] == "")
	  {
       $productimage3 = $_SESSION['productimage3'];
	  }
	   
     
       $succ= mysql_query("UPDATE  products set product_name='".$productname."',product_description='".$productdescription."',product_title='".$producttitle."',manufacturer='".$manufacturer."',model_number='".$modelnumber."',product_color='".$productcolor."',product_old_price='".$productoldprice."',product_new_price='".$productnewprice."',product_image1='".$productimage1."',product_image2='".$productimage2."',product_image3='".$productimage3."',date_of_product='".$dateofcreate."',date='".$date."',time='".$time."' WHERE id='".$_SESSION['productid']."' ") or die(mysql_error());	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Product is Successfully Updated";	
		   }
		   else
		 {
		   $_SESSION['msg']="Product is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="product.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?
	
 }
?>
	<!-- topbar ends -->
    <script>
	
	function banner_valid()
	{
		var category_name=document.getElementById('category_name').value;

          if(category_name=='')
		{
	  alert('Select Category Name');
	  document.getElementById('category_name').focus();
	  return false;
	  }
	 
	var company_name=document.getElementById('company_name').value;

	  if(company_name=='')
		{
	  alert('Select Company Name');
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
			
			<div id="content" class="span10">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Update Banner Content</h2>
						<div align="right">
							<a href="banner_content.php?t=true" class="btn btn-setting btn-round">Back To Banner Content</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
                        
                        
                        <tr >
                        <td ><label class="control-label" for="typeahead">Product Name*</label></td>
                    <td><input type="text" value="<?php echo $fetch_banner['product_name']; ?>" class="span6 typeahead"  name="productname" id="banner_image"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Product Description*</label></td>
                  <td><textarea  class="span6 typeahead"  name="productdescription" id="banner_image"  size="40" ><?php echo $fetch_banner['product_description']; ?></textarea></td>
                         </tr>
					 
					 
                      <tr >
                        <td ><label class="control-label" for="typeahead">Product Title*</label></td>
                        <td><select name="producttitle">
                        <option value="OUR SERVICES">OUR SERVICES</option>
                        <option value="OUR PRODUCTS">OUR PRODUCTS</option>
                        
                        </select></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Manufacturer Name*</label></td>
                        <td><input type="text" value="<?php echo $fetch_banner['manufacturer']; ?>" class="span6 typeahead"  name="manufacturer" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Model Number*</label></td>
                        <td><input type="text" value="<?php echo $fetch_banner['model_number']; ?>" class="span6 typeahead"  name="modelnumber" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product Color*</label></td>
                        <td><input type="text" value="<?php echo $fetch_banner['product_color']; ?>" class="span6 typeahead"  name="productcolor" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product Old Price*</label></td>
                        <td><input type="number" value="<?php echo $fetch_banner['product_old_price']; ?>" class="span6 typeahead"  name="productoldprice" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product New Price*</label></td>
                        <td><input type="number" value="<?php echo $fetch_banner['product_new_price']; ?>" class="span6 typeahead"  name="productnewprice" id="banner_image"  size="40" /></td>
                         </tr>
                         
                        
                        
					<!--Images-->
						
                        <tr >
                        <td ><label class="control-label" for="typeahead">Product  Image 1*</label></td>
						<td>
                         <?php if($fetch_banner['product_image1'] != ""){ ?>
                        <img width="300" height="300" src="images/productimages/<?=$fetch_banner['product_image1'];?>" ></img>
                        <?php }else{ ?>
                        <img width="300" height="300" src="images/productimages/defaultlogo.png" ></img>
                        
								<?php	} ?>
                        </td>
                        <td><input type="file" class="span6 typeahead"  name="productimage1" id="banner_image"  size="40" /></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Product  Image 2*</label></td>
		<td>
         <?php if($fetch_banner['product_image2'] != ""){ ?>
                        <img width="300" height="300" src="images/productimages/<?=$fetch_banner['product_image2'];?>" ></img>
                        <?php }else{ ?>
                        <img width="300" height="300" src="images/productimages/defaultlogo.png" ></img>
                        
								<?php	} ?>
        
        </td>
                        <td><input type="file" class="span6 typeahead"  name="productimage2" id="banner_image"  size="40" /></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Product  Image 3*</label></td>
						<td>
                        
                         <?php if($fetch_banner['product_image3'] != ""){ ?>
                        <img width="300" height="300" src="images/productimages/<?=$fetch_banner['product_image3'];?>" ></img>
                        <?php }else{ ?>
                        <img width="300" height="300" src="images/productimages/defaultlogo.png" ></img>
                        
								<?php	} ?>
                        
                        </td>
                        <td><input type="file" class="span6 typeahead"  name="productimage3" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         
                         <!--End Images-->
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_banner" value="Edit Image" class="btn btn-primary" onclick="return banner_valid()" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

					</div>
				</div>

			</div>
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
