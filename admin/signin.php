<?php
session_start();
include("admin/includes/config.cfg");
include("admin/includes/connection.con");
include("admin/includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();
?>

<?php
		if(isset($_POST['loginbut']))
		{
			$useremail = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['useremail']))));
			$userpassword = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['userpassword']))));
			$loginfailmsg = "";
			
			
			$query = mysql_query(" SELECT * FROM user_register WHERE email='".$useremail."' AND password='".$userpassword."'  ");
			$result = mysql_num_rows($query);
			$row = mysql_fetch_array($query);
			if($result > 0)
			{

				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $row['name'];
				$_SESSION['useremail'] = $row['email'];
				echo "<script>window.location.href='profile.php'</script>";
			}else
			{
				$loginfailmsg = "value";
			}
			
			
		}
?>

   <?php include'header.php'; ?>
<!--==============================Map=================================--> 

	
</header>
<div class="padcontent"></div>		

<!--==============================Content=================================--> 
<section id="content" class="main-content">
  <div class="container">
    <div class="row clearfix ">
          <div class="span3"></div>
		<div class="span6">
        	<h2>Log In</h2>
			<?php if(isset($_GET['registerstatus'])){ ?>
			<span style="color:green">Registration Successfully Login Now</span>
			<?php } ?>
      			<div id="note"></div>
      			<div id="fields" class="contact-form">
      				<form id="ajax-contact-form" class="form-horizontal" method="post">
      					<div class="control-group">
      						<label class="control-label" for="inputName">EMAIL:</label>
      							<input type="email" required name="useremail" class="form-control" placeholder="User Name..."  >
      					</div>
						<br>
      					<div class="control-group">
      						<label class="control-label" for="inputEmail">PASSWORD:</label>
      							<input type="password" required name="userpassword" class="form-control" placeholder="Password..">
								
      					</div>
						<?php if($loginfailmsg != ""){ ?>
						<span style="color:red;">User Name And Passowrd Does Not Match</span>
						<?php } ?>
      					<br>
						<br>
      					<input style="float:right;" name="loginbut" type="submit" class="btn submit btn-primary " value="Login">
						<div class="clearfix"></div>
      				</form>
      			</div>    
		</div>		  
		
		
	

    </div>
  </div>
</section>




   <?php include'footer.php'; ?>