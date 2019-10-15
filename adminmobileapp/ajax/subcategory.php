<?

include("../includes/config.cfg");

include("../includes/connection.con");

include("../includes/funcs_lib.inc.php");

$connection=DB_CONNECTION();

$category_id=$_GET['category_id'];

$query="select * from tbl_subcategory where category_id ='".$category_id."' and status='Active' order by subcategory_name asc";

$result=mysql_query($query);

$row=mysql_num_rows($result);
if($row>0)
{
?>

  <td ><label class="control-label" for="typeahead">Product SubCategory</label></td>

  <td>

<select  name="subcategory_id" id="subcategory_id" onchange="get_subsubcategory(this.value)">

	<option value="">---Select Prodcut SubCategory---</option>

<? while($row=mysql_fetch_array($result)) { ?>

<option value="<?=$row['id'];?>"><?=$row['subcategory_name'];?></option>

<? } ?>

   </select>

  </td>
  <? }?>