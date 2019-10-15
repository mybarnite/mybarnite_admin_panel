<?php 
	
	include("header.php");
	if(isset($_REQUEST['delete']))
	{
  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			$succ_del=mysql_query("delete from tbl_order_history where id='".$id."'");
		}
		if($succ_del)
		{
			$_SESSION['msg']="success";
		}
		else
		{
			$_SESSION['msg']="error";
		}
		?>
		   <script>window.location.href="order_history.php?msg=<?=$_SESSION['msg'];?>";</script>
		<?php
	}

?>

	<!-- topbar ends -->
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
				<!-- content starts -->
					<div class="row-fluid sortable">		
						<div class="box span12">
							
								<div class="box-header well" data-original-title>
										<h2><i class="icon-list"></i> Manage Order History</h2>
										<?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Barnite</span></a></li><?php
										}
										?>
						
								</div>
								<div class="box-content">
									<table align="center" width="100%" >
										<tr>
											<td align="center" style="color:#F00;" id="msg" ><strong>
												<?php 
													if($_SESSION['msg']=="success")
													{
														echo "Data has been deleted successfully.";
														unset($_SESSION['msg']);
													}
													if($_SESSION['msg']=="error")
													{
														echo "Error occured.";
														unset($_SESSION['msg']);
													}
												?>
											</strong></td>
										</tr>
										<tr>
											<td align="center" style="color:#F00;">&nbsp;</td>
										</tr>
									</table>

									<form action="" method="post" onSubmit="return validate()">
											<table class="table table-striped table-bordered bootstrap-datatable datatable">
												<thead>
													<tr>
														<th></th>
														<th></th>
														<th align="center">
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
														<th colspan="2">
															<label style="float: left;">Change Payment status :</label>
															<select name="paymenttype" id="paymenttype" onchange="changePaymentType();" style="width: 100px;margin-left: 10px;float: left;">
																<option value="select">Select</option>
																<option value="Pending">Pending</option>
																<option value="Done">Paid</option>
																<option value="Canceled">Canceled</option>
																<option value="Refunded">Refunded</option>
															</select>
														</th>
													</tr>
						
													<tr>
														<th width="100"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0;"/>Select All</th>
														<th>Order id</th>
														<th>Customer Id</th>
														<th>Bar Name</th>														
														<th>Event Name</th>
														<th>Owner Name</th>
														<th>User Name</th>
														<th>Total Amount (&pound;)</th>
														<th>Payment Status</th>
														<th colspan="2">Action</th>
														
													</tr>
													
													<tr>
														<th width="20" style="text-align:center;"><input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/></th>
														<th><input name="orderid" id="orderid" class="form-group" style="width:90px;border:1px solid #cccccc;border-radius:3px;height: 25px;" value=""/></th>
														<th><input name="cid" id="cid" class="form-group" style="width:90px;border:1px solid #cccccc;border-radius:3px;height: 25px;" value=""/></th>
														<th><input name="barname" id="barname" class="form-group" style="width:90px;border:1px solid #cccccc;border-radius:3px;height: 25px;" value=""/></th>
														<th><input name="eventname" id="eventname" class="form-group" value="" style="width:90px;border:1px solid #cccccc;border-radius:3px;height: 25px;" /></th>
														<th></th>
														<th><input name="orderedby" id="orderedby" class="form-group" style="width:90px;border:1px solid #cccccc;border-radius:3px;height: 25px;" value=""/></th>
														<th></th>
														<th>
															<select name="searchByPaymentStatus" class="searchByPaymentStatus" id="searchByPaymentStatus" style="width:100px;">
																<option value="All">All</option>
																<option value="Pending">Pending</option>
																<option value="Done">Paid</option>
																<option value="Canceled">Canceled</option>
																<option value="Refund Requested">Refund</option>
															</select>
														</th>
														<th colspan="2">
															<input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
															<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset" onClick="location.href='order_history.php'">
														</th>
													</tr>
												</thead>  
											
												<tbody id="target-content">
													<input type="hidden" id="totaluserCount" value=""/>
													<input type="hidden" id="userPage" value="1"/>
													<tr>	
														<td></td>
														<td></td>
														<td></td>
														<td align="center">
															<div class="text-center alluPage">
																<div class="btn-group">
																	<button type="button" class="btn btn-primary start"><b><<</b></button>
																	<button type="button" class="btn btn-primary left"><b><</b></button>
																	<button type="button" class="btn btn-primary right"><b>></b></button>
																	<button type="button" class="btn btn-primary end"><b>>></b></button>
																</div>
															</div>
														</td>
														<td></td>
														<td></td>
													</tr>
												</tbody>
											</table> 
									</form>          
								</div>
						</div><!--/span-->
					</div>
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>

<?php include("footer.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
function refundPaymentSkrill(orderid)
{	
 
			$.ajax({
				url : "<?php echo SITE_PATH;?>refundPaymentSkrill.php",
				type: "POST",
				data :{ orderid:orderid, user : "Admin"},
				
				success: function(result)
				{	
					/* alert(result)
					console.log(result);
					return false; */
					window.location="order_history.php";
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
				}
			});
		
}
function refundPayment(orderid)
{	
 
			$.ajax({
				url : "<?php echo SITE_PATH;?>refundPayment.php",
				type: "POST",
				data :{ orderid:orderid ,user : "Admin"},
				
				success: function(result)
				{	
					console.log(result);
					
					window.location="order_history.php";
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
				}
			});
		
}

function changePaymentType()
{
	var paymenttype = $("#paymenttype").val();
	var myCheckboxes = new Array();
	$("input:checked").each(function() {
	   myCheckboxes.push($(this).val());
	});
	$.ajax(
      {
        url: "ajax/changePaymentType.php", 
        type:"POST",
        data:{paymentType:paymenttype,orderids:myCheckboxes},
        success: function(response){
			$("#msg").html("Record has been modified successfully.");
			setTimeout(function(){
			   window.location.reload(1);
			}, 1000);
          
        }
       
      }
    );
	
}

/* function change_payment_status(id)
{
	$.ajax({
			url : "change_payment_status.php",
			type: "POST",
			data :{ id: id,payment_status:$("#payment_status_"+id+" option:selected").val()},
			
			success: function(result)
			{	
			
				//alert(result);
				//data - response from server
				//$(".img-list").html(result);
				window.location="order_history.php";
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
			}
		});
}	 */

function deleteOrder(id)
{
	$.ajax({
			url : "ajax/deleteOrder.php",
			type: "POST",
			data :{ id: id},
			
			success: function(result)
			{	
			
				
				//data - response from server
				$("#msg").html("Record is successfully deleted.");
				setTimeout(function(){
				   window.location.reload(1);
				}, 1000);
				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
			}
		});
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
        url: "orderList.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val(),payment_status:$("#searchByPaymentStatus").val(),eventname:$("#eventname").val(),barname:$("#barname").val(),cid:$("#cid").val(),orderedby:$("#orderedby").val(),orderid :$("#orderid").val()}
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
</script>
</body>
</html>
