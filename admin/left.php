<?php if($_REQUEST['taa'])
{
	?>

<div class="span2 main-menu-span">
<div class="well nav-collapse sidebar-nav">



<!--<li><a class="ajax-link" href="manage_member.php"><span class="hidden-tablet">Manage Member</span></a></li>
<li><a class="ajax-link" href="manage_adver.php"><span class="hidden-tablet">Manage Advertisement</span></a></li>
-->

    <ul class="nav nav-tabs nav-stacked main-menu">
<li class="nav-header hidden-tablet" style=" color:#FFF">Manage Contractor Website</li>

<li><a class="ajax-link" href="contmanage_static_page.php?t=true"><span class="hidden-tablet">Manage Static Page</span></a></li>
<li><a class="ajax-link" href="manage_contractornews.php?t=true"><span class="hidden-tablet">Manage News</span></a></li>
<li><a class="ajax-link" href="manage_contractorgallery.php?t=true"><span class="hidden-tablet">Manage Gallery</span></a></li>
<li><a class="ajax-link" href="manage_contractoregister.php?t=true"><span class="hidden-tablet">Manage Ragister User</span></a></li>
<li><a class="ajax-link" href="manage_contractorschool.php?t=true"><span class="hidden-tablet">Manage School(Join Us)</span></a></li>

</ul></div>


</div>


<?php
}
else
{
?>



	<div class="span2 main-menu-span">
		<div class="well nav-collapse sidebar-nav"> 
		<?php 
		if(isset($_SESSION['ID'])&&!isset($_SESSION['SUBUSER_ID']))
		{	
		?>	
			<ul class="nav nav-tabs nav-stacked main-menu">
				<li class="nav-header hidden-tablet">Main</li>
				<li><a class="ajax-link" href="slider.php"><span class="hidden-tablet">Slider Images</span></a></li>
				<!--<li><a class="ajax-link" href="slider2.php"><span class="hidden-tablet">Slider 2 Images</span></a></li>-->
				<li><a class="ajax-link" href="maincontent.php"><span class="hidden-tablet">Manage Mybarnite Contents</span></a></li>
				<!--<li><a class="ajax-link" href="downloadmobileapp.php"><span class="hidden-tablet">Download Mobile App</span></a></li>-->
				<li><a class="ajax-link" href="newBusinessClaims.php"><span class="hidden-tablet">New claims for business</span></a></li>
				<li><a class="ajax-link" href="uploadUserGuide.php"><span class="hidden-tablet">Upload user guide</span></a></li>
				<li><a class="ajax-link" href="user_list.php"><span class="hidden-tablet">Manage Users and Visitors</span></a></li>
				<li><a class="ajax-link" href="event_list.php"><span class="hidden-tablet">Manage Business Events</span></a></li>
				<li><a class="ajax-link" href="specialevent.php"><span class="hidden-tablet">Manage Special Events</span></a></li>
				<li><a class="ajax-link" href="latestevents.php"><span class="hidden-tablet">Manage Latest Events</span></a></li>
				<li><a class="ajax-link" href="upcomingevents.php"><span class="hidden-tablet">Manage Upcoming Events</span></a></li>
				<li><a class="ajax-link" href="business_owener_list.php"><span class="hidden-tablet">Manage Business Users</span></a></li>
				<li><a class="ajax-link" href="business_sub_users.php"><span class="hidden-tablet">Manage business sub users</span></a></li>
				<li><a class="ajax-link" href="admin_sub_users.php"><span class="hidden-tablet">My Mybarnite Staff</span></a></li>
				<li><a class="ajax-link" href="addnewbar.php"><span class="hidden-tablet">Register New Business</span></a></li>
				<li><a class="ajax-link" href="bar_lists.php"><span class="hidden-tablet">Manage Business Sales</span></a></li>
				<li><a class="ajax-link" href="bar_menu.php"><span class="hidden-tablet">Menu Management</span></a></li>
				<li><a class="ajax-link" href="order_history.php"><span class="hidden-tablet">Manage Order History</span></a></li>
				<li><a class="ajax-link" href="subscriptions.php"><span class="hidden-tablet">Subscriptions</span></a></li>
				<li><a class="ajax-link" href="promotions.php"><span class="hidden-tablet">Promotions</span></a></li>
				<li><a class="ajax-link" href="blogs.php"><span class="hidden-tablet">Manage blog</span></a></li>
				<!--<li><a class="ajax-link" href="bottombanner.php"><span class="hidden-tablet">Footer Banner</span></a></li>
				<li><a class="ajax-link" href="deleteAccountRequest.php"><div class="hidden-tablet" >Manage Requests <span id="deleteRequestCounter" style="color:brown;">(0)</span></div></a></li>-->
				<li><a class="ajax-link" href="change_admin_password.php"><span class="hidden-tablet">Change Admin Password</span></a></li>
				<li><a class="ajax-link" href="settings.php"><span class="hidden-tablet">Manage Business Commission</span></a></li>
			</ul>
		<?php 
		}
		else if(isset($_SESSION['ID'])&&isset($_SESSION['SUBUSER_ID']))
		{
			$query = "select s.can_access from tbl_admin as a join tbl_adminStaffPermission as s on a.id = s.subuser_id where s.subuser_id = ".$_SESSION['SUBUSER_ID'];
			$exe = mysql_query($query);
			while($accessiblePages = mysql_fetch_assoc($exe))
			{
				$accessiblePage[] = $accessiblePages['can_access'];
			}	
			
		?>	
			<ul class="nav nav-tabs nav-stacked main-menu">
				<li class="nav-header hidden-tablet">Main</li>
				<?php
				/* echo "<pre>";
				print_r($accessiblePage); */
				?>
				<?php if (in_array("1", $accessiblePage)){?><li><a class="ajax-link" href="slider.php"><span class="hidden-tablet">Slider Images</span></a></li><?php }?>
				<?php if (in_array("1", $accessiblePage)){?><li><a class="ajax-link" href="slider2.php"><span class="hidden-tablet">Slider 2 Images</span></a></li><?php }?>
				<?php if (in_array("3", $accessiblePage)){?><li><a class="ajax-link" href="maincontent.php"><span class="hidden-tablet">Manage Mybarnite Contents</span></a></li><?php }?>
				<?php if (in_array("4", $accessiblePage)){?><li><a class="ajax-link" href="downloadmobileapp.php"><span class="hidden-tablet">Download Mobile App</span></a></li><?php }?>
				<?php if (in_array("5", $accessiblePage)){?><li><a class="ajax-link" href="newBusinessClaims.php"><span class="hidden-tablet">New claims for business</span></a></li><?php }?>
				<?php if (in_array("6", $accessiblePage)){?><li><a class="ajax-link" href="uploadUserGuide.php"><span class="hidden-tablet">Upload user guide</span></a></li><?php }?>
				<?php if (in_array("7", $accessiblePage)){?><li><a class="ajax-link" href="user_list.php"><span class="hidden-tablet">Manage Users and Vistitors</span></a></li><?php }?>
				<?php if (in_array("8", $accessiblePage)){?><li><a class="ajax-link" href="event_list.php"><span class="hidden-tablet">Manage Business Events</span></a></li><?php }?>
				<?php if (in_array("8", $accessiblePage)){?><li><a class="ajax-link" href="specialevent.php"><span class="hidden-tablet">Manage Special Events</span></a></li><?php }?>
				<?php if (in_array("8", $accessiblePage)){?><li><a class="ajax-link" href="latestevents.php"><span class="hidden-tablet">Manage Latest Events</span></a></li><?php }?>
				<?php if (in_array("8", $accessiblePage)){?><li><a class="ajax-link" href="upcomingevents.php"><span class="hidden-tablet">Manage Upcoming Events</span></a></li><?php }?>
				<?php if (in_array("9", $accessiblePage)){?><li><a class="ajax-link" href="business_owener_list.php"><span class="hidden-tablet">Manage Business Users</span></a></li><?php }?>
				<?php if (in_array("10", $accessiblePage)){?><li><a class="ajax-link" href="business_sub_users.php"><span class="hidden-tablet">Manage business sub users</span></a></li><?php }?>
				<?php if (in_array("11", $accessiblePage)){?><li><a class="ajax-link" href="addnewbar.php"><span class="hidden-tablet">Register New Business</span></a></li><?php }?>
				<?php if (in_array("11", $accessiblePage)){?><li><a class="ajax-link" href="bar_lists.php"><span class="hidden-tablet">Manage Business Sales</span></a></li><?php }?>
				<?php if (in_array("12", $accessiblePage)){?><li><a class="ajax-link" href="bar_menu.php"><span class="hidden-tablet">Menu Management</span></a></li><?php }?>
				<?php if (in_array("13", $accessiblePage)){?><li><a class="ajax-link" href="order_history.php"><span class="hidden-tablet">Manage Order History</span></a></li><?php }?>
				<?php if (in_array("14", $accessiblePage)){?><li><a class="ajax-link" href="subscriptions.php"><span class="hidden-tablet">Subscriptions</span></a></li><?php }?>
				<?php if (in_array("15", $accessiblePage)){?><li><a class="ajax-link" href="promotions.php"><span class="hidden-tablet">Promotions</span></a></li><?php }?>
				<?php if (in_array("16", $accessiblePage)){?><li><a class="ajax-link" href="blogs.php"><span class="hidden-tablet">Manage blog</span></a></li><?php }?>
				
				<?php if (in_array("2", $accessiblePage)){?><li><a class="ajax-link" href="bottombanner.php"><span class="hidden-tablet">Footer Banner</span></a></li><?php }?>
				
			</ul>	
		<?php	
		}	
		?>	
		</div>
	</div>
<?php
}
?>

