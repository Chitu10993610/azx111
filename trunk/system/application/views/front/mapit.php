<script type="text/javascript">
var map;
var lastMarker;
var lastGeo;
jQuery(document).ready(function(){
    load();
});

    function load() {
		if (GBrowserIsCompatible()) {
			map = new GMap2(document.getElementById("map"));
			lastMarker = new GLatLng(37.4224, -122.0838);
			map.setCenter(lastMarker, 15);
			geocoder = new GClientGeocoder();
			
			//load address
			var geocode = '<?=$geocode?>';
			var address = '<?=$address?>';
			if(geocode) {
				var pont2 = new GLatLng(<?=$geocode?>);
				var marker2 = new GMarker(pont2, {draggable: true});
				map.addOverlay(marker2);
				
				lastGeo = marker2.getLatLng();
		
			    GEvent.addListener(marker2, "dragend", function() {
					lastGeo = marker2.getLatLng();
				});
				
				map.setCenter(pont2, 15);
			}
			else {
				
				if(address) showAddress(address);
			}
			
			var trafficOptions = {incidents:true};
			trafficInfo = new GTrafficOverlay(trafficOptions);
			map.addOverlay(trafficInfo);
		}
    }
    
    function showAddress(address) {
  if (geocoder) {
    geocoder.getLatLng(address,
    function(point) {
      if (!point) {
        alert(address + ", Google Maps was unable to locate the intended address. Please add a marker.");
      } else {
        clearMap();
        map.setCenter(point, 15);
        var marker = new GMarker(point, {draggable: false});
        map.addOverlay(marker);
        }
        
        	var trafficOptions = {incidents:true};
			trafficInfo = new GTrafficOverlay(trafficOptions);
			map.addOverlay(trafficInfo);
      }
    );
  }
}

function clearMap(){
  map.clearOverlays();
} 

</script>
 
<style type="text/css">
div#popup {
background:#EFEFEF;
border:1px solid #999999;
margin:0px;
padding:7px;
width:270px;
}
</style>
<div id="map" style="width:320px;height:260px"></div>
