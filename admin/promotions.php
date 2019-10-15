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
						<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
					</div>
				</noscript>
				
				<div id="content" class="span10">
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header well" data-original-title>
								<h2><i class="icon-edit"></i>&nbsp;Add Promotion</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="promotion_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg"></td></tr>
								</table>
								<table align="center" width="80%" >
									<tbody>
										<input type="hidden" name="action" id="action" value="Add"/>
										<tr>
											<td><label class="control-label" for="typeahead">Promotion: </label></td>
											<td>
												<input type="radio" required name="optradio" id="baroptradio" class="form-control" value="bar" checked style="width: 33px;vertical-align: top;height: 15px;"><span>Bar</span>
												<input type="radio" required name="optradio" id="eventoptradio" class="form-control" value="event" style="width: 33px;vertical-align: top;height: 15px;"><span>Event</span>
											</td>
										</tr>
										<tr class="hidden" id="barList">
											<td><label class="control-label" for="typeahead">Bar: <span style="color:red;">*</span></label></td>
											<td>
												<select name="bar" id="bar">
													<option value="0">Select</option>	
												<?php 
													$sql1 = "select Business_name, id from bars_list";
													$execute1 = mysql_query($sql1);
													while($bar = mysql_fetch_assoc($execute1))
													{
														if(isset($bar['Business_name'])&&$bar['Business_name']!="")
														{
												?>
														<option value="<?php echo $bar['id'];?>"><?php echo $bar['Business_name'];?></option>	
												<?php
														}
													}
												?>
												</select>
											</td>
										</tr>
										<tr class="hidden" id="eventList">
											<td><label class="control-label" for="typeahead">Events: <span style="color:red;">*</span></label></td>
											<td>
												<select name="event" id="event">
													<option value="0">Select</option>	
												<?php 
													$sql2 = "select event_name, id from tbl_events";
													$execute2 = mysql_query($sql2);
													while($event = mysql_fetch_assoc($execute2))
													{
														if(isset($event['event_name'])&&$event['event_name']!="")
														{	
												?>
															<option value="<?php echo $event['id'];?>"><?php echo $event['event_name'];?></option>	
												<?php
														}
													}
												?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Coupon code: <span style="color:red;">*</span></label></td>
											<td><input type="text" required name="code" id="code" class="form-control" value="" ><a href="javascript:void(0);" name="generate" id="generate" style="text-decoration:none;color:#2071a1;">Generate Coupon code</a></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Discount (%): <span style="color:red;">*</span></label></td>
											<td><input type="text" required name="discount" class="form-control" value="" ></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Starts at: <span style="color:red;">*</span></label></td>
											<td><input type="date" required name="startsat" id="startsat" class="form-control" value=""></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Ends at: <span style="color:red;">*</span></label></td>
											<td><input type="date" required name="endsat" id="endsat" class="form-control" value=""></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Description: </label></td>
											<td><textarea name="description" id="description"></textarea></td>
										</tr>
										<tr>
											<td><label class="control-label" for="typeahead">&nbsp;</label></td>
											<td>
												<input type="button" id="addNew" value="Add Promotion" class="btn btn-primary" />
												<button class="btn" onclick="resetFields();">Reset</button>
											</td>
										</tr>
									</tbody>	
								</table>
							</div>
						</div><!--/span-->
					</div>
					
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header well" data-original-title>
								<h2><i class="icon-edit"></i>&nbsp;Promotions </h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="listings">
								<table align="center" width="80%" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th colspan=2 align="center">
												<div class="text-center alluPage">
													<div class="btn-group">
														<button type="button" class="btn btn-primary start"><b><<</b></button>
														<button type="button" class="btn btn-primary left"><b><</b></button>
														<button type="button" class="btn btn-primary right"><b>></b></button>
														<button type="button" class="btn btn-primary end"><b>>></b></button>
													</div>
												</div>
											</th>
											<th></th>
											
											<th colspan="2"></th>
														
										</tr>
										<tr>
											
											<th>Title</th>
											<th>Owner Name</th>
											<th>Coupon Code</th>
											<th>Discount (%)</th>
											<th>Starts at</th>
											<th>Ends at</th>
											<th colspan="2">Actions</th>
										</tr>
									</thead>
									<tbody id="target-content">
										<input type="hidden" id="totaluserCount" value=""/>
										<input type="hidden" id="userPage" value="1"/>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">	
 <script>
 function resetFields()
 {
	window.location.href = 'promotionList.php';
 }
 
 
 $(document).ready(function(){
   getUserDetals();
  var limit = 15;


    $("#filteruser").click(function(){
    $("#userPage").val("1");
    getUserDetals();
    
  }
                        );


  $(".right").click(function(){
		
    var totalRecords =  $("#totaluserCount").val();
    var finalPage = Math.ceil(totalRecords/limit);
    //alert(finalPage);
    
    if(parseInt($("#userPage").val()) != finalPage ){
      var currentPageNo =  $("#userPage").val();
      $("#userPage").val(parseInt(currentPageNo)+1);
      getUserDetals();
      
    }
    
  });

    $(".left").click(function(){
    if($("#userPage").val() != 1){
      var currentPageNo =  $("#userPage").val();
      $("#userPage").val(parseInt(currentPageNo)-1);
      getUserDetals();
      
    }
    
  });


    $(".start").click(function(){
    if($("#userPage").val() != 1){
      $("#userPage").val(1);
      getUserDetals();
      enableDisPagination();
    }
  }
                   );
  
  $(".end").click(function(){
    
    var totalRecords =  $("#totaluserCount").val();
    var finalPage = Math.ceil(totalRecords/limit);
    
    if(parseInt($("#userPage").val()) != finalPage ){
      $("#userPage").val(finalPage);
      getUserDetals();
      enableDisPagination();
    }
});
      function getUserDetals(){
    //alert($("#CostPage").val());
    
    $.ajax(
      {
        url: "promotionList.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val()}
        ,
        success: function(response){
          //alert(response);
          $("#target-content").html(response);
                   if(parseInt($("#totaluserCount").val()) > limit){
            $(".alluPage").show();
          }
          else{
            $(".alluPage").hide();
          }
          
      
        }
      }
    );
  }
  function enableDisPagination(){
    if($("#userPage").val() != 1){
      $(".start").removeClass("disabled");
      $(".left").removeClass("disabled");
      
    }
    else{
      $(".start").addClass("disabled");
      $(".left").addClass("disabled");
      
    }
    
    var totalRecords =  $("#totaluserCount").val();
    var finalPage = Math.ceil(totalRecords/limit);
    
    if(finalPage == $("#userPage").val()){
      
      $(".right").addClass("disabled");
      $(".end").addClass("disabled");
    }
    else{
      
      $(".right").removeClass("disabled");
      $(".end").removeClass("disabled");
    }
  }
});
$(document).ready(function(){
		$("#barList").removeClass('hidden');
		$('input[type=radio][name=optradio]').change(function() {
			 
			if ($("#baroptradio").attr("checked")) {
				$("#barList").removeClass('hidden');
				$("#eventList").addClass('hidden');
			}
		   if ($("#eventoptradio").attr("checked")) {
				$("#barList").addClass('hidden');
				$("#eventList").removeClass('hidden');
			}
			
		});
		
		
		$("#code").blur(function() 
		{
			var code = $("#code").val();
			checkCouponCode(code,"Add");
		});

		$("#generate").click(function(){
			var code = $("#code").val();
			generateCouponCode(code,"Add");
		});
		
	
  $('#addNew').click(function(){
	
	if ($("#baroptradio").attr("checked")&&$('#bar').val() == '0') {
		$("#msg").html('Please fill all fields marked as (*).');
	}
	if ($("#eventoptradio").attr("checked")&&$('#event').val() == '0') {
		$("#msg").html('Please fill all fields marked as (*).');
	}
	else if ($('#code').val() == '') {
		
  		$("#msg").html('Please fill all fields marked as (*).');
  	}
	else if ($('#discount').val() == '') {
  		$("#msg").html('Please fill all fields marked as (*).');
  	}
	else if ($('#startsat').val() == '') {
  		$("#msg").html('Please fill all fields marked as (*).');
  	}
	else if ($('#endsat').val() == '') {
  		$("#msg").html('Please fill all fields marked as (*).');
  	}
  	else
  	{	var params = $("#promotion_container :input").serialize();

        $.ajax(
		{
			url: "managePromotions.php", 
			type:"POST",
			data:params,
			success: function(response){
				
				$("#msg").html(response);
				$( "#msg" ).scrollTop( 300 );
				   setTimeout(function(){// wait for 5 secs(2)
					   window.location.href = 'promotions.php';
				  }, 1000); 
			}
		});
  	}
  });  
   
});
</script> 	
		<?php include("footer.php");?>
		
</body>
</html>
