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
								<h2><i class="icon-edit"></i>&nbsp;Subscriptions </h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="listings">
								<table align="center" width="80%" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<th>No.</th>
											<th>Name</th>
											<th>Email</th>
											<th>Title</th>
											<th>Duration (Months)</th>
											<th>Price</th>
											<th>Status</th>
											<th colspan="2">Actions</th>
										</tr>
									</thead>
									<tbody id="target-content">
										<input type="hidden" id="totalCount" value=""/>
										<input type="hidden" id="Page" value="1"/>
									</tbody>
								</table>
								<center>
								<div class="allPage">
									<div class="btn-group">
										<button type="button" class="btn btn-primary start"><b><<</b></button>
										<button type="button" class="btn btn-primary left"><b><</b></button>
										<button type="button" class="btn btn-primary right"><b>></b></button>
										<button type="button" class="btn btn-primary end"><b>>></b></button>
									</div>
								</div>
						</center>
							</div>
						</div>
					</div>
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 <script>
 
 function delete_subscription(id)
 {
	if(id!="")
	{
		$.ajax(
		{
				url: "managePurchasedSubscription.php", 
				type:"POST",
				data:{action:"Delete",id:id}
				,
				success: function(response){
					
				  window.location.href = 'purchasedSubscriptionList.php';
				}
		});
	}	
 }
 
$(document).ready(function(){
	getUserDetals();
	var limit = 15;

	$(".right").click(function(){
		
		var totalRecords =  $("#totalCount").val();
		var finalPage = Math.ceil(totalRecords/limit);
		//alert(finalPage);
		
		if(parseInt($("#Page").val()) != finalPage ){
			  var currentPageNo =  $("#Page").val();
			  $("#Page").val(parseInt(currentPageNo)+1);
			  getUserDetals();
		  
		}
    
  });

    $(".left").click(function(){
    if($("#Page").val() != 1){
      var currentPageNo =  $("#Page").val();
      $("#Page").val(parseInt(currentPageNo)-1);
      getUserDetals();
      
    }
    
  });


    $(".start").click(function(){
    if($("#Page").val() != 1){
      $("#Page").val(1);
      getUserDetals();
      enableDisPagination();
    }
  }
                   );
  
  $(".end").click(function(){
    
    var totalRecords =  $("#totalCount").val();
    var finalPage = Math.ceil(totalRecords/limit);
    
    if(parseInt($("#Page").val()) != finalPage ){
      $("#Page").val(finalPage);
      getUserDetals();
      enableDisPagination();
    }
});
      function getUserDetals(){
    //alert($("#CostPage").val());
    
    $.ajax(
      {
        url: "purchasedSubscriptionList.php", 
        type:"POST",
        data:{
          pageNo:$("#Page").val()}
        ,
        success: function(response){
          //alert(response);
          $("#target-content").html(response);
                   if(parseInt($("#totalCount").val()) > limit){
            $(".allPage").show();
          }
          else{
            $(".allPage").hide();
          }
          
      
        }
      }
    );
  }
  function enableDisPagination(){
    if($("#Page").val() != 1){
      $(".start").removeClass("disabled");
      $(".left").removeClass("disabled");
      
    }
    else{
      $(".start").addClass("disabled");
      $(".left").addClass("disabled");
      
    }
    
    var totalRecords =  $("#totalCount").val();
    var finalPage = Math.ceil(totalRecords/limit);
    
    if(finalPage == $("#Page").val()){
      
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
		<?php include("footer.php");?>
		
</body>
</html>
