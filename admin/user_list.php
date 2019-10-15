<?php include("header.php");


  /* if(isset($_REQUEST['delete']))
  {
	  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			$userId = $id;
			$getUserAccountDetailQry = "select u.id as user_id, u.name as user_name, u.email as email from user_register as u where u.id = ".$userId;
		}
		$exeQry = mysql_query($getUserAccountDetailQry);
		$getUserAccountDetails = mysql_fetch_assoc($exeQry);
		$userName = $getUserAccountDetails['user_name'];
		$email = $getUserAccountDetails['email'];
		$role = "Non business user";
		mysql_query("delete from user_register where id=".$userId);
		$countSql = "SELECT * FROM social_media_user_account where user_id=".$userId;
		$exe= mysql_query($countSql); 
		$numOfRows = mysql_num_rows($exe);
		if($numOfRows>0){
			mysql_query("delete from social_media_user_account where user_id=".$userId);	
		}
		
  } */
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update user_register set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected User is Activated";
  }
  ?>
	   <script>window.location.href="user_list.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
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
	   <script>window.location.href="user_list.php?msg=<?=$_SESSION['msg'];?>&t=true";</script>
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
						<h2><i class="icon-list"></i> Manage Users and Visitors</h2>
                         <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Barnite</span></a></li><?php
						}
						?>
						
					</div>
					<div class="box-content">
					
                    <table align="center" width="100%" >

                    <tr><td align="center" colspan="5" id="errMsg"></td></tr>
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
					</tr>
						
							  <tr>
									<th width="20"><input type="checkbox" id="selecctall" onClick="selectAll(this)" style="margin:0 4px 0 "/>Select All</th>	
                                   <th width="20"></th>
                                   <th width="24">Edit</th>
								  
								<th>Name</th>
								<th>Email</th>
								<th>Contact No</th>
								<th>Status / Action</th>
								
							  </tr>
							  	  <tr>
									<th width="20"></th>
                                   <th width="20"></th>
                                   <th width="24"></th>
								  
								<th><input type="text" id="name" class="form-group" /></th>
								<th><input type="text" id="email" class="form-group" /></th>
								<th></th>
								<th><input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset" onClick="location.href='user_list.php'">
                </th>
								
							  </tr>
						  </thead>  
						   
						  <tbody id="target-content">
						  <input type="hidden" id="totaluserCount" value=""/>
              			<input type="hidden" id="userPage" value="1"/>
                          
							
							</tr>
					
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
        url: "members_lists.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val(),name:$('#name').val(),email:$('#email').val()}
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

});
</script>
</body>
</html>
