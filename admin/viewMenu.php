<?php 
include("header.php");
$barid=$_REQUEST['id'];
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
								<h2><i class="icon-edit"></i>&nbsp;Menu </h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="listings">
								<?php 
								$q1 = "select * from  tbl_barfoodmenu_uploads where bar_id = ".$barid;
								$exe1 = mysql_query($q1);
								$count = mysql_num_rows($exe1);
								?>	
								<div class="container" id="gallery">
								<?php
									if($count>0)
									{	
										while($row = mysql_fetch_assoc($exe1))
										{
											
											$formats = array("jpg", "png", "gif");
											$file_path = "business_owner/".$row['file_path'];
											$ext = pathinfo($row['file_name'], PATHINFO_EXTENSION);
											if(!in_array($ext,$formats)) 
											{
												$file_path = "business_owner/foodmenu_uploads/PDF-icon.png";
											}
											else
											{
												$file_path = "business_owner/".$row['file_path'];
											}	
											
											
										?>
											<figure class="threecol first gallery-item box">
												<img src="<?php echo SITE_PATH.$file_path;?>" height="300" width="300">
												<figcaption class="img-title">
													<h5>
														<a href="<?php echo SITE_PATH."business_owner/".$row['file_path'];?>" target="_blank">VIEW |</a>  <a href="javascript:void(0);" onclick="delete_image(<?php echo $row['id'];?>);">DELETE</a>
													</h5>  
												</figcaption>
											</figure>
										
										
										<?php
											
										}
									}
									else
									{
									?>	
										<div class='alert alert-danger'>Records not found.</div>
									<?php	
									}		
									?>
								</div>
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
function delete_image(id)
{		
		$.ajax({
			url : "manageMenu.php",
			type: "POST",
			data :{ img_id: id, bar_id : <?php echo $barid;?> },
			
			success: function(result)
			{	
				window.location="viewMenu.php?id=<?php echo $barid;?>";
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
			}
		});
}
</script>
<?php include("footer.php");?>
		
</body>
</html>
