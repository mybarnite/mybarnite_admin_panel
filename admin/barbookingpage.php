<?php
include("admin/includes/config.cfg");
include("admin/includes/connection.con");
include("admin/includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();
?>

<?php
		if(isset($_POST['bookbar']))
		{
			$id = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['barid']))));
			$barname = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['barname']))));
			$bookingdate = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['bookingdate']))));
			$bartime = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['bartime']))));
			$noofperson = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['noofperson']))));
			
			$query = mysql_query(" INSERT INTO bar_booking VALUES('','".$id."','".$bookingdate."','".$bartime."','".$noofperson."') ") or die(mysql_error());
			
			$to = 'admim@gmail.com';
			$subject = "Booking Bar Details";
			$txt = " Booking Bar Detail \r\n Name:- '".$barname."' \r\n Booking Date:- '".$bookingdate."' \r\n Booking Time:- '".$bartime."' \r\n No Of Persons:- '".$noofperson."'";
			$headers = "From: user@address.com" . "\r\n" ;
				
			mail($to,$subject,$txt,$headers);
			
			
			echo "<script>window.location.href='bookingconfrmmessage.php'</script>";

			
			
			
		}
?>

   <?php include'header.php'; ?>
<!--==============================Map=================================--> 

	
</header>
<div class="padcontent"></div>		

<!--==============================Content=================================--> 

<?php
	$bid = $_GET['barid'];
	$getquery = mysql_query(" SELECT * FROM bars_list WHERE id='".$bid."' ") or die(mysql_error());
	$getquery = mysql_fetch_array($getquery);
?>

<section id="content" class="main-content">
  <div class="container">
    <div class="row clearfix ">
          <div class="span3"></div>
		<div class="span6">
        <center>	<h2 style="color:#ff1da5;font-size:30px;">Bar Booking </h2></center><br>
      			<div id="note"></div>
      			<div id="fields" class="contact-form">
      				<form id="ajax-contact-form" method="post" class="form-horizontal">
					
					
						<div class="control-group">
      						<label  class="control-label" for="inputName">Bar ID:</label>
							<input type="text"  value="<?php echo $getquery['id'] ?>" id="barsid" class="form-control" placeholder="Name..." >
							<input type="hidden" value="<?php echo $getquery['id'] ?>" name="barid">
      					</div>
						<br>
						
						<div class="control-group">
      						<label class="control-label" for="inputName">Bar Name:</label>
      							<input type="text"  value="<?php echo $getquery['Business_Name'] ?>" class="form-control" placeholder="Name..." >
								<input type="hidden" value="<?php echo $getquery['Business_Name'] ?>" id="barname" name="barname">
      					</div>
						<br>
					
					
      					<div class="control-group">
      						<label class="control-label" for="inputName">Bar Booking Date:</label>
      							<input type="date"  name="bookingdate" id="barsdate" class="form-control"  >
      					</div>
						<br>
						
						
			
      					<div class="control-group">
						
      						<label class="control-label" for="inputName">Bar Booking Timing:</label>
      							<input type="time"  name="bartime" id="barstime" class="form-control"  >
      					</div>
						<br>
						
						<div class="control-group">
      						<label class="control-label" for="inputEmail">No Of Persons:</label>
      							<select name="noofperson" id="barsnoperson" class="form-control" >
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								</select>
      					</div>
      					<br>
						
      					
					
      					
						<br>
					<button type="submit" style="float:right;" data-toggle="modal" data-target="#myModal" class="btn btn-default btn-color">Book Bar</button>
					
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"> Booking Done Successfully</h4>
					  </div>
					  <div class="modal-body">
						Booking Done Successfully
					  </div>
					  <div class="modal-footer">
						<button id="myButton" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						<script type="text/javascript">
						
					document.getElementById("myButton").onclick = function () {
						
						var id = document.getElementById("barsid").value;
						var barsdate = document.getElementById("barsdate").value;
						var barstime = document.getElementById("barstime").value;
						var barsnoperson = document.getElementById("barsnoperson").value;
						var barname = document.getElementById("barname").value;
						
						
						
						location.href = "bookbar.php?id="+id+"&barsdate="+barsdate+"&barstime="+barstime+"&barsnoperson="+barsnoperson+"&barname="+barname;
					};
					</script>
					  
					  </div>
					</div>
				  </div>
				</div>
      					
						<div class="clearfix"></div>
      				</form>
      			</div>    
		</div>		  
		
		
		
    </div>
  </div>
</section>




	
    <?php include'footer.php'; ?>