<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="javascript" src="js/jquery123.js"></script>
<script type="text/javascript" language="javascript" src="http://vnexpress.net/Service/Gold_Content.js"></script>
<script type="text/javascript" language="javascript" src="http://vnexpress.net/Service/Forex_Content.js"></script>
<script language="javascript" src="js/vne/Vne.js"></script>
<style>
.box-weather {
background:#C8D4DA url(http://vnexpress.net/Images/Background/box-weather.gif) repeat-x scroll center top;
padding:2px 8px 2px 4px;
width:286px;
}
.box-middle1, .box-middle3 {
border-left:1px solid #D5D8DE;
border-right:1px solid #D5D8DE;
}
.fl, #header, #topmenu, #content, #footer, #topnews {
float:left;
}
.weather {
padding-right:10px;
width:135px;
}
.img-icon {
vertical-align:bottom;
}
.link-folder {
-x-system-font:none;
color:#8A0000;
font-family:arial;
font-size:12px;
font-size-adjust:none;
font-stretch:normal;
font-style:normal;
font-variant:normal;
font-weight:bold;
line-height:normal;
text-decoration:none;
}
.box-weather p {
margin:0;
padding:5px 0;
}
.slt-weather {
-x-system-font:none;
border-color:#9D9DA1 #9D9DA1 #9D9DA1 -moz-use-text-color;
border-style:solid solid solid none;
border-width:1px 1px 1px 0;
font-family:arial;
font-size:11px;
font-size-adjust:none;
font-stretch:normal;
font-style:normal;
font-variant:normal;
font-weight:normal;
height:20px;
line-height:normal;
padding:2px;
width:110px;
}
.img-weather {
vertical-align:middle;
}
.goldprice {
padding-left:11px;
width:128px;
}
.gold-price, .forex-rate {
margin:5px 0;
padding:0;
width:100%;
}
.forex-rate {
height:58px;
overflow-x:hidden;
overflow-y:scroll;
}
.tbl-weather {
width:110px;
}
.tbl-goldprice, .tbl-weather {
-x-system-font:none;
background-color:#A8A8A8;
font-family:arial;
font-size:11px;
font-size-adjust:none;
font-stretch:normal;
font-style:normal;
font-variant:normal;
font-weight:normal;
line-height:normal;
}
.tbl-goldprice {
width:100%;
}
.td-weather-title {
background-color:#FFFFFF;
width:40px;
}
.txtr {
text-align:right;
}
.td-weather-data {
background-color:#FFFFFF;
}
.box-weather p {
margin:0;
padding:5px 0;
}
.box-weather {
font-family:arial;
font-size:11px;
font-size-adjust:none;
font-style:normal;
font-variant:normal;
font-weight:normal;
line-height:normal;
}
</style>
</head>
<body>
<div class="box-middle1 box-weather fl">
		<div class="weather fl">
			<div class="fl"><img alt="" src="http://vnexpress.net/Images/cloud.gif" class="img-icon"/>  <label class="link-folder">Thời tiết</label></div>                                
			<div class="fl">
				<form action="#" method="post" id="frmWeather">
					<p>
						<img alt="" src="http://vnexpress.net/Images/search.gif" class="fl"/>
						<select onchange="ShowWeatherBox(this.value);" class="slt-weather" id="cboWeather">
							<option value="1">Sơn La</option>
							<!--<option value="2">Vi&#7879;t Tr&#236;</option>-->
							<option value="3">Hải Phòng</option>
							<option selected="selected" value="4">Hà Nội</option>
							<option value="5">Vinh</option>
							<option value="6">Đà Nẵng</option>
							<option value="7">Nha Trang</option>
							<option value="8">Pleiku</option>
							<option value="9">TP HCM</option>
						</select>
					</p>
					<p id="img-Do"><img alt="" class="img-weather" src="http://vnexpress.net/Images/Weather/i_troinang.gif"/> <img alt="" class="img-weather" src="http://vnexpress.net/Images/Weather/2.gif"/><img alt="" class="img-weather" src="http://vnexpress.net/Images/Weather/1.gif"/><img alt="" class="img-weather" src="http://vnexpress.net/Images/Weather/c.gif"/></p>
					<p id="txt-Weather"><b>Có mưa rào và dông</b><br/>Độ ẩm: 94%<br/>Gió đông bắc<br/>Tốc độ: 1 m/s</p>
					<script language="javascript" type="text/javascript">ShowWeatherBox(4);</script>
				</form>
			</div>                                 
		</div>
		<div class="fl"><img alt="" src="http://vnexpress.net/Images/Background/sep-boxweather.gif"/></div>
		<div class="goldprice fl">
			<div class="fl"><img alt="" src="http://vnexpress.net/Images/money.gif" class="img-icon"/>  <label class="link-folder">Giá vàng 9999</label></div>
			<div class="fl">
				<div class="gold-price fl" id="eGold"><table cellspacing="1" cellpadding="2" border="0" class="tbl-goldprice">	<tbody><tr>		<td class="td-weather-title">Mua</td>		<td class="td-weather-data txtr">1,987,000</td>	</tr>	<tr>		<td class="td-weather-title">Bán</td>		<td class="td-weather-data txtr"></td>	</tr></tbody></table></div>
				<div class="fl"><label style="font-family: arial; font-style: italic; font-variant: normal; font-weight: normal; font-size: 10px; line-height: normal; font-size-adjust: none; font-stretch: normal; -x-system-font: none; color: rgb(145, 144, 144);">( Nguồn: Cty SJC Hà Nội )</label></div>
				<div class="fl"><img alt="" src="http://vnexpress.net/Images/circle-chart.gif" class="img-icon"/>  <label class="link-folder">Tỷ giá</label></div>
				<div class="forex-rate fl" id="eForex"><table cellspacing="1" cellpadding="2" border="0" class="tbl-weather">	<tbody><tr>		<td class="td-weather-title">USD</td>		<td class="td-weather-data txtr">17,827</td>	</tr>	<tr>		<td class="td-weather-title">GBP</td>		<td class="td-weather-data txtr">26,255</td>	</tr>	<tr>		<td class="td-weather-title">HKD</td>		<td class="td-weather-data txtr">2,312</td>	</tr>	<tr>		<td class="td-weather-title"> FRF</td>		<td class="td-weather-data txtr">-</td>	</tr>	<tr>		<td class="td-weather-title">CHF</td>		<td class="td-weather-data txtr">15,828</td>	</tr>	<tr>		<td class="td-weather-title">DEM</td>		<td class="td-weather-data txtr">-</td>	</tr>	<tr>		<td class="td-weather-title">JPY</td>		<td class="td-weather-data txtr">183.11</td>	</tr>	<tr>		<td class="td-weather-title">AUD</td>		<td class="td-weather-data txtr">12,463</td>	</tr>	<tr>		<td class="td-weather-title">CAD</td>		<td class="td-weather-data txtr">14,546</td>	</tr>	<tr>		<td class="td-weather-title">SGD</td>		<td class="td-weather-data txtr">11,824</td>	</tr>	<tr>		<td class="td-weather-title">EUR</td>		<td class="td-weather-data txtr">24,110</td>	</tr>	<tr>		<td class="td-weather-title">NZD</td>		<td class="td-weather-data txtr">10,238</td>	</tr>	<tr>		<td class="td-weather-title"/>		<td class="td-weather-data txtr"/>	</tr></tbody></table></div>
				<div class="fl"><label style="font-family: arial; font-style: italic; font-variant: normal; font-weight: normal; font-size: 10px; line-height: normal; font-size-adjust: none; font-stretch: normal; -x-system-font: none; color: rgb(5, 50, 79);">( Nguồn: <img src="http://vnexpress.net/Images/logo-EXIM.gif" style="border: 0px none ; vertical-align: middle;"/> )</label></div>				
			</div>
		</div>
	</div>
	<script type="text/javascript" language="javascript">ShowGoldPrice();ShowForexRate();</script>
</body></html>