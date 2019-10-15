<?php 
include("header.php");
 
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
                 <!-- <script src="js/functionsforcheckall.js"></script> -->
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i> New claims for business</h2>
                        
						
					</div>
					<div class="box-content">
					
						<?php
						if($_REQUEST['msg']=="success")	
						{
							echo '<div class="alert alert-success">Claim has been accepted successfully!</div>';
						}	
						?>
						<form action="" method="post" onSubmit="return validate()">
							
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
								<tr>
									
									<td colspan="2">
										<input type="button" name="active" value="Accept" class="input btn btn-danger" onclick="activeClaims()"/> 
										<input type="button" name="active" value="Reject" class="input btn btn-danger" onclick="rejectClaims()"/> 
										<input type="button" name="active" value="Delete" class="input btn btn-danger" onclick="deleteClaims()"/> 
									</td>
									
								</tr>	
							</table> 
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
										<th colspan="2"></th>
										<th colspan="2"></th>
									</tr>
							
									<tr>
										<th width="100"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0 "/>Select All</th>
										<th width="100">Business name</th>
										<th>Owner name</th>
										<th>Email</th>
										<th colspan="2">Status</th>
										<th colspan="2">Action</th>
										
									</tr>
									<tr>
								    	<th width="20"></th>
										<th><input type="text" id="bname" class="form-group" style="width: 150px;" /></th>
										<th><input type="text" id="name" class="form-group"  style="width: 150px;" /></th>
										<th><input type="text" id="email" class="form-group" /></th>
										<th colspan="2">
											<select name="claim_status" id="claim_status" style="width:100px">
												<option value="">All</option>
												<option value="1">Pending</option>
												<option value="2">Accepted</option>
												<option value="3">Rejected</option>
											</select>
										</th>
										<th colspan="2">
											<input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
											<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset" onClick="location.href='<?php echo SITE_PATH;?>admin/newBusinessClaims.php'">
										</th>
										
									</tr>
								</thead>  
							   
								<tbody id="target-content">
									<tr>
										<input type="hidden" id="totaluserCount" value=""/>
										<input type="hidden" id="userPage" value="1"/>
									</tr>
								</tbody>
									<tr>
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
										<td colspan="2"></td>
										<td colspan="2"></td>
										
									</tr>
							</table> 
							<table class="table table-striped table-bordered bootstrap-datatable datatable">
								<tr>
									
									<td colspan="2">
										<input type="button" name="active" value="Accept" class="input btn btn-danger" onclick="activeClaims()"/> 
										<input type="button" name="active" value="Reject" class="input btn btn-danger" onclick="rejectClaims()"/> 
										<input type="button" name="active" value="Delete" class="input btn btn-danger" onclick="deleteClaims()"/> 
									</td>
									
								</tr>	
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

function deleteClaims()
{
	if ($('.chkbox:checked').length != 0) 
	{
		var SelectedIDs = [];
		$('.chkbox:checked').each(function (i) {
			SelectedIDs.push($(this).attr('id'));
		});
		var Ids = SelectedIDs.join(";")
	}
	
	 $.ajax({
		url : "deleteClaims.php",
		type: "POST",
		data :{ Ids :Ids },
		
		success: function(result)
		{	
				window.location.href='newBusinessClaims.php';
			//$("#searchResult").html(result);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
		}
	});	
	
	
}

function rejectClaims()
{
	if ($('.chkbox:checked').length != 0) 
	{
		var SelectedIDs = [];
		$('.chkbox:checked').each(function (i) {
			SelectedIDs.push($(this).attr('id'));
		});
		var Ids = SelectedIDs.join(";")
	}
	
	 $.ajax({
		url : "rejectClaims.php",
		type: "POST",
		data :{ Ids :Ids },
		
		success: function(result)
		{	
			
			
				window.location.href='newBusinessClaims.php';
			
			//$("#searchResult").html(result);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
		}
	});	
	
}

function activeClaims()
{
	if ($('.chkbox:checked').length != 0) 
	{
		var SelectedIDs = [];
		$('.chkbox:checked').each(function (i) {
			SelectedIDs.push($(this).attr('id'));
		});
		var Ids = SelectedIDs.join(";")
	}
	
	 $.ajax({
		url : "activeClaims.php",
		type: "POST",
		data :{ Ids :Ids },
		
		success: function(result)
		{	
			//console.log(result);return false;
			
				window.location.href='newBusinessClaims.php';
				
			//$("#searchResult").html(result);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
		}
	});	
	
}
$(document).ready(function()
{
	getUserDetals();
	var limit = 10;

    $("#filteruser").click(function(){
		$("#userPage").val("1");
		getUserDetals();
    
	});


	$(".right").click(function(){
		
		var totalRecords =  $("#totaluserCount").val();
		var finalPage = Math.ceil(totalRecords/limit);
    
		if(parseInt($("#userPage").val()) != finalPage )
		{
			var currentPageNo =  $("#userPage").val();
			$("#userPage").val(parseInt(currentPageNo)+1);
			getUserDetals();
			enableDisPagination();
		}
    
	});

    $(".left").click(function()
	{
		if($("#userPage").val() != 1)
		{
			var currentPageNo =  $("#userPage").val();
			$("#userPage").val(parseInt(currentPageNo)-1);
			getUserDetals();
			enableDisPagination();
		}
    
	});


    $(".start").click(function(){
		if($("#userPage").val() != 1)
		{
			$("#userPage").val(1);
			getUserDetals();
			enableDisPagination();
		}
	}
                   );
  
	$(".end").click(function()
	{
    
		var totalRecords =  $("#totaluserCount").val();
		var finalPage = Math.ceil(totalRecords/limit);
    
		if(parseInt($("#userPage").val()) != finalPage ){
			$("#userPage").val(finalPage);
			getUserDetals();
			enableDisPagination();
		}
	});
	
	function getUserDetals()
	{
		$.ajax({
			url: "listOfNewClaims.php", 
			type:"POST",
			data:{
			  pageNo:$("#userPage").val(),name:$('#name').val(),email:$('#email').val(), bname:$("#bname").val(),claim_status:$("#claim_status").val()}
			,
			success: function(response){
			  //alert(response);
			  $("#target-content").html(response);
			  enableDisPagination();
					   if(parseInt($("#totaluserCount").val()) > limit){
				$(".alluPage").show();
			  }
			  else{
				$(".alluPage").hide();
			  }
			  
		  
			}
		});
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
