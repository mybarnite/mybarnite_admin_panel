<?
include("../includes/config.cfg");
include("../includes/connection.con");
include("../includes/funcs_lib.inc.php");
$connection=DB_CONNECTION();

//-------------------------company name validation  check---------------
 $comp_name=$_GET['comp_name'];
$query="select * from tbl_company where comp_name='".$comp_name."'";
$exe_query=mysql_query($query);
$row=mysql_num_rows($exe_query);
if($row>0)
{
echo "This Company is Already Exist";
}

//-------------------------company email id validation check

$email_id=$_GET['email_id'];
$query_email="select * from tbl_company where email_id='".$email_id."'";
$exe_query_email=mysql_query($query_email);
$row1=mysql_num_rows($exe_query_email);
if($row1>0)
{
echo "This Email Id is Already Exist";
}

//-------------------------company mobile validation check

$mobile=$_GET['mobile'];
$mobile_query="select * from tbl_company where mobile_number='".$mobile."'";
$exe_query_mobile=mysql_query($mobile_query);
$row2=mysql_num_rows($exe_query_mobile);
if($row2>0)
{
echo "This Mobile is Already Exist";
}
?>
 