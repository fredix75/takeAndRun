<!DOCTYPE html>
<html lang="fr">
<head>

	<meta charset="ISO-8859-1" />
	<meta name="description" content="Take & Run Tribune, le site qui balance" />
	<meta name="keywords" content="Take & Run Tribune" />
	<meta name="author" content="FF" />

	<title>Take & Run Tribune</title>

	<link rel="icon" type="image/png" href="IMAGES/fav.gif" />
	<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="IMAGES/foot.gif" /><![endif]-->
	<link href="css/styl.css" rel="stylesheet" type="text/css" media="screen,print" />
	<link href="css/theme_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" media="screen,print" />
	<link href="css/jquery.autocomplete.css" rel="stylesheet" type="text/css">
<?php	

	if($link=="accueil" || $link=='' || $link=='movies' || $link=='channels'){
		if($link=="accueil" || $link==''){
?>	
		<link href="css/slideshow1.css" rel="stylesheet" type="text/css">
<?php
		}
?>	
	<link href="css/jquery.magnific-popup.css" rel="stylesheet" type="text/css">
<?php
	}elseif($link=='dossier'){
?>		
	<link href="css/slideshow2.css" rel="stylesheet" type="text/css">	
<?php		
	}elseif($link=='news'){
?>		
	<link href="css/meteo.css" rel="stylesheet" type="text/css">	
<?php		
	}
	
?>
	<!--<link href="css/typo.css" rel="stylesheet" type="text/css" media="screen,print" />-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>  
	<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<?php
	$idChamp="VIDEO_CHERCHER";
	$file="AutoCompVideo"; ?>
   	<script>
     	$(document).ready(function(){
			$("#<?php echo $idChamp;?>").autocomplete("<?php echo $file?>.php");
		 });
	</script>			
</head>

<body>

	<div id="global">

			<a href="index.page.php">
			<div id="header" align="right">
				<img src="<?php echo $vignette; ?>" height="200px" style="margin-bottom:50px;margin-right:-30px;"/>
				<img style="margin-left:-200px;margin-bottom:60px;-webkit-transform: rotate(<?php echo $n; ?>deg);-moz-transform: rotate(<?php echo $n; ?>deg);transform: rotate(<?php echo $n; ?>deg);" src="IMAGES/tele.png"/>
			</div></a>
<?php
		include('nav.html.php');
?>
