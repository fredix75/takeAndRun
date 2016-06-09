<?php
include ("class/Video.class.php");
include ("class/User.class.php");

//Formulaires
require_once('class/form/Button.class.php');
require_once('class/form/InputAction.class.php');
require_once('class/form/InputDate.class.php');
require_once('class/form/RadioAction.class.php');
require_once('class/form/SelectAction.class.php');
require_once('class/form/CheckboxAction.class.php');
require_once('class/form/TextArea.class.php');
ob_start();
session_start();

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

//Tableau des Catégories
$arrayCategorie=array();
$arrayCategorie["autre"]=-1;
$arrayCategorie["Animation"]=1;
$arrayCategorie["Musique"]=2;
$arrayCategorie["Etrange"]=3;
$arrayCategorie["Parodie"]=4;
$arrayCategorie["Interview"]=5;
$arrayCategorie["Tv"]=6;
$arrayCategorie["Documentaire"]=7;
$arrayCategorie["Cinéma"]=8;

//Tableau des Genres
$arrayGenre=array();
$arrayGenre["autre"]=-1;
$arrayGenre["Jazz/Blues"]=1;
$arrayGenre["Rock n'Roll"]=2;
$arrayGenre["Rock/Pop"]=3;
$arrayGenre["Soul/Funk"]=4;
$arrayGenre["Reggae/Ragga/Dub"]=5;
$arrayGenre["Chanson"]=6;
$arrayGenre["Punk/Alternatif"]=7;
$arrayGenre["Hard-Rock"]=8;
$arrayGenre["Blues Rock"]=9;
$arrayGenre["Electro/DJs"]=10;
$arrayGenre["World"]=11;
$arrayGenre["Roots/Folk Rock"]=12;
$arrayGenre["Rock progressif/psyché"]=13;
$arrayGenre["Variétés / Pop"]=14;
$arrayGenre["Trip-Hop"]=15;
$arrayGenre["Afrobeat"]=16;

//Tableau des Humeurs
$arrayHumeur=array();
$arrayHumeur["autre"]=0;
$arrayHumeur["rythmé joyeux"]=1;
$arrayHumeur["rythmé enervé"]=2;
$arrayHumeur["sensuel sexy"]=3;
$arrayHumeur["langoureux"]=4;
$arrayHumeur["mélancolique"]=5;
$arrayHumeur["fonsdé psychédélique"]=6;
$arrayHumeur["marrant"]=7;
$arrayHumeur["surprenant"]=8;
	
$link=$_GET['link'];

$video=new Video();
$gestion=new User();
	
	if($link=='deconnect'){
		session_destroy();
		header("Location:index.page.php");	
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Take & Run</title>
		<link rel="icon" type="image/png" href="IMAGES/fav.gif" />
		<link href="css/styl.css" rel="stylesheet" type="text/css" media="screen,print" />
		<link href="css/theme_flech.css" rel="stylesheet" type="text/css" media="screen,print" />
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>  
		<script src="js/util.js" type="text/javascript"></script>
	</head>
	<body style="background-image:none;background-color:black;">
	<?php

	switch($link){
		case 'videoFrame':
			include("inc/videoFrame.page.php");
			break;
	}
?>
	</body>
</html>
<?php
ob_end_flush();
?>