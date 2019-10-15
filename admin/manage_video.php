<? include("header.php");

 if(isset($_REQUEST['add_new_product']))
 {   
 
     
	    $video_link=trim($_REQUEST['video_link']);
	  
		   mysql_query("insert into tbl_video set video_link='".$video_link."'");
	   $_SESSION['msg']="Record is Successfully Added";
	 
		  
		   ?>
		  <script>window.location.href="manage_video.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 
  if($_GET['flag']=='delete')
  {
     $id=$_GET['id'];
	
  $succ_del=mysql_query("delete from tbl_video where id='".$id."'");
  
   if($succ_del)
  {
  $_SESSION['msg']="Record is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Record is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_video.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
?>
	<!-- topbar ends -->
    <script>
	
	function company_valid()
	{
		var video_link=document.getElementById('video_link').value;

          if(video_link=='')
		{
	  alert('Please Enter video_link');
	  document.getElementById('video_link').focus();
	  return false;
	  }
	 
	return true;
	}
       
	</script>
    	<!-- ajax script start -->
      
        	<!-- ajax script ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<? include("left.php");?><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
	<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10" >
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Manage Video</h2>
						<div align="right">
							<!--<a href="manage_product.php" class="btn btn-setting btn-round">Back To Product List</a>-->
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="80%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_product" action="" method="post" enctype="multipart/form-data" onsubmit="return company_valid();">
						<table align="center" width="100%" >
                         <tr>
                        <td align="middle" colspan="2"><h2>You can add Video</h2></td>
                       
                            </tr>
                             <tr>
                        <td align="middle" colspan="2">&nbsp;</td>
                       
                            </tr>
						 <tr>
                        <td align="middle">Video Link</td>
                        <td><input type="text"   name="video_link" id="video_link" />  <br />
                          [<strong>eg:</strong>http://www.youtube.com/watch?v=<strong style="color:#F00;">TuET0kpHoyM</strong>&feature=g-all-xit]
                      <br /> 
                      <span style="color:#F00;">Please Enter Highlighted Part In this box</span><br /></td>
                            </tr>
                              <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>&nbsp;</td>
                         </tr>
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_product" value="Add New" class="btn btn-primary" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

					</div>
				</div>

			</div>
				
			
			

		
			</div>
            <div id="content" class="span10" style="margin-left:225px;">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>ALL Videos</h2>
						<div align="right">
							<!--<a href="manage_product.php" class="btn btn-setting btn-round">Back To Product List</a>-->
							
						</div>
					</div>
					<div class="box-content">
                   
                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  
						  </thead>   
						  <tbody>
                          <tr>
                          <?
						    $j=0;
						    $sel_query= mysql_query("select * from tbl_video");
						     while($fetch_product=mysql_fetch_array($sel_query))
							 {
								 $j++;
							
						  ?>
							
                            
                              <td align="center"><iframe width="250" height="200" src="//www.youtube.com/embed/<?php echo $fetch_product['video_link'];?>" frameborder="0" allowfullscreen></iframe> <br />
                              <a href="manage_video.php?prod_id=<?=$_GET['prod_id']?>&id=<?=$fetch_product['id'];?>&flag=delete" onclick="return confirmSubmit()" style="text-decoration:none;"><strong  style="color:#F00;">Delete</strong></a>
                              </td>
                                  
                            <? if($j%3==0){ echo "</tr><tr>";} }?>
							
							</tr>
						  </tbody>
					  </table> 
                       
                      </form>    

					</div>
				</div>

			</div>
				
			
			

		
			</div>
            
            
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
