<?php include("header.php");


/* if(isset($_REQUEST['delete']))
{
  
	$chk=$_REQUEST['chk'];
	foreach($chk as $id)
	{
		  
		$succ_del=mysql_query("delete from tbl_staffPermission where subuser_id=".$id);
		$succ_del=mysql_query("delete from user_register where id=".$id);
	}
	
	if($succ_del)
	{
		$_SESSION['message1']="Record is successfully deleted";
	}
	
	else
	{
		$_SESSION['message1']="Image is not successfully deleted";
	}
	?>
	   <script>window.location.href="business_sub_users.php?message1=<?=$_SESSION['msg'];?>&t=true";</script>
	<?php
} */
  
  if(isset($_REQUEST['active']))
  {
  
	  $chk=$_REQUEST['chk'];
	  foreach($chk as $id)
	  {
		  
		mysql_query("update user_register set status='Active' , activation_key = '' where id=".$id);
		
				/* $sql = "select * from user_register where id=".$id;
				$exe = mysql_query($sql);
				$getuserEmail = mysql_fetch_assoc($exe);
				
				$msg = " Your account has been activated , please click on this link:\n\n";
				$msg .= SITE_PATH . 'business_owner/business_owner_signin.php';
				$subj = 'Account Confirmation';
				$to = $getuserEmail['email'];
				$from = 'vidhi.scrumbees@gmail.com';
				$appname = 'Mybarnite';
				$headers = "From: vidhi.scrumbees@gmail.com" . "\r\n" ."";	
				 
				mail($to,$subj,$msg,$headers); */
		
		$_SESSION['message1']="Selected User is Activated";
	  }
  ?>
	   <script>window.location.href="business_sub_users.php?message1=<?=$_SESSION['msg'];?>&t=true";</script>
	  <?php
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
	  $chk=$_REQUEST['chk'];
	  foreach($chk as $id)
	  {
	  mysql_query("update user_register set status='Suspended' where id='".$id."'");
	   $_SESSION['message1']="Selected User Is Suspended";
	  }
	  ?>
		   <script>window.location.href="business_sub_users.php?message1=<?=$_SESSION['msg'];?>&t=true";</script>
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
                <script src="js/functionsforcheckall.js"></script>
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i> Business sub users</h2>
                    </div>
					<div class="box-content">
					
                    <table align="center" width="100%" >
						<tr>
							<td align="center" style="color:#F00;">
								<strong>
									<?php if(isset($_SESSION['message1'])){ 
											echo $_SESSION['message1'];
											unset($_SESSION['message1']);
										 } ?>
									<?php if(@$_REQUEST['message1']=="success"){ 
											echo "<div class='alert alert-success'>Data has been deleted successfully!</div>";
											
										 } ?>	 
									<?php if(@$_REQUEST['message1']=="error"){ 
											echo "<div class='alert alert-danger' >Error occured!</div>";
											
										 } ?>	
								</strong>
							</td>
						</tr>
						<tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>

                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
							<tr>
								<td  align="right" colspan="7">
                                	
									<!--<input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>-->
									<input type="submit" name="active" value="Acitve" class="input btn btn-danger" /> 
									<input type="submit" name="inactive" value="Suspended" class="input btn btn-danger" /> 
									
								</td>
							</tr>	
						</table> 
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
							<thead>
								<tr>
									<th width="100"></th>
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
									<th width="20"></th>
									<th></th>
									<th colspan="3"><a class="btn btn-primary" href="addBusinessSubUser.php">Add sub user</a></th>
								</tr>
						
								<tr>
							 
									<th width="100"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0 "/>Select all</th>
									<th width="15%">Name</th>
									<th>Email</th>
									<th width="15%">Bar name</th>
									<th width="20">Accessible pages</th>
									<th>Status</th>
									<th  width="15%" colspan="3">Action</th>
								</tr>
							  	<tr>
							 
									<th width="100"></th>
									<th><input type="text" id="name" class="form-group" style="width:80%" /></th>
									<th><input type="text" id="email" class="form-group" style="width:70%" /></th>
									<th><input type="text" id="barName" class="form-group" style="width:80%" /></th>
									<th width="20"></th>
									<td></td>
									<th colspan="3">
										<input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
										<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset" onClick="location.href='<?php echo SITE_PATH;?>admin/business_sub_users.php'">
									</th>
								
								</tr>
						  </thead>  
						   
						  <tbody id="target-content">
							<input type="hidden" id="totaluserCount" value=""/>
							<input type="hidden" id="userPage" value="1"/>
                          
							
							
						  </tbody>
						  	<tr>
								  <td width="100"></td>
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
							<!-- <td></td> -->
									<td width="20"></td>
									<td></td>
									<td colspan="3"></td>
							</tr>
					  </table> 
                      <table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tr>
							<td  align="right" colspan="7">
								
								<!--<input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>-->
								<input type="submit" name="active" value="Acitve" class="input btn btn-danger" /> 
								<input type="submit" name="inactive" value="Suspended" class="input btn btn-danger" /> 
								
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
function deleteUserAccount(userId,rId){
	//alert("test");return false;
	var agree=confirm("Are you sure you want to delete this Record?");

		if (agree)

			$.ajax({
				type:'POST',
				url:'deleteUserAccount.php',
				data:{userId:userId,rId:rId},
				success:function(result){
					//alert(result);
					$("#errMsg").html(result);
					setTimeout("window.location.href = 'business_sub_users.php'",2000); 
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
        url: "businessUserList.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val(),name:$('#name').val(),email:$('#email').val(), barName : $("#barName").val()}
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
