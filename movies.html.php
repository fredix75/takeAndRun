<div id="content" style="background-color:rgba(0,0,0,0.3);">
	<form action="index.page.php?link=movies&mode=<?php echo ($mode=='moz')?'moz':'couch';?>" method="POST">
	<ul class="sous-menu">
		<li><a href="index.page.php?link=movies&mode=<?php echo ($mode=='moz')?'moz':'couch';?>&tri=random">aléatoire</a></li>
		<li><a href="index.page.php?link=movies&mode=<?php echo ($mode=='moz')?'moz':'couch';?>&tri=id">par date d'insertion</a></li>
		<li><a href="#" onClick="affiche('spanPeriode');cache('spanCateg');return false;">par période</a><span id="spanPeriode" style="display:none;">&nbsp;<?php
			$selectPERIODE=new SelectAction("periode",$arrayPeriode,null,1,$tabl_variabError);
			$selectPERIODE->setSelect();
			$btOK=new Button("submit","ok_periode","OK",1);
			$btOK->setButton();			
		?></span></li>
		<li><a href="#" onClick="cache('spanPeriode');affiche('spanCateg');return false;">par Catégorie</a><span id="spanCateg" style="display:none;">&nbsp;<?php
			$selectCATEGORIE=new SelectAction("categorie",$arrayCategorie,null,1,$tabl_variabError);
			$selectCATEGORIE->setSelect("afficheCacheSelect('categorie','2','spanGenre','spanGenre');");
			?>
				<span id="spanGenre" style="display:none">&nbsp;<?php
					$selectGENRE=new SelectAction("SelGenre",$arrayGenre,null,1,$tabl_variabError);
					$selectGENRE->setSelect();
				?></span><?php
			$btOK=new Button("submit","ok_categ","OK",1);
			$btOK->setButton();			
		?></span></li>
		<li><a href="index.page.php?link=movies&mode=<?php echo ($mode=='moz')?'couch':'moz';?>&tri=rand"><?php echo ($mode=='moz')?'canap':'mosaïque';?></a></li>
	</ul>
	</form>
<?php	
	if($mode=="couch"){
		$liste=$video->formatPlayList($arrayMOVIES);
?>
	<div style="width:100%;background-color:black;">
    	<div id="player" style="width:60%;height:450px;margin:30px 20%;"></div>
	</div>
			<div style="width:100%;clear:both;"><?php
					include("inc/index.inc");
			?></div>
	<script type="text/javascript">
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '100%',
          width: '100%',
          videoId: 'M7lc1UVf-VE',
          playerVars: { 'autoplay': 0, 'controls': 1, 'autohide':1,'iv_load_policy':3},
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        //event.target.playVideo();
      	player.loadPlaylist(<?php echo $liste; ?>); 
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          //setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
	</script>		
<?php		
	}else{
	
		if($compte){  // affiche le nombre de résultats en cas d'une recherche
	?>
			&nbsp;&nbsp;<span style="float:left;color:red;font-weight:bold;"><?php echo $compte; ?> résultat<?php echo(is_numeric($compte) && $compte!=1)?"s":"";?></span> pour cette recherche.<br/>
	<?php
		}
		for($i=0;$i<count($arrayMOVIES); $i++){
			if($i!=0 && $i%4==0){
	?>
				<div style="width:100%;clear:both;"><?php
					if($i%12==0){
						include("inc/index.inc");
					}
				?></div>
	<?php			
			}
?>		
			<div class="multitude" style="width:200px;float:left;margin:25px;">
<?php
					echo $gestion->getCategorie($arrayMOVIES[$i]['CATEGORIE'],$ok,$arrayMOVIES[$i]['PERIODE'],($arrayMOVIES[$i]['GENRE']!=-1)?$arrayMOVIES[$i]['GENRE']:0);
?>
				<a class="lienvideo" href="<?php echo $video->formatLink($arrayMOVIES[$i]['LIEN']);?>">
					<?php echo $video->getImgVideo($arrayMOVIES[$i]['LIEN'],'100%','130'); ?>
					<div class="sousCom13"  style="height:50px;">						
						<h2><?php echo $myUtil->formatAccents($arrayMOVIES[$i]['TITRE']);?></h2>
						<span class="auteur"><?php echo $myUtil->formatAccents($arrayMOVIES[$i]['AUTEUR']);?></span>&nbsp;
						<small style="color:white;"><strong><?php echo ($arrayMOVIES[$i]['ANNEE']!=-1)?$arrayMOVIES[$i]['ANNEE']:"<br/>";?></strong></small>
						<p><?php echo $arrayMOVIES[$i]['ID'];?></p>					
					</div>
</a>				
				<a href="index.page.php?link=video&id=<?php echo $arrayMOVIES[$i]['ID']; ?>"><div class="sousCom2"><?php echo ($arrayMOVIES[$i]['TEXTE']!="")?"+ + +":"&nbsp;";?></div></a>												
			</div>
<?php 
		}
?>	
			<div style="width:100%;clear:both;"><?php
					include("inc/index.inc");
			?></div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.lienvideo').magnificPopup({
		  type: 'iframe',
		  iframe: {
		    patterns: {
		      dailymotion: {
		        index: 'dailymotion.com',
		        id: function(url) {        
		            var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);
		            if (m !== null) {
		                if(m[4] !== undefined) {
		                    return m[4];
		                }
		                return m[2];
		            }
		            return null;
		        },
		        src: 'http://www.dailymotion.com/embed/video/%id%'		        
		      },
		     youtube: {
			      index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
			      id: 'v=', // String that splits URL in a two parts, second part should be %id%
			      // Or null - full URL will be returned
			      // Or a function that should return %id%, for example:
			      // id: function(url) { return 'parsed id'; } 	
			      src: '//www.youtube.com/embed/%id%?autoplay=1&iv_load_policy=3' // URL that will be set as a source for iframe. 
			  }
		    }
		  }
		});
	});
</script>
<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
<?php
}
?>
</div>