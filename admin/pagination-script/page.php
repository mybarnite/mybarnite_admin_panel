<?php include_once('pagination.class.php');
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$conn=mysql_connect($dbhost,$dbuser,$dbpass)or die('Error connecting to mysql');
$dbname='fastjobs';
mysql_select_db($dbname);?>
<style type="text/css">
#cloud a.tag1 { font-size: 1.7em; font-weight: 100; margin:0px; padding:0px; }

#cloud a.tag2 { font-size: 1.1em; font-weight: 200; margin:0px; padding:0px; }

#cloud a.tag3 { font-size: 1.2em; font-weight: 300; margin:0px; padding:0px; }

#cloud a.tag4 { font-size: 1.3em; font-weight: 400; margin:0px; padding:0px; }

#cloud a.tag5 { font-size: 1.4em; font-weight: 500; margin:0px; padding:0px; }

#cloud a.tag6 { font-size: 1.5em; font-weight: 600; margin:0px; padding:0px; }

#cloud a.tag7 { font-size: 1.6em; font-weight: 700; margin:0px; padding:0px; }

#cloud a.tag8 { font-size: 1.7em; font-weight: 800; margin:0px; padding:0px; }

#cloud a.tag9 { font-size: 1.8em; font-weight: 900; margin:0px; padding:0px; }

#cloud a.tag10 { font-size: 1.9em; font-weight: 900; margin:0px; padding:0px; }

#cloud { padding: 2px; line-height: 40px; text-align: justify; }

#cloud a { padding: 0px; color:#0c7c85 }
#cloud a:hover { padding: 0px; color:#8ccacf}

div.pagination {
	padding:3px;
	margin:3px;
	text-align:center;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin-right: 2px;
	border: 1px solid #0066FF;
	
	text-decoration: none; 
	color: #0066FF;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #2b66a5;
	color: #000;
	background-color: #0000CC;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin-right: 2px;
	border: 1px solid #0000CC;
	font-weight: bold;
	background-color: #0000CC;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin-right: 2px;
	border: 1px solid #929292;
	color: #929292;
}
</style>
			<?php  
			 $s_se = mysql_query("SELECT * from `user` order by id desc");
			 $cnt_rec = mysql_num_rows($s_se);
			 $page_no = (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:1;
			 $start = ($page_no-1)*10;
		
			$query="SELECT * FROM user order by id desc limit $start,10";
			$result=mysql_query($query);

				while($row=mysql_fetch_array($result))
      {
	?>
	<table border="1">
	<tr class="">
				<td ><?php echo $row['id'];?></td>
			  	<td ><?php echo $row['fname'];?>&nbsp; <?php echo $row['lname'];?></td>	
              	<td ><?php echo $row['email'];?></td>
              	<td ><?php echo $row['password'];?></td>
			  	<td ><?php echo $row['mobile'];?></td>
				<td ><img src="C:\wamp\www\pradeep\Fast Jobs\images\<?php echo $row['image'];?>"</td>  
	 </tr>
	 </table>
	 <?php } ?>
<tr><td width="418" height="25">&nbsp;</td>
				<td width="483">
				<?php
				$p = new pagination;
				$p->Items($cnt_rec);
				$p->limit(10);
				$p->currentPage($page_no);
				$p->show();
				?></td>
				</tr>				</tr>
				
			</table>
