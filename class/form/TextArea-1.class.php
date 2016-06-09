<?php
//fchau CLASSE GENERANT LES Textarea SIMPLES
class TextArea {

//parametres: nom du select, tableau de valeur, tableau de libellé, actif, valeurs obligatoires
	var $Name;
  var $rows;
  var $cols;
	var $value;
	var $active;
	var $tabl_variabError;
	var $maxSize;
	var $style;
    
    function __construct($Name, $value,$active, $tabl_variabError,$cols=10,$rows=10, $style="") {
    	$this->Name=$Name;
    	$this->value=$value;
    	$this->active=$active;
    	$this->tabl_variabError=$tabl_variabError;
    	$this->maxSize=$maxSize;
    	$this->cols=$cols;
    	$this->rows=$rows;
    	$this->style=$style;
    }   
    
    function setTextArea(){
    	//echo "arrayValue[".$numRadio."]=".$this->arrayValue[$numRadio];
    	//echo "valueSelected=".$this->valueSelected."<br/>";
    	
    	//fonction ajoutant l'asterix erreur: liste si un element du tableau=nom de la variable
    	if(existeErrorTextarea($this->tabl_variabError,$this->Name)==true){
    		$messageError="<font color=\"red\"><strong>*</strong></font>";	
    	}else{
    		$messageError="";
    	}
    	
    	//si activ inactif
    	if($this->active==0){
    		$active="readonly=\"readonly\""; 		
    	}else{
    		$active="";
    	}
    	
    	
    	
    	if($this->maxSize!=-1){
    		$textarea="<textarea type=\"text\" rows=\"".$this->rows."\" cols=\"".$this->cols."\" $active name=\"".$this->Name."\" style=\"".$this->style."\" size=\"".$this->maxSize."\" maxlength=\"".$this->maxSize."\" />$this->value</textarea>$messageError\r";	
    	}else{
    		$textarea="<textarea type=\"text\" rows=\"".$this->rows."\" cols=\"".$this->cols."\"  $active name=\"".$this->Name."\" >$this->value</textarea>$messageError\r";
    	}
 		echo $textarea; 	
    }    
   
}

//fonction n'appartenant pas à la classe: liste si un element du tableau=nom de la variable
	function existeErrorTextarea($tabl_variabError,$Name){
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