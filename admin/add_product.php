<? include("header.php");



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
       $productimage1 = '';
	  }
	  if($_FILES['productimage2']['name'] == "")
	  {
       $productimage2 = '';
	  }
	  if($_FILES['productimage3']['name'] == "")
	  {
       $productimage3 = '';
	  }
	   
     
       $succ= mysql_query("INSERT INTO products VALUES('','".$productname."','".$productdescription."','".$producttitle."','".$manufacturer."','".$modelnumber."','".$productcolor."','".$productoldprice."','".$productnewprice."','".$productimage1."','".$productimage2."','".$productimage3."','".$dateofcreate."','".$date."','".$time."')") or die(mysql_error());	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Product is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Product is Not Added";	
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
		
	 var banner_image=document.getElementById('banner_image').value;

          if(banner_image=='')
		{
	  alert('Fill All Fields');
	  document.getElementById('banner_image').focus();
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
						<h2><i class="icon-edit"></i>Add New Product</h2>
						<div align="right">
							<a href="product.php?t=true" class="btn btn-setting btn-round">Back To Image List</a>
							
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
                    <td><input type="text" class="span6 typeahead"  name="productname" id="banner_image"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Product Description*</label></td>
                        <td><textarea  class="span6 typeahead"  name="productdescription" id="banner_image"  size="40" ></textarea></td>
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
                        <td><input type="text" class="span6 typeahead"  name="manufacturer" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Model Number*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="modelnumber" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product Color*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="productcolor" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product Old Price*</label></td>
                        <td><input type="number" class="span6 typeahead"  name="productoldprice" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product New Price*</label></td>
                        <td><input type="number" class="span6 typeahead"  name="productnewprice" id="banner_image"  size="40" /></td>
                         </tr>
					 
					 
                        <tr >
                        <td ><label class="control-label" for="typeahead">Product Image 1*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="productimage1" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product Image 2*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="productimage2" id="banner_image"  size="40" /></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product Image 3*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="productimage3" id="banner_image"  size="40" /></td>
                         </tr>
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_banner" value="Add Product" class="btn btn-primary" onclick="return banner_valid()" />
                      
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
