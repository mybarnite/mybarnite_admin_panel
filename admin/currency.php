

<form method="post">

<input type="text" name="amount" placeholder="Enter Amount">
<br>
From.<select name="form">
	<option>USD</option>
	<option>asd</option>
	<option>asd</option>
	<option>asd</option>
</select>
To.<select name="to">
	<option>USD</option>
	<option>asd</option>
	<option>asd</option>
	<option>asd</option>
</select>
<br>
<input type="submit" name="convert" value="Convert" >
<br>
</form>

<?php

	if(isset($_POST['convert']))
	{
		$from = $_POST['form'];
		$to = $_POST['to'];
		$amount = $_POST['amount'];
		
		function get_currency($from_Currency, $to_Currency, $amount) {
 
$amount = urlencode($amount);
$from_Currency = urlencode($from_Currency);
$to_Currency = urlencode($to_Currency);
 
$url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
 
$ch = curl_init();
$timeout = 0;
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
 
curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$rawdata = curl_exec($ch);
curl_close($ch);
$data = explode('bld>', $rawdata);
$data = explode($to_Currency, $data[1]);
return round($data[0], 2);
}
 
// Call the function to get the currency converted
echo  'Converted :  '.get_currency($from , $to, $amount);
 

	}
?>

