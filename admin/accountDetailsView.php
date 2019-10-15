<?php include("header.php"); ?>
<?php
$q1 = "select * from user_register where id = " . $_GET['id'];
$exe1 = mysql_query($q1);
$getUserName = mysql_fetch_assoc($exe1);

$q2 = "select * from tbl_accounts where user_id = " . $_GET['id'];
$exe2 = mysql_query($q2);
$totalAccount = 0;
while ($getAccount = mysql_fetch_assoc($exe2)) {
    $totalAccount++;
    $getAccounts[] = $getAccount;
}

$query2 = "select SUM(totalPayeableAmount) as totalRefund from tbl_businessowner_subscription where Owner_id=" . $_GET['id'] . "  and payment_status='Refund Requested'";
$execute2 = mysql_query($query2);
$totalRefund = mysql_fetch_assoc($execute2);

$query = "SELECT bl.id as barid,ur.*,bl.* FROM bars_list as bl LEFT JOIN user_register as ur ON bl.Owner_id = ur.id and bl.Business_Name!='' where bl.Owner_id = " . $_GET['id'];
$execute = mysql_query($query);
$getDetails = mysql_fetch_assoc($execute);

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


/*$query3 = "select * from bars_list where Owner_id=" . $_GET['id'];
$execute3 = mysql_query($query3);
$res = mysql_fetch_assoc($execute3);

if ($res['is_payasyougo'] == 1) {
    //Comission
    $comission = ($totalRefund['totalRefund'] * $res['Commission']) / 100;
    $totalRequestedRefund = $totalRefund['totalRefund'] - $comission;
}

if ($res['is_payasyougo'] == 2) {
    //Discount
    $totalRequestedRefund = $totalRefund['totalRefund'];

}

if ($totalRequestedRefund > 0) {
    $totalRequestedRefund = number_format($totalRequestedRefund, 2);
} else {
    $totalRequestedRefund = '0.00';
}*/

/* echo "<pre>";
print_r($getAccounts);
echo $totalAccount;
exit; */
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
                        <table align="center" width="30%">
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
                            <tr>
                                <th align="left" style="padding:9px 0px 9px 0px">Total sales(&pound;) :</th>
                                <td style="padding:9px 0px 9px 0px"><?php echo ($totalSales) ? number_format($totalSales, 2) : '0.00'; ?></td>
                            </tr>
                            <?php
                            if ($getDetails['is_payasyougo'] == 1) {
                                ?>
                                <tr>
                                    <th align="left" style="padding:9px 0px 9px 0px">Commission amount(&pound;) :</th>
                                    <td style="padding:9px 0px 9px 0px"><?php echo ($commission) ? number_format($commission, 2) : '0.00'; ?></td>
                                </tr>
                                <?php
                            }
                            if ($getDetails['is_payasyougo'] == 2) {
                                ?>
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
                    </div><!--/box-content-->
                </div><!--/box span12-->
            </div><!--/row-fluid sortable-->
        </div>
        <div id="content" class="span10">
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2 style="float:left;"><i class="icon-list"></i> <?php echo $getUserName['name']; ?> - Account
                            Details</h2>
                    </div><!--/box-header well-->
                    <br/>
                    <!--<div class="" data-original-title>
								<center>

								<?php if ($res['is_payasyougo'] == 1) { ?>
									<span style="color:red"> Total Requested Refund (After comission deducted ) (&pound;) - <?php echo $totalRequestedRefund; ?> </span>
									<br/>
									<span style="color:red"> Comission charged (%) - <?php echo $res['Commission']; ?> </span>
									<br/>
								<?php
                    } else {
                        ?>
									<span style="float:right;color:red"> Total Requested Refund (&pound;) - <?php echo $totalRequestedRefund; ?> </span>
									<br/>
								<?php
                    }
                    ?>
								</center>
							</div>--><!--/box-header well-->
                    <div class="box-content account-box-container">
                        <?php
                        if ($totalAccount == 1) {
                            ?>
                            <div class="row clearfix">
                                <div class="span4">&nbsp;</div>
                                <div class="span4">
                                    <?php
                                    foreach ($getAccounts as $account) {
                                        ?>
                                        <div class="panel-group" id="account_contents">
                                            <div class="panel panel-default">
                                                <center>
                                                    <div class="panel-body">
                                                        <span><strong>Customer Id :</strong> <?php echo $account['customer_id']; ?></span>
                                                        <br/><br/>
                                                        <span><strong>Account name :</strong> <?php echo $account['account_name']; ?></span>
                                                        <br/><br/>
                                                        <span><strong>Account number :</strong> <?php echo $account['account_number']; ?></span>
                                                        <br/><br/>
                                                        <span><strong>Sort code :</strong> <?php echo $account['short_code']; ?></span>
                                                        <br/><br/>
                                                        <span><strong>Status : </strong><?php echo $account['status']; ?></span>
                                                        <br/><br/>
                                                    </div>

                                                </center>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="span4">&nbsp;</div>
                            </div>
                            <?php
                        } else {
                            ?>

                            <?php


                            foreach ($getAccounts as $account) {

                                ?>
                                <div class="span4">
                                    <div class="panel-group" id="account_contents">
                                        <div class="panel panel-default">

                                            <div class="panel-body">
                                                <span><strong>Customer Id :</strong> <?php echo $account['customer_id']; ?></span>
                                                <br/><br/>
                                                <span><strong>Account name :</strong> <?php echo $account['account_name']; ?></span>
                                                <br/><br/>
                                                <span><strong>Account number :</strong> <?php echo $account['account_number']; ?></span>
                                                <br/><br/>
                                                <span><strong>Sort code :</strong> <?php echo $account['short_code']; ?></span>
                                                <br/><br/>
                                                <span><strong>Status : </strong><?php echo $account['status']; ?></span>
                                                <br/><br/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                            <br/>
                            <?php
                        }

                        ?>
                    </div><!--/box-content-->
                </div><!--/box span12-->
            </div><!--/row-fluid sortable-->
        </div>
        <div id="content" class="span10">
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-content">
                        <a class="btn btn-primary" href="business_owener_list.php">Back</a>
                    </div><!--/box-content-->
                </div><!--/box span12-->
            </div><!--/row-fluid sortable-->
        </div>


        <!--/content-->

    </div><!--/fluid-row-->
    <hr>
    <?php include("footer.php"); ?>
    </body>
    </html>