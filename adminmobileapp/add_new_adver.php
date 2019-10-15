<? include("header.php");

$sel_product_query=mysql_query("select * from tbl_adver where id='".$_REQUEST['id']."'");
 $fetch_product=mysql_fetch_array($sel_product_query);
 
  $sel_category_query=mysql_query("select * from tbl_main_category where id='".$fetch_product['category_id']."'");
 $fetch_category_tmp=mysql_fetch_array($sel_category_query);
  if(isset($_REQUEST['update']))
 {   
 
	
	 $category_id=trim($_REQUEST['category_id']); 
	
	  $image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['image']['name']);
       move_uploaded_file($_FILES["image"]["tmp_name"],"product_images/".$image);
       
      
       $succ= mysql_query("update tbl_adver set category_id='".$category_id."',image='".$image."' where id='".$_GET['id']."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Record is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Some error";	
		   }
		   ?>
		  <script>window.location.href="manage_adver.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 

 if(isset($_REQUEST['submit']))
 {   
 
	
	 $category_id=trim($_REQUEST['category_id']); 
	
	  $image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['image']['name']);
       move_uploaded_file($_FILES["image"]["tmp_name"],"product_images/".$image);
       
      
       $succ= mysql_query("insert into tbl_adver set category_id='".$category_id."',image='".$image."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Record is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="Some error";	
		   }
		   ?>
		  <script>window.location.href="manage_adver.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 
?>
	<!-- topbar ends -->
			
        
    <script>
	
	function validation()
	{
		
	   
	   var category_name=document.getElementById('category_id').value;

          if(category_name=='')
		{
		  alert('Select Category Name');
		  document.getElementById('category_id').focus();
		  return false;
		  }
		 
		  
		  var product_image=document.getElementById('image').value;

          if(product_image=='')
		 {
		  alert('Upload Advertisment Image');
		  document.getElementById('image').focus();
		  return false;
		  }
		  
		
        
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
						<h2><i class="icon-edit"></i></h2>
						<div align="right">
							<a href="manage_adver.php" class="btn btn-setting btn-round">Back To Listing</a>
							
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                     <tr><td align="center" style="color:#F00;">&nbsp;</td></tr>
                    </table>
						 <form name="my_form" action="" method="post" enctype="multipart/form-data" onsubmit="return validation();">
						<table align="center" width="80%" >
                         <tr >
                        <td width="36%">&nbsp;</td>
                         <td width="62%">&nbsp;</td>
                         <td width="2%">&nbsp;</td>
                        
                        </tr>
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead"> Category*</label></td>
                        <td>
                        <select name="category_id" id="category_id" onchange="get_subcategory(this.value)">
                        <option value="">---Select Category---</option>
                        <? $sel_category_query= mysql_query("select * from tbl_main_category where status='Active' order by category_name");
						  while($fetch_category=mysql_fetch_array($sel_category_query)){
						?>
                        <option value="<?=$fetch_category['id'];?>" <? if($fetch_category_tmp['id']==$fetch_category['id']){ echo "selected";}?>><?=$fetch_category['category_name'];?></option>
                        <? }?>
                        </select>
                        </td>
                         </tr>
                       
                          <tr >
                           <tr >
                        <td ><label class="control-label" for="typeahead">Advertisement Image*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="image" id="image"  size="25" />
                        <strong>{Image size should be atlest 230*372}</strong>
                        </td>
                         </tr>
                         
                         
                          <tr >
                        <td >&nbsp;</td>
                        <td>&nbsp;</td>
                         </tr>
                      
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <? if($_GET['flag']=='edit'){?>
                           <input type="submit" name="update" value="Update" class="btn btn-primary" />
                        <? }else{?>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
                      <? }?>
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
