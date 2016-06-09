<?php 
include_once ("../FC/class/Commun.class.php");
include_once ("question.class.php");

$tabl_variabError;
$messageErreur="";
if(isset($_POST['login'])){
	$login=$_POST['login'];
}else{
	$login=$_GET['login'];	
}

?>
<div class="titre" align="center">QUESTION SECRETE</div>
<form action="accueil.php?link=question&login=<?php echo $login ?>" method="post">
<?php
$question=new question();
$myCommun= new Commun();

if($_POST['Submit']){

  //Recuperation des valeurs 
 	$question->recupereVal();
 //Test des champs
 	$testVal=$question->testVal();
 	if($testVal==true) {
  		$_SESSION['login']=$login;
  		header("Location:accueil.php?link=changemdp&msg=chngmdp");  
	}else{
    //Message d'erreur
    	$messageErreur = $question->messageErreur;    
    //Tablaux des messages d'erreur
		$tabl_variabError=$question->tabl_variabError;		
	//Valeur par default
		//$arrayQuestion = $question->getPosted();
		$arrayQuestion=$myCommun->getPassword($login);		
    	include("question.html.php");
 	}
}else{	
	$arrayQuestion=$myCommun->getPassword($login);
	//print_r($arrayQuestion);
	include("question.html.php");
}
?>
</form>