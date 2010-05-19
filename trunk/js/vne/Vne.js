function ShowWeatherBox(url, vId){
	var sLink = '';
	sLink = 'http://vnexpress.net/ListFile/Weather/';
	switch (parseInt(vId)){	    	
		case 1: sLink = sLink.concat('Sonla.xml');break;
		case 2: sLink = sLink.concat('Viettri.xml');break;
		case 3: sLink = sLink.concat('Haiphong.xml');break;
		case 4: sLink = sLink.concat('Hanoi.xml');break;
		case 5: sLink = sLink.concat('Vinh.xml');break;
		case 6: sLink = sLink.concat('Danang.xml');break;
		case 7: sLink = sLink.concat('Nhatrang.xml');break;
		case 8: sLink = sLink.concat('Pleicu.xml');break;
		case 9: sLink = sLink.concat('HCM.xml');break;
		default: sLink = sLink.concat('Hanoi.xml');break;
	}
	
		 $.ajax({
		 	type: "POST",
		   	url: url,
		    data: "file="+sLink,
//		   dataType: "xml",
		   success: function(req){
		   		var vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather;
				vAdImg = req.getElementsByTagName('AdImg').item(0).firstChild.nodeValue;
				vAdImg1 = req.getElementsByTagName('AdImg1').item(0).firstChild.nodeValue;
				if(req.getElementsByTagName('AdImg2').item(0).firstChild != null)
					vAdImg2 = req.getElementsByTagName('AdImg2').item(0).firstChild.nodeValue;
				if(req.getElementsByTagName('AdImg3').item(0).firstChild != null)
					vAdImg3 = req.getElementsByTagName('AdImg3').item(0).firstChild.nodeValue;
				if(req.getElementsByTagName('AdImg4').item(0).firstChild != null)
					vAdImg4 = req.getElementsByTagName('AdImg4').item(0).firstChild.nodeValue;
				if(req.getElementsByTagName('AdImg5').item(0).firstChild != null)
					vAdImg5 = req.getElementsByTagName('AdImg5').item(0).firstChild.nodeValue;
				vWeather = req.getElementsByTagName('Weather').item(0).firstChild.nodeValue;
				GetWeatherBox(vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather);		
			}
		});
}

function GetWeatherBox(vImg, vImg1, vImg2, vImg3, vImg4, vImg5, vWeather){
	var sHTML = '';
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg).concat('" class="img-weather" alt="" />&nbsp;');
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg1).concat('" class="img-weather" alt="" />');
	if(vImg2!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg2).concat('" class="img-weather" alt="" />');
	if(vImg3!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg3).concat('" class="img-weather" alt="" />');
	if(vImg4!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg4).concat('" class="img-weather" alt="" />');
	if(vImg5!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg5).concat('" class="img-weather" alt="" />');
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/c.gif" class="img-weather" alt="" />');
	
	gmobj('img-Do').innerHTML = sHTML;
	gmobj('txt-Weather').innerHTML = vWeather;
}

function ShowGoldPrice(){
	var sHTML = '';	
	sHTML = sHTML.concat('<span style="float:right;color:#8A0000;font:bold 10px arial;">ĐVT: tr.&#273;/ch&#7881;</span>');
	sHTML = sHTML.concat('<table border="0px" cellpadding="2px" cellspacing="1px" class="tbl-goldprice">');
	sHTML = sHTML.concat('	<tr>');
	sHTML = sHTML.concat('		<td class="td-weather-title" style="font-size:10px;width:46%;">Lo&#7841;i v&#224;ng</td>');
	sHTML = sHTML.concat('		<td class="td-weather-title" style="text-align:center;font-size:10px;width:27%;">Mua</td>');
	sHTML = sHTML.concat('		<td class="td-weather-title" style="text-align:center;font-size:10px;width:27%;">B&#225;n</td>');
	sHTML = sHTML.concat('	</tr>');
	sHTML = sHTML.concat('	<tr>');
	sHTML = sHTML.concat('		<td class="td-weather-title">SBJ</td>');
	sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSbjBuy).concat('</td>');
	sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSbjSell).concat('</td>');
	sHTML = sHTML.concat('	</tr>');
	sHTML = sHTML.concat('	<tr>');
	sHTML = sHTML.concat('		<td class="td-weather-title">SJC</td>');
	sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSjcBuy).concat('</td>');
	sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSjcSell).concat('</td>');
	sHTML = sHTML.concat('	</tr>');
	sHTML = sHTML.concat('</table>');
	gmobj('eGold').innerHTML = sHTML;
}


function ShowForexRate(){
	var sHTML = '';
	sHTML = sHTML.concat('<table border="0px" cellpadding="2px" cellspacing="1px" class="tbl-weather">');
	for(var i=0;i<vForexs.length;i++){
		sHTML = sHTML.concat('	<tr>');
		sHTML = sHTML.concat('		<td class="td-weather-title">').concat(vForexs[i]).concat('</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vCosts[i]).concat('</td>');
		sHTML = sHTML.concat('	</tr>');
	}
	sHTML = sHTML.concat('</table>');
	gmobj('eForex').innerHTML = sHTML;
}

function gmobj(o){
	if(document.getElementById){ m=document.getElementById(o); }
	else if(document.all){ m=document.all[o]; }
	else if(document.layers){ m=document[o]; }
	return m;
}