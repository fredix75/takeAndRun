<?php
class Flux extends Formulaire{
	var $cat		=	array('FLUX_CAT','select',0,'');
	var $titre		=	array('FLUX_TITRE','input',0,'');
	var $lien		=	array('FLUX_LIEN','textarea',0,'');
	var $image		=	array('FLUX_IMAGE','textarea',0);
	
	function Flux(){
		$this->variables=array($this->cat,$this->titre, $this->lien, $this->image);
	}
	
	function getFlux($categorie){
		$queryMYSQL=new QueryMYSQL();
		if($categorie==1){
			$where=" WHERE CAT=1 OR CAT=2";
		}elseif($categorie==2){
			$where=" WHERE CAT=3";
		}
				
		$req="SELECT * FROM FLUX".$where." ORDER BY RAND();";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}
	
	 
	function setFlux($id=null){
		$myqueryInsert= new InsertSQL('FLUX', $this->variables, $this->variablesForm,$id);
	}	

	function removeGame($id){
		$queryMYSQL=new QueryMYSQL();
		$query="DELETE FROM FLUX WHERE ID=".$id;
		$queryMYSQL->query($query);
	}
}
?>