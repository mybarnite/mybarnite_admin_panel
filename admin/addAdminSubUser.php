<?php 

include("header.php");

include(ROOT_PATH.'business_owner/class/business_owner.php');
include(ROOT_PATH.'business_owner/class/form.php');
$db = new business_owner();
$db->connect();
	if($_POST['back']!="")
	{
		
		header("location:admin_sub_users.php");
	}	
	if($_POST['reset']!="")
	{
		
		header("location:addAdminSubUser.php");
	}	
	if($_POST['updateUser']!="")
	{
		$admin_name = $db->escapeString($_POST['admin_name']);	
		$admin_login_id = $db->escapeString($_POST['admin_login_id']);	
		$admin_password = $db->escapeString($_POST['admin_password']);
		$admin_type = 'sub_user';
		$admin_ip = $_SERVER["REMOTE_ADDR"];
		$admin_status = 'Active';
		$admin_id = $db->escapeString($_SESSION['ID']);
		
		$chkpage = $_POST['chkpage'];
		
		if(!$admin_login_id || strlen($admin_login_id = trim($admin_login_id)) == 0) $form->setError("admin_login_id", "Admin login id can not be empty.");
		else
		{
			$db->select('tbl_admin','*',NULL,'admin_login_id="'.$admin_login_id.'" and id!='.$_GET['id'],'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$rows = $db->numRows();
			if($rows>0)
			{
				$form->setError("admin_login_id", "Admin login id already exists");
			}
		}	
		
		if($form->num_errors >= 1)
		{
					//$_SESSION['value_array'] = $_POST;
					//$_SESSION['error_array'] = $form->getErrorArray();
		}
		else
		{
			
			
			if($admin_password!="")
			{
				$array = array(
				
					'r_id'=>4,
					'admin_name'=>$admin_name,
					'admin_login_id'=>$admin_login_id,
					'admin_password'=>$admin_password,
					'admin_type'=>'sub_user',
					'admin_ip'=>$admin_ip,
					'admin_id'=>$admin_id
					
				);
			}
			else
			{
				$array = array(
				
					'r_id'=>4,
					'admin_name'=>$admin_name,
					'admin_login_id'=>$admin_login_id,
					'admin_type'=>'sub_user',
					'admin_ip'=>$admin_ip,
					'admin_id'=>$admin_id
					
				);
			}		
			
			$db->update('tbl_admin',$array,'id="'.$_GET['id'].'"'); // Table name, column names and values, WHERE conditions
			$res = $db->getResult();
			$lastInserId=@$res[0]['id'];
			
			$to2 = $admin_login_id;
			//$to2 = 'vidhi.scrumbees@gmail.com';
			$subject2 = 'Mybarnite - Account details ';
			$from2 = 'info@mybarnite.com';
			 
			// To send HTML mail, the Content-type header must be set
			$headers2  = 'MIME-Version: 1.0' . "\r\n";
			$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers2 .= 'From: '.$from2."\r\n".
				'Reply-To: '.$from2."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message2 = "<html>";
			$message2 .= "<head><title>Mybarnite</title></head>";
			$message2 .= "<body>";
			$message2 .= "Dear user,<br/>";
			$message2 .= "Your account details has been changed.<br/><br/>";
			$message2 .= "Find your login details as below :<br/><br/>";
			$message2 .= "Url : http://mybarnite.com/admin/login.php<br/>";
			$message2 .= "Email : $admin_login_id<br/>";
			$message2 .= "Password : $admin_password<br/><br/>";
			$message2 .= "Thank you for joining our website.<br/><br/>";
			$message2 .= "Mybarnite Limited<br/>Email: info@mybarnite.com<br/>URL: mybarnite.com<br/><img src='http://mybarnite.com/images/Picture1.png' width='110'>";
			$message2 .= "</body></html>";

			mail($to2, $subject2, $message2, $headers2);
			
			if(!empty($res))
			{
				if(count($chkpage)==0)
				{
					$db->select('tbl_adminStaffPermission','*',NULL,'subuser_id ='.$_GET['id'].' and admin_id = '.$admin_id,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_adminStaffPermission','subuser_id='.$_GET['id'].'  and admin_id='.$admin_id);  // Table name, WHERE conditions
						
						
					}
					$_SESSION['message2']='<div class="alert alert-success">Data has been updated successfully !</div>';
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "admin_sub_users.php";
					}, 2000);

					</script>
					<?php 		
				}
				
				else if(count($chkpage)>0)
				{
					$db->select('tbl_adminStaffPermission','*',NULL,'subuser_id ='.$_GET['id'].' and admin_id = '.$admin_id,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_adminStaffPermission','subuser_id='.$_GET['id'].'  and admin_id='.$admin_id);  // Table name, WHERE conditions
						
					}	
					$i=0;
					foreach($chkpage as $accessPage)
					{
						if($accessPage==1)
						{
							$pagename = 'Manage slider images';
						}
						/* if($accessPage==2)
						{
							$pagename = 'Manage footer banner';
						} */
						if($accessPage==3)
						{
							$pagename = 'Manage static pages';
						}					
						/* if($accessPage==4)
						{
							$pagename = 'Download mobile app';
						}
						 */if($accessPage==5)
						{
							$pagename = 'Business claim management';
						}
						if($accessPage==6)
						{
							$pagename = 'Manage user guide';
						}
						if($accessPage==7)
						{
							$pagename = 'Manage users';
						}
						if($accessPage==8)	
						{
							$pagename = 'Manage events';
						}
						if($accessPage==9)		
						{
							$pagename = 'Manage business owners';
						}
						if($accessPage==10)		
						{
							$pagename = 'Manage business sub users';
						}
						if($accessPage==11)				
						{
							$pagename = 'Manage business profile';
						}	
						if($accessPage==12)				
						{
							$pagename = 'Manage food menu';
						}	
						if($accessPage==13)				
						{
							$pagename = 'Manage orders';
						}	
						if($accessPage==14)				
						{
							$pagename = 'Manage subscriptions';
						}	
						if($accessPage==15)				
						{
							$pagename = 'Manage promotions';
						}	
						if($accessPage==16)				
						{
							$pagename = 'Manage blog';
						}	
						
						$db->insert('tbl_adminStaffPermission',array('subuser_id'=>$_GET['id'],'admin_id'=>$admin_id,'can_access'=>$accessPage,'page_name'=>$pagename));  // Table name, column names and respective values
						$getPermission = $db->getResult(); 	
						$lastId = $getPermission[0];
						$permissions[] = $pagename;
						
						$i++;
					}
					if($i>0)
					{
						$permissionGarnted  = implode(",",$permissions);
						$to1 = $admin_login_id;
						//$to1 = 'vidhi.scrumbees@gmail.com';
						$subject1 = 'Mybarnite - Permission details ';
						$from1 = 'info@mybarnite.com';
						 
						// To send HTML mail, the Content-type header must be set
						$headers1  = 'MIME-Version: 1.0' . "\r\n";
						$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						 
						// Create email headers
						$headers1 .= 'From: '.$from1."\r\n".
							'Reply-To: '.$from1."\r\n" .
							'X-Mailer: PHP/' . phpversion();
						 
						// Compose a simple HTML email message
						$message1 = "<html>";
						$message1 .= "<head><title>Mybarnite</title></head>";
						$message1 .= "<body>";
						$message1 .= "Dear user,<br/>";
						$message1 .= "You can access below features,<br/><br/>";
						$message1 .= "$permissionGarnted<br/><br/>";
						$message1 .= "Thank you for joining our website.\n\n";
						$message1 .= "<p>Mybarnite Limited</p><p>Email: info@mybarnite.com</p><p>URL: mybarnite.com</p><p><img src='http://mybarnite.com/images/Picture1.png' width='110'></p>";
						$message1 .= "</body></html>";

						mail($to1, $subject1, $message1, $headers1);
						$_POST = array();
						$_SESSION['message2']='<div class="alert alert-success">Data has been updated successfully !</div>';
					}
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "admin_sub_users.php";
					}, 2000);

					</script>
					<?php 	
						
				}	
				
			}	
			else
			{
				$_SESSION['message2']='<div class="alert alert-danger">Data can not be added !</div>';
			}	
		}
	}

if($_POST['AddUser']!="")
	{
		
		$admin_name = $db->escapeString($_POST['admin_name']);	
		$admin_login_id = $db->escapeString($_POST['admin_login_id']);	
		$admin_password = $db->escapeString($_POST['admin_password']);
		$admin_type = 'sub_user';
		$admin_ip = $_SERVER["REMOTE_ADDR"];
		$admin_status = 'Active';
		$admin_id = $db->escapeString($_SESSION['ID']);
		$chkpage = $_POST['chkpage'];
					
			/*  echo "<pre>";
			print_r($_POST); exit;  */
		
		if(!$admin_login_id || strlen($admin_login_id = trim($admin_login_id)) == 0) $form->setError("admin_login_id", "Admin login id can not be empty.");
		else
		{
			$db->select('tbl_admin','*',NULL,'admin_login_id="'.$admin_login_id.'"','id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$rows = $db->numRows();
			if($rows>0)
			{
				$form->setError("admin_login_id", "Admin login id already exists");
			}
		}	
		
		
		if($admin_password)
		{
			if(strlen($admin_password = trim($admin_password)) < 6) $form->setError("admin_password", "Passoword too short");
		}
		else $form->setError("admin_password", "Password not entered");
		
		if($form->num_errors >=1)
		{
					//$_SESSION['value_array'] = $_POST;
					//$_SESSION['error_array'] = $form->getErrorArray();
		}
		else
		{
			$db->insert('tbl_admin',array('r_id'=>'4','admin_name'=>$admin_name,'admin_login_id'=>$admin_login_id,'admin_password'=>$admin_password,'admin_type'=>$admin_type,'admin_ip'=>$admin_ip,'admin_status'=>$admin_status,'admin_id'=>$admin_id));  // Table name, column names and respective values
			$res = $db->getResult(); 

			$lastInserId = $res[0];
			if($lastInserId>0)
			{
				if(count($chkpage)==0)
				{
					$db->select('tbl_adminStaffPermission','*',NULL,'subuser_id ='.$lastInserId.' and admin_id = '.$admin_id,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_adminStaffPermission','subuser_id='.$lastInserId.'  and admin_id='.$admin_id);  // Table name, WHERE conditions
						
					}	
					$_SESSION['message2']='<div class="alert alert-success">Data has been added successfully !</div>';
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "admin_sub_users.php";
					}, 2000);

					</script>
					<?php 	
				}	
				else if(count($chkpage)>0)
				{
					$db->select('tbl_adminStaffPermission','*',NULL,'subuser_id ='.$lastInserId.' and admin_id = '.$admin_id,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					
					
					if($countPermission>0)
					{
						$db->delete('tbl_adminStaffPermission','subuser_id='.$lastInserId.'  and admin_id='.$admin_id);  // Table name, WHERE conditions
						
					}	
					$i=0;
					foreach($chkpage as $accessPage)
					{
						if($accessPage==1)
						{
							$pagename = 'Manage slider images';
						}
						/* if($accessPage==2)
						{
							$pagename = 'Manage footer banner';
						}
						 */if($accessPage==3)
						{
							$pagename = 'Manage static pages';
						}					
						/* if($accessPage==4)
						{
							$pagename = 'Download mobile app';
						}
						 */if($accessPage==5)
						{
							$pagename = 'Business claim management';
						}
						if($accessPage==6)
						{
							$pagename = 'Manage user guide';
						}
						if($accessPage==7)
						{
							$pagename = 'Manage users';
						}
						if($accessPage==8)	
						{
							$pagename = 'Manage events';
						}
						if($accessPage==9)		
						{
							$pagename = 'Manage business owners';
						}
						if($accessPage==10)		
						{
							$pagename = 'Manage business sub users';
						}
						if($accessPage==11)				
						{
							$pagename = 'Manage business profile';
						}	
						if($accessPage==12)				
						{
							$pagename = 'Manage food menu';
						}	
						if($accessPage==13)				
						{
							$pagename = 'Manage orders';
						}	
						if($accessPage==14)				
						{
							$pagename = 'Manage subscriptions';
						}	
						if($accessPage==15)				
						{
							$pagename = 'Manage promotions';
						}	
						if($accessPage==16)				
						{
							$pagename = 'Manage blog';
						}	
						$db->insert('tbl_adminStaffPermission',array('subuser_id'=>$lastInserId,'admin_id'=>$admin_id,'can_access'=>$accessPage,'page_name'=>$pagename));  // Table name, column names and respective values
						$getPermission = $db->getResult(); 	
						$lastId = $getPermission[0];
						$i++;
					}
					if($i>0)
					{
						
						$to1 = $admin_login_id;
						//$to1 = 'vidhi.scrumbees@gmail.com';
						$subject1 = 'Mybarnite - Login details ';
						$from1 = 'info@mybarnite.com';
						 
						// To send HTML mail, the Content-type header must be set
						$headers1  = 'MIME-Version: 1.0' . "\r\n";
						$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						 
						// Create email headers
						$headers1 .= 'From: '.$from1."\r\n".
							'Reply-To: '.$from1."\r\n" .
							'X-Mailer: PHP/' . phpversion();
						 
						// Compose a simple HTML email message
						$message1 = "<html>";
						$message1 .= "<head><title>Mybarnite</title></head>";
						$message1 .= "<body>";
						$message1 .= "Dear user,<br/>";
						$message1 .= "Your account has been created successfully!<br/><br/>";
						$message1 .= "Find your login details as below :<br/><br/>";
						$message1 .= "Url : http://mybarnite.com/admin/login.php<br/>";
						$message1 .= "Email : $admin_login_id<br/>";
						$message1 .= "Password : $admin_password<br/><br/>";
						$message1 .= "Thank you for joining our website.\n\n";
						$message1 .= "<p>Mybarnite Limited</p><p>Email: info@mybarnite.com</p><p>URL: mybarnite.com</p><p><img src='http://mybarnite.com/images/Picture1.png' width='110'></p>";
						$message1 .= "</body></html>";

						mail($to1, $subject1, $message1, $headers1);
						$_POST = array();
						$_SESSION['message2']='<div class="alert alert-success">Data has been added successfully !</div>';
					}
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "admin_sub_users.php";
					}, 2000);

					</script>
					<?php 	
				}	
				
			}	
			else
			{
				$_SESSION['message2']='<div class="alert alert-danger">Data can not be added !</div>';
			}	
		}
	}	

?>

<!-- ajax script start -->
<script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
<link href="css/Loader.css" rel="stylesheet">
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
						<h2><i class="icon-edit"></i>&nbsp;Add admin sub user</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
						<table align="center" width="100%" >
						<tr><td align="center" style="color:#F00;"><strong><?php
						
						if(isset($_SESSION['message2']))
						{
							echo $_SESSION['message2'];
							unset($_SESSION['message2']);
						}
						
						?></strong></td></tr>
						</table>
						 <form name="addSubUser" action="" id="addSubUser" method="post">
							<table align="center" width="80%" >
								<?php 
								if($_GET['id']!="")
								{
									$sql = "SELECT a.*, GROUP_CONCAT( DISTINCT b.can_access) as permissions FROM tbl_admin AS a LEFT JOIN  tbl_adminStaffPermission AS b ON FIND_IN_SET( b.subuser_id, a.id ) where a.id = ".$_GET['id']." and a.r_id = 4 GROUP BY id";	
									$res = $db->myconn->query($sql);
									$res1 = $res->fetch_assoc();
									
									$permission = explode(",",$res1['permissions']);
									
								?>	
								
								<tr>
									<td ><label class="control-label" for="typeahead">Admin name </label></td>
									<td>
										<input type="text" class="span6 typeahead"  name="admin_name" id="admin_name" value="<?php echo ($_POST['admin_name'])?$_POST['admin_name']:$res1['admin_name'];?>" size="40" />
										
									</td>
								</tr>
								<tr >
									<td ><label class="control-label" for="typeahead">Admin login id <span style="color:red;">*</span></label></td>
									<td>
										<input type="email" class="span6 typeahead"  name="admin_login_id" id="admin_login_id" value="<?php echo ($_POST['admin_login_id'])?$_POST['admin_login_id']:$res1['admin_login_id'];?>" size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("admin_login_id"); ?></p>
									</td>
								</tr>
							 
								<tr>
									<td><label class="control-label" for="typeahead">Password <span style="color:red;">*</span></label></td>
									<td>
										<input type="password" class="span6 typeahead"  name="admin_password" id="admin_password"  size="40" />
										
									</td>	
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Permission </label></td>
									<td>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="1" <?php if (in_array("1", $permission)){?> checked="checked" <?php }?>> Manage slider images</label>
										</div>	
										<?php /*
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="2" <?php if (in_array("2", $permission)){?> checked="checked" <?php }?>> Manage footer banner</label>
										</div>
										*/?>
										<div class= "checkbox">					
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="3" <?php if (in_array("3", $permission)){?> checked="checked" <?php }?>> Manage static pages</label>
										</div>
										<?php /*
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="4" <?php if (in_array("4", $permission)){?> checked="checked" <?php }?>> Download mobile app</label>
										</div>
										*/?>
										<div class= "checkbox">	
										<!-- New claim for business tab -->
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="5" <?php if (in_array("5", $permission)){?> checked="checked" <?php }?>> Business claim management</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="6" <?php if (in_array("6", $permission)){?> checked="checked" <?php }?>> Maneg user guide</label>
										</div>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="7" <?php if (in_array("7", $permission)){?> checked="checked" <?php }?>> Manage users</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="8" <?php if (in_array("8", $permission)){?> checked="checked" <?php }?>> Manage events</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="9" <?php if (in_array("9", $permission)){?> checked="checked" <?php }?>> Manage business owners</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="10" <?php if (in_array("10", $permission)){?> checked="checked" <?php }?>> Manage business sub users</label>
										</div>	
										<div class= "checkbox">	
										<!-- Bar profile -->
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="11" <?php if (in_array("11", $permission)){?> checked="checked" <?php }?>> Manage business profile</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="12" <?php if (in_array("12", $permission)){?> checked="checked" <?php }?>> Manage food menu</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="13" <?php if (in_array("13", $permission)){?> checked="checked" <?php }?>> Manage orders</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="14" <?php if (in_array("14", $permission)){?> checked="checked" <?php }?>> Manage subscriptions</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="15" <?php if (in_array("15", $permission)){?> checked="checked" <?php }?>> Manage promotions</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="16" <?php if (in_array("16", $permission)){?> checked="checked" <?php }?>> Manage blog</label>
										</div>	
									</td>	
								</tr>
							
								<tr>
									<td><label class="control-label" for="typeahead">&nbsp;</label></td>
									<td>
										<input type="submit" name="updateUser" id="updateUser"  class="btn btn-primary" value="Update user" />
										<input type="submit" name="back" class="btn btn-primary" value="Back" />
									</td>
								</tr>
								<?php
								}else
								{	
								?>
								
								<tr>
									<td ><label class="control-label" for="typeahead">Admin name </label></td>
									<td>
										<input type="text" class="span6 typeahead"  name="admin_name" id="admin_name" value="<?php echo ($_POST['admin_name'])?$_POST['admin_name']:''?>"  size="40" />
										
									</td>
								</tr>
								<tr >
									<td ><label class="control-label" for="typeahead">Admin login id <span style="color:red;">*</span></label></td>
									<td>
										<input type="email" class="span6 typeahead"  name="admin_login_id" id="admin_login_id" value="<?php echo ($_POST['admin_login_id'])?$_POST['admin_login_id']:''?>" size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("admin_login_id"); ?></p>
									</td>
								</tr>
							 
								<tr>
									<td><label class="control-label" for="typeahead">Password <span style="color:red;">*</span></label></td>
									<td>
										<input type="password" class="span6 typeahead"  name="admin_password" id="admin_password"  size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("admin_password"); ?></p>
									</td>	
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Permission </label></td>
									<td>
										
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="1" <?php if (in_array("1", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage slider images</label>
										</div>
										<?php /*
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="2" <?php if (in_array("2", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage footer banner</label>
										</div>
										*/?>
										<div class= "checkbox">					
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="3" <?php if (in_array("3", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage static pages</label>
										</div>
										<?php /*
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="4" <?php if (in_array("4", $_POST['chkpage'])){?> checked="checked" <?php }?>> Download mobile app</label>
										</div>
										*/?>
										<div class= "checkbox">	
										<!-- New claim for business tab -->
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="5" <?php if (in_array("5", $_POST['chkpage'])){?> checked="checked" <?php }?>> Business claim management</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="6" <?php if (in_array("6", $_POST['chkpage'])){?> checked="checked" <?php }?>> Maneg user guide</label>
										</div>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="7" <?php if (in_array("7", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage users</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="8" <?php if (in_array("8", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage events</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="9" <?php if (in_array("9", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage business owners</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="10" <?php if (in_array("10", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage business sub users</label>
										</div>	
										<div class= "checkbox">	
										<!-- Bar profile -->
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="11" <?php if (in_array("11", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage business profile</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="12" <?php if (in_array("12", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage food menu</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="13" <?php if (in_array("13", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage orders</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="14" <?php if (in_array("14", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage subscriptions</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="15" <?php if (in_array("15", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage promotions</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="16" <?php if (in_array("16", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage blog</label>
										</div>	
									</td>	
								</tr>
							
								<tr>
									<td><label class="control-label" for="typeahead">&nbsp;</label></td>
									<td>
										<input type="submit" name="AddUser" id="AddUser"  class="btn btn-primary" value="Add user" />
										<input type="submit" name="reset" id="reset"  class="btn" value="Reset" />
									</td>
								</tr>
								<?php
								}
								?>
							</table>
						</form>

					</div>
				</div><!--/span-->

			</div>
			
		</div><!--/#content.span10-->
</div><!--/fluid-row-->
			
<hr>

<?php include("footer.php");?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script type="text/javascript">


function resetFields()
{
	window.location.href = 'addAdminSubUser.php';
}



</script> 	 
</body>
</html>
