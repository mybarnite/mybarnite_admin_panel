<?php include("header.php"); ?>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<?php include("left.php");?><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
		
			
			<div class="row-fluid sortable">
				
				<div class="box">
					<div class="box-header well">
						<h2><i class="icon-list-alt"></i> &nbsp; <?php echo ucfirst( $_SESSION['USER_NAME']); ?></h2> <?php if($_REQUEST['t']) { ?><li><a class="ajax-link" href="welcome.php"><span class="hidden-tablet" style=" color:#F00;">Back To Cufflink </span></a></li><?php
						}
						?>
						<div class="box-icon">
							<? //echo $_SESSION['USER_TYPE']; ?>
						</div>
						
					</div>
					<div class="box-content">
						<div id="sincos"  class="center" style="height:300px">

                            <br><br> 
                            <h1>
                            Welcome To Bar Night<br> Web Site <br> Admin Panel<br><br>
                            
							 
                    </div>
					
					</div>
				</div>
				
				
		
		
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<? include("footer.php");?>
		
</body>
</html>
