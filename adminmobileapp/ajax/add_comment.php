<style>
html, body {
	height:100%;
}
#blackout {
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
#divpopup {
	position: fixed;
	top: 50%;
	left: 50%;
	margin-top: -81px; /*half of the height plus a little to the top*/
	margin-left: -150px; /*half of the width */
	display: none;
	border: 1px solid #66C;
	background-color: #FFF;
	color: #333;
	padding: 0;
	height: 320px;
	width: 400px;
	z-index: 10;
	font-family: "Trebuchet MS", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#divpop_head {
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


#close_pop {
	float:right;
	text-align:right;
	cursor:pointer;
	padding-right:10px;
}
#close_pop a {
	text-decoration:none;
	color: #333;
}
#close_pop a:hover {
	color:#FF0000;
}
#pop_content {
	clear:both;
	padding: 60px;
}
</style>
<div id='blackout'> </div>
<div id='divpopup'>
  <div id='divpop_head'>Add New Commnet </div>
  
  <div id='pop_content'>
    <form name="form1" method="post" action="#">
      <table style="padding-top:100px;">
        <tr>
         <td><textarea name="comment" rows="11" cols="50" style="width:280px;"></textarea></td>
        </tr>
        
   <tr><td><input type="submit" name="add_comment" value="Add Comment" /> 
   <input type="hidden" name="comment_id" id="comment_id" value="" />
  
   <a class="btn btn-success" href="#" id='close_pop'onclick='popup(0)'>
										<i class="icon-remove"></i>  
										Close                                            
									</a>
  
  </td></tr>
      </table>
    
    </form>
  
  </div>
</div>