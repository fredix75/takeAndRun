<?php
//fchau CLASSE GENERANT LES Boutons
class Button {

//parametres: nom du bouton,value , actif, onclick si besoin
	var $Name;
	var $value;
	var $active;
	var $type;
  
    function Button($type, $Name, $value,$active, $fileActionJS=null, $image=null) {
    	$this->Name=$Name;
    	$this->value=$value;
    	$this->active=$active;
    	$this->type=$type; //type button ou submit
    	$this->image=$image;
    	
    	//$this->onClick=$onClick;
    	if(!is_null($fileActionJS)&&$fileActionJS!=""){
			$adresseJs="js/".$fileActionJS.".js";			
			echo"<script src=\"$adresseJs\" type=\"text/javascript\"></script>";
    	}
    }   
    
    function setButton($onClick=null){
    	
    	//si activ inactif
    	if($this->active==0){
    		$active="disabled=\"disabled\""; 		
    	}else{
    		$active="";
    	}
    	
    	if(!is_null($onClick)){
    		$onClick="onClick=\"".$onClick."\"";
    	}else{
    		$onClick="";
    	}    	
    	
    	if(is_null($this->image)){
    		$button="<input type=\"".$this->type."\" $active id=\"".$this->Name."\" name=\"".$this->Name."\" value=\"".$this->value."\" $onClick />";	
    	}else{
    		$button="<button type=\"".$this->type."\" $active id=\"".$this->Name."\" name=\"".$this->Name."\" value=\"".$this->value."\" $onClick " .
    				"style=\"background:white; cursor:hand; border:solid 1px black;\">" .
    				"<img src='images/miniCal.png'\"> </button>";
    	}   	
 		echo $button;    	 	
    }    
   
}

?>