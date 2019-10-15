<?php
include("admin/includes/config.cfg");
include("admin/includes/connection.con");
include("admin/includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();
?>

   <?php include'header.php'; ?>

<!--==============================Content=================================--> 
<section id="content" >
  <div class="container divider">
    
	  <h2>PROMOTION&rsquo;S</h2>
		<div class="row">
			<div class="span6">
				<img src="images/carusel_1.jpg" alt=""  border="0" class="alignleft "/>
				<p style="color:#fff">
					<strong>content goes here content goes here content goes here content goes here </strong>
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here <br /> <br /> 
					
				</p>
				
				<div class="clearfix padcontent"></div>
				
				<img src="images/carusel_2.jpg" alt=""  border="0" class="alignleft "/>
				<p style="color:#fff">
					<strong>content goes here content goes here content goes here </strong>
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here <br /> <br /> 
					
				</p>

			</div>
			
			<div class="span6">
				<img src="images/carusel_3.jpg" alt=""  border="0" class="alignleft "/>
				<p style="color:#fff">
					<strong>content goes here content goes here content goes here </strong>
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here <br /> <br /> 
					
				</p>

				<div class="clearfix padcontent"></div>

				<img src="images/carusel_4.jpg" alt=""  border="0" class="alignleft "/>
				<p style="color:#fff">
					<strong>content goes here content goes here content goes here </strong>
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here <br /> <br /> 
					
				</p>
			</div>  
			
			<div class="padcontent"></div>
			
		</div>  

  </div>
</section>



	
   <?php include'footer.php'; ?>