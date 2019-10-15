<?php 
include("header.php");
if(isset($_POST['buyNow']))
{
	
	$query = "select * from tbl_businessowner_subscription where bar_id=".$_GET['barid']." and owner_id=".$_GET['ownerid']."  order by id DESC";
	$execute = mysql_query($sql);
	$getrecord = mysql_fetch_assoc($execute);
	$countrows = count($getrecord);
	
	$insert = "insert into tbl_businessowner_subscription (owner_id,bar_id,subscription_id,duration,totalamount,dueamount,payment_status) values (".$_POST['ownerid'].",".$_POST['barid'].",".$_POST['subscriptionid'].",'".$_POST['duration']."','".$_POST['totalamount']."','".$_POST['totalamount']."','Pending')";	
	$exe = mysql_query($insert);
	$insertedrecord = mysql_fetch_assoc($exe);
	
	$lastInsertedId = $insertedrecord[0];
	
		
}	
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
								<h2><i class="icon-edit"></i>&nbsp;Buy Subscription</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="subscription_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
								</table>
								<table align="center" width="80%" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<th>No.</th>
											<th>Title</th>
											<th>Subscription Type</th>
											<th>Duration (Months)</th>
											<th>Price</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="target-content">
										<?php
										$sql = "select * from tbl_subscription";
										$execute = mysql_query($sql);
										$i=1;
										while($subscription = mysql_fetch_assoc($execute))
										{	
											
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $subscription['title'];?></td>
											<td><?php echo $subscription['type'];?></td>
											<td><?php echo $subscription['duration'];?></td>
											<td><?php echo $subscription['price'];?></td>
											<td>
											<form action="" method="post">
												<input type="hidden" name="ownerid" value="<?php echo $_GET['ownerid']?>">
												<input type="hidden" name="barid" value="<?php echo $_GET['barid']?>">
												<input type="hidden" name="subscriptionid" value="<?php echo $subscription['id']?>">
												<input type="hidden" name="duration" value="<?php echo $subscription['duration']?>">
												<input type="hidden" name="totalamount" value="<?php echo $subscription['price']?>">
												<input type="submit" name="buyNow" value="Buy Now!" class="btn btn-info" />	
											</form>
											</td>
										</tr>
										<?php
											$i++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div><!--/span-->
					</div>
					
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header well" data-original-title>
								<h2><i class="icon-edit"></i>&nbsp;Subscriptions </h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="listings">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg-refund"><?php echo $_SESSION['msg'];unset($_SESSION['msg']);?></td></tr>
								</table>
								<table align="center" width="80%" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th colspan="2">
												<label style="float: left;">Change Payment status :</label>
												<select name="paymenttype" id="paymenttype" onchange="changePaymentTypeofSubscription();" style="width: 100px;margin-left: 10px;float: left;">
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
											<th>No</th>
											<th>Subscription</th>
											<th>Duration (in months)</th>
											<th>Starting date</th>
											<th>Ending date</th>
											<th>Amount</th>
											<th>Payment</th>
											<th>Status</th>
											<th colspan="3"></th>
										</tr>
									</thead>
									<?php
									$sql = "select tbl_businessowner_subscription.*,tbl_subscription.title from  tbl_businessowner_subscription join tbl_subscription on tbl_subscription.id=tbl_businessowner_subscription.subscription_id where tbl_businessowner_subscription.bar_id=".$_GET['barid']." and tbl_businessowner_subscription.owner_id=".$_GET['ownerid']." order by id DESC";
									$execute = mysql_query($sql);
									
									?>
									<tbody id="target-content">
									<?php
									$i=1;	
									while($subscription = mysql_fetch_assoc($execute))
									{
										
											$today = time();
											
											$endofsubscription = strtotime($subscription['end_date']);
											$startofsubscription = strtotime($subscription['start_date']);
											if($subscription['end_date']!="0000-00-00"&&$subscription['start_date']!="0000-00-00")
											{	
												if($today>$endofsubscription)
												{
													$upadateStatus = "Update tbl_businessowner_subscription set payment_status = 'Expired' where id=".$subscription['id'];
													mysql_query($upadateStatus);
												}	
											}
											
									?>
										<tr>
											<td style="text-align:center;"><input type="checkbox" name="chk[]" value="<?=$subscription['id']; ?>" /></td>
											<td><?php echo $i;?></td>
											<td><?php echo $subscription['title'];?></td>
											<td><?php echo $subscription['duration'];?></td>
											<td><?php echo ($subscription['start_date']!="0000-00-00"&&$subscription['start_date']!="")?date('m/d/Y',strtotime($subscription['start_date'])):"-";?></td>
											<td><?php echo ($subscription['end_date']!="0000-00-00"&&$subscription['end_date']!="")?date('m/d/Y',strtotime($subscription['end_date'])):"-";?></td>
											<td><?php echo $subscription['totalamount'];?></td>
											
											<?php 
											if($subscription['end_date']!="0000-00-00"&&$subscription['start_date']!="0000-00-00")
											{
												if($today>$endofsubscription)
												{	
											?>	
													<td>Expired</td>
											<?php
												}	
												else
												{
											?>
													<td>
														<?php 
															if($subscription['payment_status']=="")
															{
																echo "Pending";
															}	
															elseif($subscription['payment_status']=="Done")
															{
																echo "Paid";
															}
															elseif($subscription['payment_status']=="Refund Requested")
															{
																echo "Refund Requested";
															}
															else
															{
																echo $subscription['payment_status'];
															}		
														?>
													</td>
											<?php	
													
												}
											}
											else{
												
											?>
											<td>
											<?php 
												if($subscription['payment_status']=="")
												{
													echo "Pending";
												}	
												elseif($subscription['payment_status']=="Done")
												{
													echo "Paid";
												}
												elseif($subscription['payment_status']=="Refund Requested")
												{
													echo "Refund Requested";
												}
												else
												{
													echo $subscription['payment_status'];
												}		
											?>
											</td>
											<?php }?>
											<?php
											if($subscription['payment_status']=="Pending")
											{
												echo "<td class='red'>Inactive</td>";
											}	
											elseif($today>$startofsubscription&&$today>$endofsubscription&&$subscription['payment_status']=="Done"){	
												echo "<td class='red'>Expired</td>";
											}
											elseif($today<$startofsubscription&&$today<$endofsubscription&&($subscription['payment_status']=="Done"||$subscription['payment_status']=="Refunded")){	
												echo "<td>Inactive</td>";
											}elseif($today>$startofsubscription&&$today<$endofsubscription&&$subscription['payment_status']=="Done"||$subscription['payment_status']=="Refunded"){
												echo "<td class='red'>Active</td>";
											}
											else{
												echo "<td>Inactive</td>";
											}
											?>
											<td>
												<a href="editPurchasedSubscription.php?eid=<?php echo $subscription['id'];?>" class="btn btn-info"><i class="icon-pencil" title="Edit"></i></a>
												<a href="javascript:void(0);" onclick="deleteSubscription(<?php echo $subscription['id']?>)" class="btn btn-info"><i class="icon-trash" title="Trash"></i></a>
												<?php if($subscription['payment_status']=="Done"||$subscription['payment_status']=="Refund Requested")
												{
															if($subscription['skrill_transaction']!=""&&$startofsubscription>0&&$today<$startofsubscription)
															{ //Skrill Refund
												?>
																<a href="javascript:void(0);" onclick="refundSubscription(<?php echo $subscription['id']?>,'1')" class="btn btn-danger">Make Refund</a>
												<?php 
															}
															if($subscription['skrill_transaction']==""&&$startofsubscription>0&&$today<$startofsubscription)
															{ //Barclays Refund
												?>				
																<a href="javascript:void(0);" onclick="refundSubscription(<?php echo $subscription['id']?>,'2')" class="btn btn-danger">Make Refund</a>
												<?php 
															}
															
												}?>
											</td>
										</tr>	
									<?php
										
									$i++;
									}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>

function refundSubscription(orderid,refundMethod)
{	
		
			$.ajax({
				url : "<?php echo SITE_PATH;?>refundSubscription.php",
				type: "POST",
				data :{ orderid:orderid,refundMethod:refundMethod},
				
				success: function(result)
				{	
					
					console.log(result);
					location.reload(1);
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
				}
			});
		
}
function changePaymentTypeofSubscription()
{
	var paymenttype = $("#paymenttype").val();
	var myCheckboxes = new Array();
	$("input:checked").each(function() {
	   myCheckboxes.push($(this).val());
	});
	$.ajax(
      {
        url: "ajax/changePaymentTypeofSubscription.php", 
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
 function deleteSubscription(id)
 {
	if(id!="")
	{
		$.ajax(
		{
				url: "manageSubscription.php", 
				type:"POST",
				data:{action:"DeleteOwnerSubscription",id:id}
				,
				success: function(response){
					
				  window.location.href = '<?php echo strlen($_SERVER['QUERY_STRING']) ? basename($_SERVER['PHP_SELF'])."?".$_SERVER['QUERY_STRING'] : basename($_SERVER['PHP_SELF']);?>';
				}
		});
	}	
 }

</script> 	
		<?php include("footer.php");?>
		
</body>
</html>
