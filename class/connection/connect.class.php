<?php
include_once ("class/QueryMYSQL.class.php");
include_once ("class/Util.class.php");
include_once ("class/Formulaire.class.php");
require_once ("class/Identification.class.php");

class connect extends Formulaire{
var $UTILISATEUR_LOGIN=array("UTILISATEUR_LOGIN","input",1,"Vous devez saisir votre login");
var $UTILISATEUR_PASSWORD=array("UTILISATEUR_PASSWORD","input",1,"Vous devez saisir votre mot de passe");

var $variables=array();
var $ident;

    function connect() {
    	$this->variables=array($this->UTILISATEUR_LOGIN,$this->UTILISATEUR_PASSWORD);    	
    }
    
    //update le timedate de la dernière connexion
 	function setVal(){
 		$_SESSION['group_user']=$this->ident->groupUser;
 		$sql= new QueryMYSQL();
		$query="UPDATE UTILISATEUR set DERNIERCONNECTION='".date("Y-m-d H:i:s.0",mktime())."' WHERE login='".$_SESSION['login']."';";
   		$resultat=$sql->query($query);   		
 	} 	
	
	// vérifie la validité login/mdp par la classe identification
 	function testVal(){
 		$testVal=parent::testVal();
 		$j=count($this->tabl_variabError);
		$this->ident=new Identification($this->variablesForm["UTILISATEUR_LOGIN"],$this->variablesForm["UTILISATEUR_PASSWORD"]);  		 		
  		if($this->ident->ident()==false){
			$this->messageErreur=$this->messageErreur."Le login ou mot de passe sont incorrects<br/>\r";
			$this->tabl_variabError[$j+1]=UTILISATEUR_LOGIN;
 			$this->tabl_variabError[$j+2]=UTILISATEUR_PASSWORD;
 			$testVal=false;			
		}		
 		return $testVal;
 	}
	
	// vérifie si connexion antérieure
	function getLastConnexion(){
 		$sql= new QueryMYSQL();
		$query="select * from  UTILISATEUR  WHERE LOGIN='".$_SESSION['login']."';";
		echo $query;
   		$resultat=$sql->select_n($query);   
   		return $resultat;
 	}
	
}
?>