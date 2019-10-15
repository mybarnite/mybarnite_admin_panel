
<script type="text/javascript">
function getXMLHTTP1() {
    var xmlhttp = false;

    try {
      xmlhttp = new XMLHttpRequest();
    } catch (e) {
      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        try {
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e1) {
          xmlhttp = false;
        }
      }
    }

    return xmlhttp;
  }
  
  function get_del_id(id,comp_id)
  {
	  var req1 = getXMLHTTP1();
	
	 var strURL = "ajax/delete.php?id=" + id;
	 
	 req1.onreadystatechange = function ()
	  {

          // only if "OK"
		  
          if (req1.status == 200 ||req.readyState == 4)
		  {
            document.getElementById('del_msg').innerHTML = req1.responseText;
			
          }
      }

 req1.open("GET",strURL,true);
  req1.send();
}
</script>

<style>
html, body {
	height:100%;
}
#blackout2 {
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	display: none;
	background-color: #000;
	filter: alpha(opacity=80);
	-moz-opacity: .8;
	opacity: .8;
	z-index: 9;
}
#divpopup2 {
	position: absolute;
	display: none;
	border: 1px solid #66C;
	background-color: #FFF;
	color: #333;
	padding: 0;
	width: 700px;
	z-index: 10;
	font-family: "Trebuchet MS", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	top:250px;
	left:300px;
}
#divpop_head2 {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:50px;
	background-color: #999;
	text-align:center;
	color:#FFF;
	font-weight:bold;
	font-size:18px;
	padding:4px 0;
	z-index:+10;
}
#del_msg
{
	width:100%;
	height:20px;
	position:relative;
	top:50px;
	background-color:#fff;
	text-align:center;
	color:#F00;
	font-weight:bold;
	font-size:18px;
	padding:4px 0;
	z-index:10;
	
	}

#close_pop2 {
	float:right;
	text-align:right;
	cursor:pointer;
	padding-right:10px;
}
#close_pop2 a {
	text-decoration:none;
	color: #333;
}
#close_pop2 a:hover {
	color:#FF0000;
}
#pop_content2 {
	clear:both;
	padding: 60px;
	height:300px;
	overflow:scroll;
}

</style>

<div id='blackout2'> </div>
<div id='divpopup2'>
  <div id='divpop_head2'>ALL Comments 
  <a class="btn btn-success" href="#" id='close_pop2'onclick='delete_comment(0)' style="margin-right:20px;"><i class="icon-remove"></i>Close</a>
  </div>
  <div id="del_msg"></div>
  <div id='pop_content2'>
   <form name="delete_form" method="post" action="">
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
      <thead>
		     <tr>
                                   <th width="60">Comment Details</th>
                                <th width="40">Comment Added On</th>
							    <th width="40">Delete</th>
						    </tr>
						  </thead> 
      
        <tbody>
        <input type="hidden" name="comp_id" id="comp_id" value="" />
        
		<?
		
		  echo $comp_id= $_GET['comp_id'];
		 $query_comment= mysql_query("select * from tbl_comment where comp_id='".$comp_id."' order by comment_date desc");
		 while($fetch_comment=mysql_fetch_array($query_comment))
		{
		?>
        <tr>
         <td><?=$fetch_comment['comment'];?></td>
         <td><?=$fetch_comment['comment_date'];?></td>
         <td>
         <a href="#" onClick="get_del_id(<?=$fetch_comment['id'];?>,<?=$fetch_comment['comp_id'];?>)">delete</a>
         </td>
        </tr>
      <? }?>
       </tbody>
      </table>
   
</form>
  </div>
</div>
