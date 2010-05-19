<?
	if(isset($_GET['file'])){
		$content = file_get_contents($_GET['file']);
		header("Content-Type: application/rss+xml; charset=UTF-8");
		echo $content;
		exit;
	}
?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	function getContent(url){
		 $.ajax({
		   url: url,
		   success: function(req){
		   		var vAdImg; var vAdImg1; var vAdImg2; var vAdImg3; var vAdImg4; var vAdImg5; var vWeather;
								
				vAdImg = req.getElementsByTagName('AdImg').item(0).firstChild.nodeValue;
				vAdImg1 = req.getElementsByTagName('AdImg1').item(0).firstChild.nodeValue;
				if (req.getElementsByTagName('AdImg2').item(0).firstChild != null)
					vAdImg2 = req.getElementsByTagName('AdImg2').item(0).firstChild.nodeValue;
				if (req.getElementsByTagName('AdImg3').item(0).firstChild != null)
					vAdImg3 = req.getElementsByTagName('AdImg3').item(0).firstChild.nodeValue;
				if (req.getElementsByTagName('AdImg4').item(0).firstChild != null)
					vAdImg4 = req.getElementsByTagName('AdImg4').item(0).firstChild.nodeValue;
				if (req.getElementsByTagName('AdImg5').item(0).firstChild != null)	
					vAdImg5 = req.getElementsByTagName('AdImg5').item(0).firstChild.nodeValue;
				vWeather = req.getElementsByTagName('Weather').item(0).firstChild.nodeValue;
				AdWeather(vAdImg,vAdImg1,vAdImg2,vAdImg3,vAdImg4,vAdImg5,vWeather);
		   }
		 });
	}
	function ShowWeatherBox(){
		var vID=document.frmWeather.cboWeather.value;
		var vFile;
		if (vID==1){vFile="http://vnexpress.net/ListFile/Weather/Sonla.xml";}		
		else if (vID==2){vFile="http://vnexpress.net/ListFile/Weather/Viettri.xml";}
		else if(vID==3){vFile="http://vnexpress.net/ListFile/Weather/Haiphong.xml";}
		else if(vID==4){vFile="http://vnexpress.net/ListFile/Weather/Hanoi.xml";}
		else if(vID==5){vFile="http://vnexpress.net/ListFile/Weather/Vinh.xml";}
		else if(vID==6){vFile="http://vnexpress.net/ListFile/Weather/Danang.xml";	}
		else if(vID==7){vFile="http://vnexpress.net/ListFile/Weather/Nhatrang.xml";}
		else if(vID==8){vFile="http://vnexpress.net/ListFile/Weather/Pleicu.xml";}
		else{vFile="http://vnexpress.net/ListFile/Weather/HCM.xml";}
		getContent('test.php?file='+vFile);
	}
	function AdWeather(vImg,vImg1,vImg2,vImg3,vImg4,vImg5,vWeather){
		var AdDo;
		AdDo = "<Img src='http://vnexpress.net/Images/Weather/" + vImg1 + "' border='0'>";
		if (vImg2 != null) AdDo += "<Img src='http://vnexpress.net/Images/Weather/" + vImg2 + "' border='0'>";
		if (vImg3 != null) AdDo += "<Img src='http://vnexpress.net/Images/Weather/" + vImg3 + "' border='0'>";
		if (vImg4 != null) AdDo += "<Img src='http://vnexpress.net/Images/Weather/" + vImg4 + "' border='0'>";
		if (vImg5 != null) AdDo += "<Img src='http://vnexpress.net/Images/Weather/" + vImg5 + "' border='0'>";
		AdDo +="<Img src='http://vnexpress.net/Images/Weather/c.gif' border='0'>";
		
		//document.getElementById("txt-Weather").innerHTML = vWeather;
		document.getElementById("img-Weather").innerHTML = "<Img src='http://vnexpress.net/Images/Weather/" + vImg + "' border='0'>";
		document.getElementById("img-Do").innerHTML = AdDo;
	}
	$(document).ready(ShowWeatherBox);
</script>

<div style="width:150px;height:20px;float:left;">
		<div style="float:left;width:4px;height:20px;font-size:1px;">&nbsp;</div>
		<div style="width:146px;height:20px;float:left;">
			<form action="" id="frmWeather" name="frmWeather" method="post">
				
			<div style="width:140px;height:20px;float:left;">
				<select id="cboWeather" name="cboWeather" class="box-item" style="width:140;height:18;border-top: 1px solid #a8a8a8;border-bottom: 1px solid #a8a8a8;border-left: 0px solid #ffffff;border-right: 1px solid #a8a8a8;" onChange="ShowWeatherBox(this.value);">
					<option value="1">Son La</option>
					<option value="2">Viet Tri</option>
					<option value="3">Hai Phong</option>
					<option value="4" selected>Ha Noi</option>
					<option value="5">Vinh</option>
					<option value="6">Da Nang</option>
					<option value="7">Nha Trang</option>
					<option value="8">Pleicu</option>
					<option value="9">TP HCM</option>
				</select>
			</div>
			</form>
		</div>
	</div>
	<div style="float:left;width:150px;height:5px;font-size:1px;">&nbsp;</div>
	<div style="width:150px;height:35px;float:left;">
		<div style="float:left;width:4px;height:35px;font-size:1px;">&nbsp;</div>
		<div style="width:146px;height:35px;float:left;">
			<div style="width:36px;height:35px;float:left;" id="img-Weather">&nbsp;</div>
			<div style="float:left;width:5px;height:35px;font-size:1px;">&nbsp;</div>
			<div style="float:left;width:105px;height:4px;font-size:1px;">&nbsp;</div>
			<div style="width:105px;height:31px;float:left;" id="img-Do">&nbsp;</div>
		</div>
	</div>
	<div style="width:146px;height:10px;float:left;" id="txt-Weather" class="box-item">&nbsp;</div>
</div>