//------------------login validation ---------------

function loging_validation()

{

var userid=document.getElementById('username').value;



if(userid=='')

{

    alert("Enter User Id");

	

	document.getElementById('username').focus();

	return false;

}



var password=document.getElementById('password').value;



if(password=='')

{

    alert("Enter Password");

	

	document.getElementById('password').focus();

	return false;

}



return true;

}

//---------------------------check box validation------------------



function validate()

{

var chks = document.getElementsByName('chk[]');

var hasChecked = false;

for (var i = 0; i < chks.length; i++)

{

if (chks[i].checked)

{

hasChecked = true;

break;

}

}

if (hasChecked == false)

{

alert("No Record is selected.");

return false;

}

return true;

}



//-----------------------------confirm valication---------





function confirmSubmit()

{


		var atLeastOneIsChecked = false;
		  $('input:checkbox').each(function () {
			if ($(this).is(':checked')) {
			  atLeastOneIsChecked = true;
			  // Stop .each from processing any more items
			}
			
		  });
		  if(atLeastOneIsChecked == true)
			{	
				var agree=confirm("Are you sure you want to delete this Record?");

				if (agree)

					return true ;

				else

					return false ;	
				
			}


}


//---------------------------------department validation -----



function department_validation()

{

var userid=document.getElementById('department_name').value;



if(userid=='')

{

    alert("Enter Department Name");

	

	document.getElementById('department_name').focus();

	return false;

}

return true;

}



//---------------------------------post validation------------------



function post_validation()

{

	

var user_post=document.getElementById('user_post').value;



if(user_post=='')

{

    alert("Enter Department Post Name");

	

	document.getElementById('user_post').focus();

	return false;

}



var dpt_name=document.getElementById('selectError3').value;



if(dpt_name=='')

{

	 alert("Select Department");

	document.getElementById('selectError3').focus();

	return false;

	

	}

return true;

}



//------------------------------user registration validation--------------------



function user_validation()

{

	

var user_name=document.getElementById('user_name').value;



if(user_name=='')

{

    alert("Enter User Name");

	

	document.getElementById('user_name').focus();

	return false;

}



var user_id=document.getElementById('user_id').value;



if(user_id=='')

{

	 alert("Enter User Id");

	document.getElementById('user_id').focus();

	return false;

	

	}

	

	var user_password=document.getElementById('user_password').value;



if(user_password=='')

{

	 alert("Enter User Password");

	document.getElementById('user_password').focus();

	return false;

	

	}

	var selectError3=document.getElementById('selectError3').value;



if(selectError3=='')

{

	 alert("Select Department Name");

	document.getElementById('selectError3').focus();

	return false;

	

	}

	

	var selectError31=document.getElementById('selectError31').value;



if(selectError31=='')

{

	 alert("Select Post Name");

	document.getElementById('selectError31').focus();

	return false;

	

	}

return true;

}



//--------------------company registration validaton





function company_add_valid()

{

	var comp_name=document.getElementById('comp_name').value;

	

	if(comp_name=='')

	{

		alert("Enter Company Name");

		document.getElementById('comp_name').focus();

		return false;

		}

	

	var person=document.getElementById('concerned_person').value;

	

	if(person=='')

	{

		alert("Enter Concerned Person");

		document.getElementById('concerned_person').focus();

		return false;

		}

	

	var email=document.getElementById('email_id').value;

	  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

	if(email=='')

	{

		alert("Enter Eail Id");

		document.getElementById('email_id').focus();

		return false;

		}

	 else if(reg.test(email)==false)

	 {

		 alert("Enter Valid email Id");

		  document.getElementById('email_id').focus();

		  return false;

		 }

	

	var mobile=document.getElementById('mobile_number').value;

	

	if(mobile=='')

	{

		alert("Enter Mobile Number");

		document.getElementById('mobile_number').focus();

		return false;

		}

	else

	{

		 if(isNaN(mobile)||mobile.indexOf(" ")!=-1)

           {

              alert("Enter numeric value")

              return false; 

           }

           if (mobile.length!=10)

           {

                alert("enter 10 Number");

                return false;

           }

          /* if (mobile.charAt(0)!="9")

           {

                alert("it should start with 9 ");

                return false

           }*/

		}

	return true

	

	}
	
	
	