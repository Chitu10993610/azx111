// Loading
var ie45,ns6,ns4,dom;
if (navigator.appName=="Microsoft Internet Explorer") ie45=parseInt(navigator.appVersion)>=4;
else if (navigator.appName=="Netscape"){  ns6=parseInt(navigator.appVersion)>=5;  ns4=parseInt(navigator.appVersion)<5;}
dom=ie45 || ns6;

var timershow=false;
var curx=-200;
var cury=200;
var win_w=window.innerWidth ? window.innerWidth : document.body.offsetWidth;
var mid_w=win_w/2;
	
$(document).ready(function(){
	var timershow1=window.setInterval("stayMiddle()",1);
});
function getobj(id) {
	el = document.all ? document.all[id] :   dom ? document.getElementById(id) :   document.layers[id];
	return el;
}

function show_Loading() {
	obj = getobj('LoadingDiv');
	if (timershow) window.clearTimeout(timershow);
	timershow=window.setInterval("nshow()",1);
}

function hide_Loading() {
	obj = getobj('LoadingDiv');
	if (timershow) window.clearTimeout(timershow);
	timershow=window.setInterval("nhide()",1);
}

function moveobj(obj,x,y) {
	obj.style.left=x + "px";
	obj.style.top=y+ "px";
	curx=x;
	cury=y;
}

function stayMiddle() {
	if (document.documentElement && document.documentElement.scrollTop)
		var pY =  document.documentElement.scrollTop;
	else if (document.body)
		var pY =  document.body.scrollTop;

	obj = getobj('LoadingDiv');
	newy = cury+((pY-cury)/16)+12;
	moveobj(obj,curx, newy);
}

function nshow() {
	obj = getobj('LoadingDiv');
	newx = curx+((mid_w-curx)/16)-7;
	moveobj(obj,newx, cury);
}
function nhide() {
	obj = getobj('LoadingDiv');
	newx = curx+((0-curx)/16)-15;
	moveobj(obj,newx, cury);
}
// End