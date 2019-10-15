<? include("header.php");

if($_REQUEST['send'])

{
$id=$_REQUEST['chk'];
$mail_id=implode(", " , $id);
$mail=mysql_query("select * from tbl_email where id IN ($mail_id)");

	$num=mysql_num_rows($mail);

	
}

if($_REQUEST['send_mail'])
{
 $email1=$_REQUEST['email'];	
	
 $message=$_REQUEST['category_descr'];

$msg="<table align='center' cellSpacing='5' cellPadding='5' width='60%' border='2' >

<tbody>
<tr>
<td vAlign='top' style='background-color:#006699' colspan='3' >

<p style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16; color:#ffffff; text-align:center; background-color:#006699'>New Updates From Your Consult+</p></td>
</tr>
<tr>
<td vAlign='top' colspan='3' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; text-align:left; background-color:#85DDFA;' >New Updates</td>
</tr>

<tr>
<td vAlign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#003366; background-color:#E0F2FC;' ><div align='left'><strong>Message</strong></div> </td>
<td vAlign='top' style='font-family:Verdana, Arial, Helvetica, sans-serif;'>$message</td>
</tr>


</tbody>
</table>
";
$from="enquiries@consultplus.co.uk.";
$sub="You Have Received New Updates From www.consultplus.co.uk";
$mail_body = "$msg";
$sender ="CONSULT+ <".$from.">";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
$headers .= "from: ".$sender."\n";

$suc=mail($email1,$sub,$mail_body,$headers);

if($suc)
{
	$msg="Message Sent Sucessfully";
	?>
	<script type="text/javascript">window.location='manage_email.php?msg=<?php echo $msg ?>'</script>;
    <?php
}
else
{
	$msg = "Message Not Sent";
	?>
     <script type = "text/javascript">window.location='send_mail.php?id=<?php echo $fetch_email['id'] ?>&msg=<?php echo $msg ?>'</script>	
     <?php	
}

}
 
?>



<?php




  if(isset($_REQUEST['delete']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  $succ_del=mysql_query("delete from tbl_email where id='".$id."'");
  }
   if($succ_del)
  {
  $_SESSION['msg']="Selected record is successfully deleted";
  }
  else
  {
  $_SESSION['msg']="Static record is not successfully deleted";
  }
  ?>
	   <script>window.location.href="manage_email.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
   if(isset($_REQUEST['active']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_email set status='Active' where id='".$id."'");
   $_SESSION['msg']="Selected record is Activated";
  }
  ?>
	   <script>window.location.href="manage_email.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
  
  if(isset($_REQUEST['inactive']))
  {
  
  $chk=$_REQUEST['chk'];
  foreach($chk as $id)
  {
  mysql_query("update tbl_email set status='Inactive' where id='".$id."'");
   $_SESSION['msg']="Selected record is Inactivated";
  }
  ?>
	   <script>window.location.href="manage_email.php?msg=<?=$_SESSION['msg'];?>";</script>
	  <?
  }
?>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<? include("left.php");?><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
	<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

				<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-list"></i>Email Management</h2>
					  <div align="right">
                  <!--      <a href="add_news.php" class="btn btn-setting btn-round">Add New</a>-->
					    	
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
                    <?php if($_REQUEST['send'])
					{
						?>
                    
                     <form name="add_new_category" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
                         <tr >
                        <td width="30%">&nbsp;</td>
                         <td width="67%">&nbsp;</td>
                         <td width="3%">&nbsp;</td>
                        
                        </tr>
						 <tr >
                        <td ><label class="control-label" for="typeahead">Email Id*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="email" id="subcategory_name" value="<?php while ($fetch_email=mysql_fetch_array($mail)){ echo $fetch_email['email'].","; } ?>"  size="40" /></td>
                         </tr>
                       
                      <!-- <tr >

                        <td ><label class="control-label" for="typeahead"> Image*</label></td>

                        <td><input type="file" class="span6 typeahead"  name="subcat_image" id="subcat_image"  size="40" /></td>

                         </tr>-->
                        
                         
                           
                         <tr >
                        <td ><label class="control-label" for="typeahead">Message</label></td>
                        <td>
                        <textarea name="category_descr" id="category_descr" rows="20" cols="45"><?=$fetch_category['category_descr'];?></textarea>
                         <script type="text/javascript">
			
							CKEDITOR.replace( 'category_descr',
								{
									skin : 'v2'
								});
			
						  </script>
                        </td>
                         </tr>
                           
                         
                         
                         
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="send_mail" value="Send Mail" class="btn btn-primary" onclick="return main_category_valid()" />
                      
                      <button class="btn">Cancel</button></td>
                         </tr>
                        </table>
						</form>

                    <?php
					}
					else
					{
					?>
                    
                    
                    
                    <form action="" method="post" onSubmit="return validate()">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                   <th width="20">&nbsp;</th>
                                  
								 
                                  <th width="93">Email</th>
                                  
                                
                               
								
							    <th width="67">Status </th>
							  </tr>
						  </thead>   
						  <tbody>
                          <? $sel_page_query= mysql_query("select * from tbl_email");
						     while($fetch_content=mysql_fetch_array($sel_page_query))
							 {
							
						  ?>
							<tr>
                            <td><input type="checkbox" name="chk[]" value="<?=$fetch_content['id']; ?>" /></td>
                           
                            
                            <td class="center"><?=$fetch_content['email'];?></td>
                            
                           
                           
                            
                              
								<td class="center">
									<span class="label label-success"><?=$fetch_content['status'];?></span></td>
								
							</tr>
                            <? }?>
							
							</tr>
						  </tbody>
					  </table> 
                      <table class="table table-striped table-bordered bootstrap-datatable datatable">
                      <tr>
								<td>&nbsp;</td>
								<td class="center">&nbsp;</td>
								<td  align="right">
								<input type="submit" name="active" value="Acitve" class="input btn btn-danger" />
                              <input type="submit" name="inactive" value="Inactive" class="input btn btn-danger" />
                            <input type="submit" name="delete" value="Delete" class="input btn btn-danger" onclick="return confirmSubmit()"/>
                             <input type="submit" name="send" value="Mail Send" class="input btn btn-danger" />
                            
						</td>
                      </table> 
                      </form>  
                        <?php
					}
					?>
					</div>
				</div><!--/span-->
			
			</div>
				
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
