
/***********************************************
* Drop Down/ Overlapping Content- � Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function getposOffset(overlay, offsettype){
var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop;
var parentEl=overlay.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function overlay(curobj, subobjstr, opt_position, padding_left, padding_top){
if (document.getElementById){
var subobj=document.getElementById(subobjstr)
//comment de khong nhap nhay
//subobj.style.display=(subobj.style.display!="block")? "block" : "none"
subobj.style.display= "block";

var xpos=getposOffset(curobj, "left")+((typeof opt_position!="undefined" && opt_position.indexOf("right")!=-1)? -(subobj.offsetWidth-curobj.offsetWidth) : 0) 
var ypos=getposOffset(curobj, "top")+((typeof opt_position!="undefined" && opt_position.indexOf("bottom")!=-1)? curobj.offsetHeight : 0)
if((typeof opt_position!="undefined" && opt_position.indexOf("top")!=-1))
	ypos=getposOffset(curobj, "top")-subobj.offsetHeight-3;
//alert(xpos);
//alert(curobj);
subobj.style.left=xpos+"px"
subobj.style.top=ypos+"px"
return false
}
else
return true
}

function overlay1(curobj, subobjstr, opt_position, padding_left, padding_top){
	
	//close other subcat poup;
	if(subobjstr.indexOf("subcat")!=-1) closeOther(subobjstr);
	
	if (document.getElementById){
	var subobj=document.getElementById(subobjstr)
	//comment de khong nhap nhay
//	subobj.style.display=(subobj.style.display!="block")? "block" : "none"
	subobj.style.display= "block";
//	alert(getposOffset(curobj, "left"));
	var xpos=getposOffset(curobj, "left")+((typeof opt_position!="undefined" && opt_position.indexOf("right")!=-1)? -(subobj.offsetWidth-curobj.offsetWidth) : 0) 
	var ypos=getposOffset(curobj, "top")+((typeof opt_position!="undefined" && opt_position.indexOf("bottom")!=-1)? curobj.offsetHeight : 0)
	if((typeof opt_position!="undefined" && opt_position.indexOf("top")!=-1))
		ypos=getposOffset(curobj, "top")-subobj.offsetHeight-3;
//	alert(xpos);
//	alert(curobj.id);
	subobj.style.left = padding_left + xpos+"px"
	subobj.style.top= padding_top + ypos+"px"
	return false
	}
	else
	return true
}

function closeOther(subobjstr) {
	var subcat = 'subcat';
	var subcatF = 'subcat_f';
	for(i = 1; i < 18; i++) {
		subcatId = subcat + i;
		subcatFId = subcatF + i;
		var objsubcat = document.getElementById(subcatId);
		var objsubcatF = document.getElementById(subcatFId);
//		alert(objsubcat);
		if (objsubcat && subcatId != subobjstr) overlayclose(subcatId);
		if (objsubcatF && subcatFId != subobjstr) overlayclose(subcatFId);
	}
}

function closeAlloverlay() {
	var subcat = 'subcat';
	var subcat_f = 'subcat_f';
	for(i = 1; i < 18; i++) {
		subcatId = subcat + i;
		subcatFId = subcat_f + i;
		var objsubcat = document.getElementById(subcatId);
		var objsubcatF = document.getElementById(subcatFId);
		if (objsubcat) overlayclose(subcatId);
		if (objsubcatF) overlayclose(subcatFId);
	}
}

function overlayclose(subobj){
document.getElementById(subobj).style.display="none"
//subobj.style.display="none"
}

function overlayhide(subobj){
//	alert(subobj);
//	var obj = document.getElementById(subobj);
//alert(subobj.id);
//document.getElementById(subobj).style.display="none"
subobj.style.display="none"
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(subobj){
	var obj = document.getElementById(subobj);
//	alert(obj.id);
	delayhide=setTimeout('overlayhide('+subobj+')',200);
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

