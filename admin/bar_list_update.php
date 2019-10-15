<?php include("header.php");

$banner_query=mysql_query("SELECT bl.id as listid,ur.id,ur.name,ur.email,bl.Owner_id,bl.Business_Name,bl.Locality,bl.PhoneNo,bl.Hours,bl.Commission,bl.Discount,bl.is_payasyougo,bl.Price_Range,bl.Established_Year,bl.Category,bl.is_hall_available,bl.hall_capacity,bl.hall_fee,bl.cost_per_seat,bl.seat_for_basic,bl.description,bl.Longitude ,bl.Latitude ,bl.Location_Searched ,bl.Zipcode 
FROM bars_list as bl
LEFT JOIN user_register as ur
ON bl.Owner_id = ur.id where bl.id = '".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_assoc($banner_query);

 if(isset($_REQUEST['add_new_banner']))
 {
	
		$name = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['name']))));
		$email = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['email']))));
		//$password = isset($_POST['password']) ? $db->escapeString($_POST['password']) : "";
		$number = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['contact']))));
		$barname = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Business_Name'])))); 
		$category_searched  = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Category']))));
		$price_range = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Price_Range']))));
		$Established_Year = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Established_Year']))));
		$location = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Location']))));
		$Zipcode = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Zipcode']))));
		$opening_time = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Hours']))));
		$is_hall_available = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['is_hall_available']))));
		$hall_capacity = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['hall_capacity']))));
		$hall_fee = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['hall_fee']))));
		$noofbasicseat = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['noofbasicseat']))));
		$cost_per_seat = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['cost_per_seat']))));
		
		$description = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['description']))));
		$Commission = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Commission']))));
		$Discount  = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['Discount']))));
		$is_payasyougo  = (isset($_POST['is_payasyougo'])&&$_POST['is_payasyougo']==1)?"1":"";
		$val = getLnt($Zipcode);
		$Longitude = $val['lng'];
		$Latitude = $val['lat'];
		
						
		if(isset($Commission))
		{
			$succ1 = mysql_query('update bars_list set PhoneNo ="'.$number.'" ,Business_Name ="'.$barname.'" ,Category_Searched  ="'.$category_searched.'",is_hall_available ="'.$is_hall_available.'",hall_capacity="'.$hall_capacity.'" ,hall_fee ="'.$hall_fee.'",cost_per_seat ="'.$cost_per_seat.'" ,seat_for_basic ="'.$noofbasicseat.'" ,description  ="'.$description.'",Category ="'.$category_searched.'" ,Price_Range ="'.$price_range.'" ,Longitude ="'.$Longitude.'" ,Latitude  ="'.$Latitude.'",Established_Year  ="'.$Established_Year.'",Location_Searched ="'.$location.'",Zipcode  ="'.$Zipcode.'",Hours  ="'.$opening_time.'",Commission = "'.$Commission.'",is_payasyougo="1" where id="'.$_REQUEST["banner_id"].'"')or die(mysql_error());	 
		}	
		elseif(isset($Discount))
		{
			$succ1 = mysql_query('update bars_list set PhoneNo ="'.$number.'" ,Business_Name ="'.$barname.'" ,Category_Searched  ="'.$category_searched.'",is_hall_available ="'.$is_hall_available.'",hall_capacity="'.$hall_capacity.'" ,hall_fee ="'.$hall_fee.'",cost_per_seat ="'.$cost_per_seat.'" ,seat_for_basic ="'.$noofbasicseat.'" ,description  ="'.$description.'",Category ="'.$category_searched.'" ,Price_Range ="'.$price_range.'" ,Longitude ="'.$Longitude.'" ,Latitude  ="'.$Latitude.'",Established_Year  ="'.$Established_Year.'",Location_Searched ="'.$location.'",Zipcode  ="'.$Zipcode.'",Hours  ="'.$opening_time.'",Discount = "'.$Discount.'",is_payasyougo="2" where id="'.$_REQUEST["banner_id"].'"')or die(mysql_error());	 
		}
		elseif(isset($is_payasyougo))
		{
			$succ1 = mysql_query('update bars_list set PhoneNo ="'.$number.'" ,Business_Name ="'.$barname.'" ,Category_Searched  ="'.$category_searched.'",is_hall_available ="'.$is_hall_available.'",hall_capacity="'.$hall_capacity.'" ,hall_fee ="'.$hall_fee.'",cost_per_seat ="'.$cost_per_seat.'" ,seat_for_basic ="'.$noofbasicseat.'" ,description  ="'.$description.'",Category ="'.$category_searched.'" ,Price_Range ="'.$price_range.'" ,Longitude ="'.$Longitude.'" ,Latitude  ="'.$Latitude.'",Established_Year  ="'.$Established_Year.'",Location_Searched ="'.$location.'",Zipcode  ="'.$Zipcode.'",Hours  ="'.$opening_time.'",is_payasyougo="'.$is_payasyougo.'" where id="'.$_REQUEST["banner_id"].'"')or die(mysql_error());	 
		}
		else
		{
			$succ1 = mysql_query('update bars_list set PhoneNo ="'.$number.'" ,Business_Name ="'.$barname.'" ,Category_Searched  ="'.$category_searched.'",is_hall_available ="'.$is_hall_available.'",hall_capacity="'.$hall_capacity.'" ,hall_fee ="'.$hall_fee.'",cost_per_seat ="'.$cost_per_seat.'" ,seat_for_basic ="'.$noofbasicseat.'" ,description  ="'.$description.'",Category ="'.$category_searched.'" ,Price_Range ="'.$price_range.'" ,Longitude ="'.$Longitude.'" ,Latitude  ="'.$Latitude.'",Established_Year  ="'.$Established_Year.'",Location_Searched ="'.$location.'",Zipcode  ="'.$Zipcode.'",Hours  ="'.$opening_time.'",is_payasyougo="" where id="'.$_REQUEST["banner_id"].'"')or die(mysql_error());	 
		}	
		
		$succ2 = mysql_query("update user_register set  `name`='".$name."',`email`='".$email."' where id='".$_REQUEST['owner_id']."'")or die(mysql_error());	 
		
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
		  <script>window.location.href="bar_lists.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?php
	
		}
 ?><script>window.location.href="bar_lists.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
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
							<h2><i class="icon-edit"></i>Update Bar</h2>
							<?php/*<h2><i class="icon-edit"></i>Update Bar <a style="border: none;background: transparent;box-shadow: none; font-size:15px; text-shadow:0 -1px 1px rgba(0, 0, 0, 0.2);color:#000;padding-left: 0;" href="subscription_details.php?barid=<?php echo $_GET['banner_id']?>&ownerid=<?php echo $_GET['owner_id']?>" class="btn btn-setting btn-round">		|		Subscriptions</a></h2>*/?>
							<div align="right">
								<a href="subscription_details.php?barid=<?php echo $_GET['banner_id']?>&ownerid=<?php echo $_GET['owner_id']?>" class="btn btn-setting btn-round">Subscriptions</a>
								<a href="bar_lists.php?t=true" class="btn btn-setting btn-round">Back To Bar List</a>
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
										<td ><label class="control-label" for="typeahead">Owner Name <span style="color:red;">*</span></label></td>
										<td><input type="text" class="span6 typeahead" required name="name" id="name"  size="40" value="<?php echo $fetch_banner['name']; ?>" readonly/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Email <span style="color:red;">*</span></label></td>
										<td><input type="text" class="span6 typeahead"  name="email" id="email"  size="40" value="<?php echo $fetch_banner['email']; ?>" required  readonly/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Contact No <span style="color:red;">*</span></label></td>
										<td><input type="number" class="span6 typeahead" required name="contact" id="contact"  size="40" value="<?php echo $fetch_banner['PhoneNo']; ?>" readonly/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Bar Name <span style="color:red;">*</span></label></td>
										<td><input type="text" class="span6 typeahead" required name="Business_Name" id="Business_Name"  size="40" value="<?php echo $fetch_banner['Business_Name']; ?>"/></td>
									</tr>
									<tr >
										<td >
											<label class="control-label" for="typeahead">Hall <span style="color:red;">*</span></label>
										</td>
										<td>
											<select name="is_hall_available" id="is_hall_available" class="form-control" style="width: 305px;">
												<option value="0" <?php if($fetch_banner['is_hall_available']==0){?> selected="selected" <?php }?>>Not available</option>
												<option value="1" <?php if($fetch_banner['is_hall_available']==1){?> selected="selected" <?php }?>>Available</option>
											</select>
										</td>
									</tr>
									<tr id="hallCapacity">
										<td>
											<label class="control-label" for="typeahead">Capacity of hall <span style="color:red;">*</span></label>
										</td>
										<td>
											<input type="number" class="span6 typeahead"  name="hall_capacity" id="hall_capacity"  size="40" value="<?php echo $fetch_banner['hall_capacity'];?>" />(Ex.150 people)
										</td>
									</tr>
									<tr id="hallFee">
										<td>
											<label class="control-label" for="typeahead">Hall Fee (&#163;) <span style="color:red;">*</span></label>
										</td>
										<td>
											<input type="number" class="span6 typeahead"  name="hall_fee" id="hall_fee"  size="40" value="<?php echo $fetch_banner['hall_fee'];?>" />
										</td>
									</tr>
									<tr>
										<td>
											<label class="control-label" for="typeahead">Available seat <span style="color:red;">*</span></label>
										</td>
										<td>
											<input type="number" class="span6 typeahead"  name="noofbasicseat" id="noofbasicseat" value="<?php echo $fetch_banner['seat_for_basic'];?>"  size="40" />
										</td>
									</tr>
									<tr>
										<td>
											<label class="control-label" for="typeahead">Cost per seat (&#163;) <span style="color:red;">*</span></label>
										</td>
										<td>
											<input type="number" class="span6 typeahead"  name="cost_per_seat" id="cost_per_seat"  size="40" value="<?php echo $fetch_banner['cost_per_seat'];?>" />
										</td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Bar Details</label></td>
										<td><textarea id="bardes" name="description" class="span6 typeahead"><?php echo $fetch_banner['description'];?></textarea></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Category <span style="color:red;">*</span></label></td>
										<td>
											<select name="Category" id="Category" class="form-control" style="width: 305px;">
												<option value="Pub" <?php if($fetch_banner['Category']=='Pub'){ ?> selected="selected" <?php } ?>>Pub</option>
												<option value="Bars" <?php if($fetch_banner['Category']=='Bars'){?> selected="selected" <?php } ?>>Bars</option>
												<option value="Wine Bars" <?php if($fetch_banner['Category']=='Wine Bars'){?> selected="selected" <?php } ?>>Wine Bars</option>
												<option value="Lounges" <?php if($fetch_banner['Category']=='Lounges'){?> selected="selected" <?php } ?>>Lounges</option>
											</select>
										</td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Price Range </label></td>
										<td><input type="text" class="span6 typeahead"  name="Price_Range" id="Price_Range"  size="40" value="<?php echo $fetch_banner['Price_Range']; ?>"/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Established Year </label></td>
										<td><input type="text" class="span6 typeahead"  name="Established_Year" id="Established_Year"  size="40" value="<?php echo $fetch_banner['Established_Year']; ?>"/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Location <span style="color:red;">*</span></label></td>
										<td><input type="text" class="span6 typeahead" required name="Location" id="Location"  size="40" value="<?php echo $fetch_banner['Location_Searched']; ?>"/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Zipcode <span style="color:red;">*</span></label></td>
										<td><input type="text" class="span6 typeahead" required name="Zipcode" id="Zipcode"  size="40" value="<?php echo $fetch_banner['Zipcode']; ?>" maxlength="6"/></td>
									</tr>
									<tr >
										<td ><label class="control-label" for="typeahead">Hours </label></td>
										<td><input type="text" class="span6 typeahead"  name="Hours" id="Hours"  size="40" value="<?php echo $fetch_banner['Hours']; ?>"/></td>
									</tr>
									<tr>
										<?php if($fetch_banner['is_payasyougo']==2){?>
										<td>
											<label class="control-label" for="typeahead">Discount (in %)</label>
										</td>
										<td>
											<select class="span6 typeahead"  name="Discount" id="Discount">
												<option value="1" <?php if($fetch_banner['Discount']=='10'){ ?> selected="selected" <?php } ?>>10</option>
												<option value="2" <?php if($fetch_banner['Discount']=='20'){ ?> selected="selected" <?php } ?>>20</option>
												<option value="3" <?php if($fetch_banner['Discount']=='30'){ ?> selected="selected" <?php } ?>>30</option>
												<option value="4" <?php if($fetch_banner['Discount']=='40'){ ?> selected="selected" <?php } ?>>40</option>
												<option value="5" <?php if($fetch_banner['Discount']=='50'){ ?> selected="selected" <?php } ?>>50</option>
												<option value="6" <?php if($fetch_banner['Discount']=='60'){ ?> selected="selected" <?php } ?>>60</option>
												<option value="7" <?php if($fetch_banner['Discount']=='70'){ ?> selected="selected" <?php } ?>>70</option>
												<option value="8" <?php if($fetch_banner['Discount']=='80'){ ?> selected="selected" <?php } ?>>80</option>
												<option value="9" <?php if($fetch_banner['Discount']=='90'){ ?> selected="selected" <?php } ?>>90</option>
												<option value="10" <?php if($fetch_banner['Discount']=='100'){ ?> selected="selected" <?php } ?>>100</option>
											</select>
										</td>
										<?php }
										elseif($fetch_banner['is_payasyougo']==1)
										{
										?>
										<td>
											<label class="control-label" for="typeahead">Commission (in %)</label>
										</td>
										<td>
											<select class="span6 typeahead"  name="Commission" id="Commission">
												<option value="1" <?php if($fetch_banner['Commission']=='1'){ ?> selected="selected" <?php } ?>>1</option>
												<option value="2" <?php if($fetch_banner['Commission']=='2'){ ?> selected="selected" <?php } ?>>2</option>
												<option value="3" <?php if($fetch_banner['Commission']=='3'){ ?> selected="selected" <?php } ?>>3</option>
												<option value="4" <?php if($fetch_banner['Commission']=='4'){ ?> selected="selected" <?php } ?>>4</option>
												<option value="5" <?php if($fetch_banner['Commission']=='5'){ ?> selected="selected" <?php } ?>>5</option>
												<option value="6" <?php if($fetch_banner['Commission']=='6'){ ?> selected="selected" <?php } ?>>6</option>
												<option value="7" <?php if($fetch_banner['Commission']=='7'){ ?> selected="selected" <?php } ?>>7</option>
												<option value="8" <?php if($fetch_banner['Commission']=='8'){ ?> selected="selected" <?php } ?>>8</option>
												<option value="9" <?php if($fetch_banner['Commission']=='9'){ ?> selected="selected" <?php } ?>>9</option>
												<option value="10" <?php if($fetch_banner['Commission']=='10'){ ?> selected="selected" <?php } ?>>10</option>
											</select>
										</td>
										<?php 
										}
										else
										{
										?>	
										<tr>
											<td><label class="control-label" for="typeahead">Pay as you go </label></td>
											<td>
												<input type="radio" name="is_payasyougo" id="is_payasyougo" style="margin-right: 10px;margin-left: 20px;" value="1" />Yes
												<input type="radio" name="is_payasyougo" id="is_payasyougo" style="margin-right: 10px;margin-left: 20px;" value="2" />No
											</td>
										</tr>	
										<?php	
										}	
										?>
									</tr>
									<tr>
										<td><input type="hidden" class="span6 typeahead"  name="Latitude" id="Latitude"  size="40" value="" value="<?php echo $fetch_banner['Latitude']; ?>"/></td>
									</tr>
									<tr>
										<td><input type="hidden" class="span6 typeahead"  name="Longitude" id="Longitude"  size="40" value="" value="<?php echo $fetch_banner['Longitude']; ?>"/></td>
									</tr>
									<tr>
										<td ><label class="control-label" for="typeahead">&nbsp;</label></td>
										<td>
											<input type="submit" name="add_new_banner" value="Save Changes" class="btn btn-primary" onclick="return banner_valid()" />
											
										</td>
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
	<script>
	$(document).ready(function(){
		//alert($("#is_hall_available").val());
		if($("#is_hall_available").val()==1)
		{	
		   // alert('unchecked');
			$("#hallFee").css("display","table-row");
			$("#hallCapacity").css("display","table-row");
			
		}	
		else
		{	
			//alert('checked');
			$("#hallFee").css("display","none");
			$("#hallCapacity").css("display","none");
		}
		$('#is_hall_available').on('change', function() {
			if($(this).val()==1)
			{	
			   // alert('unchecked');
				$("#hallFee").css("display","table-row");
				$("#hallCapacity").css("display","table-row");
			}	
			else
			{	
				//alert('checked');
				$("#hallFee").css("display","none");
				$("#hallCapacity").css("display","none");	
			}	
		});
	});
	</script>		
</body>
</html>
