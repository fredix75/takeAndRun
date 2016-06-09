<?php
$nVid=28; // nombre de vidéos affichées

// RECEPTION des Numeros de Pages 'idTab'
if($_POST['ok_page']){
	$_GET['idTab']=	$_POST['PAGESELECT']-1;
}
if($_GET['idTab']){
	$idTab = $_GET['idTab'];
}else $idTab = 0;

$mode=($_GET['mode'])?$_GET['mode']:"couch";

$ok=1;  // variable qui permet de n'afficher la catégorie qu'une fois et le genre à chaque fois pour chaque vidéo de la page
if($_GET['categorie'] || $_GET['genre'] || $_POST['categorie'] && $_POST['categorie']!=-1){			// Tri par catégorie GET 
	if($_POST['categorie'] && $_POST['categorie']!=-1) $_GET['categorie']=$_POST['categorie'];
	$categorie=$_GET['categorie'];									
	if($_POST['SelGenre'] && $_POST['SelGenre']!=-1) $_GET['genre']=$_POST['SelGenre']; 
	if($_GET['genre']){
		$genre=$_GET['genre'];
	}
	$tailleBase=$video->getCount($categorie,$genre);
	$taille=(int)($tailleBase[0]['COUNT']/$nVid);
	if($tailleBase[0]['COUNT']%$nVid!=0)	$taille+=1;
	$numero=$idTab*$nVid;
	$arrayMOVIES=$video->getVideoByCateg($categorie,$numero,"","",$genre);
	shuffle($arrayMOVIES);
	$ok=1;  // variable qui permet de n'afficher la catégorie qu'une fois et le genre à chaque fois pour chaque vidéo de la page
	$repere="<strong>Catégorie:</srong><img src='IMAGES/nav/chiffres.png' width=80px/>";
}elseif($_GET['periode'] || $_POST['periode'] && $_POST['periode']!=-1){
	if($_POST['periode'] && $_POST['periode']!=-1) $_GET['periode']=$_POST['periode'];
	$periode=$_GET['periode'];
	$tailleBase=$video->getCount(null,null,$periode);
	$taille=(int)($tailleBase[0]['COUNT']/$nVid);
	if($tailleBase[0]['COUNT']%$nVid!=0)	$taille+=1;
	$numero=$idTab*$nVid;
	$arrayMOVIES=$video->getVideoByPeriode($periode,$numero,"",1);
	$repere="<strong>Période</srong>: ".$periode."<img src='IMAGES/menu/".$periode.".png' width=80px/>";
	
}elseif($_GET['tri']=='id'){							// Tri par ID DESC
	$tailleBase=$video->getCount();
	$taille=(int)($tailleBase[0]['COUNT']/$nVid);
	if($tailleBase[0]['COUNT']%$nVid!=0)	$taille+=1;
	$numero=$idTab*$nVid;
	$arrayMOVIES=$video->getVideoChronol($numero);
	$repere="<strong>Vidéos les plus récentes</srong><img src='IMAGES/nav/day.png' width=80px/>";

}elseif($_POST['chercher'] || $_GET['chercher']){		// Tri par Recherche POST('chercher.page') / GET(video.page)
	if($_POST['VIDEO_CHERCHER']){
		$_GET['chercher']=str_replace(" ","%",$_POST['VIDEO_CHERCHER']);
?>			
			<img src="IMAGES/vide.gif" height=1px onLoad="affiche('chercher');"/>
<?php
	}
	$videoC=$video->chercher($_GET['chercher']);
	if(!$videoC){	// Si Aucun résultat
		if(count(split("%", $_GET['chercher']))>1){
			// si plusieurs mots -> 2e traitement: recherche sur le mot le plus long
			$cherche2=$myUtil->sortBySize($_GET['chercher']);
			$_GET['chercher']=$cherche2;
			header("location:index.page.php?link=accueil&chercher=".$cherche2);
		}else{
			// Si aucun résultat sur un seul mot -> échec !!
			$compte="aucun";
			$arrayMOVIES=$video->getVideo(null,$nVid);
		}
	}else{												
		//affichage du résultat en plusieurs tableaux
		$compte=count($videoC);			// compte le nombre de résultats
		$arrayTabRecap2=$myUtil->splitResult($videoC,$nVid);
		$arrayMOVIES=$arrayTabRecap2[$idTab];
	}
	$mode="moz";
}elseif($_POST['ok_multicrit']){
	$wherP= " AND (PERIODE='00' ";
	foreach($arrayPeriode as $key=>$val){
		if($_POST['PERIODE'.$key]){
			$wherP.="OR PERIODE='".$val."' ";
		}
	}
	$wherP.=")";
	$periode=($_POST['CHOIX_PERIODE']==1)?$wherP:'';	//Recherche MULTICRITERES
	$annee=($_POST['CHOIX_PERIODE']==2 && $_POST['ANNEES'])?' AND ANNEE='.$_POST['ANNEES']:'';
	$categ=($_POST['CB_CATEG'] && $_POST['CATEG']!=-1)?' AND CATEGORIE='.$_POST['CATEG']:'';
	$genre=($_POST['CB_CATEG'] && $_POST['GENRE']!=-1)?' AND GENRE='.$_POST['GENRE']:'';
	$prio=($_POST['CB_PRIO'] && $_POST['PRIO'] && $_POST['PRIO']!=-1)?' AND PRIORITE='.$_POST['PRIO']:'';
	$requete="SELECT * FROM LIENVIDEO WHERE 1".$periode.$annee.$categ.$genre.$prio." ORDER BY ID DESC";
	$arrayMOVIES=$video->getMultiC($requete);
	?><img src="IMAGES/vide.gif" height=1px onLoad="affiche('chercher');"/><?php
	if(!$arrayMOVIES){		// Si aucun résultat -> échec !!
		$compte="aucun";
		$arrayMOVIES=$video->getVideo(null,$nVid);
	}else{												
		//affichage du résultat en plusieurs tableaux
		$compte=count($arrayMOVIES);			// compte le nombre de résultats
		$arrayTabRecap2=$myUtil->splitResult($arrayMOVIES,$nVid);
		$arrayMOVIES=$arrayTabRecap2[$idTab];
	}
	$mode="moz";
}else{
	$arrayMOVIES=$video->getVideo(null,$nVid);	
}

include("movies.html.php");
?>