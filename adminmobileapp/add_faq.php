<? include("header.php");

 if(isset($_REQUEST['add_new_page']))
 {
	 $page_heading=trim($_REQUEST['page_heading']);
	 $page_content=trim($_REQUEST['page_content']);

   
	  
       $succ= mysql_query("insert into tbl_faq set page_heading='".$page_heading."',page_content='".$page_content."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="FAQ is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="FAQ is Not Added";	
		   }
		   ?>
		  <script>window.location.href="manage_faq.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 
?>
	<!-- topbar ends -->
    <script>
	
	function main_category_valid()
	{
		var page_title=document.getElementById('page_heading').value;

          if(page_title=='')
		{
	  alert('Please Enter Heading');
	  document.getElementById('page_heading').focus();
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
						<h2><i class="icon-edit"></i>Add Affiliation</h2>
					  <div align="right">
                       	<a href="manage_other_page.php" class="btn btn-setting btn-round">Back To List</a>	</div>
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
						<!-- <tr >
                        <td ><label class="control-label" for="typeahead">Page Title*</label></td>
                        <td>Refund
                        <input type="radio" name="page_title" value="Refund" />&nbsp;&nbsp;&nbsp;
                        Shipping
                        <input type="radio" name="page_title" value="Shipping" />&nbsp;&nbsp;&nbsp;
                        News Feed
                        <input type="radio" name="page_title" value="News Feed" />
                     
                       <input type="text" class="span6 typeahead"  name="page_title" id="page_title"  size="40" />
                        </td>-->
                         </tr>
                         <tr >
                        <td ><label class="control-label" for="typeahead"> Heading*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="page_heading" id="page_heading"  size="40" /></td>
                         </tr>
                        <tr >
                        <td ><label class="control-label" for="typeahead">Description</label></td>
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
