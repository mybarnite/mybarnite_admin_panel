<? include("header.php");

 $sel_product_query=mysql_query("select * from tbl_product where id='".$_REQUEST['prod_id']."'");
 $fetch_product=mysql_fetch_array($sel_product_query);
 
  $sel_category_query=mysql_query("select * from tbl_main_category where id='".$fetch_product['category_id']."'");
 $fetch_category_tmp=mysql_fetch_array($sel_category_query);
 
  $sel_subcategory_query=mysql_query("select * from tbl_subcategory where id='".$fetch_product['subcategory_id']."'");
  $fetch_subcategory_tmp=mysql_fetch_array($sel_subcategory_query);
 
  
 
 if(isset($_REQUEST['add_new_product']))
 {   
   
	 $category_id=trim($_REQUEST['category_id']); 
	 $subcategory_id =trim($_REQUEST['subcategory_id']); 
	  $prod_name=trim($_REQUEST['prod_name']);
	  $sku=$_REQUEST['payment'];
	  $url=sluggify(trim($_REQUEST['prod_name']));
	  $prod_descr=addslashes($_REQUEST['prod_descr']);
	   $price=trim($_REQUEST['price']);
	 $qty=trim($_REQUEST['price_old']);
	
	
	
	
	
	
	
	$chk=$_REQUEST['check'];
	 if($chk != 0){
  foreach($chk as $val)
  {
  
  $women1.=$val."|";
  
  //mysql_query("update tbl_product set status='Active' where id='".$id."'");
   //$_SESSION['msg']="Selected Product is Activated";
  }
  
 $women= "women|".$women1;

 $women= substr($women,0,-1);
}
else{
 $women=0;
}

$chk2=$_REQUEST['check2'];
if($chk2!=0){ 
 foreach($chk2 as $val2)
  {
  
  $men1.=$val2."|";
  
  //mysql_query("update tbl_product set status='Active' where id='".$id."'");
   //$_SESSION['msg']="Selected Product is Activated";
  }


  $men="men|".$men1;

 $men= substr($men,0,-1);
}else {
   $men=0;
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	  if($_FILES['prod_image']['name']!='')
	 {
	 $prod_image = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['prod_image']['name']);
       move_uploaded_file($_FILES["prod_image"]["tmp_name"],"../product_images/".$prod_image);
	   
	   	 mysql_query("update tbl_product set prod_image='".$prod_image."' where id='".$_REQUEST['prod_id']."'") or die(mysql_error());	 
	
	 }
	 if($_FILES['prod_image1']['name']!='')
	 {
	 $prod_image1 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['prod_image1']['name']);
       move_uploaded_file($_FILES["prod_image1"]["tmp_name"],"../product_images/".$prod_image1);
	   
	   	 mysql_query("update tbl_product set prod_image1='".$prod_image1."' where id='".$_REQUEST['prod_id']."'") or die(mysql_error());	 
	
	 }
	 if($_FILES['prod_image2']['name']!='')
	 {
	 $prod_image2 = md5(uniqid(rand(), true)).'.'.file_ext($_FILES['prod_image2']['name']);
       move_uploaded_file($_FILES["prod_image2"]["tmp_name"],"../product_images/".$prod_image2);
	   
	   	 mysql_query("update tbl_product set prod_image2='".$prod_image2."' where id='".$_REQUEST['prod_id']."'") or die(mysql_error());	 
	
	 }
	  
	
       $succ= mysql_query("update tbl_product set  category_id='".$category_id."',subcategory_id='".$subcategory_id."',sku='".$sku."', prod_name='".$prod_name."',url='".$url."',prod_descr='".$prod_descr."',price='".$price."',qty='".$qty."' ,men='".$men."',women='".$women."' where id='".$_REQUEST['prod_id']."'");	 
	 
	       if($succ)
		 {
		   
		   $_SESSION['msg']="Product is Successfully Updated";	
		   }
		   else
		 {
		   $_SESSION['msg']="Some error";	
		   }
		   ?>
		  <script>window.location.href="manage_product.php?msg=<?=$_SESSION['msg'];?>"</script>
		   <?
	 }
 
?>
	<!-- topbar ends -->
			
        
       <script src="js/jquery-1.9.1.js"></script>
 <script src="js/jquery-ui.js"></script>
         
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
		   var subcategory_name=document.getElementById('subcategory_id').value;

         
		 
		  
		   var product_name=document.getElementById('prod_name').value;

          if(product_name=='')
		 {
		  alert('Enter Product Name');
		  document.getElementById('prod_name').focus();
		  return false;
		  }
		  
		    var sku=document.getElementById('sku').value;

          if(sku=='')
		 {
		  alert('Enter Product SKU Code');
		  document.getElementById('sku').focus();
		  return false;
		  }
		   var product_price=document.getElementById('price').value;

          if(product_price=='')
		 {
		  alert('Enter Product Price');
		  document.getElementById('price').focus();
		  return false;
		  }
		  
		
		  
		

        
	return true;
	}
       
	</script>
	
	
	<script>
 
 
 
$(function() {
$( "#accordion" ).accordion();
});

$().ready(function(){
$("#radio").hide();
$("#bank").click(function(){
	$( "#radio" ).show();
	$("#radio1").hide();
	$("#radio2").hide();
	
});


});
$().ready(function(){
$("#radio1").hide();
$("#hide").click(function(){
	$("#radio").hide();
	$("#radio1").hide();
	$("#radio2").hide();
	
});


});

$().ready(function(){
$("#radio1").show();
$("#hide2").click(function(){
	$("#radio1").hide();
	$("#radio").hide();
	$("#radio2").hide();
	
});


});

$().ready(function(){
$("#radio2").hide();
$("#hide3").click(function(){
	$("#radio2").show();
	$("#radio").hide();
	$("#radio1").hide();
	
});


});
</script>
	
	<script>
	
	$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
			
			
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
	
	</script>
	
	
	
	<script>
	
	$(document).ready(function() {
    $('#selecctall3').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox3').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox3').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
	
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
						<h2><i class="icon-edit"></i>Edit Product</h2>
						<div align="right">
							<a href="manage_product.php" class="btn btn-setting btn-round">Back To Product List</a>
							
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
                        <td ><label class="control-label" for="typeahead">Product Category*</label></td>
                        <td>
                        <select name="category_id" id="category_id" onchange="get_subcategory(this.value)" required="required">
                        <option><?php echo $fetch_product['category_id'];?></option>
                        <?// $sel_category_query= mysql_query("select * from tbl_main_category where status='Active' order by category_name");
						 // while($fetch_category=mysql_fetch_array($sel_category_query)){
						?>
                        
						
						
						
						<option>New Arrivals</option>
						<option>Dresses</option>
						<option>Tops & Blouses</option>
						<option>Outerwear</option>
						<option>Bottoms</option>
						<option>Accessories</option>
						<option>Featured</option>
						
						
						
                        </select>
                        </td>
                         </tr>
                         <tr >
						 <td ><label class="control-label" for="typeahead">Select Search type*</label></td>
                        <td><?php  if($fetch_product['women']!='0'){ ?><input type="radio" name="men" value="women" id="hide4" checked="checked"/>Women <?php } else { ?>
						<input type="radio" name="men" value="men" id="hide5" checked="checked"/>Men
						<?php } ?>
						</td>
                         </tr>
						
						 
						 
						 <?php  if($fetch_product['women']!='0'){ ?>
                         <tr id="radio4">
						 <td ><label class="control-label" for="typeahead">Women</label></td>
						 <td>
						 <ul class="chk-container">
						<li><input type="checkbox" id="selecctall"/> Selecct All</li>
						<li>
						
						
						<?php $wo=explode("|",$fetch_product['women']);
						
						
						
						?>
						
						
						
						
						<input class="checkbox1" type="checkbox" name="check[]" <?php foreach($wo as  $womens){ if ($womens=='women-accessories'){ ?> checked="checked"  <?php } } ?> value="women-accessories">Women-Accessories</li>
						
						<?php  ?>
						<li><input class="checkbox1" type="checkbox" name="check[]" value="women-swimwear" <?php foreach($wo as  $womens){ if ($womens=='women-swimwear'){ ?> checked="checked"  <?php } } ?>>Women-Swimwear</li>
						
						<li><input class="checkbox1" type="checkbox" name="check[]" value="women-basics" <?php foreach($wo as  $womens){ if ($womens=='women-basics'){ ?> checked="checked"  <?php } } ?> > Women-Basics</li>
						
						<li><input class="checkbox1" type="checkbox" name="check[]" value="women-dresses" <?php foreach($wo as  $womens){ if ($womens=='women-dresses'){ ?> checked="checked"  <?php } } ?> > Women-Dresses</li>
						
						<li><input class="checkbox1" type="checkbox" name="check[]" value="women-jeans" <?php foreach($wo as  $womens){ if ($womens=='women-jeans'){ ?> checked="checked"  <?php } } ?>> Women-Jeans</li>
						
						<li><input class="checkbox1" type="checkbox" name="check[]" value="women-skirt" <?php foreach($wo as  $womens){ if ($womens=='women-skirt'){ ?> checked="checked"  <?php } } ?> > Women-Skirt</li>
						
						<li><input class="checkbox1" type="checkbox" name="check[]" value="women-legging" <?php foreach($wo as  $womens){ if ($womens=='women-legging'){ ?> checked="checked"  <?php } } ?> > Women-Legging</li>
						
						</ul>
						 
						 </td>
						 </tr>
						 
						 <?php  } else { $mo= (explode("|",$fetch_product['men'])); ?>
						 
						 <tr id="radio5">
						 <td ><label class="control-label" for="typeahead">Men</label></td>
						 <td>
						 <ul class="chk-container">
						<li><input type="checkbox" id="selecctall3"/> Selecct All</li>
						
						<li><input class="checkbox3" type="checkbox" name="check2[]" value="men-accessories"
						<?php foreach($mo as  $mens){  if ($mens=='men-accessories'){ ?> checked="checked"  <?php } } ?> >Men-Accessories</li>
						
						<li><input class="checkbox3" type="checkbox" name="check2[]" value="men-jacket" <?php foreach($mo as  $mens){ if ($mens=='men-jacket'){ ?> checked="checked"  <?php } } ?> >Men-Jacket</li>
						
						<li><input class="checkbox3" type="checkbox" name="check2[]" value="men-jumper" <?php foreach($mo as  $mens){ if ($mens=='men-jumper'){ ?> checked="checked"  <?php } } ?> > Men-Jumper</li>
						
						<li><input class="checkbox3" type="checkbox" name="check2[]" value="men-jean" <?php foreach($mo as  $mens){ if ($mens=='men-jean'){ ?> checked="checked"  <?php } } ?> > Men-Jean</li>
						
						<li><input class="checkbox3" type="checkbox" name="check2[]" value="men-shoe" <?php foreach($mo as  $mens){ if ($mens=='men-shoe'){ ?> checked="checked"  <?php } } ?> > Men-Shoe</li>
						
						<li><input class="checkbox3" type="checkbox" name="check2[]" value="men-tshirt" <?php foreach($mo as  $mens){ if ($mens=='men-tshirt'){ ?> checked="checked"  <?php } } ?> > Men-Tshirt</li>
						
						<!--li><input class="checkbox3" type="checkbox" name="check[]" value="women-legging"> Women-Legging</li-->
						</ul>
                       </td>
                         </tr>
                       <?php } ?>
                       
                           
						 <tr >
                        <td ><label class="control-label" for="typeahead">Product Name*</label></td>
                        <td><input type="text"  name="prod_name" id="prod_name"  size="30" value="<?php echo $fetch_product['prod_name'];?>" /></td>
                         </tr>
                
                         <tr >
                        <td ><label class="control-label" for="typeahead">Product type*</label></td>
                        <td><?php   $value=$fetch_product['sku']; if($value=='new'){  ?>
						<input type="radio" name="payment" value="new" id="hide2" checked="checked"/>New
						<?php }
						else {
						
						?>
						
						<input type="radio" name="payment" value="new" id="hide2"/>New
						<?php } 
						
						if($value=='sale'){
						
						?>
						<input type="radio" name="payment" value="sale" id="hide3"/ checked="checked">Sale
						
						<?php } else{  ?>
						<input type="radio" name="payment" value="sale" id="hide3"/>Sale
						<?php  } ?>
						<input type="radio" name="payment" value="normal" id="bank"  />Normal
						</td>
                         </tr>
						 <?php if($value=='sale'){ ?> 
						 <tr id="radio1" >
					        <td ><label class="control-label" for="typeahead">Old price*</label></td>
                            <td><input type="text"   name="price_old" id="price"  size="30" value='<?php echo $fetch_product['qty'];?>' />${ eg : 150} </td>
                               
							   <?php } ?>
                           </tr>
						 <tr id="radio2" >
					        <td ><label class="control-label" for="typeahead">Old price*</label></td>
                            <td><input type="text"   name="price_old" id="price"  size="30" value='<?php echo $fetch_product['qty'];?>' />${ eg : 150} </td>
                               
                           </tr>
                        
						 
                          <tr >
                        <td ><label class="control-label" for="typeahead">Price*</label></td>
                        <td><input type="text"   name="price" id="price"  size="30" value="<?php echo $fetch_product['price'];?>" />  
                          $ { eg : 120}</td>
                         </tr>
                          <tr >
                        <td ><span class="control-label"></span></td>
                        <td><input type="hidden"   name="qty" id="qty"  size="30" value="<?php echo $fetch_product['qty'];?>"/></td>
                         </tr>
                          <tr >
                           <tr >
                        <td ><label class="control-label" for="typeahead">Product Image*</label></td>
                        <td><input type="file" class="span6 typeahead"  name="prod_image" id="prod_image"  size="25" />
						<img src='../product_images/<?php echo $fetch_product['prod_image'];?>' width='100' height='100'></img>
						<input type="file" class="span6 typeahead"  name="prod_image1" id="prod_image1"  size="25" />
						<img src='../product_images/<?php echo $fetch_product['prod_image1'];?>' width='100' height='100'></img>
						<input type="file" class="span6 typeahead"  name="prod_image2" id="prod_image2"  size="25" />
						<img src='../product_images/<?php echo $fetch_product['prod_image2'];?>' width='100' height='100'></img>
						</td>
                         </tr>
                         
                         
                          <tr >
                        <td ><label class="control-label" for="typeahead">Product Description</label></td>
                        <td><textarea name="prod_descr" id="prod_descr" rows="5" cols="45"><?php echo $fetch_product['prod_descr'];?></textarea>
                        <br />
                         <script type="text/javascript">
			
							CKEDITOR.replace( 'prod_descr',
								{
									skin : 'v2'
								});
			
						  </script>
                        </td>
                         </tr>
                        
                           <tr>
                        <td ><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <input type="submit" name="add_new_product" value="Edit Product" class="btn btn-primary" onclick="return product_validation()" />
                      
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
