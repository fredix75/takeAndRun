<?php
/***
 * constructeur génial qui permet de faire une insertion ou update en fonction des parametres
du genre insert into table values (a,b,c)
ou update table set a=, b=, c= where(cond1 and cond2 etc...)
RQ: cette requete est spécifique  avec un id_pat et une visite?
*********/
//include_once("History.class.php");


class InsertSQL {
var $requete;  
var $lastID;  
    
    //fonction ConstructInsertSQL($table,$variables, $variables du formulaire,$where, insertion par id et non pas par visite)
    function InsertSQL($table,$variables, $variablesForm,$id=null) {
    	$util=new Util();
 		$myDateToday=$util->dateTodaySQL();
		$queryMYSQL=new QueryMYSQL();

		//cette requete me sert à savoir le nom des champs de la table ainsi que le type.
		$queryShowCol="show columns from $table";
		$result=$queryMYSQL->select($queryShowCol);

		if($id){
			$reqId=$id;
		}else{
			$queryInsert="insert into $table (date_insert) values ('".$myDateToday."')";			
			$queryMYSQL->query($queryInsert);
			$reqId=mysql_insert_id();
		}
		$queryWhere=" WHERE ID =".$reqId;
		$queryUpdate="update $table ";
		
		//parcoure le tableau des variables
		for($i=0;$i<count($variables);$i++){
			$pos=strpos($variables[$i][0],'_');
			$nomVariable=substr($variables[$i][0],$pos+1);
			//ce compteur est utile parce que le set n'est mis qu'une fois


			//parcoure le tableau des champs de la table
			for($j=0;$j<=count($result);$j++){
				$nomChampSQL=$result[$j][0];
				//echo "nomvariable=$nomVariable, champ=$nomChampSQL<br/>";
				if($nomVariable==$nomChampSQL){
					//echo "match<br/>";
					
					$k=$k+1;
					$set="";
					
					$varValue=$variables[$i][0];

					//met des quote ou pas
					$quote="";					
					
					if(is_int(strpos($result[$j][1],"datetime"))){
						
						//echo"<br/>testDateAffichee=".$variablesForm["$varValue"]."<br/>";
						if($variablesForm["$varValue"]==""){
							$variablesForm["$varValue"]="NULL";
						}else{
							$quote="'";
						//EXCEPTION DATE MYSQL on réorganise la date.
						//CAS des DM à afficher
				    	//DM/DM/DM						    	
				    	$myDay=substr($variablesForm["$varValue"],0,2);
				    	$myMonth=substr($variablesForm["$varValue"],3,2);
				    	$myYear=substr($variablesForm["$varValue"],6,4);

				    	if(strtoupper($myDay)==="DM"){
							$myDay="00";
				    	}
				    	if(strtoupper($myMonth)==="DM"){
							$myMonth="00";
				    	}
				    	if(strtoupper($myYear)==="DM"){
							$myYear="0000";
				    	}

						$variablesForm["$varValue"]="$myYear-$myMonth-$myDay 00:00:00";
						}
					}
					if(is_int(strpos($result[$j][1],"varchar"))){
						$quote="'";
					}
					if(is_int(strpos($result[$j][1],"text"))){
						$quote="'";
					}					
										
					if($k==1){
						$set="set ";
					}
					
					//fchau Mettre 3 "="!!! SINON NE RENTRE PAS DANS LA BONNE CONDITION!!!! 
					if(is_int(strpos($result[$j][1],"smallint"))||is_int(strpos($result[$j][1],"tinyint"))
					||is_int(strpos($result[$j][1],"int"))||is_int(strpos($result[$j][1],"float"))){
						if($variablesForm["$varValue"]=="" && $variablesForm["$varValue"]!==0){
							$variablesForm["$varValue"]="-1";						
						}
						if(strtoupper($variablesForm["$varValue"])==="DM"){
							$variablesForm["$varValue"]="-2";
						}					
					}				
					$queryUpdate=$queryUpdate." $set $nomChampSQL =$quote".$variablesForm["$varValue"]."$quote,";
				}
			}
		}

		//enleve la derniere virgule
		$queryUpdate=substr($queryUpdate,0,strlen($queryUpdate)-1);

    	$queryUpdate=$queryUpdate. ", date_insert='$myDateToday'";
    	
    	$queryUpdate=$queryUpdate.$queryWhere;
		
		$this->requete=$queryUpdate;
		echo $queryUpdate."<br/>";
		$queryMYSQL->query($this->requete);
		
    }
}
?>