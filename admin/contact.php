<?php
include("admin/includes/config.cfg");
include("admin/includes/connection.con");
include("admin/includes/funcs_lib.inc.php");
//PAGE_PROHIBITTED($_SESSION['SESSION_AUTHENTICATE_HITTING']);
$connection=DB_CONNECTION();
?>

<?php
		$messagestatus = "";
		if(isset($_POST['sendmessagebut']))
		{
			$name = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['namee']))));
			$email = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['email']))));
			$subject = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['subject']))));
			$message = mysql_real_escape_string(htmlentities(addslashes(trim($_POST['message']))));
			
			
			$to = 'rakeshoad268@gmail.com';
			$subject = "Bar Night Contect Message";
			$txt = "  Name:- '".$barname."' \r\n Sender Email:- '".$email."' \r\n Subject:- '".$subject."' \r\n Sender Message:- '".$noofperson."'";
			$headers = "From: $email" . "\r\n" ;
				
			mail($to,$subject,$txt,$headers);
			
			$messagestatus = "value";
		}
?>

   <?php include'header.php'; ?>
<!--==============================Map=================================--> 
<div class="container">
    <div class="clearfix ">
		<div class="map span12">
			<iframe src="https://maps.google.com/maps?f=d&amp;source=s_q&amp;hl=en&amp;geocode=%3BCd58rJoNFJvNFRBFbAId0JyX-ykJIXyUFkTCiTGGeAAEdFx2gg&amp;q=Brooklyn,+NY,+USA&amp;aq=0&amp;sll=37.0625,-95.677068&amp;sspn=47.704107,79.013672&amp;ie=UTF8&amp;hq=&amp;hnear=Brooklyn,+Kings,+New+York&amp;view=map&amp;t=h&amp;daddr=Brooklyn,+NY&amp;ll=40.65,-73.95&amp;spn=0.253445,0.33405&amp;output=embed"></iframe>
		</div>
	</div>
</div>
	
</header>
<div class="padcontent"></div>		

<!--==============================Content=================================--> 
<section id="content" class="main-content">
  <div class="container">
    <div class="row clearfix ">
        
		<div class="span6">
        	<h2>Get in touch</h2>
      			<div id="note"></div>
      			<div id="fields" class="contact-form">
				<?php if($messagestatus != ""){ ?>
				<span style="color:white">Message Sended</span>
				<?php } ?>
      				<form id="ajax-contact-form" class="form-horizontal" action="" method="post">
      					<div class="control-group">
      						<label class="control-label" for="inputName">Your name:</label>
      							<input type="text" name="namee" >
      					</div>
      					<div class="control-group">
      						<label class="control-label" for="inputEmail">Your Email:</label>
      							<input type="email" name="email" >
      					</div>
      					<div class="control-group">
      						<label class="control-label" for="inputEmail">Subject:</label>
      							<input type="text" name="subject" >
      					</div>
      					<div class="control-group">
      						<label class="control-label" for="inputEmail">Your Message:</label>
      							<textarea  name="message" rows="3" style=" background-color: white"></textarea>
								
								
      					</div>
      					<button type="submit" name="sendmessagebut" class="btn submit btn-primary "><i class="icon-envelope icon-white"></i>&nbsp;&nbsp;submit</button>
						<div class="clearfix"></div>
      				</form>
      			</div>    
		</div>		  
		
		<?php
			$query = mysql_query(" SELECT * FROM bars_list WHERE id=2 ") or die(mysql_error());
			while( $row = mysql_fetch_array($query))
			{
				
			}
		?>
		
		
		
		<div class="span6">
        	<h2 >Our Address</h2>
			<div class="row clearfix ">
				<div class="span3">
				  <p>
					0000 Street, <br />
					City, Country.<br />
					Telephone: +0 000 123 4567<br />
					E-mail: <a href="#">email@barnight.com</a>
				  </p>
			      <div class="padcontent_small"></div>		
				</div>
				
			</div>
			
			

        	
			
			<h2>Useful Information</h2>

			<p class="max-size1">
				<strong>
					content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here . 
				</strong>
				
				content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here content geos here .
			</p>
  		</div>

    </div>
  </div>
</section>




	
   <?php include'footer.php'; ?>