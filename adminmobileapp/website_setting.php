<? include("header.php");


$query_per=mysql_query("select * from website_admin_setting");
$fetch_per= mysql_fetch_array($query_per);
 if(isset($_POST['update']))
 {   
 

         
		  $admin_title= trim($_REQUEST['admin_title']);
		  $site_base_url= trim($_REQUEST['site_base_url']);
		  $website_keywords= trim($_REQUEST['website_keywords']);
		  $website_title= trim($_REQUEST['website_title']);
		  $website_des= trim($_REQUEST['website_des']);
		  $name_owner= trim($_REQUEST['name_owner']);
   		  $email_of_owner= trim($_REQUEST['email_of_owner']);
		  
		  $twitterlink= trim($_REQUEST['twitterlink']);
		  $facebooklink= trim($_REQUEST['facebooklink']);
		  $gmaillink= trim($_REQUEST['gmaillink']);
		  
		  $phonenumber= trim($_REQUEST['phonenumber']);
		  
		  $headaddress= trim($_REQUEST['headaddress']);
		  $headpostal= trim($_REQUEST['headpostal']);
		  $headcity= trim($_REQUEST['headcity']);
		  
		  $branchaddress= trim($_REQUEST['branchaddress']);
		  $branchpostal= trim($_REQUEST['branchpostal']);
		  $branchcity= trim($_REQUEST['branchcity']);
		 
	     
				 
				$query =  mysql_query("update website_admin_setting set admin_title='".$admin_title."',site_base_url='".$site_base_url."',
				website_keywords='".$website_keywords."',website_title='".$website_title."',website_des='".$website_des."',name_owner='".$name_owner."',email_of_owner='".$email_of_owner."',twitterlink='".$twitterlink."',facebooklink='".$facebooklink."',gmaillink='".$gmaillink."',phonenumber='".$phonenumber."',headaddress='".$headaddress."',headpostal='".$headpostal."',headcity='".$headcity."',branchaddress='".$branchaddress."',branchpostal='".$branchpostal."',branchcity='".$branchcity."' WHERE id=1 ")or die(mysql_query());
		?><script>window.location.href='website_setting.php?msg=Updated';</script><?
     
	 }
 
?>
	<!-- topbar ends -->
			
        
    
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
						<h2><i class="icon-edit"></i>Website Setting</h2>
						<div align="right">
							
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="my_form" action="" method="post" onsubmit="return product_validation();">
						<table align="center" width="80%" >
                         <tr >
                        <td width="36%">&nbsp;</td>
                         <td width="62%">&nbsp;</td>
                         <td width="2%">&nbsp;</td>
                        
                        </tr>
                         
                        
						
                          <tr >
                        <td ><label class="control-label" for="typeahead">Admin Site Title</label></td>
                        <td><input type="text"  name="admin_title" id="admin_title"  size="40"value="<?=$fetch_per['admin_title']?>" /></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Site Base Url</label></td>
                        <td><input type="text"  name="site_base_url" id="site_base_url"  size="40"value="<?=$fetch_per['site_base_url']?>" /></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Website Keywords</label></td>
                        <td><input type="text"  name="website_keywords" id="website_keywords"  size="40" value="<?=$fetch_per['website_keywords']?>"/></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Website Title</label></td>
                        <td><input type="text"  name="website_title" id="website_title"  size="40" value="<?=$fetch_per['website_title']?>"/></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Website Description</label></td>
                        <td><input type="text"  name="website_des" id="website_des"  size="40" value="<?=$fetch_per['website_des']?>"/></td>
                         </tr>
                          <tr >
                        <td >Owner Name</td>
                        <td><input type="text"  name="name_owner" id="name_owner"  size="40" value="<?=$fetch_per['name_owner']?>"/></td>
                         </tr>
                
                          <tr >
                        <td >Owner Email Id</td>
                        <td><input type="text"  name="email_of_owner" id="email_of_owner"  size="30"value="<?=$fetch_per['email_of_owner']?>" /></td>
                         </tr>
                         
                         
                         
                         <!--Our Headquearter -->
                          <tr >
                        <td >Our Headquearter Address </td>
                        <td><input type="text"  name="headaddress" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['headaddress']?>" /></td>
                         </tr>
                         
                         <tr >
                        <td >Our Headquearter Postal Code </td>
                        <td><input type="number"  name="headpostal" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['headpostal']?>" /></td>
                         </tr>
                         
                         <tr >
                        <td >Our Headquearter City </td>
                        <td><input type="text"  name="headcity" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['headcity']?>" /></td>
                         </tr>
                         
                         <!--End Our Headquearter -->
                         
                         <!--Our Branch Office -->
                         
                          <tr >
                        <td >Our Branch Office Address </td>
                        <td><input type="text"  name="branchaddress" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['branchaddress']?>" /></td>
                         </tr>
                         
                         <tr >
                        <td >Our Branch  Postal Code </td>
                        <td><input type="number"  name="branchpostal" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['branchpostal']?>" /></td>
                         </tr>
                         
                         <tr >
                        <td >Our Branch City </td>
                        <td><input type="text"  name="branchcity" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['branchcity']?>" /></td>
                         </tr>
                         
                         <!--End Our Branch Office -->
                         
                         
                         
                         
                         <tr >
                        <td >Phone Number</td>
                        <td><input type="number"  name="phonenumber" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['phonenumber']?>" /></td>
                         </tr>
                          
                         
                         <tr >
                        <td >Twitter</td>
                        <td><input type="text"  name="twitterlink" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['twitterlink']?>" /></td>
                         </tr>
                         
                         <tr >
                        <td >Facebook</td>
                        <td><input type="text"  name="facebooklink" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['facebooklink']?>" /></td>
                         </tr>
                         
                         <tr >
                        <td >Gmail</td>
                        <td><input type="text"  name="gmaillink" id="emailAdd_sent_out"  size="30"value="<?=$fetch_per['gmaillink']?>" /></td>
                         </tr>
                        
                        
                        
                        
                      
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="update" value="Update Setting" class="btn btn-primary"  />
                      
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
