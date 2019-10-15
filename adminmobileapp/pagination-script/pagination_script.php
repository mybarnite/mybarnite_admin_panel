<?php include_once('pagination.class.php');
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$conn=mysql_connect($dbhost,$dbuser,$dbpass)or die('Error connecting to mysql');
$dbname='john';
mysql_select_db($dbname);?>

			<?php  
			 $s_se = mysql_query("SELECT * from `cena` order by id desc");
			 $cnt_rec = mysql_num_rows($s_se);
			 $page_no = (isset($_GET['page']) && $_GET['page'] != '')?$_GET['page']:1;
			 $start = ($page_no-1)*10;
		
			$query="SELECT * FROM cena order by id desc limit $start,10";
			$result=mysql_query($query);

				while($row=mysql_fetch_array($result))
      {
	?>
	<table border="1">
	<tr class="">
              <td ><?php echo $row['email'];?></td>
              <td ><?php echo $row['password'];?></td>  
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
				</tr>