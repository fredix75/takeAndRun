<?php			
	if($_POST["refresh"]){
		include_once("class/Video.class.php");
		include_once("class/User.class.php");
		$video = new Video();
		$gestion=new User();
		$myUtil=new Util();
		$videoV=$video->getVideo(); 
	}
?>
		<div class="col_contenu">
			<div class="ecran1">
				<?php
					echo $gestion->getCategorie($videoV[0]['CATEGORIE'],0,$videoV[0]['PERIODE'],($videoV[0]['GENRE']!=-1)?$videoV[0]['GENRE']:0);
					echo $video->getAffichage($videoV[0]['LIEN'],'100%','350','','1');
				?>
				<a href="index.page.php?link=video&id=<?php echo $videoV[0]['ID']; ?>">
				<div class="com1">
					<h1><?php echo $myUtil->formatAccents($videoV[0]['TITRE']); ?></h1>
					<h3><?php echo $myUtil->formatAccents($videoV[0]['AUTEUR']);?><?php echo ($videoV[0]['ANNEE']!=-1)?" - ".$videoV[0]['ANNEE']:"<br/>";?></h3>
					<p><?php echo $myUtil->formatAccents($videoV[0]['CHAPO']);?></p>
				</div></a>
			</div>
			<br/>
		</div>
		
		<?php
			include("inc/index.inc");
		?>
				
		<div class="col_contenu">
<?php
	for($i=1;$i<count($videoV); $i++){
		if($i==6)$i++;
?>		
			<div class="bando">
<?php
					echo $gestion->getCategorie($videoV[$i]['CATEGORIE'],$ok,$videoV[$i]['PERIODE'],($videoV[$i]['GENRE']!=-1)?$videoV[$i]['GENRE']:0);
?>
				<div style="width:100%">&nbsp;</div>
				<a title="wcx" class="lienvideo" href="<?php echo $video->formatLink($videoV[$i]['LIEN']);?>">
					<?php echo $video->getImgVideo($videoV[$i]['LIEN'],'33%','140'); ?>
				</a>
				<div class="com2">
					<a class="lienvideo" href="<?php echo $video->formatLink($videoV[$i]['LIEN']);?>">
					<div class="sousCom1">						
						<h2><?php echo $myUtil->formatAccents($videoV[$i]['TITRE']);?></h2>
						<span class="auteur"><?php echo $myUtil->formatAccents($videoV[$i]['AUTEUR']);?></span>&nbsp;
						<small style="color:grey;"><strong><?php echo ($videoV[$i]['ANNEE']!=-1)?$videoV[$i]['ANNEE']:"<br/>";?></strong></small>
						<p><?php echo $myUtil->formatAccents($videoV[$i]['CHAPO']);?></p>						
					</div>
					</a>
					<a href="index.page.php?link=video&id=<?php echo $videoV[$i]['ID']; ?>"><div class="sousCom2"><?php echo ($videoV[$i]['TEXTE']!="")?"+ + +":"&nbsp;";?></div></a>
				</div>
				</a>				
			</div>
<?php 
	}
?>	
			<br/><br/><br/>
		</div>
<?php
			include("inc/index.inc");
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.lienvideo').click(function (){
			if($('#player1').length>0){
				var  ytplayer = document.getElementById("player1");
				if(ytplayer.getPlayerState()=='1'){
					ytplayer.pauseVideo();
				}
			}	
		});
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
<script type="text/javascript" src="js/swfobject.js"></script>