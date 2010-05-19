<style>
#backgroundPopup{
display:none;
position:fixed;
_position:absolute; /* hack for internet explorer 6*/
height:100%;
width:100%;
top:0;
left:0;
background:#000000;
border:1px solid #cecece;
z-index:1;
}
</style>
<link rel="stylesheet" href="<?=base_url()?>css/style-search.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?=base_url()?>js/lightbox/css/lightbox.css" type="text/css" media="screen" />

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAzJMMQDZx_B_ndnMyFDnPrhQDFBhHJqIPrR-AP1oxUQmf7LNvEBTHdNjoQe4JblCVLNThvckLnKXjyA" type="text/javascript"></script>
<script src="<?=base_url()?>js/lightbox/lightbox.js" type="text/javascript"></script>
<script language="javascript">
var mapid;
function getMap(id, url, geo, add) {
	mapid = id;
	$("#"+mapid).click(function() {return false;});
//	$("#").addClass("feed_loading");

//	$.getJSON(url, buildGmap);
	$.ajax({
	
		   type: 'POST',
	
		   url : url,
	
		   dataType: 'json',
		   
		   data: "geo="+geo+"&adr="+add,
	
		   success: function(data){
		   		buildGmap(data)
		   }
		});
}

function buildGmap(datos) {
//	alert(mapid);
	 $("#map_container_"+mapid).html(datos.map);
	 $("#map_container_"+mapid).css("display","block");
	 load();
	 $("#backgroundPopup").css({  
		"opacity": "0.2"
		 });
		 $("#backgroundPopup").fadeIn("slow");
		 
	 $("#backgroundPopup").click(function() {
	 	$("#map_container_"+mapid).css("display","none");
	 	$("#map_container_"+mapid).html("");
	 	
		 $("#backgroundPopup").fadeOut("slow"); 
	 });
}

$(document).ready(function(){
			$(".lightbox").lightbox();
		});
</script>
<div id="content" class="narrowcolumn">
<?=$search?>
<div id="content-main"><div class="container">
<!--      <h4 id="results-info">
         <p id="num-results"><?=$total_rows?> <span>Results</span></p>
			<form action="/search" id="sortbyForm" method="get">
         <p id="sortby-buttons">
	<span class="current">Distance From Pit</span>
<button class="sortby" id="sortby-price" name="sortby" type="submit" value="price">Price</button>
<button class="sortby" id="sortby-sq_ft" name="sortby" type="submit" value="sq_ft">Sq Ft</button>

				
		<input id="hidden-distance" name="distance" value="" type="hidden">
		<input id="hidden-price" name="price" value="" type="hidden">
		<input id="hidden-bedrooms" name="bedrooms" value="" type="hidden">
		<input id="hidden-bathrooms" name="bathrooms" value="" type="hidden">
		<input id="hidden-bus_route" name="bus_route" value="" type="hidden">
		<input id="hidden-page" name="page" value="1" type="hidden">
</p>
			</form>
			
      </h4>-->
	  <div id="results">
	  <?php foreach ($ci_properties_list as $ci_properties) { ?>
	    <div class="result">
   <h2><a href="<?=site_url().'nha-dat/'.$ci_properties['id']?>/<?=$ci_properties['name_sef']?>"><?=$ci_properties['name']?></a></h2>  
   <div class="snapshot">
   <?php 
   $aryImg = array();
   if($ci_properties['attach_files']) {
		$aryImg = $ci_properties['attach_files'];
		$n = sizeof($aryImg);
		$img_origin = '';
		if(stripos($aryImg[0], '/')) {
				$img_name = site_url().'images/common/.thumbs/'.$aryImg[0];
				$img_origin = site_url().'images/common/'.$aryImg[0];
		}
		else {	
			//get image name
			$img_name = substr($aryImg[0], 0, strrpos($aryImg[0], '.'));
			$ext = strrchr($aryImg[0], ".");
//			$img_name = $img_name.'_thumb'.$ext;
			$img_name = site_url().'images/property/'.$img_name.'_small'.$ext;
		}
		?>
			<a title="<?=@$ci_properties['attach_files_title'][0]?>" class="lightbox" rel="roadtrip<?=$ci_properties['id']?>" href="<?php echo $img_origin;?>" alt="<?=$ci_properties['name']?>"><img src="<?php echo $img_name;?>" alt="<?=$ci_properties['name']?>" width="160"/></a>
			<?
			if ($n > 1) for($i = 1; $i < $n; $i++) {
				echo '<a title="'.$ci_properties['attach_files_title'][$i].'" href="'.site_url().'images/'.'property/'.$aryImg[$i].'" class="lightbox" rel="roadtrip'.$ci_properties['id'].'"></a>';
			}
   }
   else {
   ?>
   <img src="<?php echo site_url().'images/house_no_im.jpg';?>" alt="" width="160"/>
   <?}?>
      
      <p class="mapit"><a id="mapit<?=$ci_properties['id']?>" href="javascript:void(0);" onclick="getMap(this.id, '<?=site_url().'front/mapit'?>', '<?=base64_encode(substr($ci_properties['geocode'], 1, strlen($ci_properties['geocode'])-2))?>', '<?=base64_encode($ci_properties['address'])?>');">Map It!</a></p>
      <div id="map_container_mapit<?=$ci_properties['id']?>" style="display:none;padding:3px; border: 1px #CCCCCC solid; width:326px;height:266px; position:absolute; background-color:#C0c0c0; z-index:2;"></div>
   </div><!-- /snapshot -->

   <div class="stats-wrapper">
      <ul class="stats">
			<li><strong><?=$ci_properties['bedrooms']?></strong> P.Ngủ</li>
			<li><strong><?=$ci_properties['bath']?></strong> Phụ</li>
			<li><strong><?=$ci_properties['square_footage']?></strong> m<sup>2</sup></li>
			<li><strong><?=$ci_properties['price'] . '</strong> ' . $ci_properties['currency']?></li>
		</ul>
		<div class="description"><p><?=$ci_properties['infomation']?></p></div>
		<p class="phone">Phone: <?=$ci_properties['contact_phone']?></p>
   </div><!-- /stats-wrapper -->
   <br class="clearer"/>
</div>
<? } ?>
        <br>
<!--<p class="page-results">1 - 10 Properties of 64 Properties</p> -->
<div class="pagination"><?=$page_links?></div>

</div>
<br>
</div></div>
</div>
<div id="backgroundPopup"></div>