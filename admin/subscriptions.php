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
								<h2><i class="icon-edit"></i>&nbsp;Add Subscription</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="subscription_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
								</table>
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg"></td></tr>
								</table>
								<table align="center" width="80%" >
									<tbody>
									<?php
									if($_GET['eid']!="")
									{
										$sql = "select * from tbl_subscription where id=".$_GET['eid'];
										$execute = mysql_query($sql);
										$row = mysql_fetch_assoc($execute);
										
									}	
									?>
										<tr>
											<td><label class="control-label" for="typeahead">Title: <span style="color:red;">*</span></label></td>
											<td><input name="title" class="span6 typeahead" id="title" value="<?php echo ($_GET['eid']!="")?$row['title']:"";?>" /></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Subscription Type: <span style="color:red;">*</span></label></td>
											<td><input name="type" class="span6 typeahead" id="type" value="<?php echo ($_GET['eid']!="")?$row['type']:"";?>" /></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Duration: <span style="color:red;">*</span></label></td>
											<td>
												<select name="duration" class="span6 typeahead" id="duration">
													<option value="1" <?php if($row['duration']!=""&&$row['duration']=='1'){?> selected="selected" <?php }?> >1 Month</option>
													<option value="3" <?php if($row['duration']!=""&&$row['duration']=='3'){?> selected="selected" <?php }?> >3 Months</option>
													<option value="6" <?php if($row['duration']!=""&&$row['duration']=='6'){?> selected="selected" <?php }?> >6 Months</option>
													<option value="12" <?php if($row['duration']!=""&&$row['duration']=='12'){?> selected="selected" <?php }?> >12 Months</option>
												</select>
											</td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Price: <span style="color:red;">*</span></label></td>
											<td><input name="price" class="span6 typeahead" id="price" value="<?php echo ($_GET['eid']!="")?$row['price']:"";?>" /></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">&nbsp;</label></td>
											<td>
											<?php if($_GET['eid']!=""){?>
													<input type="button" id="addNew" value="Save Changes" class="btn btn-primary" />
											<?php }else{?>
												<input type="button" id="addNew" value="Add Subscription" class="btn btn-primary" />
												<button class="btn" onclick="resetFields();">Reset</button>
											<?php }?>	
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
								<h2><i class="icon-edit"></i>&nbsp;Subscriptions </h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="listings">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg1"></td></tr>
								</table>
								<table align="center" width="80%" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<th>No.</th>
											<th>Title</th>
											<th>Subscription Type</th>
											<th>Duration (Months)</th>
											<th>Price (&pound;)</th>
											<th colspan="2">Actions</th>
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
											<td><?php echo number_format($subscription['price'],2);?></td>
											<td colspan="2">
												<a href="subscriptions.php?eid=<?php echo $subscription['id']; ?>" class="btn btn-info"><i class="icon-pencil" title="Edit"></i></a>  
												<a href="javascript:void(0);" onclick="deleteSubscription(<?php echo $subscription['id']; ?>);" class="btn btn-info"><i class="icon-trash" title="Trash"></i></a>  
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
 function resetFields()
 {
	window.location.href = 'subscriptions.php';
 }
 
 function deleteSubscription(id)
 {
	if(id!="")
	{
		$.ajax(
		{
				url: "manageSubscription.php", 
				type:"POST",
				data:{action:"Delete",id:id}
				,
				success: function(response){
					
				  
					$("#msg1").html(response);
					
					$('#msg1').animate({scrollTop : 0},800);
					   setTimeout(function(){// wait for 5 secs(2)
						   window.location.href = 'subscriptions.php';
					  }, 1000); 
					}
		});
	}	
 }
 
$(document).ready(function(){
		
  $('#addNew').click(function(){
	
		
	if ($('#title').val() == '') {
  		alert('Please enter subscription title.');
  	}
  	else if ($('#type').val() == '') {
  		alert('Please enter subscription type.');
  	}
	else if ($('#duration').val() == '') {
  		alert('Please enter duration');
  	}
	else if ($('#price').val() == '') {
  		alert('Please enter price');
  	}
  	else
  	{
        $.ajax(
		{
			url: "manageSubscription.php", 
			type:"POST",
			<?php if($_GET['eid']!=""){?>
			data:{title:$( "#title" ).val(),type:$('#type').val(),duration:$( "#duration" ).val(),price:$('#price').val(),action:"Edit",eid:<?php echo $_GET['eid'];?>}
			<?php }else{?>
			data:{title:$( "#title" ).val(),type:$('#type').val(),duration:$( "#duration" ).val(),price:$('#price').val(),action:"Add"}
			<?php }?>
			,
			success: function(response){
				
				$("#msg").html(response);
				$( "#msg" ).scrollTop( 300 );
				   setTimeout(function(){// wait for 5 secs(2)
					   window.location.href = 'subscriptions.php';
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
