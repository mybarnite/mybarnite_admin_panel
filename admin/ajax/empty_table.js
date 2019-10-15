// JavaScript Document

function fnUnloadHandler() {
  xmlhttp=null; 
  if (window.XMLHttpRequest) 
     {// code for Firefox, Opera, IE7, etc. 
        xmlhttp=new XMLHttpRequest(); 
     } 
  else if (window.ActiveXObject) 
     {// code for IE6, IE5 
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
     } 

  if (xmlhttp!=null) 
     {  
        xmlhttp.open("GET","delete_db.php",true); 
        xmlhttp.send(null); 
     } 
     else 
     { 
        alert("Your browser does not support XMLHTTP."); 
     } 
}