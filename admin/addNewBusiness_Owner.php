  <?php include("header.php");


?>


    	<!-- ajax script start -->
        <script language="javascript" type="application/javascript" src="ajax/ajax.js"></script>
        <link href="css/Loader.css" rel="stylesheet">
        	<!-- ajax script ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<?php include("left.php");?><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
	<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
					
			
                <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i>&nbsp;Add New Business Owner</h2>
						<div class="box-icon">
							&nbsp;
						</div>
					</div>
					<div class="box-content">
                    <table align="center" width="100%" >
                    <tr><td align="center" style="color:#F00;"><strong><? echo $_REQUEST['msg'];?></strong></td></tr>
                    </table>
						 <form name="addnewownerform" action="" id="addnewownerform" method="post">
						<table align="center" width="80%" >
                         <tr >
                        <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                        
                        </tr>
						<?php if($baraddedstatus != ""){ ?>
						<span style="color:green;">Bar is Added</span>
						<?php } ?>
						 <tr >
                        <td ><label class="control-label" for="typeahead">Name <span style="color:red;">*</span></label></td>
                        <td><input type="text" class="span6 typeahead"  name="name" id="name"  size="40" required/></td>
                         </tr>
						 
						 <tr >
                        <td ><label class="control-label" for="typeahead">Email <span style="color:red;">*</span></label></td>
                        <td>
                        <input type="email" class="span6 typeahead"  name="email" id="email"  size="40" required/>
						<p class="userEmailMatch" style="color:red;">
                            User Email address already exist...
                          </p>
                        </td>
                         </tr>
						 
						 <tr>
                        <td><label class="control-label" for="typeahead">Password <span style="color:red;">*</span></label></td>
                        <td><input type="password" class="span6 typeahead"  name="password" id="password"  size="40" required/></td>
                         </tr>
						 
						 <tr>
                       
						 
                       
                           <tr>
                        <td><label class="control-label" for="typeahead">&nbsp;</label></td>
                        <td>
                        <button type="button" name="addnew" id="new" class="btn btn-primary" >Add Business Owner</button>
						<button class="btn" onclick="resetFields();">Reset</button></td>
                         </tr>
                        </table>
						</form>
<div class="windows8" style=" display: none;" id="loader">
                  <div class="wBall" id="wBall_1">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_2">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_3">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_4">
                    <div class="wInnerBall">
                    </div>
                  </div>
                  <div class="wBall" id="wBall_5">
                    <div class="wInnerBall">
                    </div>
                  </div>
                </div>
					</div>
				</div><!--/span-->

			</div>
				
			
			

		
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<?php include("footer.php");?>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="js/1.9/jquery.validate.min.js">
    </script>
<script type="text/javascript">
 function resetFields()
 {
	window.location.href = 'addNewBusiness_Owner.php';
 }

    $(".userEmailMatch").hide();
    $(document).ready(function(){
    
      $("input#email").focusout(function(){
      	if (!ValidateEmail($("#email").val())) {
            document.getElementById('new').disabled=true;
        }
        else {
                    $.ajax({
          url: "ajaxLookForUserEmail.php",
          type: "post",
          data: {
            email:$("input#email").val()}
          ,
          success: function(response) {

            if (response == 1) {
              $(".userEmailMatch").show();
              document.getElementById('new').disabled=true;
              
              
            }
            else{
              $(".userEmailMatch").hide();
              document.getElementById('new').disabled=false;
              
            }
          }
          ,
          error:function(){
            //alert("Error Occured.");
          }
        }
              );
        }

        
      }
                               );
});

    	</script>
<script type = "text/javascript">
    function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
</script>
   <script>
$(document).ready(function(){
	 $("#new").click(function(){
   
	if($('#name').val() == '')
	{
		alert("Name can not be blank");
	}
	else if($('#email').val() == '')
	{
		alert("Email can not be blank");
	}
	else if($('#password').val() == '')
	{
		alert('Password can not be blank');
	}
	else
	{
     $('#loader').show();
 $.ajax({
          url: "addnewowner.php",
          type: "post",
          data: {name:$('#name').val(),email:$('#email').val(),password:$('#password').val()}
          ,
          success: function(response) {
            //alert(response);
             $('#loader').hide();
            window.location = 'business_owener_list.php';
          }
          ,
          error:function(){
            //alert("Error Occured.");
          }
        });
	}
});
 
    
   
});
</script> 	 
</body>
</html>
