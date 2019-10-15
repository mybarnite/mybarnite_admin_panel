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
								<h2><i class="icon-edit"></i>&nbsp;Manage Business Commision</h2>
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
									
										$sql = "select * from tbl_settings where id=1";
										$execute = mysql_query($sql);
										$row = mysql_fetch_assoc($execute);
										
										
									?>
										<tr>
											<td><label class="control-label" for="typeahead">Comission (%): <span style="color:red;">*</span></label></td>
											<td><input required type="number" name="comission" class="span6 typeahead" id="comission" value="<?php echo ($row['commision']!="")?$row['commision']:"";?>" /></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">Discount (%): <span style="color:red;">*</span></label></td>
											<td><input required type="number" name="discount" class="span6 typeahead" id="discount" value="<?php echo ($row['discount']!="")?$row['discount']:"";?>" /></td>
										</tr>
										
										<tr>
											<td><label class="control-label" for="typeahead">&nbsp;</label></td>
											<td>
											
												<input type="button" id="addNew" value="Save Changes" class="btn btn-primary" />
												<button class="btn" onclick="resetFields();">Reset</button>
											
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
<script>
function resetFields()
{
	window.location.href = 'settings.php';
}
 
$(document).ready(function(){
		
  $('#addNew').click(function(){
	if ($('#comission').val() == '') {
  		$("#msg").html("Comission field can not be empty.");return false;
  	}
  	else if ($('#discount').val() == '') {
  		$("#msg").html("Discount field can not be empty.");return false;
  	}
	else
  	{
        $.ajax({
			url: "manageSettings.php", 
			type:"POST",
			data:{comission:$( "#comission" ).val(),discount:$('#discount').val()},
			success: function(response)
			{
				$("#msg").html(response);
				$( "#msg" ).scrollTop( 300 );
				   setTimeout(function(){// wait for 5 secs(2)
					   window.location.href = 'settings.php';
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
