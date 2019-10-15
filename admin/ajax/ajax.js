// JavaScript Document









  function getXMLHTTP() {

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





//-------------------------Subcategory select-------------------

  function get_subcategory(category_id) {

	

    var strURL = "ajax/subcategory.php?category_id=" + category_id;

	

	// var strURL = "catid";

	

    var req = getXMLHTTP();



    if (req) {

      req.onreadystatechange = function ()

	  {



          // only if "OK"

		  

          if (req.status == 200 ||req.readyState == 4)

		  {

            document.getElementById('subcategory').innerHTML = req.responseText;

          }

      }



      req.open("GET", strURL, true);

      req.send();

    }

  }



//-------------------------Subsubcategory select-------------------

  function get_subsubcategory(subcategory_id) {

	



    var strURL = "ajax/subsubcategory.php?subcategory_id=" + subcategory_id;

	

	// var strURL = "catid";

	

    var req = getXMLHTTP();



    if (req) {

      req.onreadystatechange = function ()

	  {



          // only if "OK"

		  

          if (req.status == 200 ||req.readyState == 4)

		  {

            document.getElementById('subsubcategory').innerHTML = req.responseText;

          }

      }



      req.open("GET", strURL, true);

      req.send();

    }

  }


//-------------------------Subcategory select-------------------

  function get_frontsubcategory(category_id,min,max) {

    var strURL = "Adminpanel/ajax/frontsubcategory.php?category_id=" + category_id + "&min=" + min + "&max=" + max;

	

	// var strURL = "catid";

	

    var req = getXMLHTTP();



    if (req) {

      req.onreadystatechange = function ()

	  {



          // only if "OK"

		  

          if (req.status == 200 ||req.readyState == 4)

		  {

            document.getElementById('product_listing').innerHTML = req.responseText;
			
          }

      }



      req.open("GET", strURL, true);

      req.send();

    }

  }


//-------------------------subSubcategory select-------------------

  function get_frontsubcategory(category_id,subcategory_id,min,max) {

    var strURL = "Adminpanel/ajax/frontsubcategory.php?category_id=" + category_id + "&subcategory_id=" + subcategory_id + "&min=" + min + "&max=" + max;

	

	// var strURL = "catid";

	

    var req = getXMLHTTP();



    if (req) {

      req.onreadystatechange = function ()

	  {



          // only if "OK"

		  

          if (req.status == 200 ||req.readyState == 4)

		  {

            document.getElementById('product_listing').innerHTML = req.responseText;
			
          }

      }



      req.open("GET", strURL, true);

      req.send();

    }

  }
  
  function  delete_page_data(id)
  {
			$.ajax({
				url : "ajax/managePageData.php",
				type: "POST",
				data :{ id: id ,action:"Remove"},
				
				success: function(result)
				{	
					
					//$("#gallery").html(result);
					window.location="maincontent.php";
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
				}
			});
	}

	function checkCouponCode(code,action,id)
	{
		$.ajax({
				url : "https://mybarnite.com/business_owner/checkCouponCode.php",
				type: "POST",
				data :{code:code,action:action,id:id},
				success: function(result)
				{	
					//alert(result);
					
					$("#generate").html(result);
					
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
				}
			});
	}
	
	
	function generateCouponCode(code,action,id)
	{
		
		$.ajax({
				url : "https://mybarnite.com/business_owner/generateCouponCode.php",
				type: "POST",
				data :{code:code,action:action,id:id},
				success: function(result)
				{	
					//alert(result);
					$("#code").val(result);
					$("#generate").html('<i class="fa fa-check pink" style="font-size:20px;"></i>');
					
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					
				}
			});
	}



function deletePromotion(id)
 {
	
	if(id!="")
	{
		$.ajax(
		{
				url: "managePromotions.php", 
				type:"POST",
				data:{action:"Delete",id:id}
				,
				success: function(response){
				
					$("#msg").html('Data has been deleted successfully.');
					$( "#msg" ).scrollTop( 300 );
					   setTimeout(function(){// wait for 5 secs(2)
						   window.location.href = 'promotions.php';
					  }, 3000); 
				}
		});
	}	
 }
 function selectAll(source) {
	checkboxes = document.getElementsByName('chk[]');
	for(var i in checkboxes)
		checkboxes[i].checked = source.checked;
		
}


function deleteMutipleSubUsers()
{
	if ($('.chkbox:checked').length != 0) 
	{
		var SelectedIDs = [];
		$('.chkbox:checked').each(function (i) {
			SelectedIDs.push($(this).attr('id'));
		});
		var Ids = SelectedIDs.join(";")
	}
	
	 $.ajax({
		url : "https://mybarnite.com/admin/deleteSubUser.php",
		type: "POST",
		data :{ Ids :Ids, action : 'Multiple' },
		
		success: function(result)
		{	
			//alert(result);
			window.location="business_sub_users.php";	
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
		}
	});	
	
}

function deleteSubUser(id)
{
	//alert(role);
	$.ajax({
		url : "https://mybarnite.com/admin/deleteSubUser.php",
		type: "POST",
		data :{ subuser_id:id},
		
		success: function(result)
		{	
			
			window.location="business_sub_users.php";	
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			
		}
	});
}

//-------------------------------------------------------------------------------//

/* 
function deleteMutipleAdminSubUsers()
{
	if ($('.chkbox:checked').length != 0) 
	{
		var SelectedIDs = [];
		$('.chkbox:checked').each(function (i) {
			SelectedIDs.push($(this).attr('id'));
		});
		var Ids = SelectedIDs.join(";")
	}
	
	 $.ajax({
		url : "http://mybarnite.com/admin/deleteAdminSubUser.php",
		type: "POST",
		data :{ Ids :Ids, action : 'Multiple' },
		
		success: function(result)
		{	
			alert(result);
			window.location="admin_sub_users.php";	
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			//$("#gallery").html("<div class='alert alert-danger'>System error occured.</div>");
		}
	});	
	
} */

function deleteAdminSubUser(id)
{
	//alert(role);
	$.ajax({
		url : "https://mybarnite.com/admin/deleteAdminSubUser.php",
		type: "POST",
		data :{ subuser_id:id},
		
		success: function(result)
		{	
			
			window.location="admin_sub_users.php";	
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			
		}
	});
}
