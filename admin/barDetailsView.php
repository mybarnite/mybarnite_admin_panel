<?php include("header.php"); ?>
<?php
$query = "SELECT bl.id as barid,ur.*,bl.* FROM bars_list as bl LEFT JOIN user_register as ur ON bl.Owner_id = ur.id and bl.Business_Name!='' where bl.id = " . $_GET['id'];
$execute = mysql_query($query);
$getDetails = mysql_fetch_assoc($execute);
/*  echo "<pre>";
print_r($getDetails);  */

$query1 = "select SUM(total_amount) as totalPurchase from tbl_order_history where Owner_id=" . $getDetails['Owner_id'] . "  and payment_status='Done'";
$execute1 = mysql_query($query1);
$totalPurchase = mysql_fetch_assoc($execute1);

if ($getDetails['is_payasyougo'] == 1) {
    $commission = ($totalPurchase['totalPurchase'] * $getDetails['Commission']) / 100;
    $totalSales = $totalPurchase['totalPurchase'];
    $totalBalance = $totalSales - $commission;
}
if ($getDetails['is_payasyougo'] == 2) {
    $discount = ($totalPurchase['totalPurchase'] * $getDetails['Discount']) / 100;
    $totalSales = $totalPurchase['totalPurchase'];
    $totalBalance = $totalSales - $discount;
}


$query2 = "select SUM(total_amount) as totalRefund from tbl_order_history where Owner_id=" . $getDetails['Owner_id'] . "  and payment_status='Refunded'";
$execute2 = mysql_query($query2);
$totalRefund = mysql_fetch_assoc($execute2);
$refundAmount = $totalRefund['totalRefund'];

?>

<div class="container-fluid">
    <div class="row-fluid">
        <!-- left menu starts -->
        <?php include("left.php"); ?><!--/span-->
        <!-- left menu ends -->
        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>
        <div id="content" class="span10">
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-list"></i> Sales Detail</h2>
                        <?php if ($_REQUEST['t']) { ?>
                            <li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet"
                                                                              style=" color:#F00;">Back To Barnite</span></a>
                            </li><?php
                        }
                        ?>
                    </div><!--/box-header well-->
                    <div class="box-content">
                         <div class="span6">
                        <table align="center" width="50%">
                            <?php
                            $sql1 = "SELECT o.* ,u.name as uname ,CASE WHEN order_for_category = 'Bar' THEN (SELECT Business_Name FROM bars_list WHERE id = o.bar_id) ELSE (SELECT event_name from tbl_events WHERE id = o.event_id) END as name FROM tbl_order_history o left join user_register u on u.id=o.user_id where payment_status = 'Done' and owner_id =" . $getDetails['Owner_id'];
                            $getTotalOrdersPaid = mysql_query($sql1);
                            $num_orders = mysql_num_rows($getTotalOrdersPaid);
                            ?>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Total order
                                    placed :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo intval($num_orders); ?></td>
                            </tr>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Total sales(&pound;) :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo ($totalSales) ? number_format($totalSales, 2) : '0.00'; ?></td>
                            </tr>
                            <?php
                            if ($getDetails['is_payasyougo'] == 1) {
                                ?>
                                <tr>
                                    <th align="left" style="padding:9px 0px 9px 0px">Commission per transaction :</th>
                                    <td style="padding:9px 0px 9px 0px"><?php echo ($getDetails['Commission']) ? floatval($getDetails['Commission']) : '0' . '%'; ?></td>
                                </tr>
                                <tr>
                                    <th align="left" style="padding:9px 0px 9px 0px">Commission amount(&pound;) :</th>
                                    <td style="padding:9px 0px 9px 0px"><?php echo ($commission) ? number_format($commission, 2) : '0.00'; ?></td>
                                </tr>
                                <?php
                            }
                            if ($getDetails['is_payasyougo'] == 2) {
                                ?>
                                <tr>
                                    <th align="left" style="padding:9px 0px 9px 0px">Discount per transaction :</th>
                                    <td style="padding:9px 0px 9px 0px"><?php echo ($getDetails['Discount']) ? floatval($getDetails['Discount']) : '0' . '%'; ?></td>
                                </tr>
                                <tr>
                                    <th align="left" style="padding:9px 0px 9px 0px">Discount amount(&pound;) :</th>
                                    <td style="padding:9px 0px 9px 0px"><?php echo ($discount) ? number_format($discount, 2) : '0.00'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>

                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Total balance(&pound;) :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo ($totalBalance) ? number_format($totalBalance, 2) : '0.00'; ?></td>
                            </tr>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Refunded amount(&pound;) :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo ($refundAmount) ? number_format($refundAmount, 2) : '0.00'; ?></td>
                            </tr>
                        </table>
                        </div>
                        <div class="span6">
                            <table align="center" width="50%">
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Bar name :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo $getDetails['Business_Name']; ?></td>
                            </tr>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Owner name :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo $getDetails['name']; ?></td>
                            </tr>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Location :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo ($getDetails['Location_Searched']) ? $getDetails['Location_Searched'] : $getDetails['Address']; ?></td>
                            </tr>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Contact number :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo $getDetails['PhoneNo']; ?></td>
                            </tr>
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Category :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo ($getDetails['Category_Searched']) ? $getDetails['Category_Searched'] : $getDetails['Category']; ?></td>
                            </tr>
                        </table>
                        </div>
                        <div class="span12" style="text-align: center;margin-bottom: 20px;"><a class="btn btn-primary" href="bar_lists.php">Back</a></div>
                    </div><!--/box-content-->
                    
                </div><!--/box span12-->
            </div><!--/row-fluid sortable-->
        </div><!--/content-->

    </div><!--/fluid-row-->
    <hr>
    <?php include("footer.php"); ?>
    </body>
    </html>