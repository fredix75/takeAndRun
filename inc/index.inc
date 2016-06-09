		<div class="video_index" align="center" style="clear:both;">
<?php 
		if($_GET['tri']=='id' || $_GET['categorie'] || $_GET['genre'] || $_GET['periode']){
			if ($taille>1)	$gestion->getIndex($idTab,$taille,"movies","&mode=".(($mode=='moz')?'moz':'couch')); 
		}elseif($_GET['chercher']){
			$taille=count($arrayTabRecap2);
			if ($taille>1)	$gestion->getIndex($idTab,$taille,"movies","&mode=".(($mode=='moz')?'moz':'couch'));
		}else{
			if($link=="movies" && $mode!="couch"){
?>			
				<a href="index.page.php?link=movies&mode=moz&tri=random" class="index_next"><img src="IMAGES/shootagain.jpg"  title="Autre page"/></a>		
<?php					
			}elseif($mode=="couch"){
				
			}else{		
?>			
				<a href="#" class="index_next" onclick="refreshVideo();return false;"><img src="IMAGES/shootagain.jpg"  title="Autre page"/></a>		
<?php	
			}
		}
?>		
		</div>	
