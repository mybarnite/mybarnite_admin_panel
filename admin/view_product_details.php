<? include("header.php");

$sel_product_query=mysql_query("select * from tbl_proudct_details where product_id='".$_REQUEST['prod_id']."'");
$fetch_product_temp=mysql_fetch_array($sel_product_query);

 
?>
	<!-- topbar ends -->
    <script>
	
	function company_valid()
	{
		var company_name=document.getElementById('company_name').value;

          if(company_name=='')
		{
	  alert('Please Enter Company Name');
	  document.getElementById('company_name').focus();
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
						<h2><i class="icon-edit"></i>Product Details</h2>
						<div align="right">
							<a href="manage_product.php" class="btn btn-setting btn-round">Back To Product List</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_product" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
                         <tr >
                        <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                        
                        </tr>
						 <tr >
                        <td ><label class="control-label" for="typeahead">Material</label></td>
                        <td><?=$fetch_product_temp['material'];?></td>
                         </tr>
                        <tr >
                        <td ><label class="control-label" for="typeahead">Upper Material</label></td>
                        <td><?=$fetch_product_temp['upper_material'];?></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Inner Lining</label></td>
                        <td><?=$fetch_product_temp['inner_lining'];?></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Fabric</label></td>
                        <td><?=$fetch_product_temp['fabric'];?></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Style</label></td>
                        <td><?=$fetch_product_temp['style'];?></td>
                         </tr>
                           <tr >
                        <td ><label class="control-label" for="typeahead">Sleeves</label></td>
                        <td><?=$fetch_product_temp['sleeves'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Neck</label></td>
                        <td><?=$fetch_product_temp['neck'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Fit</label></td>
                        <td><?=$fetch_product_temp['fit'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Length</label></td>
                        <td><?=$fetch_product_temp['length'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">USP</label></td>
                        <td><?=$fetch_product_temp['usp'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Closing</label></td>
                        <td><?=$fetch_product_temp['closing'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Tipshape</label></td>
                        <td><?=$fetch_product_temp['tipshape'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Stone Type</label></td>
                        <td><?=$fetch_product_temp['stone_type'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Package Contents</label></td>
                        <td><?=$fetch_product_temp['package_contents'];?></td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Care</label></td>
                        <td>
                        <?=$fetch_product_temp['care'];?>
                        </td>
                         </tr>
                            <tr >
                        <td ><label class="control-label" for="typeahead">Product Warranty</label></td>
                        <td><?=$fetch_product_temp['product_warranty'];?></td>
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
