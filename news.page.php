<?php
	require('inc/magpierss-0.72/rss_fetch.inc');

$cat=($_GET['cat'])?$_GET['cat']:1;

$arrayRSS=$fluxRSS->getFlux($cat);

$arrayCOLORS=array("#008080","#4682B4","#6B8E23","#A0522D","#D2B48C","#9ACD32","#800080","#3CB371","#6A5ACD","#B0C4DE","#40E0D0","#F5DEB3");

?>
<div id="content">
<ul class="sous-menu">
	<li><a href="index.page.php?link=news">infos générales</a></li>
	<li><a href="index.page.php?link=news&cat=2">écrans et réseaux</a></li>	
</ul>	
	<div style="width:32%;margin:5px;float:left;">
		<div id="meteo"></div>
		<div id="meteo2"></div>
		<div id="meteo3"></div>
<?php
for($j=0;$j<count($arrayRSS);$j++){
	if($arrayRSS[$j]['CAT']==2){
		$rss = fetch_rss($arrayRSS[$j]['LIEN']);
		$flux=$rss->items;		
		if($arrayRSS[$j]['TITRE']!="Citation du jour"){
?>
		<div style="width:100%;height:10px;clear:both;"></div>
		<div class="journal2">
	<?php	
		include('inc/dynaRSS2.php');
	?>
		</div>
<?php
		}
	}
}
?>
	</div>
	<div style="width:66%;margin:5px;float:left;">
<?php
$k=0;
for($j=0;$j<count($arrayRSS);$j++){
	if($arrayRSS[$j]['CAT']!=2){
		$rss = fetch_rss($arrayRSS[$j]['LIEN']);
		$flux=$rss->items;
		$k++;
		$n=rand(0,count($arrayCOLORS));
		$color=$arrayCOLORS[$n];
	?>	
			<div class="journal">
	<?php	
				include('inc/dynaRSS.php');
	?>
			</div>
	<?php
		if($k%2==0){
	?>		
			<div style="width:100%;height:10px;clear:both;"></div>
	<?php		
		}
	}
}
?>
	</div>

	<div style="width:32%;margin:5px;float:left;">		

		
	</div>
<iframe allowtransparency="true" name="programme tv" src="http://www.zap-programme.fr/webmaster/tools.php?alt1=e5dfec&alt2=f2eff6&bg=037db0&color=133fd0&colorh=d10202&b=2" width="700" height="1435" frameborder=0 scrolling=auto><a href="http://www.zap-programme.fr/" title="programme tv">programme tv</a>|<a href="http://www.zap-programme.fr/programme-tv/tnt/" title="programme tv tnt">programme tv tnt</a></iframe>	
</div>	
<script type="text/javascript">
$(document).ready(function () {
	$('#meteo').weatherfeed(['FRXX0076'],{
		unit: 'c',
		image: true,
		country: false,
		highlow: true,
		wind: true,
		humidity: true,
		visibility: true,
		sunrise: true,
		sunset: true,
		forecast: true,
		link: false
	});
});
</script> 
<script src="js/jquery.zweatherfeed.js" type="text/javascript"></script>