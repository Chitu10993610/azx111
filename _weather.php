<?php
class modWeatherHelper
{
	var $content="";
	function modWeatherHelper()
	{
		if(!$this->inExpires())
		{
			$this->content.= '<li><span>'.$this->loadWeather("http://vnexpress.net/ListFile/Weather/Hanoi.xml").'</span><sup>o</sup> Hà Nội</li>';
			$this->content.= '<li><span>'.$this->loadWeather("http://vnexpress.net/ListFile/Weather/HCM.xml").'</span><sup>o</sup> Hồ Chí Minh</li>';

			$this->content.= '<li><span>'.$this->loadWeather("http://vnexpress.net/ListFile/Weather/Haiphong.xml").'</span><sup>o</sup> Hải Phòng</li>';

			$this->content.= '<li><span>'.$this->loadWeather("http://vnexpress.net/ListFile/Weather/Danang.xml").'</span><sup>o</sup> Đà nẵng</li>';
			$this->writeCache($this->content);			
		}else{    		
    		$this->content=$this->readCache();
    	}		
	}
	function text()
	{
		return $this->content;		
	}
	function writeCache($contents)
	{		
	    $fp = @fopen("weather.txt",'w');
        if ($fp)
        {
            fputs($fp,$contents);
        	fclose($fp);
    	}
	}
	function readCache()
	{
        $fp = @fopen("weather.txt",'r');
        if ($fp)
        {	
			$i=0;
            while(!feof($fp)){ 
				$contents.= fread($fp,4096);
				$i++;
			}
            fclose($fp);
        }
        return $contents; 
	}
	function inExpires()
	{
		$lastmodified=@filemtime("weather.txt");
		if(!$lastmodified)
			return false;
		$lastmodified=$lastmodified+3600;
		if($lastmodified<time())
			return false;
		return true;
	}
	function loadWeather($file)
	{
		$content=file_get_contents($file);
		preg_match_all("|<AdImg1>(.*)\.gif</[^>]+>|U",$content, $out, PREG_PATTERN_ORDER);
		if($out[1][0])
			$nhietdo.=$out[1][0];
		preg_match_all("|<AdImg2>(.*)\.gif</[^>]+>|U",$content, $out, PREG_PATTERN_ORDER);
		if($out[1][0])
			$nhietdo.=$out[1][0];
		return $nhietdo;
	}
}

$weather = new modWeatherHelper();
class modTygiaHelper
{
	var $content="";
	function modTygiaHelper()
	{
		if(!$this->inExpires())
		{
			$this->content=$this->loadTygia();
			$this->writeCache($this->content);			
		}
	}
	function text()
	{
		return '<script type="text/javascript" language="JavaScript" src="Forex_Content.js"></script>';		
	}
	function writeCache($contents)
	{		
	    $fp = @fopen("Forex_Content.js",'w');
        if ($fp)
        {
            fputs($fp,$contents);
        	fclose($fp);
    	}
	}

	function inExpires()
	{
		$lastmodified=@filemtime("Forex_Content.js");
		if(!$lastmodified)
			return false;
		$lastmodified=$lastmodified+3600;
		if($lastmodified<time())
			return false;
		return true;
	}
	
	function loadTygia()
	{
		$content1=str_replace(array('\' ','-'),array('\'','_'),@file_get_contents('http://www.vnexpress.net/Service/Forex_Content.js'));
		
		
		if($content1)		{
			
		$i=0;
			$result=$content1."\n	document.write('<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"  class=\"weather\">');
	try
	{
		if (typeof vForexs[0]  != 'undefined')
	    	document.write('<tr><td>&nbsp;&nbsp;' + vForexs[0] + '</td><td>&nbsp;' + vCosts[0] + '</td></tr>');
		if (typeof vForexs[1]  != 'undefined')
	    	document.write('<tr><td>&nbsp;&nbsp;' + vForexs[1] + '</td><td>&nbsp;' + vCosts[1] + '</td></tr>');
	    if (typeof vForexs[2]  != 'undefined')
	    	document.write('<tr><td>&nbsp;&nbsp;' + vForexs[2] + '</td><td>&nbsp;' + vCosts[2] + '</td></tr>');	   
	    if (typeof vForexs[4]  != 'undefined')
	    	document.write('<tr><td>&nbsp;&nbsp;' + vForexs[4] + '</td><td>&nbsp;' + vCosts[4] + '</td></tr>');	    
		if (typeof vForexs[6]  != 'undefined')
		    document.write('<tr><td>&nbsp;&nbsp;' + vForexs[6] + '</td><td>&nbsp;' + vCosts[6] + '</td></tr>');
		if (typeof vForexs[7]  != 'undefined')
		    document.write('<tr><td>&nbsp;&nbsp;' + vForexs[7] + '</td><td>&nbsp;' + vCosts[7] + '</td></tr>');		
	}
	catch (error)
	{

	}
	document.write('</table>');";
					
			return $result;
		}
		return '';
	}
}
$tygia= new modTygiaHelper();


$content = '<div class="support_online" >';
	
$content .='<div class="weather">		
		<h3>'. _LBL_WEATHER .'</h3>
	<ul border="1" >
		'.$weather->text().'					
	</ul>
	</div></div>';    
        
  $content.=' <div class="support_online" ><div class="rate">		
		<h3>'. _LBL_RATE.'(vnđ)</h3>
		<ul>'. $tygia->text().'		
</ul>	
//<script language="JavaScript">';	
//  
//		$content .= " for(var i=0;i<vForexs.length;i++){
//						  if (typeof(vForexs[i]) !='undefined' && typeof(vCosts[i]) !='undefined'){
//							document.getElementById('rate_'+vForexs[i]).innerHTML=vCosts[i] + ' ';
//						  }					  
//					  
//				  }";
//
//
//	$content .="</script>
//				</div>        
//		</div>";
	echo $content;
  ?>