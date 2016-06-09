<?php
/***
 * Classe géniale qui permet de faire une insertion ou update en fonction de la situation
*********/
//include_once("NewHistory.class.php");

class NewInsertSQL {
var $requete;
var $lastID; 

    function NewInsertSQL($table,$variables, $variablesForm) {
    	$util=new Util();
 		$myDateToday=$util->dateTodaySQL();
		$queryMYSQL=new QueryMYSQL();	
		
		//cette requete me sert à savoir le nom des champs de la table ainsi que le type.
		$queryShowCol="show columns from $table";
		//echo "nbCol=".$queryShowCol."<br/>";
		$result=$queryMYSQL->select($queryShowCol);
		/*echo"<br/>result=";
		print_r($result);*/
		
		/********REQUETE INSERT OU PAS avec UPDATE*****************/	
		$queryColumn = "";
		$queryValue = "";
		$arrayQUpdate = array();
		$l=0; //compteur des  champs à updater.
		
		//parcourt la liste des champs de la base de donnée		
		for($i=0;$i<count($result);$i++){
			$nomChampSQL = $result[$i][0];
			$extra = $result[$i][5]; //si autoincrement
			$key =  $result[$i][3]; // si cle primaire
			//echo"champSQL=$nomChampSQL<br/>";

			//parcourt la liste des variables de la classe
			for($j=0;$j<count($variables);$j++){
				//Nom de variable complet
				$nomVariableL = $variables[$j][0];
				//cherche position du _
				$pos = strpos($nomVariableL,'_');
				//Nom de variable court
				$nomVariableS = substr($nomVariableL,$pos+1);
				//echo"<br/>extra $i =$extra<br/>";
				//echo "<br/> nomChampSQL $nomChampSQL $i ?= nomVariableS $nomVariableS $j<br/>";

				//Si correspondance nom SQL et nom de variable transformation des valeurs en fonction du type de champ dans la base.
				//echo "nomVariableS=$nomVariableS<br/>";
				if($nomVariableS==$nomChampSQL){
					//cherche le type de variable pour savoir si on met une quote ou pas.
					//valeur du champ
					//echo"champ correspondu=$nomChampSQL<br/>";
					$variableValue=$variablesForm["$nomVariableL"];
					
					//si c'est du type date
					if(is_int(strpos($result[$i][1],"datetime"))){
						
						//echo"<br/>testDateAffichee=".$variablesForm["$varValue"]."<br/>";
						if($variableValue==""){
							$variableValue="NULL";
						}else{
							$quote="'";
						//EXCEPTION DATE MYSQL on réorganise la date.
						//CAS des DM à afficher
				    	//DM/DM/DM						    	
				    	$myDay=substr($variableValue,0,2);
				    	$myMonth=substr($variableValue,3,2);
				    	$myYear=substr($variableValue,6,4);

				    	if(strtoupper($myDay)==="DM"){
							$myDay="00";
				    	}
				    	if(strtoupper($myMonth)==="DM"){
							$myMonth="00";
				    	}
				    	if(strtoupper($myYear)==="DM"){
							$myYear="0000";
				    	}
						$variableValue="$myYear-$myMonth-$myDay 00:00:00";
						}
					}
					//si la variable est de type texte
					if(is_int(strpos($result[$i][1],"varchar"))||is_int(strpos($result[$i][1],"text"))){
						$quote="'";
					}
					//echo "$nomVariable==$nomChampSQL ".$variableValue."<br/>";
					
					//fchau Mettre 3 "="!!! SINON NE RENTRE PAS DANS LA BONNE CONDITION!!!!
					//si c'est un nombre 
					if(is_int(strpos($result[$j][1],"smallint"))||is_int(strpos($result[$j][1],"tinyint"))
					||is_int(strpos($result[$j][1],"int"))||is_int(strpos($result[$j][1],"float"))){
						if($variableValue=="" && $variableValue!==0){
							$variableValue="NULL";							
						}
						if(strtoupper($variablesForm["$varValue"])==="DM"){
							$variablesForm["$varValue"]="-2";
						}
						if(strtoupper($variablesForm["$varValue"])==="NA"){
							$variablesForm["$varValue"]="-3";
						}
					}

					//vire ou transforme les quotes en correct.
					$variableValue=mysql_real_escape_string($variableValue);
					//rajoute les quotes necessaires
					$variableValue=$quote.$variableValue.$quote;

					
					if($extra=="auto_increment"){
						echo"entre dans autoincrement clef unique<br/>";
						//echo "value=$value<br/>";
						//si value vide, ne concatene pas les parametres cles et va autoincrementer
						if($variableValue=="NULL"){
							
						}else{//on va concatener si la cléf unique est vide
							//concatenation des colonnes
							$queryColumn = $queryColumn.$nomVariableS.", ";
							//concatenation des valeurs		
							$queryValue = $queryValue.$variableValue.", ";
	
							//concatenation des champs=valeurs
							$arrayQUpdate[$l]=$nomVariableS."=".$variableValue;
							$l++;
						}
					}else{
						$queryColumn = $queryColumn.$nomVariableS.", ";
						//concatenation des valeurs		
						$queryValue = $queryValue.$variableValue.", ";

						//concatenation des champs=valeurs
						$arrayQUpdate[$l]=$nomVariableS."=".$variableValue;
						$l++;
					}
				}
			}
		}
		
		$queryColumn = $queryColumn."date_insert";
		//echo "queryColumn= $queryColumn<br/>";
		//echo "queryValue= $queryValue<br/>";
		
		print_r($arrayQUpdate);
		//echo "<br/>taille arrayQUpdate=".count($arrayQUpdate)."<br/>";
		$strQueryUpdate="";
		for($k=0;$k<count($arrayQUpdate);$k++){
			$strQueryUpdate=$strQueryUpdate.$arrayQUpdate[$k].", ";
			//echo "strQueryUpdate=$strQueryUpdate<br/>";
		}
		$strQueryUpdate=$strQueryUpdate." date_insert='$myDateToday'";

		$this->requete = "INSERT INTO $table ($queryColumn) VALUES ($queryValue'$myDateToday') " .
				"ON DUPLICATE KEY UPDATE $strQueryUpdate;";
		echo $this->requete."<br/>";
		$queryMYSQL->query($this->requete);

/***********************************************************************************************/

		/************GESTION DE L'HISTORIQUE***********************/
		//$myHistory=new NewHistory($this->requete);
		/**********************************************************/

    }
}
?>