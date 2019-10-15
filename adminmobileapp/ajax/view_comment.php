<style>
html, body {
	height:100%;
}
#blackout1 {
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
#divpopup1 {
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
#divpop_head1 {
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


#close_pop1 {
	float:right;
	text-align:right;
	cursor:pointer;
	padding-right:10px;
}
#close_pop1 a {
	text-decoration:none;
	color: #333;
}
#close_pop1 a:hover {
	color:#FF0000;
}
#pop_content1 {
	clear:both;
	padding: 60px;
	height:300px;
	overflow:scroll;
}
</style>
<div id='blackout1'> </div>
<div id='divpopup1'>
  <div id='divpop_head1'>ALL Comments 
  <a class="btn btn-success" href="#" id='close_pop1'onclick='popup_view(0)' style="margin-right:20px;"><i class="icon-remove"></i>Close</a>
  </div>
  
  <div id='pop_content1'>
   
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
      <thead>
							  <tr>
                                   <th width="80">Comment Details</th>
                                <th width="20">Comment Added On</th>
							 
						    </tr>
						  </thead> 
      
        <tbody>
        <input type="hidden" name="comp_id" id="comp_id" value="" />
        
        <?
       
		 echo $comp_id= $_GET['comp_id'];
		?>
		<?
		 $query_comment= mysql_query("select * from tbl_comment where comp_id='1' order by comment_date desc");
		 while($fetch_comment=mysql_fetch_array($query_comment))
		{
		?>
        <tr>
         <td><?=$fetch_comment['comment'];?></td>
         <td><?=$fetch_comment['comment_date'];?></td>
         
        </tr>
      <? }?>
       </tbody>
      </table>
    
  
  
  
  </div>
</div>