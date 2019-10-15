<?php include("header.php");?>
<?php 
$query = "SELECT Business_Name, Owner_id FROM bars_list where id = ".$_GET['id'];
$execute= mysql_query($query);
$getDetails=mysql_fetch_assoc($execute);
$bar_name = $getDetails['Business_Name'];
$owner_id =  $getDetails['Owner_id'];
/*  echo "<pre>";
print_r($getDetails);  */

$query1="select * from tbl_order_history where Owner_id=".$owner_id."  and payment_status='Pending'";
$execute1= mysql_query($query1);
$noOfPendingPayment = mysql_num_rows($execute1);

$query2="select * from tbl_order_history where Owner_id=".$owner_id."  and payment_status='Refund Requested'";
$execute2= mysql_query($query2);
$noOfRefundRequest = mysql_num_rows($execute2);

$query3="select * from tbl_events where bar_id=".$_GET['id']." and event_end>=CURDATE()";
$execute3= mysql_query($query3);
$noOfActiveEvents = mysql_num_rows($execute3);

?>

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
								<h2><i class="icon-list"></i> Account Detail</h2>
								 <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Barnite</span></a></li><?php
								}
								?>
							</div><!--/box-header well-->
							
							<div class="box-content">
								<table align="center" width="30%" >
									<tr>
										<th align="left" style="padding:9px 0px 9px 0px">Bar name	:</th>
										<td style="padding:9px 0px 9px 0px"><?php echo $getDetails['Business_Name'];?></td>
									</tr>
									<tr>
										<th align="left" style="padding:9px 0px 9px 0px">Active Events :</th>
										<td style="padding:9px 0px 9px 0px"><?php echo $noOfActiveEvents;?></td>
									</tr>
									<tr>
										<th align="left" style="padding:9px 0px 9px 0px">Pending Orders	:</th>
										<td style="padding:9px 0px 9px 0px"><?php echo $noOfPendingPayment;?></td>
									</tr>
									<tr>
										<th align="left" style="padding:9px 0px 9px 0px">Refund Requests :</th>
										<td style="padding:9px 0px 9px 0px"><?php echo $noOfRefundRequest;?></td>
									</tr>
									<tr>
										<td colspan="2" style="padding:9px 0px 9px 0px"><a class="btn btn-primary" href="deleteAccountRequest.php">Back</a></td>
									</tr>
								</table>
							</div><!--/box-content-->
						</div><!--/box span12-->
					</div><!--/row-fluid sortable-->
				</div><!--/content-->
				
			</div><!--/fluid-row-->
			<hr>
		<?php include("footer.php");?>
	</body>
</html>