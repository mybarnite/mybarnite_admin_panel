<? include("header.php");

 if(isset($_REQUEST['add_new_page']))
 {
	 $page_title=trim($_REQUEST['page_title']);
	 $page_content=trim($_REQUEST['page_content']);

   $query= mysql_query("select * from tbl_contractor_staticpage  where page_title='".$page_title."'");
     $chk_cat= mysql_num_rows($query);
	 if($chk_cat>=1)
	 {
	   
     $_SESSION['msg']="This Page is already added";	
	   ?>
		  <script>window.location.href="add_connew_static_page.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?
	 }
	 else
	 {
		 if($_FILES['pageimage']['name']!='')
		 {
		 $pageimage = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['pageimage']['name']);       
	   
		  move_uploaded_file($_FILES["pageimage"]["tmp_name"],"product_images/".$pageimage);
	      
		 }
    
	if($_FILES['image']['name']!='')
	{
		  $image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['image']['name']);
		  move_uploaded_file($_FILES["image"]["tmp_name"],"product_images/".$image);
	}
       $succ= mysql_query("insert into tbl_contractor_staticpage  set page_title='".$page_title."',page_content='".$page_content."',image='".$pageimage."',banner_image='".$image."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Page is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Page is Not Added";	
		   }
		   ?>
		  <script>window.location.href="contmanage_static_page.php?msg=<?=$_SESSION['msg'];?>&t=true"</script>
		   <?
	 }
 }
?>
	<!-- topbar ends -->
    <script>
	
	function main_category_valid()
	{
		var page_title=document.getElementById('page_title').value;

          if(page_title=='')
		{
	  alert('Please Enter Page Title');
	  document.getElementById('page_title').focus();
	  return false;
	  }
	 var page_content=document.getElementById('page_content1').value;

          if(page_content=='')
		{
	  alert('Please Enter Page Content');
	  document.getElementById('page_content1').focus();
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
			
			<div id="content" class="span10">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Add New Static Page</h2>
						<div align="right">
                       	<a href="contmanage_static_page.php?t=true" class="btn btn-setting btn-round">Back To Static Page List</a>
						</div>
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
						 <tr >
                        <td ><label class="control-label" for="typeahead">Page Title*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="page_title" id="page_title"  size="40" /></td>
                         </tr>
                      
                        <tr >
                        <td ><label class="control-label" for="typeahead">Page Description</label></td>
                        <td>
                        <textarea name="page_content" id="page_content" rows="20" cols="45"></textarea>
                         <script type="text/javascript">
			
							CKEDITOR.replace( 'page_content',
								{
									skin : 'v2'
								});
			
						  </script>
                        </td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Page Image</label></td>
                        <td><input type="file" class="span6 typeahead"  name="pageimage" id="pageimage"  size="40" /></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Banner Image</label></td>
                        <td><input type="file" class="span6 typeahead"  name="image" id="image"  size="40" /></td>
                         </tr>
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_page" value="Add New Static Page" class="btn btn-primary" onclick="" />
                      
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
