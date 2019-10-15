<?
include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");
PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();

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

<body style="background-image:url('images/mob.jpg');background-repeat: no-repeat;
    background-attachment: fixed;background-position: center; ">
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a href="Welcome.php"><h1 style="color:#fff;"> Bar Night</h1></a>
				
				<center><h1 style="color:#fff;margin-top: -35px;"> Mobile Application Admin Panel</h1></center>
		
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" style="    margin-top: -35px;">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?=$_SESSION["USER_NAME"]; ?></span>
						<span class="caret"></span>
					</a>
					
					<ul class="dropdown-menu">
						<!--<li><a href="#">Profile</a></li>-->
						<li class="divider"></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<!--<li><a href="welcome.php">Visit Site</a></li>-->
						
					</ul>
				</div>
			</div>
		</div>
	</div>