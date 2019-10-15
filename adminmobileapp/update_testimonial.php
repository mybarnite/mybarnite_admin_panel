<? include("header.php");
  
 if($_GET['flag']=='edit')
 {
	$query= mysql_query("select * from tbl_testimonials where id='".$_GET['id']."'");
	 $fetch_test=mysql_fetch_array($query);
	 }
  
 if(isset($_REQUEST['submit']))
 {
	 $title=trim($_REQUEST['title']);
	  $name=trim($_REQUEST['name']);
	   $content=addslashes($_REQUEST['content']);
	   $date=date("Y-m-d");
	
  
		
	 
       $succ= mysql_query("Update tbl_testimonials set title='".$title."',name='".$name."',content='".$content."',date='".$date."' where id='".$_GET['id']."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Testmonial  is Successfully Updated";	
		   }
		   else
		 {
		   $_SESSION['msg']="Testmonial  is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="manage_testimonials.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	
 }
?>
	<!-- topbar ends -->
    <script>
	
	function company_valid()
	{
		var title=document.getElementById('title').value;

          if(title=='')
		{
	  alert('Please Enter title ');
	  document.getElementById('title').focus();
	  return false;
	  }
	  var name=document.getElementById('name').value;

          if(name=='')
		{
	  alert('Please Enter content');
	  document.getElementById('name').focus();
	  return false;
	  }
	  var content=document.getElementById('content').value;

          if(content=='')
		{
	  alert('Please Enter content');
	  document.getElementById('content').focus();
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
						<h2><i class="icon-edit"></i>Edit Testimonial</h2>
						<div align="right">
							<a href="manage_testimonials.php" class="btn btn-setting btn-round">Back To Testimonial List</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
                         <tr >
                        <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                        
                        </tr>
						 <!--<tr >
                        <td ><label class="control-label" for="typeahead">Title*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="title" id="title"  size="40"  value="<?=$fetch_test['title'];?>" /></td>
                         </tr>-->
                         <tr >
                        <td ><label class="control-label" for="typeahead">Name*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="name" id="name"  size="40"  value="<?=$fetch_test['name'];?>"/></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Content*</label></td>
                        <td><textarea rows="10" cols="30" name="content" id="content"><?=$fetch_test['content'];?></textarea></td>
                         </tr>
                          
                      
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="submit" value="Update" class="btn btn-primary" onclick="return company_valid()" />
                      
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
