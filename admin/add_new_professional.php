<? include("header.php");



 if(isset($_REQUEST['add_new_category']))

 {

	 $category_name=trim($_REQUEST['category_name']);
	 $url  =sluggify(trim($_REQUEST['category_name']));
	 $category_descr=trim($_REQUEST['category_descr']);
     $meta_title=trim($_REQUEST['meta_title']);
	 $meta_keywords=trim($_REQUEST['meta_keywords']);
	 $meta_descr=trim($_REQUEST['meta_descr']);

	 
       $pro = "select category_name from tbl_professional_courses where category_name = '".$category_name."'";
                       $que = mysql_query($pro) or die(mysql_error());
                       $num = mysql_num_rows($que);
                       if($num!=0)
                               {
                                                       $num = $num+1;
                                                       $url = $url."-".$num;
                               } 
   $query= mysql_query("select * from tbl_professional_courses where category_name='".$category_name."'");

     $chk_cat= mysql_num_rows($query);

	 if($chk_cat>=1)

	 {

	   

     $_SESSION['msg']="Category is Already Exist";	

	   ?>

		  <script>window.location.href="add_new_professional.php?msg=<?=$_SESSION['msg'];?>"</script>

		   <?

	 }

	 else

	 {

		

	  $category_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['category_image']['name']);

       move_uploaded_file($_FILES["category_image"]["tmp_name"],"product_images/".$category_image);

     

       $succ= mysql_query("insert into tbl_professional_courses set category_name='".$category_name."',url='".$url."',category_descr='".$category_descr."',category_image='".$category_image."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_descr='".$meta_descr."'");	 

	 

	       if($succ)

		 {

		   

		   $_SESSION['msg']="Category is Successfully Added";	

		   }

		   else

		 {

		   $_SESSION['msg']="Category  is Not Added";	

		   }

		   ?>

		  <script>window.location.href="add_new_professional.php?msg=<?=$_SESSION['msg'];?>"</script>

		   <?

	 }

 }

?>

	<!-- topbar ends -->

    <script>

	

	function main_category_valid()

	{

		var category_name=document.getElementById('category_name').value;



          if(category_name=='')

		{

	  alert('Please Enter New Category Name');

	  document.getElementById('category_name').focus();

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

						<h2><i class="icon-edit"></i>Add New Main Catgory</h2>

						<div align="right">

							<a href="manage_professional.php" class="btn btn-setting btn-round">Back</a>

							

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

                        <td width="29%">&nbsp;</td>

                         <td width="69%">&nbsp;</td>

                         <td width="2%">&nbsp;</td>

                        

                        </tr>

						 <tr >

                        <td ><label class="control-label" for="typeahead">Category Name*</label></td>

                        <td><input type="text" class="span6 typeahead"  name="category_name" id="category_name"  size="40" /></td>

                         </tr>

                       <!-- <tr >

                        <td ><label class="control-label" for="typeahead">Category Image</label></td>

                        <td><input type="file" class="span6 typeahead"  name="category_image"  size="40" /></td>

                         </tr>
                         
                           <tr >
                        <td ><label class="control-label" for="typeahead">Description</label></td>
                        <td>
                        <textarea name="category_descr" id="category_descr" rows="20" cols="45"></textarea>
                         <script type="text/javascript">
			
							CKEDITOR.replace( 'category_descr',
								{
									skin : 'v2'
								});
			
						  </script>
                        </td>
                         </tr>-->
                        <tr >

                        <td >Meta Title</td>

                        <td><input type="text" class="span6 typeahead"  name="meta_title"  size="40" /></td>

                         </tr>
                         <tr >

                        <td ><label class="control-label" for="typeahead">Meta Keywords</label></td>

                        <td><input type="text" class="span6 typeahead"  name="meta_keywords"  size="40" /></td>

                         </tr>
                         <tr >

                        <td ><label class="control-label" for="typeahead">Meta Descrption </label></td>

                        <td><input type="text" class="span6 typeahead"  name="meta_descr"  size="40" /></td>

                         </tr>
                         

                           <tr>

                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>

                        <td>

                        <input type="submit" name="add_new_category" value="Add New Main Category" class="btn btn-primary" onclick="return main_category_valid()" />

                      

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

