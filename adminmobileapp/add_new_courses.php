<? include("header.php");

 if(isset($_REQUEST['add_new_category']))
 {
	 $subcategory_name=trim($_REQUEST['subcategory_name']);
	 $meta_title=trim($_REQUEST['meta_title']);
	 $meta_keywords=trim($_REQUEST['meta_keywords']);
	 $meta_descr=trim($_REQUEST['meta_descr']);
	 $video=trim($_REQUEST['video']);
	 $category_descr=trim($_REQUEST['category_descr']);
	
	$type=trim($_REQUEST['type']);
	 $course_duration=trim($_REQUEST['course_duration']);
	 $mentor=trim($_REQUEST['mentor']);
	  $url_link=trim($_REQUEST['url_link']);
	
	
	
	  $url  =sluggify($_REQUEST['category_descr']);
	   $pro = "select subcat_name from tbl_courses where subcat_name = '".$subcategory_name."'";
                       $que = mysql_query($pro) or die(mysql_error());
                       $num = mysql_num_rows($que);
                       if($num!=0)
                               {
                                                       $num = $num+1;
                                                       $url = $url."-".$num;
                               }  
   $query= mysql_query("select * from tbl_courses where subcat_name='".$subcategory_name."' and subcategory_id='".$_REQUEST['sub_cat']."'");
     $chk_cat= mysql_num_rows($query);
	 if($chk_cat>=1)
	 {
	   
     $_SESSION['msg']="SubCategory is Already Exist In this Category";	
	   ?>
		  <script>window.location.href="add_new_courses.php?cat_id=<?=$_REQUEST['cat_id'];?>&sub_cat=<?=$_REQUEST['sub_cat'];?>&msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
	 else
	 {
	    
		if($_FILES['subcat_image']['name']!=''){
	  $subcat_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['subcat_image']['name']);

       move_uploaded_file($_FILES["subcat_image"]["tmp_name"],"product_images/".$subcat_image);
	 }
       $succ= mysql_query("insert into tbl_courses set subcat_name='".$subcategory_name."',url_link='".$url_link."',type='".$type."',course_duration='".$course_duration."',mentor='".$mentor."',subcat_image='".$subcat_image."',url='".$url."',category_descr='".$category_descr."',subcategory_id = '".$_REQUEST['sub_cat']."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_descr='".$meta_descr."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="SubCategory is Successfully Added";	
		   }
		   else
		 {
		   $_SESSION['msg']="SubCategory is Not Added";	
		   }
		   ?>
		  <script>window.location.href="add_new_courses.php?cat_id=<?=$_REQUEST['cat_id'];?>&sub_cat=<?=$_REQUEST['sub_cat'];?>&msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 }
?>
	<!-- topbar ends -->
    <script>
	
	function main_category_valid()
	{
		
	   if(document.getElementById('subcat_image').value=='')

		{

	  alert('Please Upload Image');

	  document.getElementById('subcat_image').focus();

	  return false;

	  }
	return true;
	}
       
	</script>
    <script>
		function generateRow() {
		var d=document.getElementById("div");
		d.innerHTML+="<p><input type='text' name='product_size[]'>";
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
						<h2><i class="icon-edit"></i>Add New SubCatgory</h2>
						<div align="right">
                        <a href="manage_courses.php?cat_id=<?=$_REQUEST['cat_id'];?>&subcat_id=<?=$_REQUEST['sub_cat'];?>" class="btn btn-setting btn-round">Back</a>
							
							
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
                        <td width="30%">&nbsp;</td>
                         <td width="67%">&nbsp;</td>
                         <td width="3%">&nbsp;</td>
                        
                        </tr>
						 <tr >
                        <td ><label class="control-label" for="typeahead">Course Name*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="subcategory_name" id="subcategory_name"  size="40" /></td>
                         </tr>
                         	 <tr >
                        <td ><label class="control-label" for="typeahead">Url Link*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="url_link" id="subcategory_name"  size="40" /></td>
                         </tr>
                          <tr >
                        <td ><label class="control-label" for="typeahead">Type*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="type" id="subcategory_name"  size="40" /></td>
                         </tr>
                             <tr >
                        <td ><label class="control-label" for="typeahead">Course Duration*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="course_duration" id="subcategory_name"  size="40" /></td>
                         </tr>
                                 <tr >
                        <td ><label class="control-label" for="typeahead">Mentor*</label></td>
                        <td><input type="text" class="span6 typeahead"  name="mentor" id="subcategory_name"  size="40" /></td>
                         </tr>
                            <tr >

                        <td ><label class="control-label" for="typeahead"> Image*</label></td>

                        <td><input type="file" class="span6 typeahead"  name="subcat_image" id="subcat_image"  size="40" /></td>

                         </tr>
                         
                         
                       
                      <!-- <tr >

                        <td ><label class="control-label" for="typeahead"> Image*</label></td>

                        <td><input type="file" class="span6 typeahead"  name="subcat_image" id="subcat_image"  size="40" /></td>

                         </tr>-->
                        
                         
                           <!--<tr >

                        <td ><label class="control-label" for="typeahead">Video</label></td>

                        <td><input type="text" class="span6 typeahead"  name="video"  size="40" />
                      
[<strong>eg:</strong>http://www.youtube.com/watch?v=<strong style="color:#F00;">TuET0kpHoyM</strong>&feature=g-all-xit]
<br /> 
<span style="color:#F00;">Please Enter Highlighted Part In this box</span><br /></td>

                         </tr>-->
                         
                         <tr >
                        <td ><label class="control-label" for="typeahead">Description</label></td>
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
                        <input type="submit" name="add_new_category" value="Add New SubCategory" class="btn btn-primary" onclick="return main_category_valid()" />
                      
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
