<?php


class Lien extends Formulaire {
	var $nom		=	array('LIEN_NOM','input',0,'');
	var $lien		=	array('LIEN_LIEN','input',0,'');	
	var $rubrique	=	array('LIEN_RUBRIQUE','input',0,'');

    function LIEN() {
    	$this->variables=array($this->nom, $this->lien, $this->rubrique);
    }

	function setLink(){
		//$lien1=stristr($this->variablesForm['LIEN_LIEN'],'http://');
   		$this->variablesForm['LIEN_LIEN']=str_ireplace('http://','',$this->variablesForm['LIEN_LIEN']);
		//$this->variablesForm['LIEN_LIEN']=$lien;
		$myqueryInsert= new InsertSQL('LIENSMENU', $this->variables, $this->variablesForm);
	}	

	function getRubriques(){
		$queryMYSQL=new QueryMYSQL();
		$req="SELECT RUBRIQUE FROM LIENSMENU GROUP BY RUBRIQUE ORDER BY ID";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}
	
	function getLiens(){
		$queryMYSQL=new QueryMYSQL();
		$req="SELECT * FROM LIENSMENU ORDER BY RUBRIQUE,ID";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}
}
?>