<?php
if($id){
	$gameV=$game->getGame($id);
	$id=$gameV[0]['ID'];
	$auteur=$gameV[0]['AUTEUR'];
	$titre=$gameV[0]['TITRE'];
	$annee=$gameV[0]['ANNEE'];
	$categorie=$gameV[0]['CATEGORIE'];
	$lien=$gameV[0]['LIEN'];
	$chapo=$gameV[0]['CHAPO'];
	$texte=$gameV[0]['TEXTE'];
}else{
	$gameD=$game->getGame();	
}

//Jeux de références
//$gameR=$game->getRef($id,$auteur,$titre,$annee);

// Proposition de Jeux
//$gameC=$game->getGameByCateg($categorie,'',$id,1,$genre);

?>
<div id="content">
<?php
	if($id){
?>
	<br/>
	<div id="ecrangeant">
		<?php echo $game->getAffichage($lien,'80%','500',"margin:20px 10%;"); ?>
		<br/>
		<div id="titraille">
			<?php echo $game->getCategorie($categorie,0,$genre); ?>
			<div style="width:100%">&nbsp;</div>
			<h1 style="margin-left:25px;"><?php echo $titre; ?></h1>
			<a href="index.page.php?link=accueil&chercher=<?php echo $auteur; ?>"><h2><?php echo $auteur; ?></h2></a>
<?php	if($annee!=-1){ ?>
			<p style="margin:-10px 0px 0px <?php echo 11*(strlen($auteur)); ?>px;color:#333333;font-size:300%;"><?php echo $annee; ?></p>
<?php	} ?>		
		</div>
		
		<div id="chapo">
			<?php echo $chapo; ?>
		</div>
		
		<div id="contenu">
<?php
			// Placement de la Bande des Vidéos de Références proches selon qu'il existe un texte ou non 
			if($texte){
?>
			<div id="texte" style="width:<?php echo ($gameR)?"75%":"100%"; ?>;">
				<?php echo $texte; ?>			
			</div>
<?php
				if($gameR){
?>			
			<div id="references" style="float:left;position:relative;">
<?php
					$tailleRef=array("100%","100");
				}			
			}else{
?>	
			<div id="references2">
<?php
				$tailleRef=array("220px","150px");
			} 
			for($i=0;$i<count($gameR);$i++){
?>
				<a href="index.page.php?link=Game&id=<?php echo $gameR[$i]['ID']; ?>">
				<div class="Game_ref" 	style="width:<?php echo ($texte)?"120":"250"?>px;">
<?php				echo "<span>".$gameR[$i]['AUTEUR']." - ".$gameR[$i]['TITRE']."</span><br/>";
					echo $game->getAffichage($gameR[$i]['LIEN'],$tailleRef[0],$tailleRef[1]); 
?>				</div>
				</a>
<?php
				if(!$texte && ($i+1)%3==0){
?>
					</div><div>
<?php					
				}								
			}
			if($gameR){
?>				
			</div>
<?php		}
?>
		</div>	
		
		<div class="icones">
<?php		
	if($_SESSION['group_user']==1){
?>
			<a href="#"><img src="IMAGES/buttons/modif.png" width="20px" onclick="affiche('modifier');return false;"/></a>&nbsp;
			<a href="index.page.php?id=<?php echo $id;?>&delete=delete" onClick="return confirm('Etes vous sûr de vouloir virer cette vidéo pourtant intéresante ??');"><img src="IMAGES/buttons/supprimer.png" width="20px"/></a>
<?php	
	}
?>
		</div>
	</div>
	
	<div id="modifier" class="saisieGame" >
		<?php //include('inc/insererGame.page.php'); ?>
	</div>
	
	<div id="cadre_milieu">
		<strong>Voir aussi</strong>
	</div>
	
	<div id="bandeAutre">
<?php
		for($i=0;$i<count($gameC);$i++){
?>
		<a href="index.page.php?link=Game&id=<?php echo $gameC[$i]['ID']; ?>">
		<div class="autre">
			<div class="autre_Game">
<?php
				echo $game->getAffichage($gameC[$i]['LIEN'],'100%','100');	
?>
			</div>
			<div class="autre_com">
<?php
				echo "<h3>".$gameC[$i]['TITRE']."</h3>";
				echo $gameC[$i]['AUTEUR'];
?>
			</div>
		</div>
		</a>
<?php
		}
?>	
	</div>
	<div id="cadre_bas">
	</div>
<?php
	}else{			// sommaire des Jeux
?>
	<div id="listejeux">
		<ul>
<?php
	for($i=0;$i<count($gameD);$i++){
?>		
			<li><a href="index.page.php?link=game&id=<?php echo $gameD[$i]['ID']; ?>"><?php echo $gameD[$i]['TITRE']?></a></li>
<?php		
	}
?>		
		</ul>
	</div>
<?php
}
?>
</div>	
