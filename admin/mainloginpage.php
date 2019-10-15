<? 
include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();

if(GET_CURRENT_URL()=='login.php'){
       
       
       include(FILE_NOT_FOUND);
       exit;
}
  

  if(isset($_REQUEST['login']))
  {
     $username=$_REQUEST['username'];
      $password=$_REQUEST['password'];
       
	 $user_chk_query="select * from tbl_admin where admin_login_id='".$username."' and admin_password='".$password."'";
      $exe_query=mysql_query($user_chk_query) or die(mysql_error());
      $row=mysql_num_rows($exe_query);
			if($row==1)
			{

         $sel_user_query="select * from tbl_admin where admin_login_id='".$username."'";
		  $exe_user= mysql_query($sel_user_query);
           $fetch_user = mysql_fetch_array($exe_user);
		   
		   $_SESSION['SESSION_AUTHENTICATE_HITTING'] = 1;
		   $_SESSION["SESSION_LOGIN_ID"] = "temp_id";
		   $_SESSION['ID']=$fetch_user['id']; 
		   $_SESSION['USER_NAME']=$fetch_user['admin_name']; 
		   $_SESSION['USER_ID']=$fetch_user['admin_login_id']; 
		   $_SESSION['USER_TYPE']=$fetch_user['admin_type']; 
		   
             $userip=$_SERVER['REMOTE_ADDR'];
			 
             mysql_query("update tbl_admin set admin_last_login=now(),admin_ip='".$userip."' where id='".$fetch_user['id']."'");		   
		    
			
			
			header("Location:welcome.php");
			
		   
			}
			else
			{
			$_SESSION['msg']="Wrong UserId or Password";
			//header("Location:index.php");
			}	   
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Bar Night Admin Panel</title>
	
 <!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/charisma-app.css" rel="stylesheet">


	
	<!--<link rel="shortcut icon" href="img/favicon.ico">-->
    
    <script src="ajax/validation.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
	
</head>

<body style="background-image:url('images/bg1.jpg');background-repeat: no-repeat;
    background-attachment: fixed;background-position: center; ">
		<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2 style="color:#fff;">Bar Night </h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div <? if($_SESSION['msg']!=''){ ?>class="alert alert-info" <? }?>>
						<? echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
					</div>
					<form class="form-horizontal" action="" method="post">
						<fieldset>
							
							<div class="clearfix"></div>

							<p class="center span6" style="color:white;"> CMS For Web Site 
							<input type="submit" formaction="login.php" value="Login" class="btn btn-primary" >
							
							
							</p>
							<br />
							<br />
							
							<p class="center span6" style="color:white;"> CRM For Mobile Application 
							<input type="submit" formaction="../adminmobileapp/login.php" value="Login" class="btn btn-primary" >
							
							
							</p>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->


		
</body>
</html>
