<? include("header.php");



$sel_subcategory=mysql_query("select * from tbl_clasified where id='".$_REQUEST['id']."'");

$fetch_subcategory=mysql_fetch_array($sel_subcategory);



 if(isset($_REQUEST['add_new_category']))

 {

	 $subcategory_name=$_REQUEST['subcategory_name'];
     $meta_title=trim($_REQUEST['meta_title']);
	 $meta_keywords=trim($_REQUEST['meta_keywords']);
	 $meta_descr=trim($_REQUEST['meta_descr']);
	 $video=trim($_REQUEST['video']);
	 $category_descr=trim($_REQUEST['category_descr']);
	   
    	if($_FILES['subcat_image']['name']!=''){
	  $subcat_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['subcat_image']['name']);

       move_uploaded_file($_FILES["subcat_image"]["tmp_name"],"product_images/".$subcat_image);
	  $succ= mysql_query("update tbl_clasified set subcat_image='".$subcat_image."' where id='".$_REQUEST['subcat_id']."'");	 
 
	 }
       $succ= mysql_query("update tbl_clasified set subcat_name='".$subcategory_name."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_descr='".$meta_descr."',video='".$video."', category_descr ='".$category_descr."'  where id='".$_REQUEST['id']."'");	 

	 

	       if($succ)

		 {

		   

		   $_SESSION['msg']="SubCategory is Successfully Updated";	

		   }

		   else

		 {

		   $_SESSION['msg']="SubCategory is Not Updated";	

		   }

		   ?>

		  <script>window.location.href="manage_services.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$_REQUEST['subcat_id'];?>&msg=<?=$_SESSION['msg'];?>"</script>

		   <?

	 }

 

?>

	<!-- topbar ends -->

    <script>

	

	function main_category_valid()

	{

		var category_name=document.getElementById('subcategory_name').value;



          if(category_name=='')

		{

	  alert('Please Enter New SubCategory Name');

	  document.getElementById('subcategory_name').focus();

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

						<h2><i class="icon-edit"></i>Edit SubCatgory</h2>

						<div align="right">

                        <a href="manage_services.php?cat_id=<?=$_REQUEST['cat_id'];?>" class="btn btn-setting btn-round">Back</a>

							

							

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

                        <td>&nbsp;</td>

                         <td>&nbsp;</td>

                         <td>&nbsp;</td>

                        

                        </tr>

						 <tr >

                        <td ><label class="control-label" for="typeahead">Services Name*</label></td>

                        <td><input type="text" class="span6 typeahead"  name="subcategory_name" id="subcategory_name"  size="40" value="<?=$fetch_subcategory['subcat_name'];?>"/></td>

                         </tr>
                         <tr >

                        <td >Video</td>

                        <td><input type="text" class="span6 typeahead"  name="video"  size="40" value="<?=$fetch_subcategory['video'];?>" /></td>

                         </tr>
                       <!--  <tr >

                        <td ><label class="control-label" for="typeahead">Image</label></td>

                        <td><input type="file" class="span6 typeahead"  name="subcat_image" id="subcat_image"  size="40" /></td>

                         </tr>-->
                          
                         <tr >
                        <td ><label class="control-label" for="typeahead">Description</label></td>
                        <td>
                        <textarea name="category_descr" id="category_descr" rows="20" cols="45"><?=$fetch_subcategory['category_descr'];?></textarea>
                         <script type="text/javascript">
			
							CKEDITOR.replace( 'category_descr',
								{
									skin : 'v2'
								});
			
						  </script>
                        </td>
                         </tr>
                         <tr >

                        <td >Meta Title</td>

                        <td><input type="text" class="span6 typeahead"  name="meta_title"  size="40" value="<?=$fetch_subcategory['meta_title'];?>" /></td>

                         </tr>
                         <tr >

                        <td ><label class="control-label" for="typeahead">Meta Keywords</label></td>

                        <td><input type="text" class="span6 typeahead"  name="meta_keywords"  size="40"value="<?=$fetch_subcategory['meta_keywords'];?>" /></td>

                         </tr>
                         <tr >

                        <td ><label class="control-label" for="typeahead">Meta Descrption </label></td>

                        <td><input type="text" class="span6 typeahead"  name="meta_descr"  size="40" value="<?=$fetch_subcategory['meta_descr'];?>"/></td>

                         </tr>
                       

                           <tr>

                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>

                        <td>

                        <input type="submit" name="add_new_category" value="Edit SubCategory" class="btn btn-primary" onclick="return main_category_valid()" />

                      

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

