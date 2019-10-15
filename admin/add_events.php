<?php 
include("header.php");

include(ROOT_PATH.'business_owner/class/business_owner.php');
include(ROOT_PATH.'business_owner/class/form.php');
$db = new business_owner();
$db->connect();

	if($_POST['reset']!="")
	{
		
		header("location:add_events.php");
	}	
	
	if(isset($_POST['AddEvent']))
	{
			
		/* echo "<pre>";
		print_r($_POST);
		exit;  */
		$barName = $db->escapeString($_POST['barName']);
		$eventName = $db->escapeString($_POST['EventName']);
		$eventDescription = $db->escapeString($_POST['event_description']);
		$eventStart = date('Y-m-d',strtotime($db->escapeString($_POST['event_startdate'])));
		$eventEnd = date('Y-m-d',strtotime($db->escapeString($_POST['event_enddate'])));
		$start_time = $db->escapeString($_POST['start_time']);
		$end_time = $db->escapeString($_POST['end_time']);
		
		$start = strtotime($eventStart." ".$start_time);
		$end = strtotime($eventEnd." ".$end_time);
		$event_price_vip =$db->escapeString($_POST['event_price_vip']);
		$event_price_basic = $db->escapeString($_POST['event_price_basic']);
		$cancellation_policy = $db->escapeString($_POST['cancellation_policy']); 
		$free_event = $db->escapeString($_POST['free_event']); 
		$eventtype = $db->escapeString($_POST['eventtype']); 
		
		$starttime = $db->escapeString($_POST['start_time']);
		$endtime = $db->escapeString($_POST['end_time']);
		
		$db->insert('tbl_events',array('bar_id'=>$barName,'event_name'=>$eventName,'event_description'=>$eventDescription,'event_start'=>$eventStart,'event_end'=>$eventEnd,'event_price_vip'=>$event_price_vip,'event_price_basic'=>$event_price_basic,'cancellation_policy'=>$cancellation_policy,'start_time'=>$start_time,'end_time'=>$end_time,'event_starttimestamp'=>$start,'event_endtimestamp'=>$end,'eventtype'=>$eventtype,'free_event'=>$free_event));  // Table name, column names and respective values
		$res = $db->getResult();  
		$lastInsertedId = $res[0];
		
			
			$sql = "SELECT u.email, u.name from user_register as u join bars_list as b on b.Owner_id = u.id where b.id = ".$barName ;
			$exe = $db->myconn->query($sql);
			$userDetails = $exe->fetch_assoc();
			if($starttime!="")
			{
				$timings = $starttime." to ".$endtime;
			}
			else
			{
				$timings = " - ";
			}	
				
			$email = $userDetails['email'];
			
			$starts = $_POST['event_startdate'];
			$ends = $_POST['event_enddate'];
			//$to1 = $email;
			$to1 = $email;
			$subject1 = 'Mybarnite - New event ';
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
			$message1 .= "New event has been posted for your bar, you can find below details :<br/><br/>";
			$message1 .= "Event name : $eventName<br/>";
			$message1 .= "Event type : $eventtype<br/>";
			$message1 .= "Evant date - $starts to $ends <br/>";
			$message1 .= "Timings : $timings<br/><br/>";
			$message1 .= "Thank you for joining our website.<br/><br/>";
			$message1 .= "Mybarnite Limited<br/>EMail: info@mybarnite.com<br/>URL: mybarnite.com<br/><img src='http://mybarnite.com/images/Picture1.png' width='110'>";
			$message1 .= "</body></html>";

			if(mail($to1, $subject1, $message1, $headers1))
			{	
				$_SESSION['eventmsg']="<div class='alert alert-success'>Data inserted successfully.</div>";	
			}
			else
			{
				$_SESSION['eventmsg']="<div class='alert alert-success'>It seem there is some issue while sending email.</div>";	
			}		
		if($lastInsertedId!="")
		{	global $flag;
			$valid_formats = array("jpg", "png", "gif");
			$path = "uploaded_files/"; // Upload directory
			$count = 0;
			
			// Loop $_FILES to exeicute all files
			$total = count($_FILES['files']['name']);
			// Loop through each file
			for($i=0; $i<$total; $i++) {
				$new_filename = time()."-".$_FILES['files']['name'][$i];		   
				if ($_FILES['files']['error'][$i] == 0) {	           
					if( ! in_array(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION), $valid_formats) ){
						$_SESSION['eventmsg']="<div class='alert alert-danger'>Event added successfully  but  image can not be uploaded with invalid format.</div>";
						$flag=1;
						 // Skip invalid file formats
					}
					else
					{ // No error found! Move uploaded files 
						if($flag!=1)
						{
							$new_filename = time()."-".$_FILES['files']['name'][$i];
							if(move_uploaded_file($_FILES["files"]["tmp_name"][$i], $path.$new_filename))
							$count++; // Number of successfully uploaded file
							//$db->insert('tbl_event_gallery',array('bar_id'=>$_SESSION['bar_id'],'event_id'=>$lastInsertedId,'file_name'=>$eventDescription,'file_path'=>$eventStart,'status'=>$eventEnd,'logo_image'=>$start_time));  // Table name, column names and respective values
							$db->insert('tbl_event_gallery',array('bar_id'=>$barName,'event_id'=>$lastInsertedId,'file_name'=>$new_filename,'file_path'=>$path.$new_filename,'status'=>1,'logo_image'=>0));  // Table name, column names and respective values
							$res1 = $db->getResult();  
							if($res1!="")
							{
								$flag = 0;
								$_SESSION['eventmsg']="<div class='alert alert-success'>Data inserted successfully.</div>";
							}
								
						}	
						
						
					}
				}
			}
			?>
			<script>
			window.setTimeout(function(){
				window.location.href = "event_list.php";
			}, 2000);

			</script>
			<?php
			
		}
		else
		{
			$_SESSION['eventmsg']="";
		}		
	
	
}	
?>

	<!-- topbar ends -->
   
    	<!-- ajax script start -->
      <!--   <script language="javascript" type="application/javascript" src="ajax/ajax.js"></script> -->
        <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>

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
						<h2><i class="icon-edit"></i>&nbsp;Add New Event</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><?php
								
								if(isset($_SESSION['eventmsg']))
								{
								
									echo $_SESSION['eventmsg'];
									unset($_SESSION['eventmsg']);									
								}
								
								?></strong></td></tr>
                    </table>
					 <form id="createform" method="post" enctype="multipart/form-data">	
							
						<table align="center" width="80%" >
							<tr >
								<td ><label class="control-label" for="typeahead">Bar Name:</label></td>
								<td> 
									<input type="hidden" class="form-control" id="free_event" name="free_event" value="">
									<select name="barName" class="barName" required>
										<option value="">Select</option>
											 <?php 
										
										$status="select id,Business_Name from bars_list where Owner_id!=0";
										$res = mysql_query($status);
										while($row = mysql_fetch_array($res))
										{
											if($row['Business_Name']!=""&&$row['id']!="")
											{	
										?>
											<option value="<?php echo $row['id'];?>"> <?php echo $row['Business_Name'];?></option>
									<?php 
											}
										}
									?>
									</select> 
								</td>
							</tr>
							<tr>
								<td><label class="control-label" for="typeahead">Free Entry: </label></td>
								<td><input type="checkbox" class="form-control chkbox" id="freeEventOption" name="freeEventOption" style="vertical-align:top" > </td>
							</tr>
							<tr>
								<td><label class="control-label" for="typeahead">Event Name:</label></td>
								<td><input type="text" class="span6 typeahead"  name="EventName" id="EventName"  size="40" required /></td>
							</tr>
							<tr>
								<td ><label for="event_description" class="control-label">Description: </label></td>
								<td><textarea class="form-group" id="event_description" name="event_description"></textarea></td>
							</tr>
							<tr>
								<td ><label for="event_startdate" class="control-label">Event starts: </label></td>
								<td>
									<input type="date"  id="event_startdate" required name="event_startdate" class="form-control pull-left"  value="">
									<!-- <input id="timepicker1" class="timepicker" type="time" name="start_time" > -->
									<input type="time" id = "zombieTimeInput"/>
								</td>
							</tr>
							<tr>
								<td ><label for="event_startdate" class="control-label">Event ends:</label></td>
								<td><input type="date" id="event_enddate"  name="event_enddate" class="form-control  pull-left"  value="">
									<!-- <input id="timepicker2" class="timepicker" type="time" name="end_time" > -->
									<input type="time" id = "zombieTimeInput1"/>
								</td>
							</tr>
							<tr id="vip">
								<td ><label for="event_name" class="control-label">Price - VIP (&pound;):</label></td>
								<td ><input type="number" id="event_price_vip" name="event_price_vip"   value=""></td>
							</tr>
							<tr  id="basic">
								<td ><label for="event_name" class="control-label">Price - Basic (&pound;):</label></td>
								<td ><input type="number" id="event_price_basic" name="event_price_basic"   value=""></td>
							</tr>
							<tr>
								<td ><label for="event_startdate" class="control-label">Cancellation:</label></td>
								<td>
									<select id="cancellation_policy" name="cancellation_policy">
										<option value="1" >Free cancellation</option>
										<option value="2" >Cancellation Policy</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label for="eventtype" class="control-label">Event Type:</label></td>
								<td>
									<select name="eventtype" id="eventtype" class="form-control pull-left">
										<option value="latest">Latest Event</option>
										<option value="upcoming">Upcoming Event</option>
										<option value="special">Special Event</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><label for="event_name" class="control-label">Upload image :</label></td>
								<td><input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" /></td>
							</tr>					
							<tr >
								<td ><label class="control-label" for="typeahead">&nbsp;</label></td>
								<td><button type="submit" id="AddEvent"  name="AddEvent" value="Add Event" class="btn btn-primary">Add event</button><input type="submit" name="reset" id="reset"  class="btn" value="Reset" /></td>
							</tr>
							
                        </table>
					</form>
					</div>
				</div><!--/span-->

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>


 
<script>
 function resetFields()
 {
	window.location.href = 'add_events.php';
 }
$(document).ready(function(){
	
	$('#freeEventOption').click(function() {
        if(!$(this).is(':checked'))
		{	
           // alert('unchecked');
			$("#vip").css("display","table-row");
			$("#basic").css("display","table-row");
			$("#free_event").val("0");
		}	
        else
		{	
            //alert('checked');
			$("#vip").css("display","none");
			$("#basic").css("display","none");
			$("#free_event").val("1");
		}	
    });
	
	

});
</script>
		<?php include("footer.php");?>
		
</body>
</html>
