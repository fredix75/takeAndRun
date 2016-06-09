<?php
//CLASSE PERMETTANT DE CREER DES CHACKBOX AVEC UNE ACTION JS ONCLICK

class CheckboxAction {

//parametres: nom du select, tableau de valeur, tableau de libellé, actif, valeurs obligatoires
	var $Name;
	var $selected;
	var $active;
	var $tabl_variabError;

    
    function CheckboxAction($Name, $selected,$active, $tabl_variabError, $fileActionJS=null, $value=null,$noclass=null) {
    	$this->Name=$Name;
    	$this->selected=$selected;
    	$this->active=$active;
    	$this->tabl_variabError=$tabl_variabError;
    	if($fileActionJS!=""||!is_null($fileActionJS)){
		 	$adresseJs="js/".$fileActionJS.".js";
		}

    	if(!is_null($value)){
    		$this->value=$value;
    	}
    	if(!is_null($noclass)){
    		$this->noclass=$noclass;
    	}
    }   
    
    function setCheckbox($actionJS=null){
    	//fonction ajoutant l'asterix erreur: liste si un element du tableau=nom de la variable
    	if(existeErrorCheckboxA($this->tabl_variabError,$this->Name)==true){
    		$messageError="<font color=\"red\"><strong>*</strong></font>";	
    	}else{
    		$messageError="";
    	}
    	
    	//si activ inactif
    	if($this->active==0){
    		$active="disabled=\"disabled\""; 		
    	}else{
    		$active="";
    	}
    	
    	if($this->selected==1){
    		$checked="checked=\"checked\""; 		
    	}else{
    		$checked="";
    	}
    	if($this->noclass==1){
    		$input="<input type=\"checkbox\" $active id=\"".$this->Name."\" name=\"".$this->Name."\" $checked value=\"".$this->value."\"  />$messageError\r";	
    	}
    	else if($messageError == ""){
    		$input="<input type=\"checkbox\" $active id=\"".$this->Name."\" name=\"".$this->Name."\" $checked onClick=\"$actionJS\"  />$messageError\r";	
    	}else{
    		$input="<input type=\"checkbox\" $active id=\"".$this->Name."\" name=\"".$this->Name."\" $checked onClick=\"$actionJS\"  />$messageError\r";
    	}
 		echo $input;
    }    
   
}

//fonction n'appartenant pas à la classe: liste si un element du tableau=nom de la variable
	function existeErrorCheckboxA($tabl_variabError,$Name){
		$existeError=false;
		for($i=0;$i<count($tabl_variabError);$i++){
    		if($tabl_variabError[$i]==$Name){
    			$existeError=true;
    			break;
    		}
    	}
    	return $existeError;
	}


//exemple

?>