<?php
include_once("Button.class.php");

class InputDate {

	var $Name;
	var $tabl_variabError;
	var $active;

    function InputDate($active,$tabl_variabError,$loadRegExp=null) {
    	//fchau 04/06/2009: pour des raisons pratiques (tableaux dynamiques) la variable Name est affectée au setInputDate
    	//$this->Name=$Name;
    	$this->tabl_variabError=$tabl_variabError;
    	$this->active=$active;
    	    	
    	//en commentaire en attendant
    	echo "<!--script du calendrier-->
			<table class=\"ds_box\" id=\"ds_conclass\" style=\"display: none;\" cellpadding=\"0\" cellspacing=\"0\">
				<tbody><tr><td id=\"ds_calclass\"></td></tr>
				</tbody></table>
		";
		//cas calendrier seul 
		//echo"<script src=\"../FC/js/InputDate.js\" type=\"text/javascript\"></script>";
					
   }   
    
    function setInputDate($Name,$date,$style=null,$noButton=null,$actionJS=null){
    	$this->Name=$Name;
    	//fonction ajoutant l'asterix erreur: liste si un element du tableau=nom de la variable
    	if(existeErrorIDate($this->tabl_variabError,$this->Name)==true){
    		$messageError="<font color=\"red\"><strong>*</strong></font>";	
    	}else{
    		$messageError="";
    	}    
    	
    	//si activ inactif
    	if($this->active==0){
    		//$onClick="";
    		$active="readonly=\"readonly\"";  		
    	}else{
    		//$onClick=" onClick=\"ds_sh(this);\" ";
    		$active="";
    	}
    	
    	//si $style!=null
    	if(!is_null($style)&&$style!=""){
    		$myStyle=$style;
    	}else{
    		$myStyle="";
    	}
    	
    	//$myString="tibob[2]";
    	$myString=$this->Name;
    	//echo "name=".$this->Name;
		$motClef="[";
		$pos1 = stripos($myString, $motClef);
		if($pos1!==false){
		 	//echo "trouvé<br/>";
		 	$myString= str_replace("[","_",$myString);
		 	$myString= str_replace("]","",$myString);
		 	$myID=$myString;
		}else{
			$myID=$myString;
		}
		
		if(!is_null($actionJS)){
			$actionJS=$actionJS;			
		}


    	echo"<input size=\"10\" maxLength=\"10\" $onClick name=\"".$this->Name."\" id=\"".$myID."\"  ".
		"style=\"cursor: text;".$myStyle."\" value=\"$date\" onKeyUp=\"masqueSaisieDate(this);$actionJS\" $active>$messageError";

    	//cas calendrier 
    	/*echo"<input size=\"10\" maxLength=\"10\" $onClick name=\"".$this->Name."\" id=\"".$this->Name."\" readonly=\"readonly\" " .
		"style=\"cursor: text;\" value=\"$date\">$messageError";*/
		
		//Ajout d'un bouton pour mettre le calendrier
		if(is_null($noButton)){
			$myButton= new Button("button", $myID."b", "",$this->active, "InputDate","ICO_Home.gif");
			$myButton->setButton("ds_sh($myID);$actionJS");	
		}
    }
    
    function setInputDateNow($Name/*,$date*/){
    	$this->Name=$Name;
    	//if($date==""){
    		$date=date('d/m/Y');
    	//}

		echo"<input size=\"9\" name=\"".$this->Name."\"  id=\"".$this->Name."\" style=\"cursor: text;\" value=\"$date\">";
    	//cas calendrier 
    	//echo"<input size=\"9\" onClick=\"ds_sh(this);\" name=\"".$this->Name."\"  id=\"".$this->Name."\" style=\"cursor: text;\" value=\"$date\">";
    }
}

//fonction n'appartenant pas à la classe: liste si un element du tableau=nom de la variable
	function existeErrorIDate($tabl_variabError,$Name){
		$existeError=false;
		for($i=0;$i<count($tabl_variabError);$i++){
    		if($tabl_variabError[$i]==$Name){
    			$existeError=true;
    			break;
    		}
    	}
    	return $existeError;
	}


?>