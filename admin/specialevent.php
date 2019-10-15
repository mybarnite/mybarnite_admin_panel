<?php 
	
	include("header.php");


if(isset($_REQUEST['delete']))
	{
  
		$chk=$_REQUEST['chk'];
		
		foreach($chk as $id)
		{
			$succ_del=mysql_query("delete from tbl_events where id='".$id."'");
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
		   <script>window.location.href="specialevent.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
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
										<h2><i class="icon-list"></i> Manage Special Events</h2>
										
								</div>
								<div class="box-content">
									<table align="center" width="100%" >
										<tr>
										<?php if($_REQUEST['msg']=="success"){?>
											<td align="center" style="color:#F00;" id="msg" ><strong><?php echo "Data has been deleted successfully.";?></strong></td>
										<?php unset($_SESSION['msg']);}?>	
										<?php if($_REQUEST['msg']=="error"){?>
											<td align="center" style="color:#F00;" id="msg" ><strong><?php echo "Error occured.";?></strong></td>
										<?php unset($_SESSION['msg']);}?>	
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
														<th></th>
														<th></th>
													</tr>
						
													<tr>
														<th width="100"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0;"/>Select All</th>
														<th width="20">Edit</th>
														<th width="100">Event name</th>
														<th width="100">Bar name</th>
														<th>Event starts at</th>
														<th>Ends at</th>
														<th>Action</th>
														
													</tr>
												
													<tr>
														<th style="text-align:center;"><input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/></th>
														<th></th>
														<th><input type="text" name="EventName" id="EventName" class="form-group" style="width:150px;"/></th>
														<th><input type="text" name="BarName" id="BarName" class="form-group" style="width:150px;"/></th>
														<th>
															<input type="date" name="startDate" id="startDate" class="form-group startDate" style="width:150px;"/>
														</th>
														<th>
															<input type="date" name="endDate" id="endDate" class="form-group endDate" style="width:150px;"/>
														</th>
														<th>
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

function deleteEvent(id)
{
	 $.ajax(
      {
        url: "ajax/deleteEvent.php", 
        type:"POST",
        data:{ id:id  },
        success: function(response){
			alert(response);
			window.location = "specialevent.php";
        }
       
      }
    );
}
$(document).ready(function(){
	$("#reset").click(function(){
		window.location = "specialevent.php";	
	} );
   getUserDetals();
  var limit = 10;
	
    

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
        url: "specialEventsList.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val(),EventName:$("#EventName").val(),BarName:$("#BarName").val(),startDate:$("#startDate").val(),endDate:$("#endDate").val()}
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
