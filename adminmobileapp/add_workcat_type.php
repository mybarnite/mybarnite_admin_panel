<?php
include("header.php");
include("functions/functions.php");

	 if(isset($_REQUEST['add_new_p_type']))
 {
	//$country_name=addslashes(trim($_REQUEST['country']));
	$p_type=addslashes(trim($_REQUEST['p_type']));

	/*	$data = array(
			'category'  =>  $p_type,
			'is_active'  =>  1
		);
		*/
		//$succ = insert_data('work_category',$data);
		$succ = mysql_query("INSERT INTO `work_category` VALUES(NULL,'".$p_type."',1)")or die(mysql_error());
	 
	    if($succ)
		{
		   $_SESSION['msg']="Successfully Added";	
		}
		else
		{
		   $_SESSION['msg']="Some error";	
		}
		?>
		<script>window.location.href="manage_workcat_type.php"</script>
		<?php
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
						<h2><i class="icon-edit"></i>Add New Work / Job Category</h2>
					  <div align="right">
                       	<a href="manage_property_type.php" class="btn btn-setting btn-round">Back To List</a>	</div>
				  </div>
				  <div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><?php echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" enctype="multipart/form-data" onsubmit="return main_category_valid()">
						<table align="center" width="80%" >
                         <tr >
                        <td width="22%">&nbsp;</td>
                         <td width="75%">&nbsp;</td>
                         <td width="3%">&nbsp;</td>
                        
                        </tr>
						
						
						
						
						<tr>
							<td><label class="control-label" for="typeahead"> Add Work / Job Category </label></td>
							<td><input type="text"  class="span6 typeahead"   name="p_type"  id="page_heading"  size="40" /></td>
							
							
							
                         </tr>
					
						 
                        <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_p_type" value="Submit" class="btn btn-primary" onclick="" />
                      
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
