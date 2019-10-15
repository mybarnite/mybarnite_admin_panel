<?php 
include("header.php");

?>
	<!-- topbar ends -->
   
    	<!-- ajax script start -->
        <script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
        	<!-- ajax script ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<?php include("left.php");?><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
	<p>You need to have <a href="https://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>&nbsp;Register New Business</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr>
						<td align="center" style="color:#F00;">
							<strong>
							<?php 
								
								echo $_REQUEST['msg'];	
							?>
							</strong>
						</td>
					</tr>
					<tr><td align="center" style="color:#F00;" id="msg"></td></tr>
					
                    </table>
						 
						<table align="center" width="80%" >
						<tr >
                        <td ><label class="control-label" for="typeahead">Owner Name <span style="color:red;">*</span></label></td>
                        <td> 
                        <select name="owners" class="owners" style="width: 305px;">
                        <option value="0">Select</option>
							 <?php 
						include 'includes/conection.php';
						$status="select id,r_id,name from user_register where r_id = 1";
						$res = mysql_query($status);
						while($row = mysql_fetch_array($res))
						{

						?>
			<option value="<?php echo $row['id'];?>">
						  <?php echo $row['name'];?>
                    </option>
                    <?php }?>
                  </select> 
                  </td>
                         </tr>
                         <tbody id="getEmailID">
                         <tr >
                        <td ><label class="control-label" for="typeahead">Email <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="email" id="email"  size="40" /></td>
                         </tr>
                         
						<tr >
                        <td ><label class="control-label" for="typeahead">Contact No <span style="color:red;">*</span></label></td>
                        <td><input type="number" class="span6 typeahead"  name="contact" id="contact"  size="40" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Bar Name <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="Business_Name" id="Business_Name"  size="40" /></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Hall <span style="color:red;">*</span></label></td>
                        <td>
							<select name="is_hall_available" id="is_hall_available" class="form-control" style="width: 305px;">
								<option value="0">Not available</option>
								<option value="1">Available</option>
								
							</select>
						</td>
                         
						 <tr id="hallCapacity">
                        <td ><label class="control-label" for="typeahead">Capacity of hall <span style="color:red;">*</span></label></td>
                        <td><input type="number" class="span6 typeahead"  name="hall_capacity" id="hall_capacity"  size="40" /> (Ex.150 people)</td>
                         </tr>
						 
						 </tr>
                         <tr id="hallFee">
                        <td ><label class="control-label" for="typeahead">Hall Fee (&#163;) <span style="color:red;">*</span></label></td>
                        <td><input type="number" class="span6 typeahead"  name="hall_fee" id="hall_fee"  size="40" /></td>
                         </tr>
						 
						  <tr >
                        <td ><label class="control-label" for="typeahead">Available seat <span style="color:red;">*</span></label></td>
                        <td><input type="number" class="span6 typeahead"  name="noofbasicseat" id="noofbasicseat"  size="40" /></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Cost per seat (&#163;) <span style="color:red;">*</span></label></td>
                        <td><input type="number" class="span6 typeahead"  name="cost_per_seat" id="cost_per_seat"  size="40" /></td>
                         </tr>
                        
                         <tr >
                        <td ><label class="control-label" for="typeahead">Bar Details </label></td>
                        <td><textarea id="bardes" class="span6 typeahead"></textarea></td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Category <span style="color:red;">*</span></label></td>
                        <td>
							<select name="Category" id="Category" class="form-control" style="width: 305px;">
								<option value="Pub">Pub</option>
								<option value="Bars">Bars</option>
								<option value="Wine Bars">Wine Bars</option>
								<option value="Lounges">Lounges</option>
							</select>
						</td>
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead">Price Range </label></td>
                        <td><input type="text" class="span6 typeahead"  name="Price_Range" id="Price_Range"  size="40" /></td>
                         </tr>

                         <tr >
                        <td ><label class="control-label" for="typeahead">Established Year </label></td>
                        <td><input type="number" class="span6 typeahead"  name="Established_Year" id="Established_Year"  size="40" /></td>
                         </tr>

						 <tr >
                        <td ><label class="control-label" for="typeahead">Location <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="Location" id="Location"  size="40" /></td>
                         </tr>
						 
						 <tr >
                        <td ><label class="control-label" for="typeahead">Zipcode <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="Zipcode" id="Zipcode"  size="40" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="6"/></td>
                         </tr>
						  <tr >
                        <td ><label class="control-label" for="typeahead">Hours </label></td>
                        <td><input type="text" class="span6 typeahead"  name="Hours" id="Hours"  size="40" /></td>
                         </tr>
						<tr>
							<td><label class="control-label" for="typeahead">Pay as you go </label></td>
							<td>
								<input type="radio" name="is_payasyougo" id="is_payasyougo" style="margin-right: 10px;margin-left: 20px;" value="1" />Yes
								<input type="radio" name="is_payasyougo" id="is_payasyougo" style="margin-right: 10px;margin-left: 20px;" value="2" />No
							</td>
						</tr>
						<tr >
							<td><input type="hidden" class="span6 typeahead"  name="Latitude" id="Latitude"  size="40" value="" /></td>
                        </tr>

                         <tr >
                        <td><input type="hidden" class="span6 typeahead"  name="Longitude" id="Longitude"  size="40" value="" /></td>
                         </tr>
						 </tbody>
						
						<!-- End new field -->	
						 
						 
                       
                           <tr >
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="button" id="addBar" value="Add Bar Details" class="btn btn-primary" />
                      
							<button class="btn" onclick="resetFields();">Reset</button>

                         </tr>
                        </table>
						

					</div>
				</div><!--/span-->

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAutcu3_Kvobb1C_3x1Ka-iuNTNU5KfyXs"></script>
 <!--<script src="https://code.jquery.com/jquery-1.10.2.js"></script>-->
 <script type="text/javascript">
    function resetFields()
	 {
		window.location.href = 'addnewbar.php';
	 }
    $(document).ready(function(){
          $("input#Address").keypress (function(){
				//alert('Hello');
				if ($('#Address').val()!='') {
						
					GetLocationbyAddress();	
				}
      	

        
      });
      $("#Zipcode").keypress (function(){
      	//alert('intozip');
      	if ($('#Zipcode').val()!='') {
      		GetLocation();	
      	}
      	

        
      });
});

    	</script>
    <script type="text/javascript">
    <!--
        function GetLocation() {
          //alert('IntoLocatrion');
            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById("Zipcode").value;
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    //alert("Latitude: " + latitude + "\nLongitude: " + longitude);
                    $('#Latitude').val(latitude);
                    $('#Longitude').val(longitude);

                } else {
                    alert("Request failed.")
                }
            });
        };
        //-->
    </script>
    <script type="text/javascript">
    <!--
        function GetLocationbyAddress() {
            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById("Address").value;
            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                    //alert("Latitude: " + latitude + "\nLongitude: " + longitude);
                	$('#Latitude').val(latitude);
                    $('#Longitude').val(longitude);
                } else {
                    alert("Request failed.")
                }
            });
        };
        //-->
    </script>

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
	
 $( ".owners" ).change(function() {
 	var selectedownerID = $( ".owners option:selected" ).val();
		//alert(selectedownerID);
  $.ajax(
      {
        url: "fetchOwnerEmail.php", 
        type:"POST",
        data:{selectedownerID:selectedownerID}
        ,
        success: function(response){
          
		  console.log();
          $('#getEmailID').html(response);
         
          
      
        }
      });
});
  $('#addBar').click(function(){
	var hall_fee  ;
  	if ($( ".owners option:selected" ).val() == 0) {
  		alert('Please select the owner name.');
  	}
  	else if ($('#contact').val() == '') {
  		alert('Please enter contact number.');
  	}
  	else if ($('#Business_Name').val() == '') {
  		alert('Please enter bar name.');
  	}
  	else if ($('#Category').val() == '') {
  		alert('Please enter category.');
  	}
  	
  	else if ($('#Location').val() == '') {
  		alert('Please enter location.');
  	}
  	else if ($('#Zipcode').val() == '') {
  		alert('Please enter zipcode.');
  	}
  	
    else if ($('#is_hall_available').val() == '1') {
      if ($('#hall_fee').val() == '') {
		  alert('Please enter hall fee.');
		}
		if ($('#hall_capacity').val() == '') {
		  alert('Please enter capacity of hall.');
		}
    }
    else if ($('#noofbasicseat').val() == '') {
      alert('Please enter total available seats for basic.');
    }
    else if ($('#cost_per_seat').val() == '') {
      alert('Please enter cost per seat.');
    }

  	else
  	{
		var bardes = $('#bardes').val();
		var Hours = $('#Hours').val();
		var Price_Range = $('#Price_Range').val();
		var Established_Year = $('#Established_Year').val();
		if(bardes!="")
		{
			bardes = bardes;
		}	
		else{bardes="";}
		
		if(Hours!="")
		{
			Hours = Hours;
		}	
		else{Hours="";}
		
		if(Price_Range!="")
		{
			Price_Range = Price_Range;
		}	
		else{Price_Range="";}
		
		if(Established_Year!="")
		{
			Established_Year = Established_Year;
		}	
		else{Established_Year="";}
		
		if($('#is_hall_available').val()==0)
		{
			hall_fee = 0;
			hall_capacity = 0;
		}	
		else
		{
			hall_fee = $('#hall_fee').val();
			hall_capacity = $('#hall_capacity').val();
		}	
  		  $.ajax(
		  {
			url: "addBarDetils.php", 
			type:"POST",
			data:{selectedownerID:$( ".owners option:selected" ).val(),email:$('#email').val(),contact:$('#contact').val(),Business_Name:$('#Business_Name').val(),Category:$('#Category').val(),Price_Range:Price_Range,Established_Year:$('#Established_Year').val(),Location:$('#Location').val(),Zipcode:$('#Zipcode').val(),Hours:Hours,latitude:$('#Latitude').val(),longitude:$('#Longitude').val(),Owner_Name:$( ".owners option:selected" ).text(),is_hall_available:$('#is_hall_available').val(),hall_fee:$('#hall_fee').val(),hall_capacity:$('#hall_capacity').val(),noofbasicseat:$('#noofbasicseat').val(),cost_per_seat:$('#cost_per_seat').val(),bardes:bardes,Commission:$('#Commission').val()}
			,
			success: function(response){
				window.location.href = 'bar_lists.php?msg='+response;
			}
		  });
  	}
  });  
   $('#is_hall_available').on('change', function() {
      //alert("test");  
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
		<?php include("footer.php");?>
		
</body>
</html>
