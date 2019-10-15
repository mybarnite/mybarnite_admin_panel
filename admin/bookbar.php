<?php
include("admin/includes/config.cfg");
include("admin/includes/connection.con");
include("admin/includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();
?>

<?php
			$id = $_GET['id'];
			$barname = $_GET['barname'];
			$bookingdate = $_GET['barsdate'];
			$bartime =$_GET['barstime'];
			$noofperson = $_GET['barsnoperson'];
			
			$query = mysql_query(" INSERT INTO bar_booking VALUES('','".$id."','".$bookingdate."','".$bartime."','".$noofperson."') ") or die(mysql_error());
			
			$to = 'rakeshoad268@gmail.com';
			$subject = "Booking Bar Details";
			$txt = " Booking Bar Detail \r\n Name:- '".$barname."' \r\n Booking Date:- '".$bookingdate."' \r\n Booking Time:- '".$bartime."' \r\n No Of Persons:- '".$noofperson."'";
			$headers = "From: user@address.com" . "\r\n" ;
				
			mail($to,$subject,$txt,$headers);
			
			
			echo "<script>window.location.href='index.php'</script>";
?>