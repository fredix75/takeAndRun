<?php
	if($_GET['erreur']){ 	 // affiche les erreurs à l'enregistrement
?>
		&nbsp;&nbsp;<span style="color:red;font-weight:bold;">ATTENTION:&nbsp;<?php echo $msg; ?></span>
<?php			
		}
?>
<script type="text/javascript" src="js/ajaxTableau.js"></script>		
<div id="content">
	<div id="col01">
<?php
		include("inc/dynaVideo.html.php");
?>
	</div>
		
	<div id="col02">
		<div class="col_article" style="text-align:justify;">
<?php 

			require('inc/magpierss-0.72/rss_fetch.inc');			

			for($i=0;$i<count($arrayRSS);$i++){
				$rss = fetch_rss($arrayRSS[$i]['LIEN']);
				$arrayFlux[$i]=$rss->items;
			}

			for($i=0;$i<count($arrayFlux);$i++){
				if($arrayRSS[$i]['CAT']==1){
					for($j=0;$j<count($arrayFlux[$i]);$j++){
						$arrayFlux[$i][$j]['image']=$arrayRSS[$i]['IMAGE'];
						$flux2[$arrayFlux[$i][$j]['date_timestamp']]=$arrayFlux[$i][$j];
					}
				}
			}
			krsort($flux2);
			
			$i=0;			
			foreach($flux2 as $time=>$val){
				$flux[$i]=$val;
				$i++;
				if($i==8) break;
			}			
			
?>
			<div style="background-color:#708090;padding:10px 10px;">
				<p><strong><?php echo $dateToday; ?></strong>&nbsp;
				<span id="clock" style="font-size:120%;color:white;margin-right:5px;"></span></p>
				<br/>
				<h1>Quoi de neuf dans la Presse?</h1>
				<br/>
			</div>
<?php
			include('inc/dynaRSS.php');
?>
		</div>
		<div id="colMenu">
<?php 
		include('menu.html.php');
?>
		</div>
		</div>	
		<div id="slid" class="col_contenu">
<?php

		include('inc/slideshow.php');
?>
		</div>
		<br/><br/>
<?php
if($videoV[6]['LIEN']){
?>		
		<div id="ecran_resp" class="ecran1">
			<?php
				echo $gestion->getCategorie($videoV[6]['CATEGORIE'],0,$videoV[6]['PERIODE'],($videoV[6]['GENRE']!=-1)?$videoV[6]['GENRE']:0);
			?><br/><br/>
			<a href="index.page.php?link=video&id=<?php echo $videoV[6]['ID']; ?>">
				<div class="com3">
					<h1><?php echo $videoV[6]['TITRE']; ?></h1>
					<h3><?php echo $videoV[6]['AUTEUR'];?><?php echo ($videoV[6]['ANNEE']!=-1)?" - ".$videoV[6]['ANNEE']:"<br/>";?></h3>
					<p><?php echo $videoV[6]['ID'];?></p>
					<p><?php echo $videoV[6]['CHAPO'];?></p>
				</div>
			</a>
			<?php
				echo $video->getAffichage($videoV[6]['LIEN'],'100%','350');
			?>
		</div>
<?php
}
?>
</div>
<script type="text/javascript">	
$(document).ready( function () {
    setInterval(function(){
    var currentTime = new Date();
    var h = currentTime.getHours();
    var m = currentTime.getMinutes();
    var s = currentTime.getSeconds();	  
    
    var sep=(s%2==0)?":":" ";
    
    if(m<10){m="0"+m}
    if(s<10){s="0"+s}
    
         
    $("#clock").text(h+sep+m);
    },1000);
});
</script>