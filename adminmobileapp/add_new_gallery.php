<? include("header.php");

 if(isset($_REQUEST['add_new_banner']))
 {
	 
	  $banner_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['banner_image']['name']);
       move_uploaded_file($_FILES["banner_image"]["tmp_name"],"product_images/".$banner_image);
     
       $succ= mysql_query("insert into tbl_gallery set banner_image='".$banner_image."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Image is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Image is Not Added";	
		   }
		   ?>
		  <script>window.location.href="add_new_gallery.php?msg=<?=$_SESSION['msg'];?>"</script>
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
	  alert('Browse Banner To upload');
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
						<h2><i class="icon-edit"></i>Add New Image</h2>
						<div align="right">
							<a href="manage_gallery.php" class="btn btn-setting btn-round">Back To Image List</a>
							
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
                        <td ><label class="control-label" for="typeahead">Gallery Image*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="banner_image" id="banner_image"  size="40" /></td>
                         </tr>
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_banner" value="Add New Image" class="btn btn-primary" onclick="return banner_valid()" />
                      
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
