<?php
//c'est la page "controleur" 
ob_start();
include("class/User.class.php");
//session_name('optiscreen');
//Je recupere le nom de mon dossier courant=> j'appellerai ma session come ça.
$myDirectory = substr(dirname($_SERVER['REQUEST_URI']),1);
session_name($myDirectory);

session_start();
//script de déconnexion.
$link=@$_GET['link'];
//$form=@$_GET['form'];
if($link=="deconnexion"){
	session_destroy();
	header("Location: index.php");
	exit();
}

$myUser=new User();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $myDirectory ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="jquery.autocomplete.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
<link rel="shortcut icon"  href="images/favicon.ico" />
<script src="../FC/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
		<?php
		if($_GET["link"]=="test"){
			$id="PATIENTPERSO_NATIONALITE";
			$file="AutoCompNat"; ?>
	    	<script>
	     	$(document).ready(function(){
				$("#<?php echo $id;?>").autocomplete("<?php echo $file?>.php", {
			    	selectFirst: true
			  });
			 });
			</script>
<?php
		}
?>			
</head>
<body>
<div id="bandeau">
	<div align="center">
		<table border="0" width="100%">
		    <tr>
				<td width="33%"><div align="left"></div></td>
				<td width="33%"><div align="center"><font size=300% color=white>GENOTYP</font></div></td>
				<td width="33%"><div align="right"></div></td>
			</tr>
  		</table>
	</div>
</div>
<div id="conteneur">
  <div id="menu"> 
<?php
//include_once ("class/Investig.class.php");

//utilisateur= admin
if(isset($_SESSION['group_user'])){
	// attribution d'un domaine par utilisateur
	$etude=$myUser->getEtude($_SESSION['login']);
	$_SESSION['etude']=$etude[0]['ETUDE'];
	
	if($_SESSION['group_user']==0){
		include("../".$myDirectory."/User/Admin/menu_Admin.html.php");
	}else if($_SESSION['group_user']==1){//
		include("../".$myDirectory."/User/Medecin/menu_Med.html.php");
	}else if($_SESSION['group_user']==2){// 
		include("../".$myDirectory."/User/Geneticien/menu_Gen.html.php");
	}
}else{
	include("Public/menuPublic.html.php");
}

if(isset($_GET["debug"])){
	echo "session name=".session_name();
	echo "<br/>group_user=".$_SESSION['group_user'];
	echo "<br/>login=".$_SESSION['login'];
	echo "<br/>centre=".$_SESSION['centre'];
	echo "<br/>etude=".$_SESSION['etude'];
}

?>
  </div>

<div id="contenu">

<?php
//affiche un message
	if(isset($_GET["msg"])){
?>
<script type="text/javascript">
	$(function(){
		//Durée visible
    	$('#msg').fadeIn(1500);
		//Durée pour cacher
	    $('#msg').fadeOut(2500);
    });
</script>	
<?php
	}
?>
		<br />
        <!--div align="center"><strong><font color="#FF0000">Pour des raisons de maintenance, le site sera momentanément indisponible <br />
        du 30/03/2012 18:00 au Lundi 02/03/2012 09:00<br />
        Veuillez nous excuser pour la gêne occasionnée</font></strong>.<br />
		<br /></div-->

<div align="center" id="msg" ><strong>
<?php
	switch($_GET["msg"]){
		case "successDBI":?>
			Les données ont été prises en compte.
<?php	break;
		case "successConnect":?>	
			Identification réussie.
<?php	break;
		case "successMSG":?>	
			La requ&ecirc;te a &eacute;t&eacute; envoy&eacute;e avec succes.
<?php	break;
		case "saved":?>
			La sauvegarde a &eacute;t&eacute; effectu&eacute;e.
<?php	break;
		case "chngmdp":?>
			VOUS ALLEZ CHANGER DE MOT DE PASSE.
<?php	break;
		case "successChngMdp":
?>
		Le mot de passe a été changé avec succès
<?php		
		break;
	}
?>	

</strong></div>

<?php

	$pages_autoriseesMed = array(
		'accueil' => 'accueil.php',
		'accueilMed' => 'User/Medecin/accueilMed.html.php',
		'choixPatient'=>'User/ChoixPatient.page.php',
		'changemdp'=>'../FC/connection/changemdp.page.php',
		'contact' => 'Public/indispo.html',
		''=>'User/Medecin/accueilMed.html.php'
	);
		
	$pages_autoriseesGen = array(
		'accueil' => 'accueil.php',
		'accueilGen' => 'User/Geneticien/accueilGen.html.php',
		'HLADR'=>'User/Geneticien/HLADR.page.php',
		'IL28B'=>'User/Geneticien/IL28B.page.php',
		'VITAD'=>'User/Geneticien/VITAD.page.php',			
		'choixPatient'=>'User/ChoixPatient.page.php',
		'changemdp'=>'../FC/connection/changemdp.page.php',
		'contact' => 'Public/indispo.html',	
		
		// partie test
		'test'=>'User/test.page.php',	
		
		''=>'User/Geneticien/accueilGen.html.php'
	);	
		

	$pages_autoriseesAdminSpec=array(
		'listeMed' => 'User/Admin/listeMed.page.php',
		'activation' => 'User/Admin/activation.page.php'
	);

	$pages_autoriseesAdmin = $pages_autoriseesMed+$pages_autoriseesAdminSpec;
	
	//print_r($pages_autoriseesMed);
	//si on est connecté=>
	

	
	if(isset($_SESSION['group_user'])){
			switch($_SESSION['group_user']){
				case 0://admin
					$pages_autorisees = $pages_autoriseesAdmin;
					break;
				case 1:
					$pages_autorisees = $pages_autoriseesMed;
					break;
				case 2:	
					$pages_autorisees = $pages_autoriseesGen;
					break;	
			}

		
	}else{//pour les nons connectés
		$pages_autorisees = array(
			'accueil' => 'accueil.php', 
			'identification' => '../FC/connection/connect.page.php',
			'question' => '../FC/connection/question.page.php',
			'Merci' => 'Public/merci.html',
			'loginQuestion' => '../FC/connection/loginQuestion.page.php',
			'changemdp'=>'../FC/connection/changemdp.page.php',
			'contact' => 'Public/contact.html',
			'inscription' => 'Public/inscription.page.php',
			'Merci' => 'Public/Merci.htm.php',
			'Resume' => 'Public/resume.html',
			'' => '../FC/connection/connect.page.php');
	}
	
	if (isset($pages_autorisees[$link])){
		//echo "<br/>test link=".$pages_autorisees[$link];
		include($pages_autorisees[$link]);
	}else{
		//include('vide.php'); n'arrive jamais
		include("autorisation.html");
	}
?>      		 
</div>
</div>

<div id="piedpage">
  <div align="center">
  <table border="0" width="100%">
  	<tr>
  	  <td align="left" width="33%"><img src="../FC/images/logo_inserm.png"></td>
      <td align="center" width="33%">
		<font size="1">
		<strong>Inserm UMR-S 707 <br /> Epidemiologie, Syst&egrave;mes d'information, Mod&eacute;lisation</strong>
		<br /> Facult&eacute; de M&eacute;decine Pierre et Marie Curie
		<br /> Site Saint-Antoine
		<br /> 27, rue Chaligny - 75571 Paris Cedex 12
		</font>
	  </td>
	  <td align="right" width="33%">
	  <font size="1">Site optimisé pour les navigateurs :<br /> - Mozilla Firefox 3.5<br /> - Internet Explorer 8</font></td>
    </tr>
  </table>
  </div>      
</div>
</body>
</html>

<?php
ob_end_flush();
?>