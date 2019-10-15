<?

include("../includes/config.cfg");

include("../includes/connection.con");

include("../includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();

 $product_id=$_GET['product_id'];
 $size=$_GET['size'];

echo "<input type='hidden' name='product_size' value='$size'>";
$query_stock=mysql_query("select * from tbl_stock where product_id='".$product_id."' and product_size='".$size."'");
$count=mysql_num_rows($query_stock);
if($count>0)
{
	$fetch_stock=mysql_fetch_array($query_stock);
	$items=$fetch_stock['product_stock'];
	$temp_size=$fetch_stock['product_size'];
	if($items>0)
	{
	echo "<em><strong>Your selection: </strong></em>Only ".$items." items left";
	echo "<input type='hidden' name='hidden_size' id='hidden_size' readonly='readonly' value='".$items."'>";
	}
	else if($items==0)
	{
			echo "<em><strong>Your selection: </strong></em><input type='text' name='hidden_size' id='hidden_size' readonly='readonly' value='Sold Out'>";
		}
}
else if($count==0)
{
$query_stock1=mysql_query("select * from tbl_stock where product_id='".$product_id."' and product_size='All'");	
	$count1=mysql_num_rows($query_stock1);
	if($count1>0)
	{
	$fetch_stock1=mysql_fetch_array($query_stock1);
	$items1=$fetch_stock1['product_stock'];
    if($items1>0)
	{
    echo "<em><strong>Your selection: </strong></em>Only ".$items1." items left";
	echo "<input type='hidden' name='hidden_size' id='hidden_size' readonly='readonly' value='".$items1."'>";
	}
	else if($items1==0)
	{
	echo "<em><strong>Your selection: </strong></em><input type='text' name='hidden_size' id='hidden_size' readonly='readonly' value='Sold Out'>";
		
		}
	}
	
}
	
?>

  