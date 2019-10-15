<?php
include 'includes/conection.php';
if(isset($_POST['pageNo'])){
	$pageNo = $_POST['pageNo'];
}


$limit  = 15;
$offset = ($pageNo - 1) * $limit;

$eventname = trim($_POST['eventname']);
$barname = trim($_POST['barname']);
$cid= trim($_POST['cid']);
$orderedby = trim($_POST['orderedby']);
$status = $_POST['payment_status'];
$orderid = trim($_POST['orderid']);

/*$query = "SELECT o.* , CASE WHEN order_for_category = 'Bar' THEN (SELECT Business_Name FROM bars_list WHERE id = o.bar_id) ELSE (SELECT event_name from tbl_events WHERE id = o.event_id) END as name, u.name as user_name, u.id as cid FROM tbl_order_history o, user_register as u where o.user_id = u.id" ;*/
$query = "SELECT o.* , CASE WHEN order_for_category = 'Event' THEN (SELECT event_name from tbl_events WHERE id = o.event_id) END as event_name, (SELECT name from user_register WHERE id = o.owner_id) as owner_name, u.name as user_name, b.Business_Name as bar_name FROM tbl_order_history o, user_register as u, bars_list b where o.user_id = u.id and o.owner_id = b.Owner_id" ;
//$countSql = "SELECT COUNT(*) AS count FROM tbl_order_history";
$countSql = "SELECT COUNT(*) AS count FROM tbl_order_history o, user_register as u, bars_list b where o.user_id = u.id and o.owner_id = b.Owner_id";

if(isset($_POST['orderid'])&&$_POST['orderid']!="")
{
	@$query .= " AND o.id = ".$_POST['orderid'];
	@$countSql .= "	AND o.id = ".$_POST['orderid'];
}
if(isset($_POST['cid'])&&$_POST['cid']!="")
{
	@$query .= " AND o.owner_id = ".$_POST['cid'];
	@$countSql .= "	AND o.owner_id = ".$_POST['cid'];
}
if(isset($_POST['eventname'])&&$_POST['eventname']!="")
{
	@$query .= " AND o.ordername like '%".$_POST['eventname']."%'";
	@$countSql .= "	AND o.ordername like '%".$_POST['eventname']."%'";
}
if(isset($_POST['barname'])&&$_POST['barname']!="")
{
	@$query .= " AND b.Business_Name like '%".$_POST['barname']."%'";
	@$countSql .= "	AND b.Business_Name like '%".$_POST['barname']."%'";
}

if(isset($_POST['orderedby'])&&$_POST['orderedby']!="")
{
	@$query .= " AND u.name like '%".$_POST['orderedby']."%'";
	@$countSql .= "	AND u.name like '%".$_POST['orderedby']."%'";
}
if(isset($_POST['payment_status'])&&$_POST['payment_status']!=""&&$_POST['payment_status']!="All")
{
	$query .= " AND payment_status = '".$_POST['payment_status']."'";
	$countSql .= " where payment_status = '".$_POST['payment_status']."'";
}	


$query .= " limit ".$offset.",".$limit;
$sel_banner_query= mysql_query($query);
echo mysql_error();
#echo $countSql;
$exe= mysql_query($countSql);
$countRows = mysql_fetch_assoc($exe);
?>
	<input type='hidden' id='totaluserCount' value='<?php echo $countRows['count']; ?>'/>
	<input type='hidden' id='userPage' value='<?php echo "$pageNo" ?>'/>
<?php
$i=1;
while($fetch_banner=mysql_fetch_assoc($sel_banner_query))
{
	
	/* $post_url = "https://mdepayments.epdq.co.uk/ncol/test/querydirect.asp";
	$post_values = array(
					
		// the API Login ID and Transaction Key must be replaced with valid values
		"PSPID"            => "mybarnite",
		"ORDERID"        => $fetch_banner['transaction_id'],
		"PAYID"            => '',
		"USERID"        => "mybarnite1",
		"PSWD"            => "fE5(hHF0V%",
		
	);
	
	$post_string = "";
	
	foreach( $post_values as $key => $value )
	{ 
		$post_string .= "$key=" . urlencode( $value ) . "&"; 
	}
	
	$post_string = rtrim( $post_string, "& " );
			  
	$request = curl_init($post_url); // initiate curl object
	curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($request, CURLOPT_HTTPHEADER, ["application/x-www-form-urlencoded"]);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
	curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
	$post_response = curl_exec($request); // execute curl post and store results in $post_response
	
	curl_close ($request); // close curl object
	if($post_response === false)
	{
		echo 'Curl error: ' . curl_error($request);
	}    
	//$post_response response is in xml format
	$simplexml_response = simplexml_load_string($post_response);
	$simplexml_response_array = (array) $simplexml_response;//Convert to array because it is easier to manager for response object name start with @
	$respon = $simplexml_response_array['@attributes'];
	#echo $respon['STATUS'];
	if($respon['STATUS']=='8')
	{
		$upadate = "Update tbl_order_history set  where payment_status = 'Refunded' where id=".$fetch_banner['id'];
		mysql_query($upadate);

	} */
?>
	<tr>
			<td style="text-align:center;"><input type="checkbox" name="chk[]" value="<?=$fetch_banner['id']; ?>" /></td>
            <td><?=$fetch_banner['id'];?></td>
            		<td><?=$fetch_banner['owner_id'];?></td>
            		<td><?=$fetch_banner['bar_name'] ? $fetch_banner['bar_name'] : "-";?></td>
			<td><?=$fetch_banner['event_name'] ? $fetch_banner['event_name'] : "-";?></td>
			<td><?=$fetch_banner['owner_name'] ? $fetch_banner['owner_name'] : "-";?></td>
			<td class="center"><?=$fetch_banner['user_name'];?></td>
			<td class="center"><?=number_format($fetch_banner['total_amount'],2);?></td>
			<?php 
			
			if($respon['STATUS']=='8')
			{	
			?>
				<td>Refunded</td>	
				
			<?php 
			}
			elseif($respon['STATUS']=='9')
			{
			?>
				<td>Paid</td>	
			<?php 
			}
			elseif($respon['STATUS']=='81')
			{
			?>	
				<td>Reund Requested</td>
			<?php 	
			}elseif($respon['STATUS']=='91')
			{
			?>	
			
			<td>Payment Processing</td>	
			<?	
			}	
			else{
			?>
				<td><?php echo ($fetch_banner['payment_status']=="Done")?"Paid":$fetch_banner['payment_status'];?></td>	
			<?php 
			}
			?>
			<td colspan="2">
				<a class="btn btn-info" href="javascript:void(0);" onclick="deleteOrder(<?php echo $fetch_banner['id']?>)"><i class="icon-trash" title="Trash"></i></a>
				<?php if($fetch_banner['payment_status']=="Done"&&$respon['STATUS']=='9'&&$fetch_banner['skrill_transaction']==''){?>
				<a class="btn btn-danger" href="javascript:void(0);" onclick="refundPayment(<?php echo $fetch_banner['id']?>)">Make Refund</a>
				<?php }?>
				<?php if($fetch_banner['payment_status']=="Done"&&$fetch_banner['skrill_transaction']!=''){?>
				<a class="btn btn-danger" href="javascript:void(0);" onclick="refundPaymentSkrill(<?php echo $fetch_banner['id']?>)">Make Refund</a>
				<?php }?>
			</td>
	</tr>
<?php
$i++;
} 
?>