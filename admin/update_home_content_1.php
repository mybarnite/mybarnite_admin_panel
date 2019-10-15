<? include("header.php");

$banner_query=mysql_query("select * from home_content_1 where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
 if(isset($_REQUEST['add_new_banner']))
 {
	
	 if($_FILES['banner_image']['name']!='')
	 {
	  $banner_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['banner_image']['name']);
       move_uploaded_file($_FILES["banner_image"]["tmp_name"],"images/maincontent/".$banner_image);
	   $heading=mysql_real_escape_string(trim(addslashes($_REQUEST['heading'])));
	   $message=mysql_real_escape_string(trim(addslashes($_REQUEST['message'])));
	   $heading1=mysql_real_escape_string(trim(addslashes($_REQUEST['heading1'])));
	   $message1=mysql_real_escape_string(trim(addslashes($_REQUEST['message1'])));
	   
	 $succ = mysql_query("update home_content_1 set  banner_image='".$banner_image."',`heading`='".$heading."',`message`='".$message."',`heading1`='".$heading1."',`message1`='".$message1."' where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	 
	 }
		if($_FILES['banner_image']['name']==''){
		
	    $heading=mysql_real_escape_string(trim(addslashes($_REQUEST['heading'])));
	   $message=mysql_real_escape_string(trim(addslashes($_REQUEST['message'])));
	   $heading1=mysql_real_escape_string(trim(addslashes($_REQUEST['heading1'])));
	   $message1=mysql_real_escape_string(trim(addslashes($_REQUEST['message1'])));
	   
	 $succ1 = mysql_query("update home_content_1 set  `heading`='".$heading."',`message`='".$message."',`heading1`='".$heading1."',`message1`='".$message1."' where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	 
		
		}
		
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Image is Successfully Updated";	
		   }
		   else
		 {
		 if($succ1){
		 
		 $_SESSION['msg']="Image is Updated";
		 }else{
		   $_SESSION['msg']="Image is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="home_content_1.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?php
	
 }
 ?><script>window.location.href="home_content_1.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
<?php }
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
						<h2><i class="icon-edit"></i>Update Image</h2>
						<div align="right">
							<a href="manage_contractorgallery.php?t=true" class="btn btn-setting btn-round">Back To Image List</a>
							
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
                        <td ><label class="control-label" for="typeahead"> Heading 1*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="heading" id="banner_image" value="<?php echo $fetch_banner['heading']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead"> Description 1*</label></td>
                        <td><textarea  class="span6 typeahead"  name="message" id="banner_image"  size="40" ><?php echo $fetch_banner['message']; ?></textarea></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Heading 2*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="heading1" id="banner_image" value="<?php echo $fetch_banner['heading1']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Description 2*</label></td>
                        <td><textarea  class="span6 typeahead"  name="message1" id="banner_image"  size="40" ><?php echo $fetch_banner['message1']; ?></textarea></td>
                         </tr>
						
						
						
						
						
						
						
						
                        <tr >
                        <td ><label class="control-label" for="typeahead">Gallery  Image*</label></td>
						<td><img width="300" height="300" src="images/maincontent/<?=$fetch_banner['banner_image'];?>" ></img></td>
                        <td><input type="file" class="span6 typeahead"  name="banner_image" id="banner_image"  size="40" /></td>
                         </tr>
                         
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
