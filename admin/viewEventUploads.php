<?php 
include("header.php");
$eventId = $_REQUEST['id'];
if(isset($_REQUEST['delete']))
	{
  
		$chk=$_REQUEST['chk'];
		
		foreach($chk as $id)
		{
			$succ_del=mysql_query("delete from tbl_event_gallery where id='".$id."'");
		}
		if($succ_del)
		{
			$_SESSION['publishmsg']="<div class='alert alert-success'>Data has been deleted successfully!</div>";
		}
		else
		{
			$_SESSION['publishmsg']="<div class='alert alert-danger'>Some data can not be deleted!</div>";
		}
		?>
		   <script>window.location.href="viewEventUploads.php?id=<?php echo $eventId;?>";</script>
		<?php
	}
  
	if(isset($_REQUEST['Publish']))
	{
	  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			  
			mysql_query("update tbl_event_gallery set is_published=1 where id=".$id);
			$res = mysql_affected_rows();
			
		}
		if($res>0)
		{
			$sql = "select bar_id from tbl_event_gallery where id=".$id." and event_id = ".$eventId;
			$exe = mysql_query($sql);
			$getBarId = mysql_fetch_assoc($exe);
			
			$sql1= "SELECT email FROM user_register AS u JOIN bars_list AS b ON u.id = b.Owner_id WHERE b.id = ".$getBarId['bar_id'];
			$exe1 = mysql_query($sql1);
			$getUserEmail = mysql_fetch_assoc($exe1);
			$email = $getUserEmail['email'];
			
			//$to1 = 'vidhi.scrumbees@gmail.com';
			$to1 = $email;
			$subject1 = 'Mybarnite - Publish event image ';
			$from1 = 'info@mybarnite.com';
			 
			// To send HTML mail, the Content-type header must be set
			$headers1  = 'MIME-Version: 1.0' . "\r\n";
			$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers1 .= 'From: '.$from1."\r\n".
				'Reply-To: '.$from1."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message1 = "<html>";
			$message1 .= "<head><title>Mybarnite</title></head>";
			$message1 .= "<body>";
			$message1 .= "Dear User,<br/><br/>";
			$message1 .= "Your event uploads have been published, review your event page for published images.<br/><br/>";
			$message1 .= "Thank you for joining our website.<br/><br/>";
			$message1 .= "Mybarnite Limited<br/>EMail: info@mybarnite.com<br/>URL: mybarnite.com<br/><img src='http://mybarnite.com/images/Picture1.png' width='110'>";
			$message1 .= "</body></html>";

			if(mail($to1, $subject1, $message1, $headers1))
			{
				$_SESSION['publishmsg']="<div class='alert alert-success'>Data has been modified successfully!</div>";	
			}	
			else
			{
				$_SESSION['publishmsg']="<div class='alert alert-success'>There is some issue while sending email!</div>";
			}	
		}	
	
	}
	  
	if(isset($_REQUEST['Hide']))
	{
	  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			mysql_query("update tbl_event_gallery set is_published=0 where id='".$id."'");
			$res = mysql_affected_rows();
		}
		if($res>0)
		{
			$sql = "select bar_id from tbl_event_gallery where id=".$id." and event_id = ".$eventId;
			$exe = mysql_query($sql);
			$getBarId = mysql_fetch_assoc($exe);
			
			$sql1= "SELECT email FROM user_register AS u JOIN bars_list AS b ON u.id = b.Owner_id WHERE b.id = ".$getBarId['bar_id'];
			$exe1 = mysql_query($sql1);
			$getUserEmail = mysql_fetch_assoc($exe1);
			$email = $getUserEmail['email'];
			
			//$to1 = 'vidhi.scrumbees@gmail.com';
			$to1 = $email;
			$subject1 = 'Mybarnite - Publish event image ';
			$from1 = 'info@mybarnite.com';
			 
			// To send HTML mail, the Content-type header must be set
			$headers1  = 'MIME-Version: 1.0' . "\r\n";
			$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers1 .= 'From: '.$from1."\r\n".
				'Reply-To: '.$from1."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message1 = "<html>";
			$message1 .= "<head><title>Mybarnite</title></head>";
			$message1 .= "<body>";
			$message1 .= "Dear User,<br/><br/>";
			$message1 .= "Your event uploads have been hide from displaying, review your event page for published images.<br/><br/>";
			$message1 .= "Thank you for joining our website.<br/><br/>";
			$message1 .= "Mybarnite Limited<br/>EMail: info@mybarnite.com<br/>URL: mybarnite.com<br/><img src='http://mybarnite.com/images/Picture1.png' width='110'>";
			$message1 .= "</body></html>";

			if(mail($to1, $subject1, $message1, $headers1))
			{
				 $_SESSION['publishmsg']="<div class='alert alert-success'>Data has been modified successfully!</div>";	
			}	
			else
			{
				$_SESSION['publishmsg']="<div class='alert alert-success'>There is some issue while sending email!</div>";
			}	
		}	
	
	}
	?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
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
								<h2><i class="icon-edit"></i>&nbsp;Event uploads </h2>
								<div align="right">
									<a href="event_list.php" class="btn btn-setting btn-round">Back To events</a>
								</div>
							</div>
							<div class="box-content" id="listings">
								<?php 
								$q1 = "select * from  tbl_event_gallery where event_id = ".$eventId;
								$exe1 = mysql_query($q1);
								$count = mysql_num_rows($exe1);
								?>	
								<form method="post">
								<?php
									if($count>0)
									{
								?>
									 <table align="center" width="100%" >
											<tr><td align="center" style="color:#F00;"><strong><?php
												
												if(isset($_SESSION['publishmsg']))
												{
												
													echo $_SESSION['publishmsg'];
													unset($_SESSION['publishmsg']);									
												}
												
												?></strong></td></tr>
									</table>
									<table class="table table-striped table-bordered bootstrap-datatable datatable">
										<tr>
											<td colspan="5">
												<input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()">
												<input type="submit" name="Publish" value="Publish" class="btn btn-danger"/>
												<input type="submit" name="Hide" value="Hide" class="btn btn-danger"/>
											</td>
										</tr>
										<tr>
											<th width="100" style="text-align:center"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0;"/>All</th>
											<th>Name</th>
											<th>logo Image</th>
											<th colspan="2">Action</th>
										</tr>	
										
								<?php	
										while($row = mysql_fetch_assoc($exe1))
										{
										?>	
										<tr>
											<td style="text-align:center"><input type="checkbox" name="chk[]" value="<?php echo $row['id']; ?>" /></td>
											<td><?php echo $row['file_name']?></td>
											<td>
											<?php if($row['logo_image']==1){?>
											<i class="fa fa-check fa-2x" aria-hidden="true" style="color:#32CD32"></i>
											<?php }else{
												echo "-";
											}
											?>
											</td>
											<td colspan="3">
												<a class="btn btn-info" href="<?php echo '../business_owner/'.$row['file_path']?>" target="_blank">View</a>
												<?php if($row['is_published']==0){?>
												<a class="btn btn-danger" href="javascript:void(0);" onclick="publishEventImage(<?php echo $row['id']?>,<?php echo $row['is_published']?>,<?php echo $eventId;?>)">Publish Image</a>
												<?php }else{?>
												<a class="btn btn-info published" href="javascript:void(0);" onclick="publishEventImage(<?php echo $row['id']?>,<?php echo $row['is_published']?>,<?php echo $eventId;?>)">Published</a>
												<?php }?>
												<?php if($row['logo_image']==1){?>
												<a class="btn btn-info" href="javascript:void(0);" onclick="event_logo_image(<?php echo $row['id']?>,<?php echo $row['logo_image']?>,<?php echo $eventId;?>)">Remove Logo</a>
												<?php }else{?>
												<a class="btn btn-info" href="javascript:void(0);" onclick="event_logo_image(<?php echo $row['id']?>,<?php echo $row['logo_image']?>,<?php echo $eventId;?>)">Make Logo</a>
												<?php }?>
												<a class="btn btn-info" href="javascript:void(0);" onclick="deleteEventImage(<?php echo $row['id']?>)"><i class="icon-trash" title="Trash"></i></a>
											</td>
											
										</tr>
										<?php	
										}
									?>
									</table>
									</form>
								</div>									
									<?
									}
									
									else
									{
									?>	
									<div class="container" id="gallery">	
										<div class='alert alert-danger'>Records not found.</div>
									
									</div>	
									<?php	
									}		
									?>
									
							</div>
						</div>
					</div>
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>			
<script type="text/javascript" src="../business_owner/js/uploader.js"></script>
<link type="text/css" href="../business_owner/css/uploader.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function()
{
	$('.gallery-item').hover( function() {
        $(this).find('.img-title').fadeIn(300);
    }, function() {
        $(this).find('.img-title').fadeOut(100);
    });
	
});
function deleteEventImage(id)
{		
		$.ajax({
			url : "deleteEventImage.php",
			type: "POST",
			data :{ id: id, eventId : <?php echo  $_GET['id'];?> },
			
			success: function(result)
			{	
				//alert(result);return false;
				window.location="viewEventUploads.php?id=<?php echo $_GET['id'];?>";
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
			}
		});
}

function event_logo_image(id,logo_image,event_id)
{
		//alert(id+" = "+logo_image);
		$.ajax({
			url : "<?php echo SITE_PATH;?>/business_owner/eventLogoImage.php",
			type: "POST",
			data :{ img_id: id,status:logo_image,event_id:event_id,user:"Admin"},
			
			success: function(result)
			{	
			
				//alert(result);
				//data - response from server
				//$("#image_container_"+event_id).html(result);
				window.location="viewEventUploads.php?id=<?php echo $_GET['id']?>";
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
			}
		}); 
}
function publishEventImage(id,is_published,event_id)
{
	$.ajax({
			url : "<?php echo SITE_PATH;?>/admin/ajax/publishImage.php",
			type: "POST",
			data :{ img_id: id,status:is_published,event_id:event_id,user:"Admin"},
			
			success: function(result)
			{	
					//console.log(result);
				
					window.location="viewEventUploads.php?id=<?php echo $_GET['id']?>";
				
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
			}
		}); 
}


</script>
<?php include("footer.php");?>
		
</body>
</html>
