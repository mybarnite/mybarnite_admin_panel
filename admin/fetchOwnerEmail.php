<?php
include 'includes/conection.php';
$selectedownerID = $_POST['selectedownerID'];
$query = "select ur.id,ur.email,bl.* from user_register as ur left join bars_list as bl on ur.id = bl.Owner_id where ur.id=".$selectedownerID;
$rs_result = mysql_query($query); 
	while ($row = mysql_fetch_assoc($rs_result)) {
		
		if($row['Category']=='Pubs'){
			@$sel1 = "selected='selected'";
		}
		if($row['Category']=='Bars'){
			@$sel2 = "selected='selected'";
		}
		if($row['Category']=='Wine Bars'){
			@$sel3 = "selected='selected'";
		}
		if($row['Category']=='Lounges'){
			@$sel4 = "selected='selected'";
		}
		
		if($row['is_payasyougo']==1)
		{
			if(@$row['Commission']=='1')$sel5 = "selected='selected'";
			if(@$row['Commission']=='2')$sel6 = "selected='selected'";
			if(@$row['Commission']=='3')$sel7 = "selected='selected'";
			if(@$row['Commission']=='4')$sel8 = "selected='selected'";
			if(@$row['Commission']=='5')$sel9 = "selected='selected'";
			if(@$row['Commission']=='6')$sel10 = "selected='selected'";
			if(@$row['Commission']=='7')$sel11 = "selected='selected'";
			if(@$row['Commission']=='8')$sel12 = "selected='selected'";
			if(@$row['Commission']=='9')$sel13 = "selected='selected'";
			if(@$row['Commission']=='10')$sel14 = "selected='selected'";
		}
		elseif($row['is_payasyougo']==2)
		{
			if(@$row['Discount']=='10')$sel5 = "selected='selected'";
			if(@$row['Discount']=='20')$sel6 = "selected='selected'";
			if(@$row['Discount']=='30')$sel7 = "selected='selected'";
			if(@$row['Discount']=='40')$sel8 = "selected='selected'";
			if(@$row['Discount']=='50')$sel9 = "selected='selected'";
			if(@$row['Discount']=='60')$sel10 = "selected='selected'";
			if(@$row['Discount']=='70')$sel11 = "selected='selected'";
			if(@$row['Discount']=='80')$sel12 = "selected='selected'";
			if(@$row['Discount']=='90')$sel13 = "selected='selected'";
			if(@$row['Discount']=='100')$sel14 = "selected='selected'";
		}		
		
		if($row['is_hall_available']=='1'){
			@$is_hall_available1 = "selected='selected'";
		}
		else
		{
			@$is_hall_available2 = "selected='selected'";
		}	
		
		$content= 	'<tr >
                        <td ><label class="control-label" for="typeahead">Email <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="email" id="email"  size="40" value="'.$row['email'].'" disabled/></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Contact No <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="contact" id="contact"  size="40" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'.$row['PhoneNo'].'"/></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Bar Name <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="Business_Name" id="Business_Name"  size="40" value="'.$row['Business_Name'].'"/></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Hall <span style="color:red;">*</span></label></td>
                        <td>
							<select name="is_hall_available" id="is_hall_available" class="form-control" style="width: 315px;">
								<option value="0" '.@$is_hall_available2.'>Not available</option>
								<option value="1" '.@$is_hall_available1.'>Available</option>
								
							</select>
						</td>
                         </tr>
						 
						 <tr id="hallCapacity">
                        <td ><label class="control-label" for="typeahead">Capacity of hall <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="hall_capacity" id="hall_capacity"  size="40" value="'.$row['hall_capacity'].'"/>(Ex.150 people)</td>
                         </tr>
                         <tr id="hallFee">
                        <td ><label class="control-label" for="typeahead">Hall Fee (&#163;)<span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="hall_fee" id="hall_fee"  size="40" value="'.$row['hall_fee'].'"/></td>
                         </tr>
						  <tr >
                        <td ><label class="control-label" for="typeahead">Available seat <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="noofbasicseat" id="noofbasicseat"  size="40" value="'.$row['seat_for_basic'].'"/></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Cost per seat (&#163;) <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="cost_per_seat" id="cost_per_seat"  size="40" value="'.$row['cost_per_seat'].'"/></td>
                         </tr>
                        
                         <tr >
                        <td ><label class="control-label" for="typeahead">Bar Details </label></td>
                        <td><textarea id="bardes" class="span6 typeahead">'.$row['description'].'</textarea></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Category <span style="color:red;">*</span></label></td>
                        <td>
							<select name="Category" id="Category" class="form-control" style="width: 315px;">
								<option value="Pub" '.@$sel1.'>Pubs</option>
								<option value="Bars" '.@$sel2.'>Bars</option>
								<option value="Wine Bars" '.@$sel3.'>Wine Bars</option>
								<option value="Lounges" '.@$sel4.'>Lounges</option>
							</select>
						</td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Price Range </label></td>
                        <td><input type="text" class="span6 typeahead"  name="Price_Range" id="Price_Range"  size="40" value="'.$row['Price_Range'].'"/></td>
                         </tr>

                         <tr >
                        <td ><label class="control-label" for="typeahead">Established Year </label></td>
                        <td><input type="text" class="span6 typeahead"  name="Established_Year" id="Established_Year"  size="40" value="'.$row['Established_Year'].'"/></td>
                         </tr>

						 <tr >
                        <td ><label class="control-label" for="typeahead">Location <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="Location" id="Location"  size="40" value="'.$row['Locality'].'"/></td>
                         </tr>
						 
						 <tr >
                        <td ><label class="control-label" for="typeahead">Zipcode <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="Zipcode" id="Zipcode"  size="40" value="'.$row['Zipcode'].'"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6" /></td>
                         </tr>
						  <tr >
                        <td ><label class="control-label" for="typeahead">Hours </label></td>
                        <td><input type="text" class="span6 typeahead"  name="Hours" id="Hours"  size="40" value="'.$row['Hours'].'"/></td>
                         </tr>';
			if($row['is_payasyougo']==1)			 
			{
				$content.=	'<tr>
							<td><label class="control-label" for="typeahead">Commission (in %)</label></td>
							<td>
								<select class="span6 typeahead"  name="Commission" id="Commission">
									<option value="1" '.@$sel5.'>1</option>
									<option value="2" '.@$sel6.'>2</option>
									<option value="3" '.@$sel7.'>3</option>
									<option value="4" '.@$sel8.'>4</option>
									<option value="5" '.@$sel9.'>5</option>
									<option value="6" '.@$sel10.'>6</option>
									<option value="7" '.@$sel11.'>7</option>
									<option value="8" '.@$sel12.'>8</option>
									<option value="9" '.@$sel13.'>9</option>
									<option value="10" '.@$sel14.'>10</option>
								</select>
							</td>
                        </tr>';	
			}
			elseif($row['is_payasyougo']==2)			 
			{
				$content.=	'<tr>
							<td><label class="control-label" for="typeahead">Discount (in %)</label></td>
							<td>
								<select class="span6 typeahead"  name="Discount" id="Discount">
									<option value="10" '.@$sel5.'>10</option>
									<option value="20" '.@$sel6.'>20</option>
									<option value="30" '.@$sel7.'>30</option>
									<option value="40" '.@$sel8.'>40</option>
									<option value="50" '.@$sel9.'>50</option>
									<option value="60" '.@$sel10.'>60</option>
									<option value="70" '.@$sel11.'>70</option>
									<option value="80" '.@$sel12.'>80</option>
									<option value="90" '.@$sel13.'>90</option>
									<option value="100" '.@$sel14.'>100</option>
								</select>
							</td>
                        </tr>';	
			}			
			else			 
			{
				$content.=	'<tr>
								<td><label class="control-label" for="typeahead">Pay as you go </label></td>
								<td>
									<input type="radio" name="is_payasyougo" id="is_payasyougo" style="margin-right: 10px;margin-left: 20px;" value="1" />Yes
									<input type="radio" name="is_payasyougo" id="is_payasyougo" style="margin-right: 10px;margin-left: 20px;" value="2" />No
								</td>
							</tr>';	
			}
            $content.=	'<tr >
							<td><input type="hidden" class="span6 typeahead"  name="Latitude" id="Latitude"  size="40" value="'.$row['Latitude'].'"/></td>
                        </tr>
						<tr >
							<td><input type="hidden" class="span6 typeahead"  name="Longitude" id="Longitude"  size="40" value="'.$row['Longitude'].'"/></td>
                        </tr>';
	echo $content;					 
	}

	?>
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