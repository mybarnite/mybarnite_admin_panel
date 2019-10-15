<? include("header.php");

$page_query=mysql_query("select * from tbl_faq where id='".$_REQUEST['page_id']."'");
$fetch_content=mysql_fetch_array($page_query);
 if(isset($_REQUEST['add_new_page']))
 {
	 $page_heading=trim($_REQUEST['page_heading']);
	 $page_content=trim($_REQUEST['page_content']);

   
	  
       $succ= mysql_query("update tbl_faq set page_heading='".$page_heading."',page_content='".$page_content."' where id='".$_REQUEST['page_id']."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Faq is Successfully Updated";	
		   }
		   else
		 {
		   $_SESSION['msg']="Faq is Not Updated";	
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
		var page_heading=document.getElementById('page_heading').value;

          if(page_heading=='')
		{
	  alert('Please Enter Page Title');
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
						<h2><i class="icon-edit"></i>Edit Affiliation</h2>
					  <div align="right">
                       	<a href="manage_faq.php" class="btn btn-setting btn-round">Back To List</a>						</div>
				  </div>
				  <div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" enctype="multipart/form-data" onsubmit="return main_category_valid()">
						<table align="center" width="80%" >
                         <tr >
                        <td width="21%">&nbsp;</td>
                         <td width="76%">&nbsp;</td>
                         <td width="3%">&nbsp;</td>
                        
                        </tr>
						<!-- <tr >
                        <td ><label class="control-label" for="typeahead">Page Title*</label></td>
                        <td>
                        <strong>
                        Refund
                        <input type="radio" name="page_title" value="Refund" <? if($fetch_content['page_title']=='Refund') echo "checked='checked'";?> />&nbsp;&nbsp;&nbsp;
                        Shipping
                        <input type="radio" name="page_title" value="Shipping" <? if($fetch_content['page_title']=='Shipping') echo "checked='checked'";?> /></strong>&nbsp;&nbsp;&nbsp;
                        News Feed
                        <input type="radio" name="page_title" value="News Feed" <? if($fetch_content['page_title']=='News Feed') echo "checked='checked'";?> /></strong>
                        
                        
                        </td>
                         </tr>-->
                         <tr >
                        <td ><label class="control-label" for="typeahead"> Heading*</label></td>
                        <td>
                        <strong>
                        <input type="text" value="<?=$fetch_content['page_heading'];?>" class="span6 typeahead"  name="page_heading" id="page_title"  size="40" /></strong></td>
                         </tr>
                        <tr >
                        <td ><label class="control-label" for="typeahead">Description</label></td>
                        <td>
                        <textarea name="page_content" id="page_content" rows="20" cols="45"><?=$fetch_content['page_content'];?></textarea>
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
                        <input type="submit" name="add_new_page" value="Update" class="btn btn-primary" onclick="" />
                      
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
