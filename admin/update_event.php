<?php 
include("header.php");

include(ROOT_PATH.'business_owner/class/business_owner.php');
include(ROOT_PATH.'business_owner/class/form.php');
$db = new business_owner();
$db->connect();
//echo "select e.*,b.Business_Name from tbl_events as e join bars_list as b on e.bar_id = b.id where e.id=".$_REQUEST['event_id'];
$db->select('tbl_events','*',NULL,'id="'.$_REQUEST['event_id'].'"','id DESC');
$items = $db->getResult();

$db->select('bars_list','id,Business_Name',NULL,'id="'.@$items[0]['bar_id'].'"','id DESC');
$bar = $db->getResult();

if(isset($_POST['Update']))
{
	
	$barId = $db->escapeString($_POST['barId']);
	$eventName = $db->escapeString($_POST['EventName']);
	$eventDescription = $db->escapeString($_POST['event_description']);
	$eventStart = date('Y-m-d',strtotime($db->escapeString($_POST['event_startdate'])));
	$eventEnd = date('Y-m-d',strtotime($db->escapeString($_POST['event_enddate'])));
	
	$start_time = $db->escapeString($_POST['start_time']);
	$end_time = $db->escapeString($_POST['end_time']);
	$start = strtotime($eventStart." ".$start_time);
	$end = strtotime($eventEnd." ".$end_time);
	$event_price_vip =$db->escapeString($_POST['event_price_vip']);
	$event_price_basic =$db->escapeString($_POST['event_price_basic']);
	$cancellation_policy = $db->escapeString($_POST['cancellation_policy']); 
	$free_event = $db->escapeString($_POST['free_event']); 
	$eventtype1 = $db->escapeString($_POST['eventtype1']); 
	
	$array = array(
		'bar_id'=>$barId,
		'event_name'=>$eventName,
		'event_description'=>$eventDescription,
		'event_start'=>$eventStart,
		'event_end'=>$eventEnd,
		'event_price_vip'=>$event_price_vip,
		'event_price_basic'=>$event_price_basic,
		'cancellation_policy'=>$cancellation_policy,
		'start_time'=>$start_time,
		'end_time'=>$end_time,
		'event_starttimestamp'=>$start,
		'event_endtimestamp'=>$end,
		'eventtype' => $eventtype1 ,
		'free_event' => $free_event 
		
	);
			
			$db->update('tbl_events',$array,'id='.$_GET['event_id']);
			$is_res = $db->myconn->affected_rows;	
			if($is_res!=""&&$is_res>0)
			{
				$_SESSION['msg']="<div class='alert alert-success'>Data has been updated successfully</div>";
			}	
			global $flag;
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
						$_SESSION['msg']="<div class='alert alert-danger'>Data has been updated successfully but image can not be uploaded with invalid format. </div>";
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
							
							$db->insert('tbl_event_gallery',array('bar_id'=>$barId,'event_id'=>$_REQUEST['event_id'],'file_name'=>$new_filename,'file_path'=>$path.$new_filename,'status'=>1,'logo_image'=>0));  // Table name, column names and respective values
							$res1 = $db->getResult();  
							if($res1!="")
							{
								$flag = 0;
								$_SESSION['msg']="<div class='alert alert-success'>Data has been updated successfully</div>";
								
							}	
							else
							{
								
								$_SESSION['msg']="<div class='alert alert-danger'>Invalid file format.</div>";
								
							}
							
						}	
						
						
					}
				}
			}	
			header("location:event_list.php");	
				
	
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
						<h2><i class="icon-edit"></i>&nbsp;Update Event</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                    </table>
					<form class="form-inline" role="form" id="bar_events" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
						
							 <tbody>
								<input type="hidden" class="form-control" id="free_event" name="free_event" value="<?php echo @$items[0]['free_event'];?>">
								<input type="hidden" id="Event_Id" name="Event_Id" value="<?php echo $_REQUEST['event_id']; ?>"></input>
								<input type="hidden" id="barId" name="barId" value="<?php echo @$bar[0]['id']; ?>"></input>
							 <tr >
								
								<td ><label class="control-label" for="typeahead">Bar Name*</label></td>
								<td> 
									<input type="text" id = "owners" name="owners" value="<?php echo @$bar[0]['Business_Name']?>" readonly/>	
								</td>
							 </tr>
							 <tr>
									<td><label class="control-label" for="typeahead">Free Entry: </label></td>
									<td><input type="checkbox" class="form-control chkbox" <?php if(@$items[0]['free_event']=='1'){?>  checked="checked"  <?php }?> id="freeEventOption" name="freeEventOption" style="vertical-align:top" onclick="freeEventOption1();"> </td>
							</tr>
							 <tr >
							<td ><label class="control-label" for="typeahead">Event Name *</label></td>
							<td><input type="text" class="span6 typeahead"  name="EventName" id="EventName"  size="40" value="<?php echo @$items[0]['event_name'];?>" /></td>
							 </tr>
							 
							<tr >
							<td ><label for="event_description" class="pull-left">Description :</label></td>
							<td>
									<textarea class="form-group" id="event_description" name="event_description"><?php echo @$items[0]['event_description'];?></textarea></td>
							 </tr>
							 <tr >
							<td ><label for="event_startdate" class="pull-left">Event starts	:</label></td>
							<td><input type="date"  id="event_startdate" required name="event_startdate" class="form-control pull-left"  data-valuee="2014-08-08" value="<?php echo @$items[0]['event_start'];?>">
									<!-- <input id="timepicker1" class="timepicker" type="time" name="start_time" value="<?php echo @$items[0]['start_time'];?>"> -->
								<input type="text" id = "zombieTimeInput" value="<?php echo @$items[0]['start_time']?>" />
									</td>
							 </tr>
							 <tr >
							<td ><label for="event_startdate" class="pull-left">Event ends	:</label></td>
							<td><input type="date" id="event_enddate" required  name="event_enddate" class="form-control  pull-left"  value="<?php echo @$items[0]['event_end'];?>" data-valuee="2014-08-08">
									
								<input type="text" id = "zombieTimeInput1" value="<?php echo @$items[0]['end_time']?>" />
									</td>
							 </tr>
							 <tr id="vip">
								<td ><label for="event_startdate" class="pull-left">Event price - VIP (&pound;):</label></td>
								<td><input type="number" id="event_price_vip" name="event_price_vip" required  value="<?php echo @$items[0]['event_price_vip'];?>">
								</td>
							</tr>
							<tr id="basic">
								<td><label for="event_startdate" class="pull-left">Event price - Basic (&pound;):</label></td>
								<td>
									<input type="number" id="event_price_basic" name="event_price_basic" required  value="<?php echo @$items[0]['event_price_basic'];?>">
								</td>
							</tr>
							<tr>
								<td ><label for="event_startdate" class="pull-left">Cancellation:</label></td>
								<td>
									<select id="cancellation_policy" name="cancellation_policy">
										<option value="1" <?php if(@$items[0]['cancellation_policy']=='1'){?> selected="selected" <?php }?> >Free cancellation</option>
										<option value="2" <?php if(@$items[0]['cancellation_policy']=='2'){?> selected="selected" <?php }?> >Cancellation Policy</option>
									</select>
								</td>
							</tr>
							 <tr>
								<td><label for="eventtype1" class="pull-left">Event Type	:</label></td>
								<td>
									<select name="eventtype1" id="eventtype1" class="form-control pull-left">
										<option value="latest" <?php if(@$items[0]['eventtype']=="latest"){?> selected="selected"  <?php } ?> >Latest Event</option>
										<option value="upcoming" <?php if(@$items[0]['eventtype']=="upcoming"){?> selected="selected"  <?php } ?> >Upcoming Event</option>
										<option value="special" <?php if(@$items[0]['eventtype']=="special"){?> selected="selected"  <?php } ?> >Special Event</option>
									</select>
								</td>
							</tr>	
							 <tr>
								<td ><label for="event_startdate" class="pull-left">Booking	:</label></td>
								<td>
									<select name="availBooking" id="availBooking">
										<option value="Available" <?php if(@$items[0]['is_availableForBooking']=="Available"){?> selected="selected" <?php }?> >Booking Available</option>
										<option value="Booked" <?php if(@$items[0]['is_availableForBooking']=="Booked"){?> selected="selected" <?php }?> >Fully Booked</option>
									</select>
								</td>	
							</tr>
							<tr>
								<td><label for="event_name" class="pull-left">Upload image :</label></td>
								<td><input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" /></td>
							</tr>
							
							 </tbody>
							
							
							 
							 
						   
							   <tr >
							<td ><label class="control-label" for="typeahead">&nbsp;</label></td>
							<td>
								<button type="submit" id="UpdateEvent"  name="Update" value="Update Event" class="btn btn-primary">Save changes</button>
								<a href="event_list.php" id="Eventlist"  name="Eventlist" class="btn btn-primary">Back to events</a>
								

							 </tr>
                        </table>
					</form>	

					</div>
				</div><!--/span-->

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>
<script type="application/javascript">
function freeEventOption1()
	{
		if(!$("#freeEventOption").is(':checked'))
		{	
            //alert('unchecked');
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
	}
freeEventOption1();
</script>
		<?php include("footer.php");?>
		
</body>
</html>
