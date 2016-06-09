<?php
$arrayPeriodes=$video->getStats('PERIODE');
$arrayLiens=$lien->getLiens();
// $arrayRubriques (link.class) instanciée dans 'link.page.php'
$arrayCategories=$video->getStats('CATEGORIE');

//CHOIX POSSIBLES
if($_GET['erreur']){
	switch ($_GET['erreur']){	// Gestion des Erreurs à l'enregistrement: lien déja existant
		case 'linkexist':
			$msg="Ce lien existe déja !! L'enregistrement n'a pas été effectué";
			$arrayVID[0]=$verif;
			$videoV=$video->getVideoById($arrayVID);
			break;
		case 'linkvoid':
			$msg="Les champs obligatoires sont vides !! L'enregistrement n'a pas été effectué";
			$msg.="<br/>".$video->messageErreur;
			break;		
	}
?>			
	<img src="IMAGES/vide.gif" height=1px onLoad="affiche('inserer');"/>
<?php	
}else{													// Ordre aléatoire (choix par défaut)
	$videoV=$video->getVideo();
}

//Chargement du Flux Presse
//$arrayRSS=$fluxRSS->getFlux(1);

// Chargement du Diaporama
$dossier="Pop Art";
$arrayPortfolio=$gestion->getPortfolio($dossier);
shuffle($arrayPortfolio);
$pFSize=count($arrayPortfolio);
$pFSize=18; // RESTRICTION : 3 séries d'images seulemnt
$nb=ceil($pFSize/6);


// LANCEMENT DE LA PAGE

include('accueil.html.php');

?>
