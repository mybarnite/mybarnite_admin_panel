<?php include("header.php");

 if(isset($_REQUEST['change_password']))
 {
	 $admin_login_id=$_REQUEST['admin_login_id'];
      $new_pass=$_REQUEST['new_pass'];
   $admin_query= mysql_query("select * from tbl_admin where admin_login_id='".$admin_login_id."'");
     $chk_login_id= mysql_num_rows($admin_query);
	 if($chk_login_id==0)
	 {
	   
     $_SESSION['msg']="User Login Id is not valid";	
	   ?>
		  <script>window.location.href="change_admin_password.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?php
	 }
	 else
	 {
	 
         $pass_change_cnf= mysql_query("update tbl_admin set admin_password='".$new_pass."' where admin_login_id='".$admin_login_id."'");	 
	 
	       if($pass_change_cnf)
		 {
		   
		   $_SESSION['msg']="Password is successfully changed";	
		   }
		   else
		 {
		   $_SESSION['msg']="Password is not changed";	
		   }
		   ?>
		  <script>window.location.href="change_admin_password.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?php
	 }
 }
?>
	<!-- topbar ends -->
    <script>
	
	function admin_passwod_valid()
	{
		var admin_login_id=document.getElementById('admin_login_id').value;

          if(admin_login_id=='')
		{
	  alert('Please Enter User Login Id');
	  document.getElementById('admin_login_id').focus();
	  return false;
	  }
	  var new_pass=document.getElementById('new_pass').value;
	  if(new_pass=='')
		{
	  alert('Please Enter New Password');
	  document.getElementById('new_pass').focus();
	  return false;
	  }
	  var cnf_pass=document.getElementById('cnf_pass').value;
	  if(cnf_pass=='')
		{
	  alert('Please Enter Confirm Password');
	 document.getElementById('cnf_pass').focus();
	  return false;
	  }
	return true;
	}
			 function chk()
			 {
			 
				var new_pass1=document.getElementById('new_pass').value;
				 var cnf_pass1=document.getElementById('cnf_pass').value;
				 if(new_pass1!=cnf_pass1)
				 {
				  alert('Password is Not Matching');
				 
				  document.getElementById('cnf_pass').value="";
				   
				  return false;
				 }
				 return true
			 }
       
	</script>
    	<!-- ajax script start -->
        <script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
        	<!-- ajax script ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<?php include("left.php");?><!--/span-->
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
						<h2><i class="icon-edit"></i>&nbsp;Change Admin Password</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                    </table>
						 <form name="add_new_deparment" action="" method="post">
						<table align="center" width="80%" >
                         <tr >
                        <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                        
                        </tr>
						 <tr >
                        <td ><label class="control-label" for="typeahead">User Login Id*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="admin_login_id" id="admin_login_id"  size="40" /></td>
                         </tr>
                        <tr >
                        <td ><label class="control-label" for="typeahead">New Password*</label></td>
                        <td><input type="password" class="span6 typeahead"  name="new_pass" id="new_pass"  size="40" /></td>
                         </tr>
                          <tr >
                        <td><label class="control-label" for="typeahead">Confirm Password*</label></td>
                        <td><input type="password" class="span6 typeahead"  name="cnf_pass" id="cnf_pass"  size="40" onblur="return chk()" /></td>
                         </tr>
                        
                       
                           <tr >
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="change_password" value="Change Admin Password" class="btn btn-primary" onclick="return admin_passwod_valid()" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

					</div>
				</div><!--/span-->

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<?php include("footer.php");?>
		
</body>
</html>
