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

<?php
	$bid = $_GET['barid'];
	$getquery = mysql_query(" SELECT * FROM bars_list WHERE id='".$bid."' ") or die(mysql_error());
	$getquery = mysql_fetch_array($getquery);
?>

<section id="content" class="main-content">
  <div class="container">
    <div class="row clearfix ">
          <div class="span3"></div>
		<div class="span6">
        	<h2>booking successful Done </h2>
      			<div id="note"></div>
      			   
		</div>		  
		
		
		
    </div>
  </div>
</section>




	
    <?php include'footer.php'; ?>