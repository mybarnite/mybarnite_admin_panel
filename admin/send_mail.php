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
	<!-- topbar ends -->
    <script>
	
	function main_category_valid()
	{
	/*	var category_name=document.getElementById('category_descr').value;

          if(category_name=='')
		{
	  alert('Please Enter New Message');
	  document.getElementById('category_descr').focus();
	  return false;
	  }*/

	}
       
	</script>

    	<!-- ajax script start -->
      
        	<!-- ajax script ends -->
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
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>Add New Message</h2>
						<div align="right">
                        <a href="manage_email.php" class="btn btn-setting btn-round">Back</a>
							
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><?php echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
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

					</div>
				</div>

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
