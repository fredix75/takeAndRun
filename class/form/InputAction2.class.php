<?php
//fchau CLASSE GENERANT LES INPUT. Ne charge pas le regexp par defaut.
class InputAction {

//parametres: nom, tableau de valeur, actif, valeurs obligatoires, erreur, taille, fichier js, methode js
	var $Name;
//	var $libel;
	var $value;
	var $valueSelected;
	var $active;
	var $tabl_variabError;
	var $maxSize;//if 0 hidden if -2 password type ,for others text type
	var $action;
	var $style;

	//constructeur 
    //le name  , valeur par defaut , enable or disable , message d'erreur , le size du champ, javascript specification
    function InputAction($Name, $value,$active, $tabl_variabError,$maxSize,$fileActionJS=null,$action=null, $style="") {
    	$this->Name=$Name;
    	if($value=="-1"){
    		$value="";
    	}
    	$this->value=$value;
    	$this->active=$active;
    	$this->tabl_variabError=$tabl_variabError;
    	$this->maxSize=$maxSize;       	
    	$this->style=$style;
    	$this->action=NULL;
    	 
    	//fichier de script
    	//if(!is_null($fileActionJS)){
    		if($fileActionJS!="" && !is_null($fileActionJS)) {
	    		//si le fichier est local alors transforme la chaine pour le mettre dans le local dir. 			
	 			$motClef="local";
	 			$pos1 = stripos($fileActionJS, $motClef);
	 
				if($pos1!==false){
					//echo "trouvé<br/>";
				 	$adresseJs="js/".substr($fileActionJS, strlen($motClef)+1).".js";
				}else{
					//echo "pas trouvé<br/>";
				 	$adresseJs="../FC/js/".$fileActionJS.".js";
				}
    			
    			echo"<script src=\"$adresseJs\" type=\"text/javascript\"></script>";
    		}
    	//}
    	
    	
    	//3 cas permettant masque de saisie:
    	//if(is_null($action)){
    		if($action=="numeriq"){
    			//echo "1";
    			$action="onkeyup=\"return regexpToInput(this,'numeriq')";
    		}
    		if($action=="alpha"){
				//echo "2";
				$action="onkeyup=\"return regexpToInput(this,'alpha')";    		
    		}
    		if($action=="alphanumeriq"){
    			//echo "3";
    			$action="onkeyup=\"return regexpToInput(this,'alphanumeriq')";
    		}
    		if($action=="decimale"){
    			//echo "4";
    			$action="onkeyup=\"return regexpToInput(this,'decimale')";
    		}
    		
    /******************************/
    	//}
    	$this->action=$action;
    }   
    
    //creer le champ input 
    function setInput($actionJS=null){
    	
    	//si il faut faire appel à une autre methode js=> on la rajoute et après on ferme les ""
    	if(!is_null($this->action)&& $this->action!=""){
    		if(!is_null($actionJS)){
    			$this->action=$this->action.",$actionJS"."\"";	
    		}else{
    			$this->action=$this->action."\"";	
    		}
    	}
    	//echo $this->action;
    	
    	//fonction ajoutant l'asterix erreur: liste si un element du tableau=nom de la variable
    	if(existeErrorIA($this->tabl_variabError,$this->Name)==true){
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
    		$type="text";
    		if($this->maxSize==-2){
    			$type="password";
    			$this->maxSize=15;    				
    		}
    		if($this->maxSize==0){
    			$type="hidden";	
    		}
	    	$input="<input $active type=\"$type\" id=\"".$this->Name."\" name=\"".$this->Name."\" value=\"".$this->value."\" style=\"".$this->style."\" size=\"".$this->maxSize."\" maxlength=\"".$this->maxSize."\" ".$this->action." />$messageError\r";
    	}else{
    		$input="<input $active type=\"text\" id=\"".$this->Name."\" name=\"".$this->Name."\" value=\"".$this->value."\" ".$this->action." />$messageError\r";
    	}

 		echo $input;
    	/*echo "<input type=\"radio\" name=\"".$this->Name."\" value=\"".$this->arrayValue[$numRadio]."\" ";
    	if($this->arrayValue[$numRadio]==$this->valueSelected){
    		echo "checked=\"checked\" /> ".$libel;
    	}else{
    		echo " />$libel ";
    	}*/    	
    }    
   
}

//fonction n'appartenant pas à la classe: liste si un element du tableau=nom de la variable
	function existeErrorIA($tabl_variabError,$Name){
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
/*$inputA= new InputAction("inputActionName", "45",0, $tabl_variabError,3);
$inputA->setInput();*/

?>