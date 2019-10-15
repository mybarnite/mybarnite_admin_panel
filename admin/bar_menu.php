<?php 
include("header.php");
if(isset($_POST['addNew']))
{
	
	global $flag;
	$valid_formats = array("jpg", "png", "gif", "pdf");
	$path = "../business_owner/foodmenu_uploads/"; // Upload directory
	$count = 0;
	$bar_id = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['bar']))));
	// Loop $_FILES to exeicute all files
	$total = count($_FILES['files']['name']);
	// Loop through each file
	for($i=0; $i<$total; $i++) {
		$new_filename = $bar_id."-".time()."-".$_FILES['files']['name'][$i];		   
		if ($_FILES['files']['error'][$i] == 0) {	           
			if( ! in_array(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION), $valid_formats) ){
				$_SESSION['msg']="<div class='alert alert-danger'>File format is invalid.</div>";
				$flag=1;
				 // Skip invalid file formats
			}
			else
			{ // No error found! Move uploaded files 
				if($flag!=1)
				{
					$new_filename = $bar_id."-".time()."-".$_FILES['files']['name'][$i];
					if(move_uploaded_file($_FILES["files"]["tmp_name"][$i], $path.$new_filename))
					$count++; // Number of successfully uploaded file
					
					$q1= "INSERT INTO tbl_barfoodmenu_uploads (bar_id,file_name,file_path) VALUES('".$bar_id."','".$new_filename."','".$path.$new_filename."')";
					$e1 = mysql_query($q1);
					$lastInsertedId = mysql_insert_id();
					//$db->insert('tbl_barfoodmenu_uploads',array('bar_id'=>$_SESSION['bar_id'],'file_name'=>$new_filename,'file_path'=>$path.$new_filename));  // Table name, column names and respective values
					//$res1 = $db->getResult();  
					if($lastInsertedId!="")
					{
						$flag = 0;
						$_SESSION['msg']="<div class='alert alert-success'>File Uploaded successfully.</div>";
					}	
				}	
				
				
			}
		}
	}
	
}	
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
								<h2><i class="icon-edit"></i>&nbsp;Menu Management</h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="menu_container">
								<table align="center" width="100%" >
									<tr><td align="center" style="color:#F00;" id="msg"><?php echo $_SESSION['msg'];unset($_SESSION['msg']);?></td></tr>
								</table>
								<form role="form" method="post" class="form-horizontal" enctype="multipart/form-data">
									<table align="center" width="80%" >
										<tbody>
											<input type="hidden" name="action" id="action" value="Add"/>
										
											<tr id="barList">
												<td><label class="control-label" for="typeahead">Bar: <span style="color:red;">*</span></label></td>
												<td>
													<select name="bar" id="bar">
														<option value="0">Select</option>	
													<?php 
														$sql1 = "select Business_name, id from bars_list";
														$execute1 = mysql_query($sql1);
														while($bar = mysql_fetch_assoc($execute1))
														{
															if(isset($bar['Business_name'])&&$bar['Business_name']!="")
															{
													?>
															<option value="<?php echo $bar['id'];?>"><?php echo $bar['Business_name'];?></option>	
													<?php
															}
														}
													?>
													</select>
												</td>
											</tr>
											
											
											<tr>
												<td><label class="control-label" for="typeahead">Upload menu : <span style="color:red;">*</span></label></td>
												<td><input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" /></td>
											</tr>
											<tr>
												<td><label class="control-label" for="typeahead">&nbsp;</label></td>
												<td>
													<input type="submit" id="addNew" name="addNew" value="Upload" class="btn btn-primary" />
													<button class="btn" onclick="resetFields();">Reset</button>
												</td>
											</tr>
										</tbody>	
									</table>
								</form>
							</div>
						</div><!--/span-->
					</div>
					
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header well" data-original-title>
								<h2><i class="icon-edit"></i>&nbsp;Promotions </h2>
								<div class="box-icon">&nbsp;</div>
							</div>
							<div class="box-content" id="listings">
								<table align="center" width="80%" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											
											<th></th>
											<th colspan=2 align="center">
												<div class="text-center alluPage">
													<div class="btn-group">
														<button type="button" class="btn btn-primary start"><b><<</b></button>
														<button type="button" class="btn btn-primary left"><b><</b></button>
														<button type="button" class="btn btn-primary right"><b>></b></button>
														<button type="button" class="btn btn-primary end"><b>>></b></button>
													</div>
												</div>
											</th>
											
														
										</tr>
										<tr>
											
											<th>Bar Name</th>
											<th colspan="2">Actions</th>
											
										</tr>
									</thead>
									<tbody id="target-content">
										<input type="hidden" id="totaluserCount" value=""/>
										<input type="hidden" id="userPage" value="1"/>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->
			<hr>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 
 <script>
 function resetFields()
 {
	window.location.href = 'menuList.php';
 }
 
 
 $(document).ready(function(){
   getUserDetals();
  var limit = 15;


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
        url: "menuList.php", 
        type:"POST",
        data:{
          pageNo:$("#userPage").val()}
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
$(document).ready(function(){
	$('#addNew').click(function(){
		 var fileName = $("#file").val();
		 
		if ($('#bar').val() == '0') {
			$("#msg").html('Please fill all fields marked as (*).');
			return false;
		}
		if (!fileName) {
			$("#msg").html('Please select any file.');
			return false;
		}
		
		else
		{
			return true;
		}
	});  
});
</script> 	
		<?php include("footer.php");?>
		
</body>
</html>
