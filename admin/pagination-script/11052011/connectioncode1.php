<?php
		mysql_connect("localhost","root","");
		mysql_select_db("mobile");
		
		function file_extension($filename)
		{
		$path_info = pathinfo($filename);
		return $path_info['extension'];
		}
		if(isset($_REQUEST["save"]))
		{
		$add2 = $_FILES['image']['name'];
		if($add2)
		{
		$filename = basename($_FILES['image']['name']);
		$ext      = file_extension($filename);
		
		if(!($ext=="png"||$ext=="PNG"||$ext=="jpeg"||$ext=="JPEG"||$ext=="jpg"||$ext=="JPG"||$ext=="gif"||$ext=="GIF"))
		{
		echo $msg = "Sorry ! Please Uploade only jpg,png,jpeg or gif file only";
		}
		else
		{
		$ftmp = $_FILES['image']['tmp_name'];
		move_uploaded_file($ftmp,"images/$add2");
		}
		}

				$abc="insert into user(name,password,confirm,email,image)values('".$_POST['name']."','".$_POST['password']."','".$_POST['confirm']."','".$_POST['email']."','$add2')";
				$def=mysql_query($abc);
				
				if($def)
				{
				$msg1="data save";
				}
				else
				{echo "data not save";}
		    }
				
          if(isset($_REQUEST['find']))
		  {
			   $id=$_REQUEST['choice'];
			   $query=mysql_query("select image from user order by id dec limit 0,4");				
			   $sql=mysql_fetch_array($query);
		  }
?>
	
		<script type="text/javascript" language="javascript">
		function validation()
		
		{
		    if(document.getElementById("name").value=='')
		    {
		    alert ("Pleas enter your name");
		    document.getElementById("name").focus();
		    return false;
		    }
		   
		   	if(document.getElementById("password").value=='')
		    {
		   alert("please fill your pass");
		   document.getElementById("password").focus();
		   return false;
		   }
		   if(document.getElementById("confirm").value=='')
		   {
		   alert("plese enter confirm password")
		   document.getElementById("confirm").focus();
		   return false;
		   }
   		  
		  
		  if(document.getElementById("email").value=='')
		  {
		  alert("fill your email please");
		  document.getElementById("email").focus();
		  return false;
		  }
		  return true;
		
		
		}
		</script>
		
		<form method="post" action="" onsubmit="return validation();" enctype="multipart/form-data" >
		  <table style="border:thick; width:530PX;height:300PX;">
            
            <tr>
			<td>Search ID</td>
			<td colspan="4"><input type="text" name="choice" id="choice" size="31" /></td>
			<td colspan="6"><?php echo $msg1;?></td>
			</tr>
			<tr>
              <td>Name:</td>
              <td colspan="4"><input name="name" type="text" value="" id="name"  size="31" /></td>
              <td colspan="6"><input type="text" name="name1" size="22"  value="<?php echo $sql['name'];?>" /></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td colspan="4"><input name="password" type="password" value=""  size="31" id="password"/></td>
              <td colspan="4"><input type="text" name value="<?php echo $sql['password'];?>" size="22" /></td>
            </tr>
            <tr>
              <td>Confirm:</td>
              <td colspan="4"><input name="confirm" type="password" value="" size="31" id="confirm"/></td>
			  <td colspan="4"><input  type="text" value="<?php echo $sql['confirm'];?>" size="22" /></td>
            </tr>
            <tr>
              <td>E-mail</td>
              <td colspan="4"><input name="email" type="text" value="" size="31" id="email" /></td>
			  <td colspan="4"><input type="text" value="<?php echo $sql['email'];?>" size="22" /></td>
            </tr>
			<tr>
              <td></td>
              <td colspan="5"><input type="file"   name="image" id="image" size="22"/>
              </td>
            </tr>
			
              <td width="83"><input type="submit" name="save" id="save" value="Submit" /></td>
              <td width="40"><input type="submit" name="find" id="find" value="Find" size="15"/></td>
              <td width="45"><input type="submit" name="reset" id="reset" value="reset" size="15"/></td>
              <td width="36"><input type="submit" name="exit" id="exit" value="exit"/></td>
              <td width="59"><input type="submit" name="image" id="image" value="imageS"/></td>
			  <td width="66"><input type="submit" name="image" id="image" value="Update"/></td>
              <td width="169">&nbsp;</td>
            </tr>

          </table>
		</form>
		<p>&nbsp;</p>
		<form method="post">
		<table style="width:75px; height:75px; border:solid;">
		<tr><td><img src="images/10022" width="50" height="50"/></td></tr>
		</table>
		</form>
Array
(
[dirname] => /testweb
[basename] => test.jpg
[extension] => test
)