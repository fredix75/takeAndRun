<?php

$rubriques=array();
$rubriques[0]['libel']="<img src='IMAGES/nav/tent.png' height=25px title='back home' />";
$rubriques[0]['lien']="index.page.php";

$rubriques[1]['libel']="<img src='IMAGES/nav/publish.png' height=25px title='ajouter une vidéo' />";
$rubriques[1]['lien']="#";

$rubriques[2]['libel']="<img src='IMAGES/nav/loupe.png' height=25px title='chercher une vidéo'/>";
$rubriques[2]['lien']="#";

$rubriques[3]['libel']="<img src='IMAGES/nav/movie.png' height=25px title='vidéos'/>";
$rubriques[3]['lien']="index.page.php?link=movies";

$rubriques[4]['libel']="<img src='IMAGES/nav/mail.png' height=25px title='envoyer un message au taulier'/>";
$rubriques[4]['lien']="#";

$rubriques[5]['libel']="<img src='IMAGES/nav/games.png' height=25px title='jeux'/>";
$rubriques[5]['lien']="index.page.php?link=game";

$rubriques[6]['libel']="<img src='IMAGES/nav/chat.png' height=25px title='chatter'/>";
$rubriques[6]['lien']="index.page.php?link=chat";

$rubriques[7]['libel']="<img src='IMAGES/nav/report.png' height=25px title='gérer la base'/>";
$rubriques[7]['lien']="index.page.php?link=gestion";

$rubriques[8]['libel']="<img src='IMAGES/nav/dossier.png' height=25px title='dossiers'/>";
$rubriques[8]['lien']="index.page.php?link=dossier";

$rubriques[9]['libel']="<img src='IMAGES/nav/news.png' height=25px title='flux d actualité'/>";
$rubriques[9]['lien']="index.page.php?link=news";

$rubriques[10]['libel']="<img src='IMAGES/nav/tv.png' height=25px title='channels'/>";
$rubriques[10]['lien']="index.page.php?link=channels";

$rubriques[11]['libel']="<img src='IMAGES/nav/map.png' height=25px title='carte'/>";
$rubriques[11]['lien']="index.page.php?link=map";

$rubriques[12]['libel']="<img src='IMAGES/nav/biology.png' height=25px title='test'/>";
$rubriques[12]['lien']="index.page.php?link=test";

$rubriques[13]['libel']="<img src='IMAGES/nav/peinture.png' height=25px title='choix du thème'/>";
$rubriques[13]['lien']="#";

$rubriques[14]['libel']="<img src='IMAGES/nav/shield.png' height=25px title='frise historique'/>";
$rubriques[14]['lien']="index.page.php?link=frise";

$rubriques[15]['libel']="<img src='IMAGES/nav/disconnect.png' height=25px title='se déconnecter'/>";
$rubriques[15]['lien']="index.page.php?link=deconnexion";
?>


<div id="nav">
	<ul class="nav">
		
<?php
	if($_SESSION['login']){
	for($i=0; $i<=count($rubriques);$i++){
		if($i==1 && $_SESSION['group_user']==1){
?>
			<li><a href="<?php echo $rubriques[$i]['lien']; ?>" onclick="affiche('inserer');return false;"><?php echo $rubriques[$i]['libel']; ?></a></li>
<?php			
		}elseif($i==2){
?>
			<li><a href="<?php echo $rubriques[$i]['lien']; ?>" onclick="affiche('chercher');return false;" ><?php echo $rubriques[$i]['libel']; ?></a></li>
<?php						
		}elseif($i==4){
?>			
			<li><a href="<?php echo $rubriques[$i]['lien']; ?>" onClick="affiche('mailer');return false;"><?php echo $rubriques[$i]['libel']; ?></a></li>
<?php			
		}elseif($i==13){
?>			
			<li><a href="<?php echo $rubriques[$i]['lien']; ?>" onclick="affiche('settings');return false;"><?php echo $rubriques[$i]['libel']; ?></a></li>			
<?php
		}else{
			if($i!=7 && $i!=12 && $i!=14 || (($i==7 || $i==12 || $i==14) && $_SESSION['group_user']==1)){
?>
			<li><a href="<?php echo $rubriques[$i]['lien']; ?>"><?php echo $rubriques[$i]['libel']; ?></a></li>
<?php					
			}
		}
	}
	}else{
?>
	<li style="color:orange;"><a href="#"><img id="fav" src="IMAGES/fav.gif" height="25px" /></a>&nbsp;Connectez vous pour accéder à ce merveilleux Site</li>
<?php		 
	}
?>				
	</ul>
</div>

<div id="date"></div>
<?php
$tabl_variabError; 
$actif=1;

$anneeMax=date('Y');
$arrayAnnees=array();
$arrayAnnees[' ']=-1;
for($i=$anneeMax;$i>1926;$i--){
	$arrayAnnees[$i]=$i;
}

$array123=array(1,2,3);

$arrayPriorite=array(''=>-1,1=>1,2=>2,3=>3,4=>4);

$arrayPeriode=array();
$arrayPeriode[' ']=-1;
$arrayPeriode['2001-2015']='2001-2015';
$arrayPeriode['1986-2000']='1986-2000';
$arrayPeriode['1971-1985']='1971-1985';
$arrayPeriode['1956-1970']='1956-1970';
$arrayPeriode['1940-1955']='1940-1955';
$arrayPeriode['<1939']='<1939';
?>
<form id="formulaire_nav" name="formulaire_nav" role="search" method='POST' action='index.page.php'>
	<div id="chercher" class="saisieVideo">
	<?php
		include('inc/chercher.page.php');
	?>
	<br/>
	</div>
	<div id="mailer" class="saisieVideo">
	<?php
		include('inc/mailer.page.php');
	?>
	</div>
	<div id="inserer" class="saisieVideo">
		<br/>
		<?php
			$choix=($_GET['erreur'])?1:"";
			$radioCHOIXINSER=new RadioAction("CHOIX_INSER",$array123,$choix,$actif,$tabl_variabError,"local/afficheCache");
			$radioCHOIXINSER->setRadio(0,"Vidéo","affiche('inser_video');cache('inser_lien');cache('inser_rss');cache('inser_game');",1);
			if($choix==1){
			?>
				<script type="text/javascript">
					$(function(){
						$('#inser_video').show();
					});
				</script>
			<?php	
			}else{
			?>
				<script type="text/javascript">
					$(function(){
						$('#inser_video').hide();
					});
				</script>
			<?php				
			}
		?>
		<img src="IMAGES/nav/video.png" width="30px" height="30px" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<?php		
			$radioCHOIXINSER->setRadio(1,"Lien","cache('inser_video');affiche('inser_lien');cache('inser_rss');cache('inser_game');",2);
		?>
		<img src="IMAGES/nav/lien.png" width="30px" height="30px" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
			$radioCHOIXINSER->setRadio(2,"Flux","cache('inser_video');cache('inser_lien');affiche('inser_rss');cache('inser_game');",3);
		?>
		<img src="IMAGES/nav/rss.png" width="30px" height="30px" />
		&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
			$radioCHOIXINSER->setRadio(3,"Jeu","cache('inser_video');cache('inser_lien');cache('inser_rss');affiche('inser_game');",4);
		?>
		<img src="IMAGES/nav/games.png" width="30px" height="30px" />	
		<div id="inser_video">
			<?php include('inc/insererVideo.page.php'); ?>
		</div>
		
		<div id="inser_lien" style="display:none;">
			<?php include('inc/link.page.php'); ?>
		</div>
		
		<div id="inser_rss" style="display:none;">
			<?php include('inc/insererFlux.page.php'); ?>	
		</div>			
		
		<div id="inser_game" style="display:none;">
			<?php include('inc/insererGame.page.php'); ?>	
		</div>			
		<br/>
	</div>
	<div id="settings" class="saisieVideo">
	<?php
		include('inc/settings.page.php');
	?>
	</div>
</form>