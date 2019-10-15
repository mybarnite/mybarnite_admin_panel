<? include("header.php");

$banner_query=mysql_query("select * from tbl_banner where id='".$_REQUEST['banner_id']."'");
$fetch_banner=mysql_fetch_array($banner_query);
 if(isset($_REQUEST['add_new_banner']))
 {
	 
	   $title=trim($_REQUEST['title']);
	  $caption=trim($_REQUEST['caption']);
	   $alt=trim($_REQUEST['alt']);
	   $description=trim($_REQUEST['description']);
	   $url_link=trim($_REQUEST['url_link']);
	   $date_added=trim($_REQUEST['date_added']);
	
	 
	 if($_FILES['banner_image']['name']!='')
	 {
	  $banner_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['banner_image']['name']);
       move_uploaded_file($_FILES["banner_image"]["tmp_name"],"product_images/".$banner_image);
	$succ= mysql_query("update tbl_banner set  banner_image='".$banner_image."' where id='".$_REQUEST['banner_id']."'");	 
	 }
      
	  $succ= mysql_query("update tbl_banner set title='".$title."',caption='".$caption."',alt='".$alt."',description='".$description."',url_link='".$url_link."',date_added='".$date_added."' where id='".$_REQUEST['banner_id']."'");
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Banner is Successfully Updated";	
		   }
		   else
		 {
		   $_SESSION['msg']="Banner is Not Updated";	
		   }
		   ?>
		  <script>window.location.href="manage_banner.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	
 }
?>
	<!-- topbar ends -->
    <script>
	
	function banner_valid()
	{
		
	return true;
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
						<h2><i class="icon-edit"></i>Update Banner</h2>
						<div align="right">
							<a href="manage_banner.php" class="btn btn-setting btn-round">Back To Banner List</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="add_new_category" action="" method="post" enctype="multipart/form-data">
						<table align="center" width="80%" >
                         <tr > 
                         <td align="center"> Title</td>
                         <td><input type="text" name="title" id="title"  size="40" value="<?=$fetch_banner['title'];?>"/> </td>
                         </tr>
                           <tr > 
                         <td align="center">Caption</td>
                         <td><input type="text" name="caption" id="caption"  size="40" value="<?=$fetch_banner['caption'];?>"/> </td>
                         </tr>
					
                      <tr > 
                         <td align="center">Alt</td>
                         <td><input type="text" name="alt" id="alt"  size="40" value="<?=$fetch_banner['alt'];?>"/> </td>
                         </tr>
					
                      <tr > 
                         <td align="center">Banner Link</td>
                         <td><input type="text" name="url_link" id="url_link"  size="40" value="<?=$fetch_banner['url_link'];?>"/>
{Eg: http://example.com} </td>
                         </tr>
					     <tr > 
                         <td align="center">Banner Added Date</td>
                         <td><input type="text" name="date_added" id="date_added"  size="40" value="<?=$fetch_banner['date_added'];?>"/>
                           {Date should 2013-06-23 format} </td>
                         </tr>
					
                        <tr >
                        <td align="center"><label class="control-label" for="typeahead">Banner Image*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="banner_image" id="banner_image"  size="28" />
{Banner Size should be 1000*280 to better look}</td>
                         </tr>
                          <!-- <tr > 
                         <td align="center">Banner Description</td>
                         <td> <textarea rows="5" cols="30" name="description"  id="description"><?=$fetch_banner['description'];?></textarea> </td>
                         </tr>-->
					
					
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_banner" value="Edit Banner" class="btn btn-primary" onclick="return banner_valid()" />
                      
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
