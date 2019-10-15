<? include("header.php");

 if(isset($_REQUEST['add_new_page']))
 {
	  $page_heading=addslashes(trim($_REQUEST['page_heading']));
	  $page_content=addslashes(trim($_REQUEST['page_content']));
      $image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['image']['name']);
       move_uploaded_file($_FILES["image"]["tmp_name"],"../images/".$image);
     
   
	  
       $succ= mysql_query("insert into tbl_events set news_heading='".$page_heading."',news_description='".$page_content."', image='".$image."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="News is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Some error";	
		   }
		   ?>
		  <script>window.location.href="manage_events.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }

?>
	<!-- topbar ends -->
    
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
			
			<div id="content" class="span10">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Add New Event</h2>
					  <div align="right">
                       	<a href="manage_events.php" class="btn btn-setting btn-round">Back To List</a>	</div>
				  </div>
				  <div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" enctype="multipart/form-data" onsubmit="return main_category_valid()">
						<table align="center" width="80%" >
                         <tr >
                        <td width="22%">&nbsp;</td>
                         <td width="75%">&nbsp;</td>
                         <td width="3%">&nbsp;</td>
                        
                        </tr>
						
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead"> Heading*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="page_heading" id="page_heading"  size="40" /></td>
                         </tr>
                       <tr style="display:none;">
                        <td ><label class="control-label" for="typeahead"> Image</label></td>
                        <td><input type="file" class="span6 typeahead"  name="image" id="image"  size="28" /></td>
                         </tr>
                        <tr >
                        <td ><label class="control-label" for="typeahead">Description</label></td>
                        <td>
                        <textarea name="page_content" id="page_content" rows="5" cols="45"></textarea>
                        <script type="text/javascript">
			
							CKEDITOR.replace( 'page_content',
								{
									skin : 'v2'
								});
			
						  </script>
                         
                        </td>
                         </tr>
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_page" value="Submit" class="btn btn-primary" onclick="" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

					</div>
				</div>

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
