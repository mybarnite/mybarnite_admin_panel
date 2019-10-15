<?php


include 'includes/conection.php';
$ids = $_POST['Ids'];
$user_ids = explode(";", $ids);
/* echo "<pre>";
print_r($user_ids); */
function random_password($length = 6)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;
}

foreach ($user_ids as $user_id) {

    $password = random_password();

    mysql_query("SET @update_id := 0");
    $query2 = "update bars_list set registration_date = '" . date('Y-m-d') . "',is_requestedForClaim = 2, Discount=0, is_payasyougo = 2, id = (SELECT @update_id := id) where Owner_id = " . $user_id;
    $exec2 = mysql_query($query2);

    $query = mysql_query("SELECT @update_id");
    $array = mysql_fetch_assoc($query);
    $lastUpdatedId = $array['@update_id'];

    if ($lastUpdatedId > 0) {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date . '+ 30 days'));

        $sql = "INSERT INTO tbl_businessowner_subscription (owner_id, bar_id,subscription_id, start_date,end_date,ref_date,payment_status,is_active)
VALUES ($user_id, $lastUpdatedId, 1,'$start_date','$end_date','$end_date','Done','Active')";
        if (mysql_query($sql)) {
            $lastInsertedId = mysql_insert_id($connection);
        }

        // 	$query = "update user_register set password = '".$password."', status = 'Active', activation_key = '' where id = ".$user_id;
        // 	$exec = mysql_query($query);


        if ($lastInsertedId > 0) {
            $query1 = "select u.*,b.id as bar_id from  user_register as u join bars_list as b on u.id = b.Owner_id where u.id = " . $user_id;
            $exec1 = mysql_query($query1);
            $getUserDetails = mysql_fetch_assoc($exec1);


            $name = $getUserDetails['name'];
            $email = $getUserDetails['email'];

            $to1 = $email;
            $subject1 = 'Mybarnite - Confirmation for Claim ';
            $from1 = 'info@mybarnite.com';

            // To send HTML mail, the Content-type header must be set
            $headers1 = 'MIME-Version: 1.0' . "\r\n";
            $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Create email headers
            $headers1 .= 'From: ' . $from1 . "\r\n" .
                'Reply-To: ' . $from1 . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // Compose a simple HTML email message
            $message1 = "<html>";
            $message1 .= "<head><title>Mybarnite</title></head>";
            $message1 .= "<body>";
            $message1 .= "Dear $name,<br/><br/>";
            $message1 .= "Your Business claim has been accepted successfully!<br/><br/>";
// 		$message1 .= "Find your login details as below :<br/><br/>";
// 		$message1 .= "URL : <a href='http://mybarnite.com/business_owner/business_owner_signin.php'>Login to My Barnite</a><br/>";
// 		$message1 .= "E-mail : $email<br/>";
// 		$message1 .= "Password : $password<br/><br/><br/>";
            $message1 .= "Before login please connect your stripe account with us to enable the transactions. Follow the <a href='https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id=ca_F15O3cb0X1lxejvcPfqFkQeNuqAc2VdP&scope=read_write'>link</a> to connect with us using an existing account or by creating a new one.<br/><br/>";
            $message1 .= "Thank you for joining our buisiness.<br/><br/>";
            $message1 .= "<p>Mybarnite Limited</p><p>E-mail: <a href='mailto:info@mybarnite.com' target='_top'>info@mybarnite.com</a></p><p>Website: <a href='mybarnite.com'>mybarnite.com</a></p><p><img src='http://mybarnite.com/images/Picture1.png' width='110'></p>";
            $message1 .= "</body></html>";

            mail($to1, $subject1, $message1, $headers1);

        }
    }
}

?>