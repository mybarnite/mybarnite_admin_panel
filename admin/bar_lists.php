<?php include("header.php");


  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
	  
  $succ_del=mysql_query("delete from bars_list where id ='".$id."'");
  echo $succ_del;
  }
   if($succ_del)
  {
  $_SESSION['msg']="Record is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Image is not successfully deleted";
  }
  ?>
	   <script>window.location.href="bar_lists.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
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
						<h2><i class="icon-list"></i> Manage Business Sales</h2>
                         <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Barnite</span></a></li><?php
						}
						?>
						
					</div>
					<div class="box-content">
					
                    <table align="center" width="100%" >

                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];unset($_SESSION['msg']);?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>

                    <form method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							<tr>
								<th></th>
								<th></th>	
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th>  
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
							 
									<th width="100" style="text-align: center;"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0;"/>Select All</th>
									<th width="24">Edit</th>
									<th>Customer Id</th>
									<th>Owner Name</th>  
									<th width="60">Email</th>
									<th>Business Name</th>
									<th>Location</th>
									<th>Contact No</th>
									<th>Category</th>
									<th>Commission</th>
									<th colspan="2">Actions</th>
							</tr>
							<tr>
								<th width="20" style="text-align: center;"><input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/></th>
                                <th width="24"></th>
                                				<th><input  type="text" class="form-group" name="cid" id="cid" style="width: 90px;" /></th>
								<th><input  type="text" class="form-group" name="ownername" id="ownername" style="width: 90px;" /></th>
								<th></th>  
								<th><input  type="text" class="form-group" name="businessownername" id="businessownername" style="width: 90px;"/></th>
								<th><input  type="text" class="form-group" name="location" id="location" style="width: 90px;" /></th>
								<th></th>
								<th>
									<select name="category" id="category" class="form-control" style="width: 90px;">
										<option value="">Select</option>
										<option value="Pub">Pub</option>
										<option value="Bars">Bars</option>
										<option value="Wine Bars">Wine Bars</option>
										<option value="Lounges">Lounges</option>
									</select>
								</th>
								<th>
									<select class="span6 typeahead"  name="Commission" id="Commission" style="width: 90px;">
										<option value="">All</option>
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="40">40</option>
										<option value="50">50</option>
										<option value="60">60</option>
										<option value="70">70</option>
										<option value="80">80</option>
										<option value="90">90</option>
										<option value="100">100</option>
									</select>
								</th>
								<th  colspan="2">
									<input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
									<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset">
								</th>
							</tr>
							  	  
						  </thead>  
						   
						  <tbody id="target-content">
							<input type="hidden" id="totaluserCount" value=""/>
							<input type="hidden" id="userPage" value="1"/>
                          </tbody>
						  <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
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

$(document).ready(function(){
	
	$("#reset").click(function(){
		window.location = "bar_lists.php";	
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
 
    if(parseInt($("#userPage").val()) != finalPage ){
      var currentPageNo =  $("#userPage").val();
      $("#userPage").val(parseInt(currentPageNo)+1);
      getUserDetals();
      enableDisPagination();
    }
    
  });

    $(".left").click(function(){
    if($("#userPage").val() != 1){
      var currentPageNo =  $("#userPage").val();
      $("#userPage").val(parseInt(currentPageNo)-1);
      getUserDetals();
      enableDisPagination();
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
        url: "barResult.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val(),cid:$('#cid').val(),ownername:$('#ownername').val(),businessownername:$('#businessownername').val(),location:$('#location').val(),category:$('#category').val(),Commission:$("#Commission").val() }
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
