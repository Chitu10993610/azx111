	function FloatTopDiv()
	{
		startLX = ((document.body.clientWidth -MainContentW)/2)-LeftBannerW-LeftAdjust , startLY = TopAdjust+80;
		startRX = ((document.body.clientWidth -MainContentW)/2)+MainContentW+RightAdjust , startRY = TopAdjust+80;
		var d = document;
		function ml(id)
		{
			var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			el.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
			el.x = startRX;
			el.y = startRY;
			return el;
		}
		function m2(id)
		{
			var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			e2.sP=function(x,y){this.style.left=x + 'px';this.style.top=y + 'px';};
			e2.x = startLX;
			e2.y = startLY;
			return e2;
		}
		window.stayTopLeft=function()
		{
			if (document.documentElement && document.documentElement.scrollTop)
				var pY =  document.documentElement.scrollTop;
			else if (document.body)
				var pY =  document.body.scrollTop;
			if (document.body.scrollTop > 30){startLY = 3;startRY = 3;} else {startLY = TopAdjust;startRY = TopAdjust;};
			ftlObj.y += (pY+startRY-ftlObj.y)/16;
			ftlObj.sP(ftlObj.x, ftlObj.y);
			ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
			ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			setTimeout("stayTopLeft()", 1);
		}
		ftlObj = ml("divAdRight");
		//stayTopLeft();
		ftlObj2 = m2("divAdLeft");
		stayTopLeft();
	}
	function ShowAdDiv()
	{
		var objAdDivRight = document.getElementById("divAdRight");
		var objAdDivLeft = document.getElementById("divAdLeft");		
		
		if (document.body.clientWidth < MainContentW+(LeftBannerW+RightBannerW)/2)
		{
		    objAdDivRight.style.display = "none";
			objAdDivLeft.style.display = "none";
		}

	}
	
var browser     = '';
var version     = '';
var entrance    = '';
var cond        = '';
// BROWSER?
if (browser == ''){
if (navigator.appName.indexOf('Microsoft') != -1)
browser = 'IE'
else if (navigator.appName.indexOf('Netscape') != -1)
browser = 'Netscape'
else browser = 'IE';
}
if (version == ''){
version= navigator.appVersion;
paren = version.indexOf('(');
whole_version = navigator.appVersion.substring(0,paren-1);
version         = parseInt(whole_version);
}
if (browser == 'IE' && version >= 4) 
{
 LeftAdjust = 31;
 RightAdjust = 11;
}
if (browser == 'Netscape' && version >= 2.02) 
{
 LeftAdjust = 40;
 RightAdjust = 2;
}
MainContentW = 1000;
LeftBannerW = 120;
RightBannerW = 120;
LeftAdjust = -8;
RightAdjust = -2;
TopAdjust = 10;
ShowAdDiv();
window.onresize=ShowAdDiv;
