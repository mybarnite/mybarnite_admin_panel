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
								<h2><i class="icon-edit"></i>&nbsp;Update Promotion</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="promotion_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg"></td></tr>
								</table>
								<table align="center" width="80%" >
									<?php 
									$id = (isset($_GET['bid']))?@$_GET['bid']:@$_GET['eid'];
									$sql = "SELECT p.*, case when eventId=0 THEN (SELECT Business_Name FROM bars_list WHERE id = p.barId) ELSE (SELECT event_name from tbl_events WHERE id = p.eventId) END as name from tbl_promotions as p where id =".$id ;
									$execute = mysql_query($sql);
									$promotion = mysql_fetch_assoc($execute);
								
									?>
									<tbody>
										<input type="hidden" name="action" id="action" value="Update"/>
										<input type="hidden" name="eid" id="eid" value="<?php echo $id;?>"/>
										
										<?php if(isset($_GET['bid'])){?>
										<tr id="barList">
											<td><label class="control-label" for="typeahead">Bar: <span style="color:red;">*</span></label></td>
											<td><input type="text" name="bar" id="bar" class="form-control" value="<?php echo $promotion['name'];?>" readonly ></td>
										</tr>
										<?php 
										}
										?>
										
										<?php if(isset($_GET['eid'])){?>
										<tr id="eventList">
											<td><label class="control-label" for="typeahead">Events: <span style="color:red;">*</span></label></td>
											<td><input type="text" name="event" id="event" class="form-control" value="<?php echo $promotion['name'];?>" readonly ></td>
										</tr>
										<?php }?>
										<tr>
											<td><label class="control-label" for="typeahead">Coupon code: <span style="color:red;">*</span></label></td>
											<td><input type="text" required name="code" id="code" class="form-control" value="<?php echo $promotion['couponcode'];?>" ><a href="javascript:void(0);" name="generate" id="generate" style="text-decoration:none;color:#2071a1;">Generate Coupon code</a></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Discount (%): <span style="color:red;">*</span></label></td>
											<td><input type="text" required name="discount" id="discount" class="form-control" value="<?php echo $promotion['discount'];?>" ></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Starts at: <span style="color:red;">*</span></label></td>
											<td><input type="date" required name="startsat" id="startsat" class="form-control" value="<?php echo $promotion['startsat'];?>"></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Ends at: <span style="color:red;">*</span></label></td>
											<td><input type="date" required name="endsat" id="endsat" class="form-control" value="<?php echo $promotion['endsat'];?>"></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Description: </label></td>
											<td><textarea name="description" id="description"><?php echo $promotion['description'];?></textarea></td>
										</tr>
										<tr>
											<td><label class="control-label" for="typeahead">&nbsp;</label></td>
											<td>
												<input type="button" id="save" value="Save Changes" class="btn btn-primary" />
												
											</td>
										</tr>
									</tbody>	
								</table>
							</div>
						</div><!--/span-->
					</div>
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">	
 <script>
 
 </script> 	
<?php include("footer.php");?>
		
</body>
</html>
<script>
	$('#save').click(function(){
	//alert('123');
		if ($('#code').val() == '') {
			
			$("#msg").html('Please fill all fields marked as (*).');
		}
		else if ($('#discount').val() == ''||$('#discount').val() == '0') {
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
					//console.log(response);
					$("#msg").html(response);
					$( "#msg" ).scrollTop( 300 );
					   setTimeout(function(){// wait for 5 secs(2)
						   window.location.href = 'promotions.php';
					  }, 3000); 
				}
			});
		}
	});
	
	$("#code").blur(function() 
	{
		var code = $("#code").val();
		checkCouponCode(code,"Update",<?php echo $id ;?>);
	});
	
	$("#generate").click(function(){
		var code = $("#code").val();
		generateCouponCode(code,"Update",<?php echo $id ;?>);
	});
	

</script>	