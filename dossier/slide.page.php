<?php
	$dossier=str_ireplace("_"," ",$_GET['s']);
	$arrayPortfolio=$gestion->getPortfolio($dossier);
	if($arrayPortfolio!=false){
		shuffle($arrayPortfolio);
		$pFSize=count($arrayPortfolio);
		$nb=ceil($pFSize/6);
		$rest=($nb*6)-$pFSize+1;
	
		include("inc/slideshow2.php");
	}
?>

