<?php 

 function GET_CURRENT_URL(){

$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$chk_url  =  explode("/",$url);
return $chk_url[5];
}


// funtion to authenticating all the page to open directly here

function PAGE_PROHIBITTED($authenticate){
       
       if($authenticate!=1){
               
             //  include(FILE_NOT_FOUND);			 			 ?>			 			 <script>window.location.href='login.php'</script>			 			 <?php 
               exit;
       }
       
}

	
	 function sluggify($url)
{
   
   $url = strtolower($url);
   $url = strip_tags($url);
   $url = stripslashes($url);
   $url = html_entity_decode($url);
   $url = str_replace('\'', '', $url);
   $match = '/[^a-z0-9]+/';
   $replace = '-';
   $url = preg_replace($match, $replace, $url);
   $url = trim($url, '-');
   return $url;
}
	
	function file_ext($file_name)
	{
		$path_parts = pathinfo($file_name);
		$ext = strtolower($path_parts["extension"]);
		return $ext;
	}
	
function GetSiteRoot()
	{
		$query_per=mysql_query("select * from tbl_prefrences");
   $fetch_per= mysql_fetch_array($query_per);
 echo $fetch_per['site_base_url'];
	}
	
/* function smtpmailer($to, $from, $from_name, $subject, $body, $is_gmail = true) 
{ 

	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true; 
	if ($is_gmail) {
		$mail->SMTPSecure = 'tls'; 
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;  
		$mail->Username = 'scrumbees2@gmail.com';  
		$mail->Password = 'ScrumBees123#';   
	} else {
		$mail->Host = SMTPSERVER;
		$mail->Username = SMTPUSER;  
		$mail->Password = SMTPPWD;
	}        
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
} */	



function getLnt($zip)
{
	//CT13 0RE
	$url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBtMP0tJWVNFoVXFxARPWekHZqU9XVp3y0&address=".urlencode($zip);
	$result_string = file_get_contents($url);
	$result = json_decode($result_string, true);
	$result1[]=$result['results'][0];
	$result2[]=$result1[0]['geometry'];
	$result3[]=$result2[0]['location'];
	return $result3[0];
}

function getUserLocationDetails($ip)
{
	return $url = json_decode(file_get_contents(trim("https://api.ipinfodb.com/v3/ip-city/?key=b45e93a3842b9b9e2bd566a9e7f3c27221aa0da93ed4cca210c22c1d4aee0081&ip=".$ip."&format=json")));
	
}
function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Calculate the distance in degrees
	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
	}
	return round($distance, $decimals);
}



function dateDiff ($date1, $date2) {
// Return the number of days between the two dates:

  return round(abs(strtotime($date1)-strtotime($date2))/86400);

} 

function checkAccess()
{
	if(!isset($_SESSION['ID'])&&$_SESSION['ID']=="")
	{
		header("location:login.php");
		die();
	}
}


?>