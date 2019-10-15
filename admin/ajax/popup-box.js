// JavaScript Document

function popup(sw,id) {


if (sw == 1) {
// Show popup
document.getElementById("comment_id").value = id;
document.getElementById('blackout').style.visibility = 'visible';
document.getElementById('divpopup').style.visibility = 'visible';
document.getElementById('blackout').style.display = 'block';
document.getElementById('divpopup').style.display = 'block';
} 
else {
// Hide popup
document.getElementById('blackout').style.visibility = 'hidden';
document.getElementById('divpopup').style.visibility = 'hidden';
document.getElementById('blackout').style.display = 'none';
document.getElementById('divpopup').style.display = 'none';
}
}


//-----------------------------------------------------------------




function popup_view(sww,idd) {

if (sww == 1) {
// Show popup
window.location="#?comp_id="+idd;

document.getElementById('blackout1').style.visibility = 'visible';
document.getElementById('divpopup1').style.visibility = 'visible';
document.getElementById('blackout1').style.display = 'block';
document.getElementById('divpopup1').style.display = 'block';


} 
else {
// Hide popup
document.getElementById('blackout1').style.visibility = 'hidden';
document.getElementById('divpopup1').style.visibility = 'hidden';
document.getElementById('blackout1').style.display = 'none';
document.getElementById('divpopup1').style.display = 'none';
}
}


//--------------------delete popup box---------------------------------------------


function delete_comment(sww,idd) {


 
if (sww == 1) {
window.location="#?comp_id="+idd;
document.getElementById("comp_id").value = idd;
document.getElementById('blackout2').style.visibility = 'visible';
document.getElementById('divpopup2').style.visibility = 'visible';
document.getElementById('blackout2').style.display = 'block';
document.getElementById('divpopup2').style.display = 'block';

} 
else {
// Hide popup
document.getElementById('blackout2').style.visibility = 'hidden';
document.getElementById('divpopup2').style.visibility = 'hidden';
document.getElementById('blackout2').style.display = 'none';
document.getElementById('divpopup2').style.display = 'none';
}

}


