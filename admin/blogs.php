<?php include("header.php");


	if(isset($_REQUEST['delete']))
	{
	  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
		  
			$succ_del=mysql_query("delete from tbl_manage_blogs where id='".$id."'");
		}
		if($succ_del)
		{
			$_SESSION['blogerrmsg']="Record has been deleted successfully.";
		}
		else
		{
			$_SESSION['blogerrmsg']="Record has not been deleted  successfully.";
		}
		?>
		   <script>window.location.href="blogs.php?msg=<?=$_SESSION['blogerrmsg'];?>&t=true";</script>
		<?php
	}
  
	if(isset($_REQUEST['active']))
	{
  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			mysql_query("update tbl_manage_blogs set status='Active' where id='".$id."'");
			$_SESSION['blogerrmsg']="Records have been changed successfully.";
		}
		?>
		<script>window.location.href="blogs.php?msg=<?=$_SESSION['blogerrmsg'];?>&t=true";</script>
		<?php
	}
  
	if(isset($_REQUEST['reject']))
	{
  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			mysql_query("update tbl_manage_blogs set status='Rejected' where id='".$id."'");
			$_SESSION['blogerrmsg']="Records have been updated successfully.";
		}
		?>
		<script>window.location.href="blogs.php?msg=<?=$_SESSION['blogerrmsg'];?>&t=true";</script>
		<?php
	}
	if(isset($_REQUEST['deactive']))
	{
  
		$chk=$_REQUEST['chk'];
		foreach($chk as $id)
		{
			mysql_query("update tbl_manage_blogs set status='Inactive' where id='".$id."'");
			$_SESSION['blogerrmsg']="Records have been updated successfully.";
		}
		?>
		<script>window.location.href="blogs.php?msg=<?=$_SESSION['blogerrmsg'];?>&t=true";</script>
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
                 <script src="js/functionsforcheckall.js"></script>
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i> Blogs</h2>
                      
						
					</div>
					<div class="box-content">
					
                    <table align="center" width="100%" >

                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['blogerrmsg'];?></strong></td></tr>
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
									</div
								</th>
								<th><input type="button" value="Add Blog" class="btn btn-primary" onclick="location.href='update_blog.php';"></th>
							</tr>
							<tr>
							    <th width="20"></th>
                                <th width="24">Edit</th>
								<th>Title</th>
								<th>Author</th>
								<th>Modified date</th>
								<th>Status / Action</th>
							</tr>
							<tr>
							    <th width="20"></th>
                                <th width="24"></th>
								<th><input type="text" id="title" class="form-group" /></th>
								<th><!--<input type="text" id="author" class="form-group" />--></th>
								<th></th>
								<th>
									<input type="button" id="filteruser" class="btn btn-primary"  value="Filter" name="Filter">
									<input type="button" id="reset" class="btn btn-danger"  value="Reset" name="Reset" onClick="location.href='blogs.php'">
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
						</tr>
					</table> 
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tr>
							<td>&nbsp;</td>
							<td class="center">&nbsp;</td>
							<td  align="right">
                               	<input type="submit" name="active" value="Active" class="input btn btn-danger" /> 
								<input type="submit" name="deactive" value="Deactive" class="input btn btn-danger" /> 
								<input type="submit" name="reject" value="Reject" class="input btn btn-danger" /> 
								<input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>
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
$(document).ready(function(){
   getUserDetals();
	var limit = 10;
	$("#filteruser").click(function(){
		$("#userPage").val("1");
		getUserDetals();
    
	});


	$(".right").click(function(){
		
		var totalRecords =  $("#totaluserCount").val();
		var finalPage = Math.ceil(totalRecords/limit);
    
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
	});
  
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
		$.ajax({
			url: "blog_list.php", 
			type:"POST",
			//data:{pageNo:$("#userPage").val(),name:$('#name').val(),email:$('#email').val()},
			data:{pageNo:$("#userPage").val(),title:$('#title').val(),author:$('#author').val()},
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
		});
	}

});
</script>
</body>
</html>
