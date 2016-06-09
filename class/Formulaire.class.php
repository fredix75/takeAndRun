<?php
include_once ("QueryMYSQL.class.php");
include_once ("Util.class.php");



class Formulaire {
//Liste des variables de la base de données
//$variable est le tableau des variables utilisées dans le formulaire (nom, type de composant html, le test, le msg erreur)
var $variables = array();
//$variablesForm est le tableau des variables avec la clé et la valeur.
var $variablesForm = array();

var $tabl_variabError;
var $testVal=true;

    function Formulaire() {

    }
    
    //fonction qui recolte les valeurs postees en valeur de classe 
    //il recupere les vlauer de poste pour les ranger dans le tableau variablesForm avec les clé adequate
    function recupereVal(){
    	
    	/**pour chaque element de la liste des variables definies (variables), 
    	variablesForm est un tableau qui recupere le post et la valeur.**/ 
 		for($i=0;$i<=count($this->variables);$i++){
 			$cle=$this->variables[$i][0];			
 			$post=$this->variables[$i][0];
 			
 			//Spécificité CheckBox parce que sa valeur est on
			if($this->variables[$i][1]=="checkbox"){
				if($_POST["$post"]=="on"){
					$_POST["$post"]=1;
				};
			}
 			//echo $cle.'-'.$_POST["$post"].'<br>';
 			//mise en majuscule:
 			$this->variablesForm["$cle"]=$_POST["$post"]; 			
 			
			/*if($this->variablesForm["$cle"]==""){
				$this->variablesForm["$cle"]=-1;
 			}*/
 		}
    	/*foreach($this->variablesForm as $key => $value){
    		echo "cle=".$key.", valeur=".$value."<br/>";
    	}*/
    }
    
     //fonction qui recolte les valeurs postees en valeur de classe de tableaux dynamiques 
    function recupereValTabDyn($nom_inputNbLignes){

    	/**pour chaque element de la liste des variables definies (variables), 
    	variablesForm est un tableau qui recupere le post et la valeur.**/
    	//global $tailleChamps;
    	 
 		for($i=0;$i<count($this->variables);$i++){
 			$cle=$this->variables[$i][0];
 			$post=$this->variables[$i][0];
 			//echo "cle=".$cle.", post=".$post."<br/>";
 			
 			$myPost=$_POST["$post"];
 			//echo $myPost."<br/>"; 
 			
 			//on est obligé de récupérer la val de input NbLignes parce que count($myPost)ne donne pas un nb correct pour checkbox. 
 			$tailleChamps=$_POST["$nom_inputNbLignes"];
 			//echo "tailleChamps=$tailleChamps<br/>";
 			
 			//Spécificité CheckBox parce que sa valeur est on		
			if($this->variables[$i][1]=="checkbox"){
				for($j=1;$j<=$tailleChamps;$j++){
					//echo "post[$post]=".$myPost[$j]." <br/>";
					if($myPost[$j]=="on"){
						$myPost[$j]=1;
					};
				}
			}
 			//echo $cle.'-'.$myPost.'<br>';
 			$this->variablesForm["$cle"]=$myPost;
 		}
    	/*foreach($this->variablesForm as $key => $value){
    		//$taille=count($value);
    		echo "tailleChamps=$tailleChamps<br/>";
    		//echo "tailleDeTDuChamp=count($key)$taille<br/>";
    		for($i=1;$i<=$tailleChamps;$i++){
    			echo "cle=".$key."[$i], valeur=".$value[$i]."<br/>";	
    		}
    	}*/
    	
    	return (int)$tailleChamps;
    }
    
    
    //function organise les valeurs postees dans un array
 	function getPosted(){
		//$arrayPosted=$this->variablesForm; 	
		
		//Boucle à mettre en commentaire si pronlème de performance
 		//Résoud le problème de backslash - remplace le $arrayPosted=$this->variablesForm;
		for($i=0;$i<count($this->variables);$i++){
 			$cle=$this->variables[$i][0];
 			//if(is_string($this->variablesForm["$cle"])){
 			if($this->variables[$i][1]=="input" || $this->variables[$i][1]=="textarea"|| $this->variables[$i][1]=="select"){
 				$arrayPosted["$cle"]=stripslashes($this->variablesForm["$cle"]);
 			}else{
 				$arrayPosted["$cle"]=$this->variablesForm["$cle"];
 			}
 		}
 			
 		$arrayPosted["actif"]=1;
 		
 		//on doit retraiter le posted parce que -1 doit etre traité en tant que vide pour le texte
 		/*foreach($this->variablesForm as $key => $value){
    		echo "cle=".$key.", valeur=".$value."<br/>";
    	}*/
 		return $arrayPosted;
 	}
 	
 	//function organise les valeurs postees dans un array
 	function getPostedDyn($nom_inputNbLignes){
 		$variablesFormSpec=array();
 		//$arrayPosted=$this->variablesForm; 		
 		
 		$tailleChamps=$_POST["$nom_inputNbLignes"]; 		
 		
 		//Boucle à mettre en commentaire si pronlème de performance
 		//Résoud le problème de backslash - remplace le $arrayPosted=$this->variablesForm;
 		for($i=0;$i<count($this->variables);$i++){
 			$cle=$this->variables[$i][0];
 			for($j=1;$j<=$tailleChamps;$j++){
	 			//if(is_string($this->variablesForm["$cle"])){
	 			if($this->variables[$i][1]=="input" || $this->variables[$i][1]=="textarea"){
	 				$arrayPosted["$cle"][$j]=stripslashes($this->variablesForm["$cle"][$j]);
	 			}else{
	 				$arrayPosted["$cle"][$j]=$this->variablesForm["$cle"][$j];
	 			}
 			}
 		}
 		
 		for($i=1;$i<=$tailleChamps;$i++){
 			foreach($arrayPosted as $key => $value){
 				$cle=$key."[$i]"; 				
				$nomVariableDyn=$key."[$i]";
				$variablesFormSpec["$nomVariableDyn"]=$value[$i];
			}
 		}
		
		$variablesFormSpec["actif"]=1;
 		return $variablesFormSpec;
 	}
 	
 	
    
    //fonction qui place les valeurs de la base dans un array et arrange les resultat en remplacant  les -1 et les null par ""
    function getVal($arrayResult){
		//echo count($arrayResult)."<br/>";
		//echo $arrayResult[0]['visite ']."<br/>";
		
		//on parcourt le tableau des variables, et on compare avec le nom de arrayResult   
		//RQ normalement le arrayResult ne renvoie qu'une seule ligne
		for($i=0;$i<=count($this->variables);$i++){
			$pos=strpos($this->variables[$i][0],'_');
			$nomVariable=substr($this->variables[$i][0],$pos+1);
			$vraiNomVariable=$this->variables[$i][0];
			
			//echo "nomVariable=$nomVariable<br/>";
			//parcourt le tableau des valeurs de la base
			for($j=0;$j<count($arrayResult);$j++){
				//foreach($arrayResult[$j] as $key => $value){
				foreach($arrayResult[0] as $key => $value){
    				//echo "KEY=".$key.", valeur=".$value."<br/>";
    				
    				if($nomVariable==$key){    		 						
 						//exception de la date, reconversion en format / /.
 						if($this->variables[$i][1]=="inputDate"){
 							if($value=="" or is_null($value)){
 								$value=""; 								
 							}else{
 								//CAS des DM à afficher
						    	//DM/DM/DM						    	
						    	$myDay=substr($value, 8, 2);
						    	$myMonth=substr($value, 5, 2);
						    	$myYear=substr($value, 0, 4);
						    	
						    	//echo "test $myDay/$myMonth/$myYear<br/>";
						    	
						    	
						    	if($myDay==="00"){
									$myDay="DM";
						    	}
						    	if($myMonth==="00"){
									$myMonth="DM";
						    	}
						    	if($myYear==="0000"){
									$myYear="DM";
						    	}
 								//echo "value Date=$value<br/>";
 								$value="$myDay/$myMonth/$myYear";
 							}
 						}
 						
 						if($this->variables[$i][1]=="textarea"||$this->variables[$i][1]=="input"){
 							if($value=="-1"){
 								$value="";
 							}
 							if($value=="-2"){
 								$value="DM";
 							}
 						}

 						$this->variablesForm["$vraiNomVariable"]=$value;
 						//echo $vraiNomVariable." ".$value."<br/>";
    				}
    			}
			}
		}
		

 		$arrayDataBase=$this->variablesForm;
 		$arrayDataBase["actif"]=1;
 		//echo count($arrayDataBase)."<br/>";
 		//print_r($arrayDataBase);
 		return $arrayDataBase;
    }
    
    
    //fonction qui place les valeurs de la base dans un array pour un tableau dynamique
    function getValDyn($arrayResult){
		
		//on parcourt le tableau des variables, et on compare avec le nom de arrayResult   
		//RQ normalement le arrayResult ne renvoie qu'une seule ligne
			
			
			//echo "nomVariable=$nomVariable<br/><br/>"; 
			//parcourt le tableau des valeurs de la base
			//echo "taille arrayresult=".count($arrayResult)."<br/>";
			for($j=0;$j<count($arrayResult);$j++){
					
				foreach($arrayResult[$j] as $key => $value ){
					$k=$j+1;
					//echo "key=$key, valeur=".$value."<br/>";
					//$nom_variable=$key."[$k]";
					//echo "cle=$nom_variable, valeur=".$value."<br/>";
					//$resultmyPatientModif[$k]["$nom_variable"]=$value;
					
					for($i=0;$i<count($this->variables);$i++){
						$pos=strpos($this->variables[$i][0],'_');
						$nomVariable=substr($this->variables[$i][0],$pos+1);
						$vraiNomVariable=$this->variables[$i][0];						
						
						if($nomVariable==$key){
 						//echo "$k $nomVariable $key<br/>";
 						//exception de la date, reconversion en format / /.
 							if($this->variables[$i][1]=="inputDate"){
 								if($value==""){
 									$value="";
 								}else{
	 								$value=substr($value,8,2)."/".substr($value,5,2)."/".substr($value,0,4);
 								}
 							}
 					
 							if($this->variables[$i][1]=="textarea"||$this->variables[$i][1]=="input"){
 								if($value=="-1"){
 									$value="";
 								}
 							}

 						$nomVariableDyn=$vraiNomVariable."[$k]";
 						$this->variablesForm["$nomVariableDyn"]=$value;
						//echo "taille variableForm=".count($this->variablesForm);
 						}	
					}
				}
				//echo "taille variablesForm=".count($this->variablesForm)."<br/>";
			}			
			
		
		//echo "TEST".$arrayAjoutPatient['AP_centre'];
 		$arrayDataBase=$this->variablesForm;
 		$arrayDataBase["actif"]=1;
 		
 		/*foreach($arrayDataBase as $key => $value){
			$m=$k+1;
			echo "$key=$value <br/>";
 		}*/

 		return $arrayDataBase;
    }
    
    
    
    
    //teste les valeurs: on parcourt le tableau des variables et on teste si=1=> cherche si le post est vide.
    //verifier ke les valeur sont rentré et indiquent le message d'erreur 
    function testVal(){
    	$this->messageErreur="<strong>Vous devez effectuer la ou les modifications suivantes avant de valider le formulaire:</strong><br/>\r";
    	$this->testVal=true;   
   	//variable tableau erreur
    	$j=0;
    	for($i=0;$i<=count($this->variables);$i++){
    		//si il est specifie qu'on teste la variable=>test
    		$test=$this->variables[$i][2];
    		if($test==1){//si le composant est active 
    			$cle=$this->variables[$i][0];
 				$value=$this->variablesForm["$cle"];
    			//si texte on verifie que champ vide
    			//echo "$i $cle, $value<br/>";
    			if($this->variables[$i][1]=="textarea"||$this->variables[$i][1]=="input"/*||$this->variables[$i][1]=="radio"*/||$this->variables[$i][1]=="inputDate"/*||$this->variables[$i][1]=="checkbox"*/){
    				if($value==""){
    					$this->testVal=false;
    					$this->messageErreur=$this->messageErreur.$this->variables[$i][3]."<br/>\r";
    					//echo $this->messageErreur;					
    					$this->tabl_variabError[$j]=$cle;
    					//incremente le tableau des erreurs
    					/*echo $cle."<br/>";
    					echo $this->tabl_variabError[$j]."<br/>";*/
    					$j++;
    				}
    			}else{//cas non textes
    				if($value==-1||is_null($value)){
    					$this->testVal=false;
    					$this->messageErreur=$this->messageErreur.$this->variables[$i][3]."<br/>\r";
    					$this->tabl_variabError[$j]=$cle;
	    				//incremente le tableau des erreurs
    					//echo $cle."<br/>";
    					//echo $this->tabl_variabError[$j]."<br/>";
    					$j++;
    				}
    			}
    		}
    	}
    	return $this->testVal;
    }

	function testComplet($niveau=1, $myVar=null){
		for($i=0 ; $i<count($this->variables) ; $i++){
			$cle = $this->variables[$i][0];
			$value = $this->variablesForm["$cle"];
			$niveauVar = $this->variables[$i][4];
			//if($niveau==2) return 222;
			if(empty($myVar)){
				if($niveauVar==$niveau){
					$listValue=$this->variables[$i][5];
					if($listValue!="" && in_array($value, $listValue)){
						$listVar=$this->variables[$i][6][$value];
						$newNiveau=$niveau+1;
						for($j=0 ; $j<count($listVar) ; $j++){
							//return "'".$listVar[$j]."'";
							//return $newNiveau;
							$this->testComplet($newNiveau, $listVar[$j]);
						}
					}else{
						if($this->variables[$i][1]=="textarea"	||	$this->variables[$i][1]=="input"	||$this->variables[$i][1]=="radio"
						||$this->variables[$i][1]=="inputDate"	||	$this->variables[$i][1]=="checkbox"){
							if($value=="") return false;
						}else{
							if($value==-1) return false;
						}
					}
				}
			}else{
				//return 77;
				if($cle==$myVar && $niveau==$niveauVar){
					$listValue=$this->variables[$i][5];
					if($listValue!="" && in_array($value, $listValue)){
						$listVar=$this->variables[$i][6][$value];
						$newNiveau=$niveau+1;
						for($j=0 ; $j<count($listVar) ; $j++){
							$this->testComplet($newNiveau, $listVar[$j]);
						}
					}else{
						if($this->variables[$i][1]=="textarea"	||	$this->variables[$i][1]=="input"	||$this->variables[$i][1]=="radio"
						||$this->variables[$i][1]=="inputDate"	||	$this->variables[$i][1]=="checkbox"){
							if($value=="") return false;
						}else{
							if($value==-1) return false;
						}
					}
				}
			}
		}
		//return "'FIN'";
		return true;
	}
}
?>