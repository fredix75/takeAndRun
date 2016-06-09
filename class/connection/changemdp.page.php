<?php	
include_once("../FC/connection/changemdp.class.php");
$projectName=session_name();
require_once("../$projectName/class/User.class.php");

$tabl_variabError;
$messageErreur="";
//si on change le mdp hors session=>pas besoin de préciser l'ancien mdp
if(isset($_SESSION["group_user"])&&isset($_SESSION["centre"])){
	$oubli=null;
}else{
	$oubli=1;
}
/*echo "oubli=$oubli. is oubli null?";
if (is_null($oubli)){
	echo"VRAI<br/>";
}else{
	echo "FAUX<br/>";
}*/
$changemdp = new changemdp($oubli);

//$arrayChangeMdp=$changemdp->getVal();

?>
<div class="DivTab" align="center" style="background-color:#FFFAE8;">
<br/>
<div class="titre" align="center" style="background-color:#F9E1BF;width:95%;">Mon Compte</div>
<br/>
<form action="accueil.php?link=changemdp" method="post">
<?php

	if($_POST['Submit']){
		$changemdp->recupereVal();	
		
		$testVal=$changemdp->testVal($oubli);
		
		if($testVal==true){
			//echo "1";
			$changemdp->setVal();
			//redirige vers calendrier si deja connecté
			if((isset($_SESSION["group_user"])) && (isset($_SESSION["centre"]))){
        		//header("Location: accueil.php?link=calendrier&msg=successChngMdp");
        		$myUser= new User();
				$myUser->setAccueil();
      		}else{
        		//sinon redirige vers identification
        		unset($_SESSION['login']);
        		header("Location: accueil.php?link=identification&msg=successChngMdp");
      		}
		}else{
			$arrayChangeMdp = $changemdp->getPosted();			
			$messageErreur = $changemdp->messageErreur;
			$tabl_variabError=$changemdp->tabl_variabError;
			
			//print_r($messageErreur);
			include("../FC/connection/changemdp.html.php");
		}
	}else{
		include("../FC/connection/changemdp.html.php");
	}
?>
</form>
</div>