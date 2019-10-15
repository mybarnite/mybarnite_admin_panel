<? include("header.php");

$banner_query=mysql_query("select * from security where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
 if(isset($_REQUEST['add_new_banner']))
 {
	 
	   $security_message=mysql_real_escape_string(trim(addslashes($_REQUEST['security_message'])));
	   $privatekey_message=mysql_real_escape_string(trim(addslashes($_REQUEST['privatekey_message'])));
	   $encrypted_message=mysql_real_escape_string(trim(addslashes($_REQUEST['encrypted_message'])));
	   $dailyoff_message=mysql_real_escape_string(trim(addslashes($_REQUEST['dailyoff_message'])));
	   $harddrive_message=mysql_real_escape_string(trim(addslashes($_REQUEST['harddrive_message'])));
	   $mcafee_message=mysql_real_escape_string(trim(addslashes($_REQUEST['mcafee_message'])));
	   $ddos_message=mysql_real_escape_string(trim(addslashes($_REQUEST['ddos_message'])));
	   $revenue_message=mysql_real_escape_string(trim(addslashes($_REQUEST['revenue_message'])));
	   $securemember_message=mysql_real_escape_string(trim(addslashes($_REQUEST['securemember_message'])));
	   
	
	 if($_FILES['banner_image']['name']!='')
	 {
	  $banner_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['banner_image']['name']);
       move_uploaded_file($_FILES["banner_image"]["tmp_name"],"images/security/".$banner_image);
	   
	   
	 $succ = mysql_query("update security set  banner_image='".$banner_image."',`security_message`='".$security_message."' , `privatekey_message`='".$privatekey_message."', `encrypted_message`='".$encrypted_message."', `dailyoff_message`='".$dailyoff_message."', `harddrive_message`='".$harddrive_message."', `mcafee_message`='".$mcafee_message."', `ddos_message`='".$ddos_message."', `revenue_message`='".$revenue_message."', `securemember_message`='".$securemember_message."' where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	 
	 }
		if($_FILES['banner_image']['name']==''){
		
	   
	   
	 $succ = mysql_query("update security set  `security_message`='".$security_message."' , `privatekey_message`='".$privatekey_message."', `encrypted_message`='".$encrypted_message."', `dailyoff_message`='".$dailyoff_message."', `harddrive_message`='".$harddrive_message."', `mcafee_message`='".$mcafee_message."', `ddos_message`='".$ddos_message."', `revenue_message`='".$revenue_message."', `securemember_message`='".$securemember_message."' where id='".$_REQUEST['banner_id']."'")or die(mysql_error());	
		
		}
		
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Successfully Updated";	
		   }
		   else
		 {
		 if($succ1){
		 
		 $_SESSION['msg']=" Updated";
		 }else{
		   $_SESSION['msg']="Image is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="security.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?php
	
 }
 ?><script>window.location.href="security.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
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
                        <td ><label class="control-label" for="typeahead">Security*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="security_message" id="banner_image" value="<?php echo $fetch_banner['security_message']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">2048-Bit Private Key Encryption Comodo EV SSL*</label></td>
                        <td><textarea  class="span6 typeahead"  name="privatekey_message" id="banner_image"  size="40" ><?php echo $fetch_banner['privatekey_message']; ?></textarea></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">128-Bit Encrypted Connection*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="encrypted_message" id="banner_image" value="<?php echo $fetch_banner['encrypted_message']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">Daily Offsite Back-Ups*</label></td>
                        <td><textarea  class="span6 typeahead"  name="dailyoff_message" id="banner_image"  size="40" ><?php echo $fetch_banner['dailyoff_message']; ?></textarea></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Server Has 2 Processors & 2 Hard Drives*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="harddrive_message" id="banner_image" value="<?php echo $fetch_banner['harddrive_message']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">McAfee Secure*</label></td>
                        <td><textarea  class="span6 typeahead"  name="mcafee_message" id="banner_image"  size="40" ><?php echo $fetch_banner['mcafee_message']; ?></textarea></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">DDoS Protection*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="ddos_message" id="banner_image" value="<?php echo $fetch_banner['ddos_message']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					 <tr >
                        <td ><label class="control-label" for="typeahead">24 Hour Delay on Revenue Sharing*</label></td>
                        <td><textarea  class="span6 typeahead"  name="revenue_message" id="banner_image"  size="40" ><?php echo $fetch_banner['revenue_message']; ?></textarea></td>
                         </tr>
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Secure Member Account Support*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="securemember_message" id="banner_image" value="<?php echo $fetch_banner['securemember_message']; ?>"  size="40" /></td>
                         </tr>
					 
					 
					 
					
						
						
						
						
						
						
						
						
                        <tr >
                        <td ><label class="control-label" for="typeahead">Gallery  Image*</label></td>
						<td><img width="300" height="300" src="images/security/<?=$fetch_banner['banner_image'];?>" ></img></td>
                        <td><input type="file" class="span6 typeahead"  name="banner_image" id="banner_image"  size="40" /></td>
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
