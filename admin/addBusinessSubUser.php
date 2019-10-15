<?php 
include("header.php");

include(ROOT_PATH.'business_owner/class/business_owner.php');
include(ROOT_PATH.'business_owner/class/form.php');
$db = new business_owner();
$db->connect();

	if($_POST['reset']!="")
	{
		
		header("location:addBusinessSubUser.php");
	}	
	if($_POST['back']!="")
	{
		
		header("location:business_sub_users.php");
	}	
	
	if($_POST['updateUser']!="")
	{
		$name = $db->escapeString($_POST['name']);	
		$email = $db->escapeString($_POST['email']);
		$password = $db->escapeString($_POST['password']);
		$chkpage = $_POST['chkpage'];
		$barId = $db->escapeString($_POST['barId']);
		
		/* echo "<pre>";
		print_r($_POST);
		exit; */
		if(!$name || strlen($name = trim($name)) == 0) $form->setError("name", "Name can not be empty.");
		else
		{
			$db->select('user_register','*',NULL,'name="'.$name.'" and id!='.$_GET['id'],'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$rows = $db->numRows();
			if($rows>0)
			{
				$form->setError("name", "User name already exists");
			}
		}	
		if(!$email || strlen($email = trim($email)) == 0) $form->setError("email", "Email can not be empty.");
		else
		{
			$db->select('user_register','*',NULL,'email="'.$email.'" and id!='.$_GET['id'],'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$rows = $db->numRows();
			if($rows>0)
			{
				$form->setError("email", "Email already exists");
			}
		}
		if($form->num_errors >= 1)
		{
					//$_SESSION['value_array'] = $_POST;
					//$_SESSION['error_array'] = $form->getErrorArray();
		}
		else
		{
			
			if($password!="")
			{
				$array = array(
				
					'r_id'=>3,
					'name'=>$name,
					'email'=>$email,
					'password'=>$password,
					'activation_key'=>'',
					'bar_id'=>$barId
					
				);
			}
			else
			{
				$array = array(
				
					'r_id'=>3,
					'name'=>$name,
					'email'=>$email,
					'activation_key'=>'',
					'bar_id'=>$barId
					
				);
			}		
			
			$db->update('user_register',$array,'id="'.$_GET['id'].'"'); // Table name, column names and values, WHERE conditions
			$res = $db->getResult();
			$lastInserId=@$res[0]['id'];
			
			if(!empty($res))
			{
				$i=0;
				if(count($chkpage)==0)
				{
					$db->select('tbl_staffPermission','*',NULL,'subuser_id ='.$_GET['id'].' and bar_id = '.$barId,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_staffPermission','subuser_id='.$_GET['id'].'  and bar_id='.$barId);  // Table name, WHERE conditions
						
					}
					$_POST = array();
					$_SESSION['message2']='<div class="alert alert-success">Data has been updated successfully !</div>';	
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "business_sub_users.php";
					}, 2000);

					</script>
					<?php
				}	
				else if(count($chkpage)>0)
				{
					$db->select('tbl_staffPermission','*',NULL,'subuser_id ='.$_GET['id'].' and bar_id = '.$barId,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_staffPermission','subuser_id='.$_GET['id'].'  and bar_id='.$barId);  // Table name, WHERE conditions
						
					}	
					
					foreach($chkpage as $accessPage)
					{
						if($accessPage==1)
						{
							$pagename = 'Bar profile';
						}
						if($accessPage==2)
						{
							$pagename = 'Gallery';
						}
						if($accessPage==3)
						{
							$pagename = 'Event management';
						}					
						if($accessPage==4)
						{
							$pagename = 'Food management';
						}
						if($accessPage==5)
						{
							$pagename = 'Subscription';
						}
						if($accessPage==6)
						{
							$pagename = 'Order management';
						}
						if($accessPage==7)
						{
							$pagename = 'Sales';
						}
						if($accessPage==8)	
						{
							$pagename = 'Promotion';
						}
						if($accessPage==9)		
						{
							$pagename = 'Account';
						}
						if($accessPage==10)		
						{
							$pagename = 'User guide';
						}
						if($accessPage==11)				
						{
							$pagename = 'Profile settings';
						}
						if($accessPage==12)				
						{
							$pagename = 'Manage blog';
						}		
						$db->insert('tbl_staffPermission',array('subuser_id'=>$_GET['id'],'bar_id'=>$barId,'can_access'=>$accessPage,'page_name'=>$pagename));  // Table name, column names and respective values
						$getPermission = $db->getResult(); 	
						$lastId = $getPermission[0];
						$permissions[] = $pagename;
						
						$i++;
					}
					if($i>0)
					{
						$permissionGarnted  = implode(",",$permissions);
						$to1 = $email;
						//$to1 = 'vidhi.patel@scrumbees.com';
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
						$message1 .= "<p>Mybarnite Limited</p><p>EMail: info@mybarnite.com</p><p>URL: mybarnite.com</p><p><img src='http://mybarnite.com/images/Picture1.png' width='110'></p>";
						$message1 .= "</body></html>";

						mail($to1, $subject1, $message1, $headers1);
						$_POST = array();
						$_SESSION['message2']='<div class="alert alert-success">Data has been updated successfully !</div>';
					}
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "business_sub_users.php";
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
		
		$name = $db->escapeString($_POST['name']);	
		$email = $db->escapeString($_POST['email']);
		$password = $db->escapeString($_POST['password']);
		$chkpage = $_POST['chkpage'];
		$barId = $db->escapeString($_POST['barId']);
		if(!$name || strlen($name = trim($name)) == 0) $form->setError("name", "Name can not be empty.");
		else
		{
			$db->select('user_register','*',NULL,'name="'.$name.'"','id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$rows = $db->numRows();
			if($rows>0)
			{
				$form->setError("name", "User name already exists");
			}
		}	
		if(!$email || strlen($email = trim($email)) == 0) $form->setError("email", "Email can not be empty.");
		else
		{
			$db->select('user_register','*',NULL,'email="'.$email.'" ','id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
			$rows = $db->numRows();
			if($rows>0)
			{
				$form->setError("email", "Email already exists");
			}
		}
		
		if($password)
		{
			if(strlen($password = trim($password)) < 6) $form->setError("password", "Password too short");
		}
		else $form->setError("password", "Password not entered");
		
		if($form->num_errors >=1)
		{
					//$_SESSION['value_array'] = $_POST;
					//$_SESSION['error_array'] = $form->getErrorArray();
		}
		else
		{
			$db->insert('user_register',array('r_id'=>'3','name'=>$name,'email'=>$email,'password'=>$password,'status'=>'Active','activation_key'=>'','bar_id'=>$barId));  // Table name, column names and respective values
			$res = $db->getResult(); 
			/* echo "<pre>";
			print_r($res); */
			$lastInserId = $res[0];
			
			if($lastInserId>0)
			{	
			
				$i=0;
				
				$resetpasskey = md5($lastInserId);
				$db->update('user_register',array('resetpasskey'=>"$resetpasskey"),'id= "'.$lastInserId.'" and email="'.$email.'" and status="Active" and r_id="3"');
				if(count($chkpage)==0)
				{
					$db->select('tbl_staffPermission','*',NULL,'subuser_id ='.$lastInserId.' and bar_id = '.$barId,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_staffPermission','subuser_id='.$lastInserId.'  and bar_id='.$barId);  // Table name, WHERE conditions
						
					}
					$_POST = array();
					$_SESSION['message2']='<div class="alert alert-success">Data has been added successfully !</div>';	
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "business_sub_users.php";
					}, 2000);

					</script>
					<?php
				}	
				else if(count($chkpage)>0)
				{
					$db->select('tbl_staffPermission','*',NULL,'subuser_id ='.$lastInserId.' and bar_id = '.$barId,'id DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
					$countPermission = $db->numRows();
					if($countPermission>0)
					{
						$db->delete('tbl_staffPermission','subuser_id='.$lastInserId.'  and bar_id='.$barId);  // Table name, WHERE conditions
						
					}	
					
					foreach($chkpage as $accessPage)
					{
						if($accessPage==1)
						{
							$pagename = 'Bar profile';
						}
						if($accessPage==2)
						{
							$pagename = 'Gallery';
						}
						if($accessPage==3)
						{
							$pagename = 'Event management';
						}					
						if($accessPage==4)
						{
							$pagename = 'Food management';
						}
						if($accessPage==5)
						{
							$pagename = 'Subscription';
						}
						if($accessPage==6)
						{
							$pagename = 'Order management';
						}
						if($accessPage==7)
						{
							$pagename = 'Sales';
						}
						if($accessPage==8)	
						{
							$pagename = 'Promotion';
						}
						if($accessPage==9)		
						{
							$pagename = 'Account';
						}
						if($accessPage==10)		
						{
							$pagename = 'User guide';
						}
						if($accessPage==11)				
						{
							$pagename = 'Profile settings';
						}
						if($accessPage==12)				
						{
							$pagename = 'Manage blog';
						}
						$db->insert('tbl_staffPermission',array('subuser_id'=>$lastInserId,'bar_id'=>$barId,'can_access'=>$accessPage,'page_name'=>$pagename));  // Table name, column names and respective values
						$getPermission = $db->getResult(); 	
						$lastId = $getPermission[0];
						$i++;
					}
					if($i>0)
					{
						
						$to1 = $email;
						//$to1 = 'vidhi.patel@scrumbees.com';
						$subject1 = 'Mybarnite - Reset Password ';
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
						$message1 .= "Dear User,<br/><br/>";
						$message1 .= "Your account has been created successfully!<br/><br/>";
						$message1 .= "You can set your password using below link :<br/><br/>";
						$message1 .= SITE_PATH . "business_owner/resetpassword.php?id=$resetpasskey<br/><br/>";
						$message1 .= "Thank you for joining our website.\n\n";
						$message1 .= "Mybarnite Limited<br/>Email: info@mybarnite.com<br/>URL: mybarnite.com<br/><img src='http://mybarnite.com/images/Picture1.png' width='110'>";
						$message1 .= "</body></html>";

						mail($to1, $subject1, $message1, $headers1);
						$_POST = array();
						$_SESSION['message2']='<div class="alert alert-success">Data has been added successfully !</div>';
					}
					?>
					<script>
					window.setTimeout(function(){
						window.location.href = "business_sub_users.php";
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
						<h2><i class="icon-edit"></i>&nbsp;Add business user</h2>
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
									$sql = "SELECT a.*, GROUP_CONCAT( DISTINCT b.can_access) as permissions FROM user_register AS a LEFT JOIN  tbl_staffPermission AS b ON FIND_IN_SET( b.subuser_id, a.id ) where a.id = ".$_GET['id']." and a.r_id = 3 GROUP BY id";	
									$res = $db->myconn->query($sql);
									$res1 = $res->fetch_assoc();
									
									$permission = explode(",",$res1['permissions']);
									
								?>	
								<tr>
									<td ><label class="control-label" for="typeahead">Choose bar <span style="color:red;">*</span></label></td>
									<td>
										<?php 
												$q="select id,Business_Name from bars_list where id=".$res1['bar_id'];
												$exe = mysql_query($q);
												$row = mysql_fetch_array($exe)
										?>
										<input type="hidden"  name="barId" id="barId" value="<?php echo $row['id'];?>" size="40"/>
										<input type="text" class="span6 typeahead"  name="barname" id="barname" value="<?php echo ($_POST['barname'])?$_POST['barname']:$row['Business_Name'];?>" size="40" readonly/>
										
									</td>
								</tr>
								<tr>
									<td ><label class="control-label" for="typeahead">Name <span style="color:red;">*</span></label></td>
									<td>
										<input type="text" class="span6 typeahead"  name="name" id="name" value="<?php echo ($_POST['name'])?$_POST['name']:$res1['name'];?>" size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("name"); ?></p>
									</td>
								</tr>
								<tr >
									<td ><label class="control-label" for="typeahead">Email <span style="color:red;">*</span></label></td>
									<td>
										<input type="email" class="span6 typeahead"  name="email" id="email" value="<?php echo ($_POST['email'])?$_POST['email']:$res1['email'];?>" size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("email"); ?></p>
									</td>
								</tr>
							 
								<tr>
									<td><label class="control-label" for="typeahead">Password <span style="color:red;">*</span></label></td>
									<td>
										<input type="password" class="span6 typeahead"  name="password" id="password"  size="40" />
										
									</td>	
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Permission </label></td>
									<td>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="1" <?php if (in_array("1", $permission)){?> checked="checked" <?php }?>> Bar profile</label>
										</div>	
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="2" <?php if (in_array("2", $permission)){?> checked="checked" <?php }?>> Gallery</label>
										</div>
										<div class= "checkbox">					
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="3" <?php if (in_array("3", $permission)){?> checked="checked" <?php }?>> Event management</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="4" <?php if (in_array("4", $permission)){?> checked="checked" <?php }?>> Food management</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="5" <?php if (in_array("5", $permission)){?> checked="checked" <?php }?>> Subscription</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="6" <?php if (in_array("6", $permission)){?> checked="checked" <?php }?>> Order management</label>
										</div>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="7" <?php if (in_array("7", $permission)){?> checked="checked" <?php }?>> Sales</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="8" <?php if (in_array("8", $permission)){?> checked="checked" <?php }?>> Promotion</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="9" <?php if (in_array("9", $permission)){?> checked="checked" <?php }?>> Account</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="10" <?php if (in_array("10", $permission)){?> checked="checked" <?php }?>> User guide</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="12" <?php if (in_array("12", $permission)){?> checked="checked" <?php }?>> Manage blog</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="11" <?php if (in_array("11", $permission)){?> checked="checked" <?php }?>> Profile settings</label>
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
									<td ><label class="control-label" for="typeahead">Choose bar <span style="color:red;">*</span></label></td>
									<td>
										<select name="barId" required>
											<option value="">Select any</option>
									<?php 
									$q="select id,Business_Name from bars_list where Owner_id!=0";
									$exe = mysql_query($q);
									while($row = mysql_fetch_array($exe))
									{	
									
										if($row['Business_Name']!="")
										{	
									?>	
										
											<option value="<?php echo $row['id']?>" <?php if($_POST['barId']==$row['id']){?> selected="selected" <?php }?>><?php echo $row['Business_Name'];?></option>
									
									<?php 
										}
									}	
									?>	
										</select>
									</td>
								</tr>
								<tr>
									<td ><label class="control-label" for="typeahead">Name <span style="color:red;">*</span></label></td>
									<td>
										<input type="text" class="span6 typeahead"  name="name" id="name" value="<?php echo ($_POST['name'])?$_POST['name']:''?>"  size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("name"); ?></p>
									</td>
								</tr>
								<tr >
									<td ><label class="control-label" for="typeahead">Email <span style="color:red;">*</span></label></td>
									<td>
										<input type="email" class="span6 typeahead"  name="email" id="email" value="<?php echo ($_POST['email'])?$_POST['email']:''?>" size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("email"); ?></p>
									</td>
								</tr>
							 
								<tr>
									<td><label class="control-label" for="typeahead">Password <span style="color:red;">*</span></label></td>
									<td>
										<input type="password" class="span6 typeahead"  name="password" id="password"  size="40" required/>
										<p style="#ff0000;"><?php echo $form->error("password"); ?></p>
									</td>	
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Permission </label></td>
									<td>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="1" <?php if (in_array("1", $_POST['chkpage'])){?> checked="checked" <?php }?>> Bar profile</label>
										</div>	
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="2" <?php if (in_array("2", $_POST['chkpage'])){?> checked="checked" <?php }?>> Gallery</label>
										</div>
										<div class= "checkbox">					
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="3" <?php if (in_array("3", $_POST['chkpage'])){?> checked="checked" <?php }?>> Event management</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="4" <?php if (in_array("4", $_POST['chkpage'])){?> checked="checked" <?php }?>> Food management</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="5" <?php if (in_array("5", $_POST['chkpage'])){?> checked="checked" <?php }?>> Subscription</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="6" <?php if (in_array("6", $_POST['chkpage'])){?> checked="checked" <?php }?>> Order management</label>
										</div>
										<div class= "checkbox">
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="7" <?php if (in_array("7", $_POST['chkpage'])){?> checked="checked" <?php }?>> Sales</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="8" <?php if (in_array("8", $_POST['chkpage'])){?> checked="checked" <?php }?>> Promotion</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="9" <?php if (in_array("9", $_POST['chkpage'])){?> checked="checked" <?php }?>> Account</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="10" <?php if (in_array("10", $_POST['chkpage'])){?> checked="checked" <?php }?>> User guide</label>
										</div>
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="12" <?php if (in_array("12", $_POST['chkpage'])){?> checked="checked" <?php }?>> Manage blog</label>
										</div>	
										<div class= "checkbox">	
											<label class= "checkbox"><input type="checkbox" name="chkpage[]" value="11" <?php if (in_array("11", $_POST['chkpage'])){?> checked="checked" <?php }?>> Profile settings</label>
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
	window.location.href = 'addBusinessSubUser.php';
}



</script> 	 
</body>
</html>
