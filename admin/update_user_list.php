<?php include("header.php");

$banner_query=mysql_query("select * from user_register where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
 if(isset($_REQUEST['add_new_banner']))
 {
	
	 
		
		
	   $name=mysql_real_escape_string(trim(addslashes($_REQUEST['name'])));
	   $email=mysql_real_escape_string(trim(addslashes($_REQUEST['email'])));
	   $contect = mysql_real_escape_string(trim(addslashes($_REQUEST['contect'])));
	   
	   
	 $succ1 = mysql_query("update user_register set  `name`='".$name."',`email`='".$email."',`contact`='".$contect."'  where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	 
		
		
		
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Image is Successfully Updated";	
		   }
		   else
		 {
		 if($succ1){
		 
		 $_SESSION['msg']="Record Updated";
		 }else{
		   $_SESSION['msg']="Record is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="user_list.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?php
	
 }
 ?><script>window.location.href="user_list.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
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
			<?php include("left.php");?><!--/span-->
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
						<h2><i class="icon-edit"></i>Update User record</h2>
						<div align="right">
							<a href="user_list.php?t=true" class="btn btn-setting btn-round">Back To User List</a>
							
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
                        <td ><label class="control-label" for="typeahead">Name*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="name" id="banner_image" value="<?php echo $fetch_banner['name']; ?>"  size="40" /></td>
                         </tr>
						 
						  <tr >
                        <td ><label class="control-label" for="typeahead">Email*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="email" id="banner_image" value="<?php echo $fetch_banner['email']; ?>"  size="40" /></td>
                         </tr>
						 
						  <tr >
                        <td ><label class="control-label" for="typeahead">Contect No*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="contect" id="banner_image" value="<?php echo $fetch_banner['contact']; ?>"  size="40" /></td>
                         </tr>
					 
						
						
						
                        
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_banner" value="Update Record" class="btn btn-primary" onclick="return banner_valid()" />
                      
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

		<?php include("footer.php");?>
		
</body>
</html>
