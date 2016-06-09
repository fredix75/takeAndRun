<?php
//CLASSE PERMETTANT DE CREER DES RADIO AVEC UNE ACTION JS ONCLICK
class RadioAction {

	var $arrayValue;
	var $Name;
	var $valueSelected;
	var $active;
	var $tabl_variabError;

    function RadioAction($Name, $arrayValue,$valueSelected, $active, $tabl_variabError, $fileActionJS=null) {
    	$this->Name=$Name;
    	$this->arrayValue=$arrayValue;
    	$this->valueSelected=$valueSelected;
    	$this->active=$active;
    	$this->tabl_variabError=$tabl_variabError;
    	
    	if($fileActionJS!=""||!is_null($fileActionJS)){
		 	$adresseJs="js/".$fileActionJS.".js";    		
    		echo"<script src=\"$adresseJs\" type=\"text/javascript\"></script>\r";	
    	}    	
    }   
    
    function setRadio($numRadio,$libel,$actionJS,$id=""){
    	//echo "arrayValue[".$numRadio."]=".$this->arrayValue[$numRadio];
    	//echo "valueSelected=".$this->valueSelected."<br/>";
    	if ($id!=""){
    		$idradio=" id=\"".$this->Name.$id."\" ";
    	}else{
    		$idradio="";
    	}
    		
    	//fonction ajoutant l'asterix erreur: liste si un element du tableau=nom de la variable
    	if(existeErrorRadioA($this->tabl_variabError,$this->Name)==true){
    		$messageError="<font color=\"red\"><strong>*</strong></font>";	
    	}else{
    		$messageError="";
    	}
    	
    	if($this->active==0){
    		$active="disabled=\"disabled\""; 		
    	}else{
    		$active="";		
    	}
    	
    	if ($id!=""){
    		$libel="<label for=\"".$this->Name.$id."\">$libel</label>";		
    	}
    	
    	echo "<input $active type=\"radio\" name=\"".$this->Name."\"".$idradio."  value=\"".$this->arrayValue[$numRadio]."\" onClick=\"$actionJS\" ";
    	if($this->arrayValue[$numRadio]==$this->valueSelected){
    		echo "checked=\"checked\" /> ";
    		echo $libel;
    		echo $messageError;
    	}else{
    		echo " />$libel";
    		echo "$messageError";
    	}
    	
    	
    	//cas special créé un input du même type parce que le post disabled ne fonctionne pas.
    	if($this->active==0){
    		echo "<input type=\"hidden\" name=\"".$this->Name."\"".$idradio."  value=\"".$this->valueSelected."\" />";
    	}
    	
    }
        
}

//fonction n'appartenant pas à la classe: liste si un element du tableau=nom de la variable
	function existeErrorRadioA($tabl_variabError,$Name){
		$existeError=false;
		for($i=0;$i<count($tabl_variabError);$i++){    		
    		//echo $tabl_variabError[$i]."=".$Name;
    		if($tabl_variabError[$i]==$Name){    			
    			$existeError=true;
    			break;
    		}
    	}
    	return $existeError;
	}



//exemple
/*$mArrayValue=array('1','0');
$radio=new Radio("test",$mArrayValue,"1",0,0);
echo "coucou=".$radio->arrayValue[0]."<br/>";
$radio->setRadio(0,"test1");
echo"\r";
$radio->setRadio(1,"test2");*/
?>