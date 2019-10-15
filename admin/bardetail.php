<?php
include("admin/includes/config.cfg");
include("admin/includes/connection.con");
include("admin/includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();
?>


   <?php include'header.php'; ?>
<!--==============================Map=================================--> 

	
</header>
<div class="padcontent"></div>		

<!--==============================Content=================================--> 
<section id="content" class="main-content">
  <div class="container">
         <div class="row clearfix ">
        
		
		  
		  <?php
		  $detailid = $_GET['barid'];
		 
			$bardetailquery = mysql_query(" SELECT * FROM bars_list WHERE id='".$detailid."' ") or die(mysql_error());
			$bardetailrow = mysql_fetch_array($bardetailquery);
			
		  ?>
		 
						<div class="span6">
						<img src="images/detail.jpg"/>
						</div>
						<div class="span6">
        	<h2>Bar Detail</h2>
      			<div id="note"></div>
      			<div id="fields" class="contact-form">
      				<form id="ajax-contact-form" method="post" class="form-horizontal">
					
					
					<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Bar Name: <?php echo $bardetailrow['Business_Name'] ?></label>
							
      							
      					</div>
						<br>
					
      					<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Location: <?php echo $bardetailrow['Location_Searched'] ?></label>
							
      							
      					</div>
						<br>
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Category: <?php echo $bardetailrow['Category'] ?></label>
							
      							
      					</div>
						<br>
						
						
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Source Url: <?php echo $bardetailrow['Source_Url'] ?></label>
							
      							
      					</div>
						<br>
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Address: <?php echo $bardetailrow['Address'] ?></label>
							
      							
      					</div>
						<br>
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Zipcode: <?php echo $bardetailrow['Zipcode'] ?></label>
							
      							
      					</div>
						<br>
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Phone No: <?php echo $bardetailrow['PhoneNo'] ?></label>
							
      							
      					</div>
						<br>
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Rating: <?php echo $bardetailrow['Rating'] ?></label>
							
      							
      					</div>
						<br>
						
						<div class="control-group">
      						<label  style="font-size:16px;color:white" for="inputName">Entry Fee: $<?php echo(rand(1,40)); ?></label>
							
      							
      					</div>
						<br>
						
					
					
				<a href="barbookingpage.php?barid=<?php echo $bardetailrow['id'] ?>">	<button type="button" style="float:right;" name="bookbar" class="btn btn-default btn-color">Book Bar</button> </a>
						
						
      				</form>
      			</div>    
		</div>		  
		  
		
		
		
		
    </div>
	<br><br><br>
  </div>
</section>




	
    <?php include'footer.php'; ?>