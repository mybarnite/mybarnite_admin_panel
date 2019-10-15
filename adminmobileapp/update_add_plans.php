<? include("header.php");

$banner_query=mysql_query("select * FROM add_plans where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
 if(isset($_REQUEST['add_new_banner']))
 {
	
	
	   $philosophy=mysql_real_escape_string(trim(addslashes($_REQUEST['philosophy'])));
	   $philosophy_message=mysql_real_escape_string(trim(addslashes($_REQUEST['philosophy_message'])));
	   $cash_link=mysql_real_escape_string(trim(addslashes($_REQUEST['cash_link'])));
	   $cash_link_message=mysql_real_escape_string(trim(addslashes($_REQUEST['cash_link_message'])));
	   $sharing=mysql_real_escape_string(trim(addslashes($_REQUEST['sharing'])));
	   $sharing_message=mysql_real_escape_string(trim(addslashes($_REQUEST['sharing_message'])));
	   $earn_traffic_exchange=mysql_real_escape_string(trim(addslashes($_REQUEST['earn_traffic_exchange'])));
	   $earn_traffic_exchange_message=mysql_real_escape_string(trim(addslashes($_REQUEST['earn_traffic_exchange_message'])));
	   $services=mysql_real_escape_string(trim(addslashes($_REQUEST['services'])));
	   $services_message=mysql_real_escape_string(trim(addslashes($_REQUEST['services_message'])));
	   
	 $succ = mysql_query("update add_plans set  `philosophy`='".$philosophy."' , `philosophy_message`='".$philosophy_message."' , `cash_link`='".$cash_link."', `cash_link_message`='".$cash_link_message."', `sharing`='". $sharing."', `sharing_message`='".$sharing_message."', `earn_traffic_exchange`='". $earn_traffic_exchange."', `earn_traffic_exchange_message`='".$earn_traffic_exchange_message."', `services`='".$services."', `services_message`='".$services_message."' where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	 
	 
		
		
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
		  <script>window.location.href="update_add_plans.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?php
	
 }
 ?><script>window.location.href="add_plans.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
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
                        <td ><label class="control-label" for="typeahead">Philosophy:*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="philosophy" id="banner_image" value="<?php echo $fetch_banner['philosophy']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Message Philosophy*</label></td>
                        <td><textarea  class="span6 typeahead"  name="philosophy_message" id="banner_image"  size="40" ><?php echo $fetch_banner['philosophy_message']; ?></textarea></td>
                         </tr>
                         
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Cash Links:*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="cash_link" id="banner_image" value="<?php echo $fetch_banner['cash_link']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Message Cash Links*</label></td>
                        <td><textarea  class="span6 typeahead"  name="cash_link_message" id="banner_image"  size="40" ><?php echo $fetch_banner['cash_link_message']; ?></textarea></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Sharing*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="sharing" id="banner_image" value="<?php echo $fetch_banner['sharing']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Message Sharing*</label></td>
                        <td><textarea  class="span6 typeahead"  name="sharing_message" id="banner_image"  size="40" ><?php echo $fetch_banner['sharing_message']; ?></textarea></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Earn Traffic Exchange Credits*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="earn_traffic_exchange" id="banner_image" value="<?php echo $fetch_banner['earn_traffic_exchange']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Message Earn Traffic Exchange Credits*</label></td>
                        <td><textarea  class="span6 typeahead"  name="earn_traffic_exchange_message" id="banner_image"  size="40" ><?php echo $fetch_banner['earn_traffic_exchange_message']; ?></textarea></td>
                         </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Services:</label></td>
                        <td><input type="text" class="span6 typeahead"  name="services" id="banner_image" value="<?php echo $fetch_banner['services']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Message Services*</label></td>
                        <td><textarea  class="span6 typeahead"  name="services_message" id="banner_image"  size="40" ><?php echo $fetch_banner['services_message']; ?></textarea></td>
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
