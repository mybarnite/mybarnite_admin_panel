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
      
	   <div class="span2">
		  <h2 style="color:#ff1da5; font-size:25px;">Bar List</h2>
		  
		  <?php
		  $word = $_POST['searchtxt'];
		  $word .= '%';
			$barlistquery = mysql_query(" SELECT * FROM bars_list WHERE Business_Name LIKE ('".$word."') LIMIT 20 ") or die(mysql_error());
			$result = mysql_num_rows($barlistquery);
			if($result > 0){
			while($row = mysql_fetch_array($barlistquery))
			{ ?>
		
		<br><a class="barlist" href="bardetail.php?barid=<?php echo $row['id'] ?>" >
		<?php echo $row['Business_Name'] ?>
		</a>
				
			<?php	} }else
			{ ?>
		<h3>No Result Found</h3>
				
		<?php	} ?>
</div>
<div class="span10">
		<div class="row">
		
		
		<?php
		  $word = $_POST['searchtxt'];
		  $word .= '%';
		  $counter = 1;
			$barlistquery = mysql_query(" SELECT * FROM bars_list WHERE Business_Name LIKE ('".$word."') LIMIT 6 ") or die(mysql_error());
			$result = mysql_num_rows($barlistquery);
			if($result > 0){
			while($row = mysql_fetch_array($barlistquery))
			{ ?>
		
		
		<div class="span3">
	
						<img src="img/<?php echo $counter; ?>.jpg" alt=""  border="0" />
						
							<h3  style="color:#fff;font-size:14px;"><?php echo $row['Business_Name'] ?></h3>
							<p>
								Rating <?php echo $row['Rating'] ?>
							</p>
							<a href="bardetail.php?barid=<?php echo $row['id'] ?>"> <button type="button" class="btn btn-default btn-color" style="float:right;margin-top:-60px;">Detail</button> </a>
					
	</div>
				
			<?php $counter++;	} } ?>
		
		
	

			
			
		</div>
	
</div>
	
    </div>
  </div>
</section>


	<br><br><br>

	
    <?php include'footer.php'; ?>