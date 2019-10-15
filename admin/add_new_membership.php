<? include("header.php");

 if(isset($_REQUEST['add_new_membership']))
 {
	 $membership_name=trim($_REQUEST['membership_name']);
	  $silver=trim($_REQUEST['silver']);
	   $gold=trim($_REQUEST['gold']);
	    $platinum=trim($_REQUEST['platinum']);
	
		
	   $succ= mysql_query("insert into tbl_membership set silver='".$silver."',gold='".$gold."',platinum='".$platinum."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Membership is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Membership is Not Added";	
		   }
		   ?>
		  <script>window.location.href="add_new_membership.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 
?>
	<!-- topbar ends -->
    <script>
	
	function validation()
	{
		
	  var silver=document.getElementById('silver').value;

          if(silver=='')
		{
	  alert('Please Enter Payment Value');
	  document.getElementById('silver').focus();
	  return false;
	  }
	  
	  var gold=document.getElementById('gold').value;

          if(gold=='')
		{
	  alert('Please Enter Total Time');
	  document.getElementById('gold').focus();
	  return false;
	  }
	  
	  var platinum=document.getElementById('platinum').value;

          if(platinum=='')
		{
	  alert('Please Enter Validity');
	  document.getElementById('platinum').focus();
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
						<h2><i class="icon-edit"></i>Add New Membership </h2>
						<div align="right">
							<a href="manage_membership.php" class="btn btn-setting btn-round">Back To Membership List</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="Tage-form" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
						
                          <tr >
                        <td ><label class="control-label" for="typeahead">Payment *</label></td>
                        <td><input type="text"   name="silver" id="silver"  size="20"  /> 
                        {Eg: 75,400}</td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Total Hours*</label></td>
                        <td><input type="text" name="gold" id="gold"  size="20"  /></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Validity*</label></td>
                        <td><input type="text"  name="platinum" id="platinum"  size="20"  /> 
                        {Eg: 6 Months}</td>
                         </tr>
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_membership" value="Add New Membership" class="btn btn-primary" onclick="return validation()" />
                      
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
