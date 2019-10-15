<? include("header.php");

$baraddedstatus = "";

 if(isset($_REQUEST['add_bar']))
 {
	 $Location_Searched = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Location_Searched']))));
	 $Category_Searched = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Category_Searched']))));
	 $Source_Url = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Source_Url']))));
	 $Business_Name = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Business_Name']))));
	 $Address = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Address']))));
	 $Locality = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Locality']))));
	 $Region = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Region']))));
	 $Zipcode = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Zipcode']))));
	 $PhoneNo = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['PhoneNo']))));
	 $Website = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Website']))));
	 $Hours = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Hours']))));
	 $Price_Range = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Price_Range']))));
	 $Rating = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Rating']))));
	 $Reviews = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Reviews']))));
	 $Owner_Name = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Owner_Name']))));
	 
	 $Category = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Category']))));
	 $Longitude = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Longitude']))));
	 $Latitude = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Latitude']))));
	 $More_info = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['More_info']))));
	 $Established_Year = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Established_Year']))));
	 $Owner_Name_Link = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Owner_Name_Link']))));
	 $Last_Review_Date = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Last_Review_Date']))));
	 $Bizid = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Bizid']))));
	 $Yelp_advertiser_not = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Yelp_advertiser_not']))));
	 
	 $idget = mysql_query(" SELECT * FROM bars_list ORDER BY id DESC LIMIT 1 ") or die(mysql_error()) ;
	 $idgetrow = mysql_fetch_array($idget);
	 $newidb = $idgetrow['id'] + 1;
	 
	 $addbarquery = mysql_query(" INSERT INTO bars_list VALUES('".$newidb."','".$Location_Searched."','".$Category_Searched."','".$Source_Url."','".$Business_Name."','".$Category."','".$Address."','".$Locality."','".$Region."','".$Zipcode."','".$PhoneNo."','".$Website."','".$Hours."','".$Price_Range."','".$Longitude."','".$Latitude."','".$Rating."','".$Reviews."','".$More_info."','".$Established_Year."','".$Owner_Name."','".$Owner_Name_Link."','".$Last_Review_Date."','".$Bizid."','".$Yelp_advertiser_not."') ") or die(mysql_error()) ;
	 
	 $baraddedstatus = "Value";
 }
?>
	<!-- topbar ends -->
    <script>
	
	function admin_passwod_valid()
	{
		var admin_login_id=document.getElementById('admin_login_id').value;

          if(admin_login_id=='')
		{
	  alert('Please Enter User Login Id');
	  document.getElementById('admin_login_id').focus();
	  return false;
	  }
	  var new_pass=document.getElementById('new_pass').value;
	  if(new_pass=='')
		{
	  alert('Please Enter New Password');
	  document.getElementById('new_pass').focus();
	  return false;
	  }
	  var cnf_pass=document.getElementById('cnf_pass').value;
	  if(cnf_pass=='')
		{
	  alert('Please Enter Confirm Password');
	 document.getElementById('cnf_pass').focus();
	  return false;
	  }
	return true;
	}
			 function chk()
			 {
			 
				var new_pass1=document.getElementById('new_pass').value;
				 var cnf_pass1=document.getElementById('cnf_pass').value;
				 if(new_pass1!=cnf_pass1)
				 {
				  alert('Password is Not Matching');
				 
				  document.getElementById('cnf_pass').value="";
				   
				  return false;
				 }
				 return true
			 }
       
	</script>
    	<!-- ajax script start -->
        <script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
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
						<h2 style="color:#fff;"><i class="icon-edit"></i>&nbsp;Add New Bar</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                    </table>
						 <form name="add_new_deparment" action="" method="post">
						<table align="center" width="80%" >
                         <tr >
                        <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                        
                        </tr>
						<?php if($baraddedstatus != ""){ ?>
						<span style="color:green;">Bar is Added</span>
						<?php } ?>
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Location*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Location_Searched" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Category Searched*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Category_Searched" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Source Url*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Source_Url" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Bar Name*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Business_Name" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Address*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Address" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Locality*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Locality" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Region*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Region" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Zipcode*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Zipcode" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">PhoneNo*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="PhoneNo" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Website*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Website" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Hours*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Hours" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Price Range*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Price_Range" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Rating*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Rating" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Reviews*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Reviews" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Owner Name*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Owner_Name" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <!-- new field -->
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Category*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Category" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						  <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Longitude*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Longitude" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						  <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Latitude*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Latitude" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">More_info*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="More_info" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Established_Year*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Established_Year" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Owner_Name_Link*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Owner_Name_Link" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Last_Review_Date*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Last_Review_Date" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Bizid*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Bizid" id="admin_login_id"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td style="color:#fff;"><label class="control-label" for="typeahead">Yelp_advertiser/not*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="Yelp_advertiser_not" id="admin_login_id"  size="40" /></td>
                         </tr>
						
						<!-- End new field -->	
						 
						 
                       
                           <tr >
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_bar" value="Add Bar" class="btn btn-primary" onclick="return admin_passwod_valid()" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

					</div>
				</div><!--/span-->

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
