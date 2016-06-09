<?php 

include_once ("loginQuestion.class.php");

$tabl_variabError;
$messageErreur="";
?>
<div class="titre" align="center">OUBLI DE MOT DE PASSE</div>
<form action="accueil.php?link=loginQuestion" method="post">
<?php
$loginQuestion=new loginQuestion();

if($_POST['Submit']){

  //Recuperation des valeurs 
	$loginQuestion->recupereVal();
 //$loginQuestion->requete();
 //Test des champs
 	if($loginQuestion->testVal()==true) {
  		header("Location:accueil.php?link=question&login=".$loginQuestion->variablesForm['UTILISATEUR_LOGIN']);
 	}else{
    //Message d'erreur
    	$messageErreur = $loginQuestion->messageErreur;    
    //Tablaux des messages d'erreur
		$tabl_variabError=$loginQuestion->tabl_variabError;		
		//Valeur par default
		$arrayloginQuestion = $loginQuestion->getPosted();
		
    	include("loginQuestion.html.php");
 	}
}else{
	include("loginQuestion.html.php");
}
?>
</form>