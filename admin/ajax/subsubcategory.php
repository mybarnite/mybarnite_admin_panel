<?
include("../includes/config.cfg");
include("../includes/connection.con");
include("../includes/funcs_lib.inc.php");
$connection=DB_CONNECTION();
$subcategory_id=$_GET['subcategory_id'];
$query="select * from tbl_subsubcategory where subcategory_id='".$subcategory_id."' and status='Active' order by subsubcategory_name asc";
$result=mysql_query($query);

?>
  <td ><label class="control-label" for="typeahead">Product SubSubCategory*</label></td>
  <td>
<select  name="subsubcategory_id" id="subsubcategory_id">
	<option value="">---Select Product SubCategory---</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value="<?=$row['id'];?>"><?=$row['subsubcategory_name'];?></option>
<? } ?>
   </select>
  </td>