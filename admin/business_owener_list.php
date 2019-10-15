<?php include("header.php");


  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
	  
  $succ_del=mysql_query("delete from user_register where id='".$id."'");
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
	   <script>window.location.href="business_owener_list.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?php
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {/* echo $id;exit; */
	  
	mysql_query("update user_register set status='Active' , activation_key = '' where id=".$id);
	
			$sql = "select email from user_register where id=".$id;
			$exe = mysql_query($sql);
			$getuserEmail = mysql_fetch_assoc($exe);
			
			$msg = " Your account has been activated , please click on this link:\n\n";
			$msg .= SITE_PATH . 'business_owner/business_owner_signin.php';
			$subj = 'Account Confirmation';
			$to = $getuserEmail['email'];
			$from = 'info@mybarnite.com';
			$appname = 'Mybarnite';
			$headers = "From: info@mybarnite.com" . "\r\n" ."";	
			 
			mail($to,$subj,$msg,$headers);
	
	$_SESSION['msg']="Selected User is Activated";
  }
  ?>
	   <script>window.location.href="business_owener_list.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?php
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update user_register set status='Suspended' where id='".$id."'");
   $_SESSION['msg']="Selected User Is Suspended";
  }
  ?>
	   <script>window.location.href="business_owener_list.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?php
  }
  
 
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
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
						<h2><i class="icon-list"></i> Manage Business Users</h2>
                         <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Barnite</span></a></li><?php
						}
						?>
						
					</div>
					<div class="box-content">
					
                    <table align="center" width="100%" >

                    <tr><td align="center" colspan="7" id="errMsg"></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
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
									<th></th>																		
									<th colspan="2"><a class="btn btn-primary" href="addNewBusiness_Owner.php">Add owner</a></th>
								</tr>
						
								<tr>
							 
									<th><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0 "/>Select All</th>
									<th width="30"></th><!--<input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0 "/>Select All--></th>
									<th width="24">Edit</th>
									<th>Customer Id</th>
									<th>Name</th>
									<th>Email</th>
									<th width="100">Business Name</th>
									<th>Status</th>
									<th colspan="2">Action</th>
								</tr>
							  	<tr>
									<th></th>
									<th width="20"></th>
									<th width="24"></th>
									<th><input type="text" id="cid" class="form-group" style="width: 100px"/></th>
									<th><input type="text" id="name" class="form-group" /></th>
									<th><input type="text" id="email" class="form-group" /></th>
									<th></th>
									<th></th>									
									<th colspan="2">
										<input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
										<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset" onClick="location.href='<?php echo SITE_PATH;?>admin/business_owener_list.php'">
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
							<td></td>
							<td></td>
							</tr>
					  </table> 
                      <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <tr>
								<td>&nbsp;</td>
								<td class="center">&nbsp;</td>
								<td  align="right">
                                	<input type="submit" name="active" value="Acitve" class="input btn btn-danger" /> 
                              <input type="submit" name="inactive" value="Suspended" class="input btn btn-danger" /> 
                            <!--<input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>-->
						</td>
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
function deleteUserAccount(userId,rId){
	
	var agree=confirm("Are you sure you want to delete this Record?");

		if (agree)

			$.ajax({
				type:'POST',
				url:'deleteUserAccount.php',
				data:{userId:userId,rId:rId},
				success:function(result){
					//alert(result);
					$("#errMsg").html(result);
					//setTimeout("window.location.href = 'user_list.php'",2000); 
				}
			}); 


		else

			return false ;	

}
$(document).ready(function(){
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
        url: "userResult.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val(),name:$('#name').val(),email:$('#email').val(),cid:$('#cid').val()}
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
