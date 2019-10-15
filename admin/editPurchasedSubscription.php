<?php 
include("header.php");

if(isset($_POST['update']))
{
	
	$active = ($_POST['paymentstatus']=="Done")?'Active':'Inactive';
	$sql = "UPDATE tbl_businessowner_subscription SET subscription_id= '".$_POST['subscription']."',payment_status= '".$_POST['paymentstatus']."', start_date='".$_POST['startdate']."', end_date = '".$_POST['enddate']."', is_active = '".$active."'  where id=".$_GET['eid'];	
	mysql_query($sql);
	$_SESSION['msg'] = '<div class="alert alert-success">Data has been updated successfully.</div>';
	$sql1 = "select * from tbl_businessowner_subscription where id=".$_GET['eid'];
	$execute = mysql_query($sql1);
	$getSubscription = mysql_fetch_assoc($execute);
	
	?>
	<script>
		setTimeout(function(){// wait for 5 secs(2)
			window.location.href = 'subscription_details.php?barid=<?php echo $getSubscription['bar_id'];?>&ownerid=<?php echo $getSubscription['owner_id'];?>';
		}, 1000); 
	</script>				  
	<?php
	//subscription_details.php?barid=186&ownerid=51
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
								<h2><i class="icon-edit"></i>&nbsp;Edit Subscription</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="subscription_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
								</table>
								<form name="purchasedSubscription" action="" method="post" id="purchasedSubscription">
									<table align="center" width="80%" >
										<tbody>
											<?php
											if($_GET['eid']!="")
											{
												$sql = "select * from tbl_businessowner_subscription where id=".$_GET['eid'];
												$execute = mysql_query($sql);
												$row = mysql_fetch_assoc($execute);
												
											}	
											?>
											<tr>
												<td><?php echo $_SESSION['msg']; unset($_SESSION['msg']);?></td>
											</tr>
											<tr>
												<td><label class="control-label" for="typeahead">Subscription:</label></td>
												<td>
												<?php
												$select = "select * from tbl_subscription";
												$execute1 = mysql_query($select);
												
												?>		
													<select name="subscription" class="span6 typeahead" id="subscription">
													<?php
													while($getSubscriptions = mysql_fetch_assoc($execute1))
													{	
													?>		
													<option value="<?php echo $getSubscriptions['id']?>" <?php if($getSubscriptions['id']==$row['subscription_id']){?> selected="selected"  <?php }?> ><?php echo $getSubscriptions['type']." - Duration (Months) : ".$getSubscriptions['duration'].",  Price : ".$getSubscriptions['price']?></option>
														
													<?php
													}
													?>
													</select>
												</td>
											</tr>
											
											<tr>
												<td><label class="control-label" for="typeahead">Start Date:</td>
												<td><input type="date" name="startdate" class="span6 typeahead" id="startdate" data-valuee="2014-08-08" value="<?php echo ($_GET['eid']!="")?$row['start_date']:"";?>" /></td>
											</tr>
											
											<tr>
												<td><label class="control-label" for="typeahead">End Date:</td>
												<td><input type="date" name="enddate" class="span6 typeahead" id="enddate" data-valuee="2014-08-08" value="<?php echo $row['end_date'];?>" /></td>
											</tr>
											
											
											<tr>
												<td><label class="control-label" for="typeahead">Payment Status:</label></td>
												<td>
													
													<select name="paymentstatus" class="span6 typeahead" id="paymentstatus">	
														<option value="Pending" <?php if($row['payment_status']=="Pending"){?> selected="selected" <?php }?> >Pending</option>
														<option value="Done" <?php if($row['payment_status']=="Done"){?> selected="selected" <?php }?> >Paid</option>
														<option value="Cancelled" <?php if($row['payment_status']=="Cancelled"){?> selected="selected" <?php }?> >Cancelled</option>
														<option value="Refunded" <?php if($row['payment_status']=="Cancelled"){?> selected="selected" <?php }?> >Refunded</option>
													</select>	
												</td>
											</tr>
											
											<tr>
												<td><label class="control-label" for="typeahead">&nbsp;</label></td>
												<td>
													<input type="submit" id="update" value="Update" name="update" class="btn btn-primary" />
													
												</td>
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
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 
		<?php include("footer.php");?>
		
</body>
</html>
