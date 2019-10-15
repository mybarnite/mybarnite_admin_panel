<? include("header.php");

$page_query=mysql_query("select * from work_category where id='".$_REQUEST['page_id']."'");
$fetch_content=mysql_fetch_array($page_query);
 if(isset($_REQUEST['add_new_page']))
 {
	 $page_heading=addslashes(trim($_REQUEST['page_heading']));
	
	 if($_REQUEST['page_id'])
	 {
     
	    $succ= mysql_query("update work_category set category='".$page_heading."' where id='".$_REQUEST['page_id']."'");	 
		$_SESSION['msg']="Successfully Updated";
	 }
	
		   ?>
		  <script>window.location.href="manage_workcat_type.php?msg=<?php echo $_SESSION['msg'];?>"</script>
		   <?php
  }
	
?>
	<!-- topbar ends -->
    <script>
	
	function main_category_valid()
	{
		
	 var page_content=document.getElementById('page_content').value;

          if(page_content=='')
		{
	  alert('Please Enter Page Content');
	  document.getElementById('page_content').focus();
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
						<h2><i class="icon-edit"></i>Edit About</h2>
					  <div align="right">
                       	<a href="manage_workcat_type.php" class="btn btn-setting btn-round">Back To List</a>						</div>
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
						
						
						<tr >
							<td><label class="control-label" for="typeahead" >Category </label></td>
							<td>
								<input type="text" class="span6 typeahead"  name="page_heading" 
								value="<?php echo $fetch_content['category'];?>" id="page_heading"  size="40" />
							</td>
							
						</tr>
						
						
                       
                        <tr>
							<td >
								<label class="control-label" for="typeahead">&nbsp;</label>
							</td>
							<td>
							<input type="submit" name="add_new_page" value="Update" class="btn btn-primary" onclick="" />
                      
							<button class="btn">Cancel</button>
							</td>
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
