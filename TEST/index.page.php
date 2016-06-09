<?php
require_once("class/Util.class.php");
require_once('class/User.class.php');
require_once('class/Video.class.php');
require_once('class/Lien.class.php');
require_once('class/Flux.class.php');
require_once('class/Game.class.php');

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

$link=@$_GET['link'];
$theme=($_SESSION['theme'])?$_SESSION['theme']:'flech';

// Paramètres temporels
setlocale(LC_ALL,"fr_FR","french","French_France.1252","fr_FR.ISO8859-1","fra"); 
date_default_timezone_set ( 'Europe/Paris' );
$dateToday=strftime("%a %d %b %Y"); 


// Objets initiaux
$video=new Video();
$myUtil = new Util();
$gestion= new User();
$lien= new Lien();
$fluxRSS= new Flux();
$game=new Game();

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

//Vignette-Titre aléatoire
if($link=="gestion") $arg=1;
if($link!="video"&&$link!="chat"&&$link!="dossier"){
	$vignette=$gestion->getVignette($arg);
}
	//Télé inclinaison aléatoire
	$n=rand(-15,15);


// CHOIX POSSIBLES
if($link=="deconnexion"){					// si Déconnexion
	session_destroy();
	header("Location:index.page.php");	
}elseif($_POST['enrg_video']){					// si Enregistrement ou Update d'une Vidéo POST(insererVideo.page)
	$video->recupereVal();
	$test=$video->testVal();
	if($test==true){
		$verif=$video->setVideo($_POST['VIDEO_ID']);	// vérif d'antériorité (false si OK sinon renvoie l'ID antérieur)
		if($verif==false){
			if($_POST['VIDEO_ID']){
				$id=$_POST['VIDEO_ID'];
				header("Location:index.page.php?link=video&id=$id");			
			}else{
				header("Location:index.page.php?link=movies&mode=moz&tri=id");			
			}
		}else{									// si vérification d'antériorité échoue
			$videoV=$video->getPosted();
			$_GET['erreur']='linkexist';
			include("index.html.php");
		}	
	}else{											// si enregistrement échoue
		$videoV=$video->getPosted();
		$_GET['erreur']='linkvoid';	
		include("index.html.php");
	}	
}elseif($_POST['enrg_lien']){					// si Enregistrement d'un Lien
	$lien->recupereVal();
	$lien->setLink();
	header("Location:index.page.php?link=accueil");	
}elseif($_POST['enrg_flux']){					// si Enregistrement d'un Flux
	$fluxRSS->recupereVal();
	$fluxRSS->setFlux();
	header("Location:index.page.php?link=news");	
}elseif($_POST['enrg_game']){					// si Enregistrement d'un Jeu
	$game->recupereVal();
	$game->setGame();
	header("Location:index.page.php?link=game");			
}elseif($_POST['Send']){						// Si envoi d'un Mail
	$gestion->sendMail();
	header("Location:index.page.php?link=accueil");
}elseif($_POST['OK_theme']){					// Si choix d'un Thème
	$_SESSION['theme']=$_POST['THEME'];
	header("Location:index.page.php?link=accueil");
}elseif($_GET['delete'] && $_SESSION['group_user']==1){		// Si suppression d'une Video GET(video.page)
	$video->removeVideo($_GET['id']);
	header("Location:index.page.php?link=accueil");
}else{										
	if($_POST['chercher'] || $_GET['chercher']){
		$link="movies";
	}elseif($_POST['ok_multicrit']){
		$link="movies";
	}
											// LANCEMENT DE LA PAGE (choix par défaut)
	include("index.html.php");
}

// exige le login pour accéder contenu sinon ->identification
if(!$_SESSION['login'] || $_GET['link']=='identification'){
	include("class/connection/connect.page.php");
}else{
// SWITCH DES INCLUDES PRINCIPAUX
	switch($link){
		case 'accueil':
			include("accueil.page.php");
			break;
		case 'movies':		
			include("movies.page.php");
			break;
		case 'gestion':
			include("gestion.page.php");
			break;
		case 'video':
			$id=$_GET['id'];		
			include("video.page.php");
			break;
		case 'game':
			$id=$_GET['id'];
			include("game.page.php");
			break;
		case 'dossier':  				
			include("dossier.page.php");
			break;
		case 'news':  				
			include("news.page.php");
			break;
		case 'channels':  				
			include("channels.page.php");
			break;
		case 'map':  				
			include("map.page.php");
			break;
		case 'chat':  				
			include("chat.page.php");
			break;	
		case 'frise':  				
			include("frise.page.php");
			break;
		case 'test':  			// page test	
			include("test.php");
			break;			
		// par défaut : accueil	
		case '':
			$link='accueil';
			include("accueil.page.php");
			break;
	}
}
// PIED DE PAGE
	include("pied.html.php");

?>