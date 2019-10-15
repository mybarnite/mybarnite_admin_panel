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





