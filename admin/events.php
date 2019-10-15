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
    
		<div class="row">
		
			<div class="span4">
			  <h2>Events</h2>
				<div id="accordion2" class="accordion max-size1">
				
				<?php
						$count = 1;
						$upcomingquery = mysql_query(" SELECT * FROM upcoming_event ");
						while($upcomingrow = mysql_fetch_array($upcomingquery)){

							?>

				
				<div class="accordion-group">
					<div class="accordion-heading ">
						<a class="accordion-toggle" href="#collapse<?php echo $count; ?>" data-toggle="collapse" data-parent="#accordion2">
							<span></span>
						<?php echo $upcomingrow['heading']; ?>
						</a>
					</div>
					<div id="collapse<?php echo $count; ?>" class="accordion-body collapse ">
						<div class="accordion-inner">
							<?php echo $upcomingrow['message']; ?>
							
						</div>
					</div>
				</div>
				
						<?php
						 $count++;
						} ?>
				
				</div>

			</div>
			
			<div class="span8">
				<h2>Special Event</h2>
				
				<img src="images/img15.jpg" alt=""  border="0" class="alignleft "/>
				<p style="color:#fff">
					<strong>content goes here content goes here content goes here content goes here .</strong>
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here  <br /> <br />
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here <br /> <br /><br />
				</p>
				<p style="color:#fff">
					<strong>content goes here content goes here content goes here content goes here .</strong>
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here  <br /> <br />
					content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here content goes here .
				</p>
				
			</div>  
			
			<div class="padcontent"></div>
			
		</div>  

  </div>
</section>



	
    <?php include'footer.php'; ?>