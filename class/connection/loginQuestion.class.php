<?php
include_once ("../FC/class/QueryMYSQL.class.php");
include_once ("../FC/class/Util.class.php");
include_once ("../FC/class/Formulaire.class.php");


class loginQuestion extends Formulaire{
var $UTILISATEUR_LOGIN=array("UTILISATEUR_LOGIN","input",1,"Vous devez saisir votre login.");
var $UTILISATEUR_EMAIL=array("UTILISATEUR_EMAIL","input",1,"Vous devez saisir votre email.");


var $variables=array();

function loginQuestion() {
    	$this->variables=array($this->UTILISATEUR_LOGIN,$this->UTILISATEUR_EMAIL);    	
    }
  
    
  //fonction qui teste si le login ou mot de passe est correct
 	function testVal(){
 		$testVal=parent::testVal();
 		$j=count($this->tabl_variabError);  		
  		
  		//echo $this->variablesForm['UTILISATEUR_LOGIN'];
  		if(strpos($this->variablesForm['UTILISATEUR_LOGIN'],"demo")===0){
        	$myqueryMYSQL=new QueryMYSQL("connexionDbDEMO");
        	//echo "baseDEMO";        
      	}else{
        	$myqueryMYSQL=new QueryMYSQL();
        	//echo "baseProduction";
      	}
      
      //Test sur le login
		if($this->variablesForm["UTILISATEUR_LOGIN"] != ""){
  		  $query = "select * from UTILISATEUR where LOGIN ='".$this->variablesForm['UTILISATEUR_LOGIN']."'";
  		 // echo $query;
  		  $resultQuestion=$myqueryMYSQL->select_n($query);
  		  //print_r($resultQuestion);
  		  $resu=count($resultQuestion);
        
        if ($resu==0){
          	$this->messageErreur=$this->messageErreur."Votre login est inexact.<br/>\r";			
			$this->tabl_variabError[$j]="UTILISATEUR_LOGIN";			
 			$testVal=false;
			$j=$j+1;
        }else{
			$query = "select * from UTILISATEUR where LOGIN ='".$this->variablesForm['UTILISATEUR_LOGIN']."' and  EMAIL = '" .$this->variablesForm['UTILISATEUR_EMAIL']."'";
          	$resultQuestion=$myqueryMYSQL->select_n($query);
          	$resu=count($resultQuestion);
          	if ($resu==0){
          		$this->messageErreur=$this->messageErreur."Votre mail et votre login ne correspondent pas.<br/>\r";			
			    $this->tabl_variabError[$j]="UTILISATEUR_MAIL";			
 			    $testVal=false;
 			    $j=$j+1;
          }
        }		 
      }
      //Fin test sur le login
      
      //Test sur le mail
		if($this->variablesForm["UTILISATEUR_EMAIL"] != ""){
  			$query = "select * from UTILISATEUR where EMAIL ='".$this->variablesForm['UTILISATEUR_EMAIL']."'";
			$resultQuestion=$myqueryMYSQL->select_n($query);
        	$resu=count($resultQuestion);
        	if ($resu==0){
          		$this->messageErreur=$this->messageErreur."Votre mail est inexact.<br/>\r";			
			    $this->tabl_variabError[$j]="UTILISATEUR_EMAIL";			
 			    $testVal=false;
 			    $j=$j+1;
        	} 
      }
      //Fin de test sur le mail
      
      //Les 2 champs rempli
		if (($this->variablesForm["UTILISATEUR_EMAIL"] != " ") && ($this->variablesForm["UTILISATEUR_LOGIN"] != " ")){
			$query = "select * from UTILISATEUR where LOGIN ='".$this->variablesForm['UTILISATEUR_LOGIN']."' and  EMAIL = '" .$this->variablesForm['UTILISATEUR_EMAIL']."'";
        	$resultQuestion=$myqueryMYSQL->select_n($query);
        	return $testVal;
      	}
      //Fin des 2 champs rempli.

 	}
}
?>