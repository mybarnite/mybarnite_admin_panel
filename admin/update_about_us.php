<? include("header.php");

$banner_query=mysql_query("select * FROM about_us where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
 if(isset($_REQUEST['add_new_banner']))
 {
	
	
	   $main_objectibe=mysql_real_escape_string(trim(addslashes($_REQUEST['main_objectibe'])));
	   $detail_main_objective=mysql_real_escape_string(trim(addslashes($_REQUEST['detail_main_objective'])));
	   $company_history=mysql_real_escape_string(trim(addslashes($_REQUEST['company_history'])));
	   $detail_company_history=mysql_real_escape_string(trim(addslashes($_REQUEST['detail_company_history'])));
	   
	 $succ = mysql_query("update about_us set  `main_objectibe`='".$main_objectibe."' , `detail_main_objective`='".$detail_main_objective."' , `company_history`='".$company_history."', `detail_company_history`='".$detail_company_history."' where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	 
	 
		
		
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Message is Successfully Updated";	
		   }
		   else
		 {
		 if($succ1){
		 
		 $_SESSION['msg']="Message is Updated";
		 }else{
		   $_SESSION['msg']="Message is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="update_about_us.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?php
	
 }
 ?><script>window.location.href="about_us.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
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
						<h2><i class="icon-edit"></i>Update About Us</h2>
						<div align="right">
							<a href="manage_contractorgallery.php?t=true" class="btn btn-setting btn-round">Back To Image List</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" >
						<table align="center" width="80%" >
                        
						
						 <tr >
                        <td ><label class="control-label" for="typeahead">Main Objectibe*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="main_objectibe" id="banner_image" value="<?php echo $fetch_banner['main_objectibe']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Detail Main Objective*</label></td>
                        <td><textarea  class="span6 typeahead"  name="detail_main_objective" id="banner_image"  size="40" ><?php echo $fetch_banner['detail_main_objective']; ?></textarea></td>
                         </tr>
                         
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Company History*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="company_history" id="banner_image" value="<?php echo $fetch_banner['company_history']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Detail Company History*</label></td>
                        <td><textarea  class="span6 typeahead"  name="detail_company_history" id="banner_image"  size="40" ><?php echo $fetch_banner['detail_company_history']; ?></textarea></td>
                         </tr>
						
						
						
						
						
						
						
						
                        <tr >
                        
                         </tr>
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_banner" value="Update" class="btn btn-primary" onclick="return banner_valid()" />
                      
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
