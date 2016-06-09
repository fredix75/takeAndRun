<?php
include_once ("../FC/class/QueryMYSQL.class.php");
include_once ("../FC/class/Util.class.php");
include_once ("../FC/class/Formulaire.class.php");


class question extends Formulaire{
var $UTILISATEUR_REPONSE=array("UTILISATEUR_REPONSE","input",1,"Vous devez réponse à la question.");
var $UTILISATEUR_LOGIN=array("UTILISATEUR_LOGIN","input",0,"");
var $variables=array();

function question() {
    	$this->variables=array($this->UTILISATEUR_REPONSE, $this->UTILISATEUR_LOGIN);    	
    }
    
    
    function testVal(){
 		$testVal=parent::testVal();
 		$j=count($this->tabl_variabError);  		
  		
  		if(strpos($this->variablesForm['UTILISATEUR_LOGIN'],"demo")===0){ 	
        	$myqueryMYSQL=new QueryMYSQL("connexionDbDEMO");
      	}else{
        	$myqueryMYSQL=new QueryMYSQL();
      	}
  		
  		if($this->variablesForm['UTILISATEUR_REPONSE'] != ""){
        	$query = "select * from UTILISATEUR where REPONSE ='".$this->variablesForm['UTILISATEUR_REPONSE']."' and LOGIN='".$this->variablesForm['UTILISATEUR_LOGIN']."'";     
        	//echo $query;
        	$resultQuestion=$myqueryMYSQL->select_n($query);
        	$resu=count($resultQuestion);
        	if ($resu==0){
          		$this->messageErreur=$this->messageErreur."Votre réponse est inexacte.<br/>\r";
				$this->tabl_variabError[$j]="UTILISATEUR_REPONSE";			
				$testVal=false;
				$j=$j+1;
        	}
       }
       return $testVal;
 	}

}
?>
