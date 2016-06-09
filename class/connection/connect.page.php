<?php
session_start();
require_once("connect.class.php");
$projectName=session_name();
$myConnect=new connect();
$tabl_variabError;
$messageErreur="";

$imgFond=$gestion->getImgAccueil();
?>
<form action="index.page.php?link=identification" method="post">
<?php
if(!empty($_POST)){
	// success
	$myConnect->recupereVal();
	if($myConnect->testVal()){
		$arrayCONNEXION=$myConnect->getLastConnexion();
		//1ere connexion
		if(($arrayCONNEXION[0]["DERNIERCONNECTION"]==""||$arrayCONNEXION[0]["DERNIERCONNECTION"]==NULL)&&($_SESSION["group_user"]==1)){
			$myConnect->setVal();
			header("Location: index.page.php?link=accueil"); 
		}else{
			$myConnect->setVal();//update la date de la derniere connection
			header("Location: index.page.php?link=accueil");
		}
	}else{
		// l'identification a echoué
		$arrayQ=$myConnect->getPosted();
		include("connect.html.php");
	}
	
}else{	//par défaut
	include("connect.html.php");
}
?>
</form>