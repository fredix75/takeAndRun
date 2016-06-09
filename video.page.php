<div id="content">
<?php
$id=$_GET['id'];
// Vidéo principale
$videoV=$video->getVideo($id);

$auteur=$videoV['VIDEO_AUTEUR'];
$titre=$videoV['VIDEO_TITRE'];
$annee=$videoV['VIDEO_ANNEE'];
$categorie=$videoV['VIDEO_CATEGORIE'];
$genre=($videoV['VIDEO_GENRE']!=-1)?$videoV['VIDEO_GENRE']:null;
$lien=$videoV['VIDEO_LIEN'];
$chapo=$videoV['VIDEO_CHAPO'];
$texte=$videoV['VIDEO_TEXTE'];

//Vidéos de références
$videoR=$video->getRef($id,$auteur,$titre,$annee);

// Proposition de Vidéos
$videoC=$video->getVideoByCateg($categorie,'',$id,1,$genre);

// variables d'ajustement entre "Ecran géant" et "Pop-Up"
if($link=="video"){
	$idDiv="ecrangeant";
	$style="margin:20px 10%;";
	$largeur="80%";
	$hauteur="500";
	$nbVideoC=7;
	$classVideoC="autre";
	$linkV="index.page.php?link=video&id=";
}else{
	$largeur="100%";
	$hauteur="650";
	$nbVideoC=5;
	$classVideoC="autre_pu";
	$onclick="window.opener.location='http://nfactory.comlu.com/index.page.php?link=accueil&chercher=".$auteur."';return false;";
	$linkV="popUp.php?link=videoFrame&id=";
}
echo "<p style='font-size:200%;color:white;'>".$id."</p>";
?>
<div id="<?php echo $idDiv; ?>">
<?php 
	
	echo $video->getAffichage($lien,$largeur,$hauteur,$style); 
?>
	<br/>
	<div id="titraille">
			<?php echo $gestion->getCategorie($categorie,0,$genre); ?>
			<div style="width:100%">&nbsp;</div>
			<h1 style="margin-left:25px;"><?php echo $titre; ?></h1>
			<a href="index.page.php?link=accueil&chercher=<?php echo $auteur; ?>" onclick="<?php echo $onclick; ?>"><h2><?php echo $auteur; ?></h2></a>
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
			<div id="texte" style="width:<?php echo ($videoR)?"75%":"100%"; ?>;">
				<?php echo $texte; ?>			
			</div>
<?php
				if($videoR){
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
			for($i=0;$i<count($videoR);$i++){
?>
				<a href="<?php echo $linkV.$videoR[$i]['ID']; ?>">
				<div class="video_ref" 	style="width:<?php echo ($texte)?"120":"250"?>px;">
<?php				echo "<span>".$videoR[$i]['AUTEUR']." - ".$videoR[$i]['TITRE']."</span><br/>";
					echo $video->getImgVideo($videoR[$i]['LIEN'],$tailleRef[0],$tailleRef[1]); 
?>				</div>
				</a>
<?php
				if(!$texte && ($i+1)%3==0){
?>
					</div><div>
<?php					
				}								
			}
			if($videoR){
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
	
	<div id="modifier" class="saisieVideo" >
		<form action="index.page.php" method="POST" >
		<?php include('inc/insererVideo.page.php'); ?>
		</form>
	</div>
	
	<div id="cadre_milieu">
		<strong>Voir aussi</strong>
	</div>
	
	<div id="bandeAutre">
<?php
	for($i=0;$i<$nbVideoC;$i++){
?>
		<a href="<?php echo $linkV.$videoC[$i]['ID']; ?>">
		<div class="<?php echo $classVideoC; ?>">
			<div class="autre_video">
<?php
				echo $video->getImgVideo($videoC[$i]['LIEN'],'100%','100');	
?>
			</div>
			<div class="autre_com">
<?php
				echo "<h3>".$videoC[$i]['TITRE']."</h3>";
				echo $videoC[$i]['AUTEUR'];
?>
			</div>
		</div>
		</a>
<?php
	}
?>	
	</div>
	<?php 
		$par="http://www.youtube.com/embed/";
		$par2="//www.youtube.com/embed/";
		if(mb_substr($lien, 0, strlen($par))==$par){
			$vid=substr($lien,strlen($par));
		}elseif(mb_substr($lien, 0, strlen($par2))==$par2){
			$vid=substr($lien,strlen($par2));
		}
 ?>
	<content type='application/atom+xml' src='https://gdata.youtube.com/feeds/api/videos/<?php echo $vid; ?>?v=2'/>
</div>
