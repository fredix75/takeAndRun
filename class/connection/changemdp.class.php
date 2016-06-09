<?php
//include_once ("class/QueryMYSQL.class.php");
include_once ("../FC/class/Util.class.php");
include_once ("../FC/class/Formulaire.class.php");
include_once ("../FC/class/Commun.class.php");
//require_once ("class/Identification.class.php");

class changemdp extends Formulaire{

var $UTILISATEUR_QUESTION=array("UTILISATEUR_QUESTION","select",1,"Vous devez choisir la question");
var $UTILISATEUR_REPONSE=array("UTILISATEUR_REPONSE","input",1,"Vous devez mettre la réponse.");
var $UTILISATEUR_OLDPASSWORD=array("UTILISATEUR_OLDPASSWORD","input",1,"Vous devez mettre l'ancien mot de passe.");
var $UTILISATEUR_NEWPASSWORD1=array("UTILISATEUR_NEWPASSWORD1","input",1,"Vous devez mettre le nouveau mot de passe.");
var $UTILISATEUR_NEWPASSWORD2=array("UTILISATEUR_NEWPASSWORD2","input",1,"Vous devez mettre le nouveau mot de passe.");

var $variables=array();


    //charge les donnees. Et instancie la classe Identification
    function changemdp($oubli) {
    	//si changement de mot de passe alors qu'il a été oublié=>oldpassword non requis.
    	if(!is_null($oubli)){
    		//echo "oubli null";
    		$this->UTILISATEUR_OLDPASSWORD=array("UTILISATEUR_OLDPASSWORD","input",0,"");
    	}else{
    		//echo "oubli non null";
    	}
    	
    	$this->variables=array($this->UTILISATEUR_QUESTION,$this->UTILISATEUR_REPONSE,$this->UTILISATEUR_OLDPASSWORD,
    	$this->UTILISATEUR_NEWPASSWORD1,$this->UTILISATEUR_NEWPASSWORD2);
    }
    
    //insere ou update les valeurs du patient
 	function setVal(){
 		$myCommun=new Commun();
 		$myCommun->setNewPassword($this->variablesForm["UTILISATEUR_NEWPASSWORD1"],$this->variablesForm["UTILISATEUR_QUESTION"],$this->variablesForm["UTILISATEUR_REPONSE"]);
		$myUtil=new Util();
		$myUtil->mailInfo("nouveau mot de passe changé sur le site ".session_name()." ","un nouveau mot de passe a été changé par l'utilisateur ".$_SESSION["login"]);		 		
 	}
	
	function getVal(){
    	$QueryMYSQL=new QueryMYSQL();
    	$myQuery="select QUESTION, REPONSE from UTILISATEUR where LOGIN='".$_SESSION['login']."'";
    	$resQuery=$QueryMYSQL->select_n($myQuery);
    	//$myNobug->getVALUES($_SESSION['LOGIN'], 'UTILISATEUR');
    	//on transmet le tableau au parent pour qu'il le traite
    	$arrayGetVal=parent::getVal($resQuery);
 		return $arrayGetVal;
    }
	
	//fonction qui teste si le login ou mot de passe est correct
 	function testVal($oubli=null){
 		$testVal=parent::testVal();
 		$j=count($this->tabl_variabError);  		
  		
  		$taille1=strlen($this->variablesForm["UTILISATEUR_NEWPASSWORD1"]);  		
  		if($taille1<6){
			$this->messageErreur=$this->messageErreur."Le mot de passe doit contenir au minimum 6 caractères<br/>\r";			
			$this->tabl_variabError[$j]="UTILISATEUR_NEWPASSWORD1";			
 			$testVal=false;
 			$j=$j+1;
		}  		
  		
  		if($this->variablesForm["UTILISATEUR_NEWPASSWORD1"]!=$this->variablesForm["UTILISATEUR_NEWPASSWORD2"]){
			$this->messageErreur=$this->messageErreur."Le nouveau mot de passe ne correspond pas à la confirmation de mot de passe.<br/>\r";			
			$this->tabl_variabError[$j]="UTILISATEUR_NEWPASSWORD2";			
 			$testVal=false;
 			$j=$j+1;
		}
		
		$myCommun=new Commun();
		$arrayPasswordBase=$myCommun->getPassword($_SESSION["login"]);
		$passwordBase=$arrayPasswordBase[0]["PASSWORD"];
		//echo $_SESSION["login"];
	    //print_r($arrayPasswordBase);
		//echo "<br/>oldPassword=$passwordBase<br /> password saisi=".sha1($this->variablesForm["UTILISATEUR_OLDPASSWORD"]);
		
		//teste s'il ne s'agit pas d'un oubli.
		if(is_null($oubli)){
			/*echo "oldpassword=".sha1($this->variablesForm["UTILISATEUR_OLDPASSWORD"]).", ";
			echo "passwordbase=$passwordBase<br/>";*/
			if(sha1($this->variablesForm["UTILISATEUR_OLDPASSWORD"])!=$passwordBase){
				$this->messageErreur=$this->messageErreur."L'ancien mot de passe saisi est faux.<br/>\r";			
				$this->tabl_variabError[$j]="UTILISATEUR_OLDPASSWORD";
 				$testVal=false;
 				$j=$j+1;
			}
		}
  		
 		return $testVal;
 	}	
	
	
}
?>