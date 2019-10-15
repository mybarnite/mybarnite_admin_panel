<?

include("../includes/config.cfg");

include("../includes/connection.con");

include("../includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();

 $category_id=$_GET['category_id'];
 $min=$_GET['min'];
 $max=$_GET['max'];
?>

       <table width="98%" border="0" cellspacing="0" cellpadding="0">
                      <?php $exe_prdq= mysql_query("select * from tbl_product where category_id='".$category_id."' and price between '$min' and '$max' and status='Active'");
					    while($fetch_prod=mysql_fetch_array($exe_prdq)){
					  
					  ?>
                        <tr>
                          <td align="center" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="5" style="padding-top:7px;">
                            <tr>
                              <td width="24%" align="left" valign="top"><img src="phpThumb/phpThumb.php?src=<?php echo GetSiteRoot() ?>Adminpanel/product_images/<?php echo $fetch_prod['prod_image'];?>&w=179&h=182&iar=1"  class="inner-sec-image" /></td>
                              <td width="54%" align="left" valign="top" style="border-right:#CCC 1px solid"><div class="inner-top-font-bg">
                                <div class="inner-top-font"> <strong><?php echo $fetch_prod['prod_name'];?></strong></div>
                              </div>
                                <div class="inner-contnt-font"><?php echo $fetch_prod['prod_descr'];?></div></td>
                              <td width="22%" align="right" valign="top"><table width="140" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td align="left" valign="top">Code : <strong><?php echo $fetch_prod['sku'];?></strong></td>
                                </tr>
                                <tr>
                                  <td align="left" valign="top">Price     : <span><strong>Rs. <?php echo $fetch_prod['price'];?></strong></span></td>
                                </tr>
                                <?php if($fetch_prod['discount']!=''){?>
                                <tr>
                                  <td align="left" valign="top">Discount :  <strong>Rs. <?php echo $fetch_prod['discount'];?></strong></td>
                                </tr>
                                <?php }?>
                                <tr>
                                  <td align="left" valign="middle">Quantity: 
                                    <input name="textfield4" type="text" id="textfield4" size="5" /></td>
                                </tr>
                                <tr>
                                  <td align="left" valign="bottom"><a href="book-details.html"><img src="images/add-to-cart.jpg" width="96" height="36" /></a></td>
                                </tr>
                                <tr>
                                  <td align="left" valign="bottom"><a href="product/<?php echo $fetch_prod['url'];?>"><img src="images/view.jpg" /></a></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="left" valign="top">&nbsp;</td>
                              <td align="left" valign="top">&nbsp;</td>
                              <td align="left" valign="top">&nbsp;</td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td align="center" valign="top">&nbsp;</td>
                        </tr>
                        <?php }?>
                        
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                        </tr> 
                      </table>