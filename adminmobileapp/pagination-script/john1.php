
<?php
mysql_connect("localhost","root","");
mysql_select_db("john");
if(isset($_REQUEST["submit"]))
{
$email=$_REQUEST["email"];
$password=$_REQUEST["password"];
$abc="insert into cena (email,password)values('$email','$password')";
if($sql=mysql_query($abc))
{
echo "data saved";
}
else
{
 echo "not saved";
}
}
?>


<html>
<head></head>
<body>
<form action="" method="post">
<table>
<tr><td>email</td>
<td><input type="text" name="email"></td></tr>
<tr><td>password</td>
<td><input type="password" name="password"></td></tr>
<td><input type="submit" name="submit"></td>
</table>
</form>


</body>
</html>