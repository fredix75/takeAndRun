<?php

class FileAction {
    	var $name;
		var $value;
		var $active;
		var $tabl_variabError;
		var	$maxSize;
		
    function FileAction($name,$value,$active,$tabl_variabError,$maxSize) {
    	$this->name=$name;
    	$this->value=$value;
    	$this->active=$active;
    	$this->tabl_variabError=$tabl_variabError;
    	$this->maxSize=$maxSize;
    }
    
    function setFile(){
    	
    	if(existeErrorIA($this->tabl_variabError,$this->name)==true){
    		$messageError="<font color=\"red\"><strong>*</strong></font>";	
    	}else{
    		$messageError="";
    	}
    	
    	if($this->active==0){
    		$active="readonly=\"readonly\""; 		
    	}else{
    		$active="";
    	}
    	
    	if($this->maxSize!=-1){
    		$type="file";
    		if($this->maxSize==0){
    			$type="hidden";	
    		}
    	$input=	"<input type=\"$type\" id=\"".$this->name."\" name=\"".$this->name."\" size=\"".$this->maxSize."\" />";
    	}
    	
    	echo $input;
    }
    
    function existeErrorIA($tabl_variabError,$name){
		$existeError=false;
		for($i=0;$i<count($tabl_variabError);$i++){
    		if($tabl_variabError[$i]==$name){
    			$existeError=true;
    			break;
    		}
    	}
    	return $existeError;
	}
}
?>