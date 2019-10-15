<?php 
include("header.php");
$barid = $_REQUEST['id'];
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
								<h2><i class="icon-edit"></i>&nbsp;Business documents </h2>
								<div align="right">
									<a href="newBusinessClaims.php" class="btn btn-setting btn-round">Back To Claims</a>
								</div>
							</div>
							<div class="box-content" id="listings">
								<?php 
								$q1 = "select * from  tbl_claimbusiness where bar_id = ".$barid;
								$exe1 = mysql_query($q1);
								$count = mysql_num_rows($exe1);
								?>	
								<div class="container" id="gallery">
									<table class="table table-striped table-bordered bootstrap-datatable datatable">
										<tr>
											<th>Name</th>
											<th colspan="2">Action</th>
											
										</tr>
								<?php
									if($count>0)
									{	
										while($row = mysql_fetch_assoc($exe1))
										{
										?>	
										<tr>
											<td><?php echo $row['file_name']?></td>
											<td colspan="2">
												<a class="btn btn-info" href="<?php echo '../business_owner/'.$row['path']?>" target="_blank">View</a>
												<a class="btn btn-info" href="javascript:void(0);" onclick="deleteClaimDocs(<?php echo $row['id']?>)"><i class="icon-trash" title="Trash"></i></a>
											</td>
											
										</tr>
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
									</table>
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
function deleteClaimDocs(id)
{		
		$.ajax({
			url : "deleteClaimDocs.php",
			type: "POST",
			data :{ claimId: id, bar_id : <?php echo  $_REQUEST['id'];?> },
			
			success: function(result)
			{	
				//alert(result);return false;
				window.location="viewBusinessDocuments.php?id=<?php echo $barid;?>";
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
