<?php
//fchau CLASSE GENERANT LA BALISE SELECT VERSION 2 AVEC OU SANS JS
class SelectAction {

//parametres: nom du select, tableau de valeur, tableau de libellé, actif, valeurs obligatoires
//INDICATION POUR LES OPTGROUP:
/**EXEMPLE
  $arrayValueLibel14=array();
  $arrayValueLibel14[""]="-1";
  $arrayValueLibel14["optgroup1"]="Europe";    
  $arrayValueLibel14["France"]="1";
  $arrayValueLibel14["Espagne"]="2";
  $arrayValueLibel14["Angleterre"]="3";
  $arrayValueLibel14["/optgroup"]="";  
 */

	var $Name;
	var $arrayValueLibel;
	var $valueSelected;
	var $active;
	var $tabl_variabError;

    
    function SelectAction($Name, $arrayValueLibel,$valueSelected, $active, $tabl_variabError,$fileActionJS=null,$style=null) {
    	$this->Name=$Name;
    	$this->arrayValueLibel=$arrayValueLibel;
    	$this->valueSelected=$valueSelected;
    	if($this->valueSelected==""){
    		$this->valueSelected=-1;
    	}
    	$this->active=$active;
    	$this->style=$style;
    	
    	$this->tabl_variabError=$tabl_variabError;
    	if($fileActionJS!=""&&!is_null($fileActionJS)){
		 	$adresseJs="js/".$fileActionJS.".js";	    		
    		echo"<script src=\"$adresseJs\" type=\"text/javascript\"></script>\r";	
    	}
    }
    
    function setSelect($actionJS=null){
    	//echo "arrayValue[".$numRadio."]=".$this->arrayValue[$numRadio];
    	//echo "valueSelected=".$this->valueSelected."<br/>";
    	
    	//fonction ajoutant l'asterix erreur: liste si un element du tableau=nom de la variable
    	if(existeErrorSelectAction($this->tabl_variabError,$this->Name)==true){
    		$messageError="<font color=\"red\"><strong>*</strong></font>";	
    	}else{
    		$messageError="";
    	}   
    	
    	if($this->active==0){
    		$active="disabled=\"disabled\"";
    	}
    	
    	if($this->style!=""&& !is_null($this->style)){
    		$myStyle="style=\"".$this->style."\"";
    	}
    	
    	
    	//TIENS COMPTE DES ARRAY POUR LES TABLEAUX DYNAMIQUES
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
    	
    	//test affichage
    	/*echo"<select name=\"test\">";
    	foreach($this->arrayValueLibel as $key => $value){
    		//echo "key=$key, value=$value<br/>";
    		echo"<option value=\"".$value."\" >$key</option";
    	}
    	echo "</select>";*/
    	
    	echo "<select $active name=\"".$this->Name."\" id=\"$myID\" $myStyle ";
    	
		if($actionJS!=""||is_null($actionJS)){
			echo "onChange=\"$actionJS\"  ";
		}    	
      	echo ">\r";
      	
    	/*ANCIENNNE METHODE
    	 * for($i=0;$i<count($this->arrayValue);$i++){
    		echo " <option value=\"".$this->arrayValue[$i]."\" ";
    		if($this->arrayValue[$i]==$this->valueSelected){
    			echo " selected=\"selected\"";
    		}
    		echo ">".$this->arrayLibel[$i]."</option>\r";    		
    	}*/
    	
    	foreach($this->arrayValueLibel as $key => $value){	
    		//echo "position=".strpos($key, "optgroup")."<br/>";
    		
    		if(strpos($key, "optgroup")===0){
    			//$pos=strpos($key, "optgroup");
    			echo"<optgroup label=\"$value\">\r";
    		}else if(/*strpos($key, "/optgroup")===0*/ $key==="/optgroup"){
    			echo"</optgroup>\r";
    		}else{
    			echo "<option value=\"".$value."\" ";
    			if($value==$this->valueSelected){
    				echo " selected=\"selected\"";
    			}
    			echo ">$key</option>\r";
    		}
    	}
   	
    	echo "</select>$messageError";
    }
        
}

//fonction n'appartenant pas à la classe: liste si un element du tableau=nom de la variable
	function existeErrorSelectAction($tabl_variabError,$Name){
		$existeError=false;
		for($i=0;$i<count($tabl_variabError);$i++){
    		//echo "namevar=$Name, variabError=$tabl_variabError[$i]";
    		if($tabl_variabError[$i]==$Name){
    			$existeError=true;
    			break;
    		}
    	}
    	return $existeError;
	}

//exemple
/*
$myArrayValueLibel=array();
$myArrayValueLibel[""]=-1;
$myArrayValueLibel["TAMIFLU<br>(oseltamivir)"]=1;
$myArrayValueLibel["RELENZA<br>(zanamivir)"]=2;
$myArrayValueLibel["MANTADIX<br>(amantadine)"]=3;
$myArrayValueLibel["Autre"]=4;
$mySelectAction=new SelectAction("mySelectAction", $myArrayValueLibel,3, 1, $tabl_variabError);
$mySelectAction->setSelect("");
*/

?>