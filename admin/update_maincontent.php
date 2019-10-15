<?php 
ob_start();
include("header.php");

include("includes/config.cfg");
include 'includes/conection.php';


$banner_query=mysql_query("select * FROM maincontent where id='".$_REQUEST['eid']."'");
$fetch_banner=mysql_fetch_array($banner_query);
if(isset($_POST['addnew']))
{
	#echo "<pre>";
	#print_r($_POST);
	#exit;
	
	$title = $_POST['title'];
	$content = $_POST['content'];

	$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));
	$query = "SELECT COUNT(*) AS NumHits FROM maincontent WHERE  slug  LIKE '$slug%'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	$numHits = $row['NumHits'];
	$slugname = ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
	
	$sql = "INSERT INTO maincontent (heading, message, slugname) VALUES ('".$title."','".$content."','".$slugname."')";
	$exe = mysql_query($sql);
	$lastId = mysql_insert_id();
	if(isset($lastId)&&$lastId>0)
	{
		header("location:update_maincontent.php?msg=true");
	}	
}	
if(isset($_POST['update']))
{
	#echo "<pre>";
	#print_r($_POST);
	#exit;
	
	$title = $_POST['title'];
	$content = $_POST['content'];
	
	$sql = "update maincontent set heading='".$title."' , message='".$content."' where id='".$_REQUEST['eid']."'";
	$exe = mysql_query($sql);
	$lastId = mysql_affected_rows();
	if(isset($lastId)&&$lastId>0)
	{
		header("location:maincontent.php?msg=true");
	}	
}	
?>
<!-- script start -->
<script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
<link href="css/Loader.css" rel="stylesheet">


<!-- ajax script ends -->
	
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
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>&nbsp;Add New Page</h2>
						<div class="box-icon">&nbsp;</div>
					</div>
					<div class="box-content">
						<?php
						if($_REQUEST['msg']=="true")
						{	
						?>
							<table align="center" width="100%" >
								<tr><td align="center" class="alert alert-success"><strong>Data has been added successfully!</strong></td></tr>
							</table>
						<?php
						}
						?>	
						
						<form name="addnewpage" action="" id="addnewpage" method="post">
							<table align="center" width="80%" >
								<tr >
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								
								<tr>
									<td ><label class="control-label" for="typeahead">Title <span style="color:#ff0000;">*</span></label></td>
									<td><input type="text" class="span6 typeahead"  name="title" id="title" value="<?php echo $fetch_banner['heading']; ?>"  size="40" required></td>
								</tr>
								<tr>
									<td><label class="control-label" for="typeahead">Content </label></td>
									<td>
										<textarea name="content" id="content" class="content" ><?php echo $fetch_banner['message']; ?></textarea>
										
									</td>
								</tr>
								
								<tr>
									<td><label class="control-label" for="typeahead">&nbsp;</label></td>
									<td>
										<?php 
										if($_REQUEST['eid']!="")
										{
										?>	
											<button type="submit" name="update" id="update" class="btn btn-primary" >Update</button>	
										<?php	
										}else{		
										?>
											<button type="submit" name="addnew" id="addnew" class="btn btn-primary" >Add New</button>	
											
										<?php
										}
										?>
											<button type="button" class="btn btn-default" onclick="location.href='update_maincontent.php'">Cancel</button>
									</td>
								</tr>
							</table>
						</form>
					
					</div>
				</div><!--/span-->
			</div>
		</div><!--/#content.span10-->
	</div><!--/fluid-row-->
	<hr>
	<?php include("footer.php");?>
	
	 <script type="text/javascript">                               
	CKEDITOR.replaceAll('content');	
	</script>
</body>
</html>
