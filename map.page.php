
<div id="content">
<div id="map" style="width:100%;height:200px;background-color:black;position:relative;float:left;"></div>
<div id="poignee" style="width:100%;height:5px;background-color:#333333;float:left;">&nbsp;</div>
<div id="pano" style="width:100%;height:500px;background-color:black;position:relative;float:left;"></div> 
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	function initialisation(){
		var centreCarte = new google.maps.LatLng(48.853336,2.348922);
		var optionsCarte = {
			zoom: 4,
			center: centreCarte,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var maCarte = new google.maps.Map(document.getElementById("map"), optionsCarte);
			
		var optionsPanoramiqueStreetView = {
			position: centreCarte,
			pov: {
				heading: 34,
				pitch: 3,
				zoom: 1
			}
		};
		var panoramiqueStreetView = new google.maps.StreetViewPanorama(document.getElementById('pano'), optionsPanoramiqueStreetView);
		maCarte.setStreetView(panoramiqueStreetView);
	 }
			
	google.maps.event.addDomListener(window, 'load', initialisation);


$( "#poignee" ).click(function() {
	if($('#pano').css('height')=='500px'){
		$( "#map" ).animate({
			height:500
		}, 500 );
		$( "#pano" ).animate({
			height:200
		}, 500 );
	}else{
		$( "#map" ).animate({
			height:200
		}, 500 );
		$( "#pano" ).animate({
			height:500
		}, 500 );
	}
});
		
</script>
</div>
