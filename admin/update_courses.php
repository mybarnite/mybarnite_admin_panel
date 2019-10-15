<? include("header.php");



$sel_subcategory=mysql_query("select * from tbl_courses where id='".$_REQUEST['id']."'");

$fetch_subcategory=mysql_fetch_array($sel_subcategory);



 if(isset($_REQUEST['add_new_category']))

 {

	 $subcategory_name=$_REQUEST['subcategory_name'];
	  $url  =sluggify(trim($_REQUEST['subcategory_name']));
     $meta_title=trim($_REQUEST['meta_title']);
	 $meta_keywords=trim($_REQUEST['meta_keywords']);
	 $meta_descr=trim($_REQUEST['meta_descr']);
	 $video=trim($_REQUEST['video']);
	 $category_descr=trim(addslashes($_REQUEST['category_descr']));
	 $type=trim($_REQUEST['type']);
	  $course_duration=trim($_REQUEST['course_duration']);
	   $mentor=trim($_REQUEST['mentor']);
	    $url_link=trim($_REQUEST['url_link']);
		
		   $pro = "select category_name from tbl_elearning_cpd where category_name = '".$category_name."'";
                       $que = mysql_query($pro) or die(mysql_error());
                       $num = mysql_num_rows($que);
                       if($num!=0)
                               {
                                                       $num = $num+1;
                                                       $url = $url."-".$num;
                               }
		
	   
    	if($_FILES['subcat_image']['name']!=''){
	  $subcat_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['subcat_image']['name']);

       move_uploaded_file($_FILES["subcat_image"]["tmp_name"],"product_images/".$subcat_image);
	  $succ= mysql_query("update tbl_courses set subcat_image='".$subcat_image."' where id='".$_REQUEST['subcat_id']."'");	 
 
	 }
       $succ= mysql_query("update tbl_courses set subcat_name='".$subcategory_name."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_descr='".$meta_descr."',type='".$type."',course_duration='".$course_duration."',mentor='".$mentor."', url_link='".$url_link."',category_descr ='".$category_descr."',url='".$url."'  where id='".$_REQUEST['id']."'") or die(mysql_error());	 

	 

	       if($succ)

		 {

		   

		   $_SESSION['msg']="Courses is Successfully Updated";	

		   }

		   else

		 {

		   $_SESSION['msg']="Courses is Not Updated";	

		   }

		   ?>

		  <script>window.location.href="manage_courses.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$_REQUEST['subcat_id'];?>&msg=<?=$_SESSION['msg'];?>"</script>

		   <?

	 }

 

?>

	<!-- topbar ends -->



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

                        <a href="manage_courses.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$_REQUEST['subcat_id'];?>" class="btn btn-setting btn-round">Back</a>

							

							

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
                        <td ><label class="control-label" for="typeahead">Course Name*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="subcategory_name" value="<?=$fetch_subcategory['subcat_name'];?>" id="subcategory_name"  size="40" /></td>
                         </tr>
                         
                         			 <tr >
                        <td ><label class="control-label" for="typeahead">Url Link*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="url_link" value="<?=$fetch_subcategory['url_link'];?>" id="subcategory_name"  size="40" /></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Type*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="type" value="<?=$fetch_subcategory['type'];?>" id="subcategory_name"  size="40" /></td>
                         </tr>
                             <tr >
                        <td ><label class="control-label" for="typeahead">Course Duration*</label></td>
                        <td><input type="text" class="span6 typeahead" value="<?=$fetch_subcategory['course_duration'];?>" name="course_duration" id="subcategory_name"  size="40" /></td>
                         </tr>
                                 <tr >
                        <td ><label class="control-label" for="typeahead">Mentor*</label></td>
                        <td><input type="text" class="span6 typeahead" value="<?=$fetch_subcategory['mentor'];?>" name="mentor" id="subcategory_name"  size="40" /></td>
                         </tr>
                            <tr >

                        <td ><label class="control-label" for="typeahead"> Image*</label></td>

                        <td><input type="file" class="span6 typeahead"  name="subcat_image" id="subcat_image"  size="40" /></td>

                         </tr>
                          
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

