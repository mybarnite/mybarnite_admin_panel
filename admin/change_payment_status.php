<?php

session_start();
ob_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("includes/config.cfg");
include("includes/connection.con");
include("includes/funcs_lib.inc.php");

include('../business_owner/class/business_owner.php');
include('../business_owner/class/form.php');
$db = new business_owner();
$db->connect();

$id = $_POST['id'];
$payment_status = $_POST['payment_status'];
$db->update('tbl_order_history',array('payment_status'=>$payment_status),'id='.$id); // Table name, column names and values, WHERE conditions
$res = $db->getResult();

?>