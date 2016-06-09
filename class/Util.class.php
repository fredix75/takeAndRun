<?php

include_once('class/form/Button.class.php');
include_once('class/form/SelectAction.class.php');

class Util {

    function Util() {
    }	
	
	function stripAccents($string){
		return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ#°',
			'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY__');
	}
	
	function formatAccents($chaine){
		return $this->stripAccents($chaine);
	}
	
    function format_text_SQL($value){
       	$value=ereg_replace("'","''",$value);
        $value=ereg_replace('"',' ',$value);
        //supprime l'antislash de la requete car php le rajoute automatiquement
        $value=stripslashes($value);
		return $value;
	}
	
	//EXCEPTION DATE MYSQL on réorganise la date.
	function format_dateToSQL($dateFRA){
		$dateSQL=substr($dateFRA,6,4)."-".substr($dateFRA,3,2)."-".substr($dateFRA,0,2)." 00:00:00";
		return $dateSQL;
	}
	
	function format_text_PHP($value){
        //supprime l'antislash de la requete car php le rajoute automatiquement
        $value=stripslashes($value);
	 	return $value;
	}
	
	function mailInfo($objet,$corps_mail,$headers="",$from){
		 mail ('fred_ric@hotmail.com', $objet , $corps_mail, $headers.'from : '.$from);
	}
	
	function mailUtilisateur($email, $objet,$corps_mail, $headers="",$from){
		 mail ($email, $objet , $corps_mail, $headers.'from : '.$from);
	}
	
	//créée une date aujourd'hui pour insertion SQL
	function dateTodaySQL(){
		$date = date("d/m/Y");
		$heure= date("H:i");
		
		$dayStr=substr($date,0,2); //le jour
		$monthStr=substr($date,3,2); //le mois
		$yearStr=substr($date,6,4); //annee
		$heureStr=substr($heure,0,2);//heure
		$minStr=substr($heure,3,2);//mn
		//transformation au format php universel
		$dateTimeStamp=mktime((int)$heureStr, (int)$minStr, 0,(int)$monthStr ,(int)$dayStr,(int)$yearStr);
		//echo"test $dayStr/$monthStr/$yearStr ";
		//transformation au format SQL
		$myDate=date("Y-m-d H:i:s.0",$dateTimeStamp);		
		return $myDate;
	}
	
	//créée une date simple sans min aujourd'hui pour insertion SQL
	function dateTodaySQL2(){
		$date = date("d/m/Y");
		$heure= date("H:i");
		
		$dayStr=substr($date,0,2); //le jour
		$monthStr=substr($date,3,2); //le mois
		$yearStr=substr($date,6,4); //annee
		$heureStr=substr($heure,0,2);//heure
		$minStr=substr($heure,3,2);//mn
		//transformation au format php universel
		$dateTimeStamp=mktime((int)$heureStr, (int)$minStr, 0,(int)$monthStr ,(int)$dayStr,(int)$yearStr);
		//echo"test $dayStr/$monthStr/$yearStr ";
		//transformation au format SQL
		$myDate=date("Y-m-d",$dateTimeStamp);		
		return $myDate;
	}
	
	//CREE UNE DATE QUI PERMET D'AJOUTER SUPPRIMER DES MIN,HEURE etc
	function dateTodaySQLPlusMinus($val,$type,$operation){
		$date = date("d/m/Y");
		$hour= date("H:i");
		
		$dayStr=(int)substr($date,0,2); //le jour
		$monthStr=(int)substr($date,3,2); //le mois
		$yearStr=(int)substr($date,6,4); //annee
		$hourStr=(int)substr($hour,0,2);//heure
		$minStr=(int)substr($hour,3,2);//mn
		//transformation au format php universel
		if($type=="year"){
			if($operation=="+"){
				$yearStr=$yearStr+$val;	
			}
			if($operation=="-"){
				$yearStr=$yearStr-$val;	
			}
		}else if($type=="month"){
			if($operation=="+"){
				$monthStr=$monthStr+$val;	
			}
			if($operation=="-"){
				$monthStr=$monthStr-$val;	
			}
		}else if($type=="day"){
			if($operation=="+"){
				$dayStr=$dayStr+$val;	
			}
			if($operation=="-"){
				$dayStr=$dayStr-$val;	
			}
		}else if($type=="hour"){
			if($operation=="+"){
				$hourStr=$hourStr+$val;	
			}
			if($operation=="-"){
				$hourStr=$hourStr-$val;	
			}
		}else if($type=="min"){
			if($operation=="+"){
				$minStr=$minStr+$val;	
			}
			if($operation=="-"){
				$minStr=$minStr-$val;	
			}
		}
		
		$dateTimeStamp=mktime($hourStr, $minStr, 0,$monthStr ,$dayStr,$yearStr);
		//transformation au format SQL
		$myDate=date("Y-m-d H:i:s.0",$dateTimeStamp);
		return $myDate;
	}
	
	//CREE UNE DATE QUI PERMET D'AJOUTER SUPPRIMER DES MIN,HEURE etc
	function dateSQLPlusMinus($datedmYHi,$val,$type,$operation,$french=null){		
		
		if(!is_null($french)){
			$yearStr=(int)substr($datedmYHi,6,4); //annee
			$monthStr=(int)substr($datedmYHi,3,2); //le mois
			$dayStr=(int)substr($datedmYHi,0,2); //le jour	
		}else{
			$yearStr=(int)substr($datedmYHi,0,4); //annee
			$monthStr=(int)substr($datedmYHi,5,2); //le mois
			$dayStr=(int)substr($datedmYHi,8,2); //le jour
		}		
			$hourStr=(int)substr($datedmYHi,11,2);//heure
			$minStr=(int)substr($datedmYHi,14,2);//mn	
		
		//transformation au format php universel
		if($type=="year"){
			if($operation=="+"){
				$yearStr=$yearStr+$val;	
			}
			if($operation=="-"){
				$yearStr=$yearStr-$val;	
			}
		}else if($type=="month"){
			if($operation=="+"){
				$monthStr=$monthStr+$val;	
			}
			if($operation=="-"){
				$monthStr=$monthStr-$val;	
			}
		}else if($type=="day"){
			if($operation=="+"){
				$dayStr=$dayStr+$val;	
			}
			if($operation=="-"){
				$dayStr=$dayStr-$val;	
			}
		}else if($type=="hour"){
			if($operation=="+"){
				$hourStr=$hourStr+$val;	
			}
			if($operation=="-"){
				$hourStr=$hourStr-$val;	
			}
		}else if($type=="min"){
			if($operation=="+"){
				$minStr=$minStr+$val;	
			}
			if($operation=="-"){
				$minStr=$minStr-$val;	
			}
		}
		
		$dateTimeStamp=mktime($hourStr, $minStr, 0,$monthStr ,$dayStr,$yearStr);
		//transformation au format SQL
		$myDate=date("Y-m-d H:i:s.0",$dateTimeStamp);
		return $myDate;
	}
	
	
	//fonction qui fixe le jour ouvrable à J+ $j près
	function dateTodayOuvrablePHP($J, $PlusMoins){
		$valeur=date("d/m/Y");
		
		$jPlusJ = mktime(0, 0, 0, date("m") , date("d") + $J, date("Y"));
		$jourDate=date("l",$jPlusJ);
		
		if($jourDate=="Saturday"){
			if($PlusMoins=="plus"){
				$jPlusJ = mktime(0, 0, 0, date("m") , date("d") + $J+2, date("Y"));	
			}else{
				$jPlusJ = mktime(0, 0, 0, date("m") , date("d") + $J-1, date("Y"));
			}
		}
		
		if($jourDate=="Sunday"){
			if($PlusMoins=="plus"){
				$jPlusJ = mktime(0, 0, 0, date("m") , date("d") + $J+1, date("Y"));
			}else{
				$jPlusJ = mktime(0, 0, 0, date("m") , date("d") + $J-2, date("Y"));
			}
		}
		
		//echo $valeur;//affiche la date au format français
		$jourDate=date("d/m/Y",$jPlusJ);
		return $jourDate;
	}
	
	//fonction qui rajoute des jours à une date SQL
	function datePlusNDayPHP($J,$dateSQL,$formatPHP=false){
		$valeur=date("d/m/Y",strtotime($dateSQL));
		$dayStr=substr($valeur,0,2); //le jour
		$monthStr=substr($valeur,3,2); //le mois
		$yearStr=substr($valeur,6,4); //annee		
		$jPlusJ = mktime(0, 0, 0, (int)$monthStr ,(int)$dayStr + $J, (int)$yearStr);
		//echo $valeur;//affiche la date au format français
		if($formatPHP==false){
			$jourDate=date("d/m/Y",$jPlusJ);
		}else{			
			$jourDate=$jPlusJ;
		}
		return $jourDate;
	}

	function dateSQLtoAffiche($dateSQL,$heure=null){
		$myDate=substr($dateSQL,8,2)."/".substr($dateSQL,5,2)."/".substr($dateSQL,0,4);
		if($myDate=="//"){
			$myDate="--/--/----";
		}
		
		if($heure){
			$myDate.=" ".substr($dateSQL,11,5);
		}
		
		return $myDate;
	}
	
	
	//Date SQL en PHP
	function datePHP($dateSQL){
		$valeur=date("d/m/Y",strtotime($dateSQL));
		$dayStr=substr($valeur,0,2); //le jour
		$monthStr=substr($valeur,3,2); //le mois
		$yearStr=substr($valeur,6,4); //annee		
		$datePHP = mktime(0, 0, 0, (int)$monthStr ,(int)$dayStr, (int)$yearStr);
		return $datePHP;
	}
	
	//Date SQL en PHP
	function boolToText($value){
		$text="";
		switch ($value){
			case "-1":
				$text="";
			break;
			case "0":
				$text="Non";
			break;
			case "1":
				$text="Oui";
			break;
		}
		return $text;
	}
	
	//fonction qui complete le vide par un 0 ou etc...
	function completeVide($element,$tailleFixe,$valeurACombler){
		//calcule le vide à combler
		$videRestant=$tailleFixe-strlen($element);
		for($i=0;$i<$videRestant;$i++){
			$element=$valeurACombler.$element;
		}
		return $element;
	}
	
	
	//fonction qui splite le tableau en plusieurs tableaux
	function splitResult($arrayResult,$nbLigneMax){
		$nbPages=(int)(count($arrayResult)/$nbLigneMax)+1;
		$newTableau=array();		
		$idTableau=0;
		$mySousTableau=array();
		
		//je parcoure tout le tableau de résultar
		$j=0;
		$tailleTab=count($arrayResult);
		for($i=0;$i<$tailleTab;$i++){
			//si le reste de nblignes/nbLignesMax==0 => incrémente indice du tableau.
			//par exemple nbligneMax=10=>  5 eme ligne/10

			if(is_int($i/$nbLigneMax)){
				//exception (pour caler exactement à idTableau=> on incrémente pas i des le départ.
				if($i>0){
					$newTableau[$idTableau]=$mySousTableau;
					$mySousTableau=array();
					$idTableau++;
				}
				$j=0;
			}

			//tableau à 3 dimensions:		
		
			$ligne=$arrayResult[$i];
			foreach($ligne as $key => $value){
				//$myLittleArray[$j]["$key"]=$value;
				$mySousTableau[$j]["$key"]=$value;
			}
			$j++;
		}
		$newTableau[$idTableau]=$mySousTableau;	
		return $newTableau;
	}
	
	
	//fonction qui créé les liens suivant et précédent.
	function displaySplitResult($idTab,$taille,$link1,$linkOptionnel=null){
		if($_GET['categorie']){
			$option='&categorie='.$_GET['categorie'];
		}elseif($_GET['tri']=='id'){
			$option='&tri=id';
		}
		$nbTab=$taille-1;
		$nbPage=$nbTab+1;
		$idPage=$idTab+1;
		$nexTab=$idTab+1;
		$prevTab=$idTab-1;
		
		$actif=1;
		
		//génère un tableau de numéro de Pages
		$arrayPages=array();
		for($i=1;$i<=$taille;$i++){
			$arrayPages[$i]=$i;
		}		
		
		//si le tableau a plus de 10 pages
		if($nbPage>15){
			if($idPage>1){
		?>		
				<a class="page" href="index.page.php?link=<?php echo$link1?>&idTab=0<?php echo$linkOptionnel.$option;?>">1</a>&nbsp;
				<a class="nextprev" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo$prevTab.$linkOptionnel.$option;?>">Precedent </a>&nbsp;
		<?php
			}
			echo $idPage;
		?>&nbsp;
		<?php
			if($idPage<$nbPage){
		?>
				<a class="nextprev" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo$nexTab.$linkOptionnel.$option;?>">Suivant </a>&nbsp;
				<a class="page" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo$nbTab.$linkOptionnel.$option;?>"><?php echo$nbPage?></a>&nbsp;
		<?php
			}
		?>
		<br/>
		<?php	
		}else{
			for($k=0;$k<$taille;$k++){
				$l=$k+1;
				if($idTab==$k){
					echo $l; ?>&nbsp;
		<?php
				}else{
		?>
					<a class="page" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo $k.$linkOptionnel.$option; ?>"><?php echo$l?></a>&nbsp;
		<?php
				}
			}
		}
		?>
		<form action="index.page.php?link=accueil<?php echo $option; ?>" method=POST>
		<?php
			$selectPAGE=new SelectAction("PAGESELECT",$arrayPages,$idPage,$actif,$tabl_variabError);
			$selectPAGE->setSelect();
		
			$btnOK=new Button("Submit","ok_page","Ok",$actif);
			$btnOK->setButton();
		?>
		</form>
		<?php
	}
	
	
	function policeMiseEnform($chaine){
		$newChaine = strtolower($chaine);
		$newChaine[0] = strtoupper($newChaine[0]);
		return $newChaine;
	}
	
	function afficheTel($tel){
		$newTel="";
		if(!is_null($tel)){
			for($j=0 ; $j<10 ; $j++){
				if($j%2==0 && $j!=0) $newTel=$newTel.'.';
				$newTel=$newTel.$tel[$j];
			}
		}
		return $newTel;
	}
	
	function genPassword($length){
	   $password='';
	   $pattern = "1234567890abcdefghijklmnopqrstuvwxyzAZERTYUIOPMLKJHGFDSQWXCVBN";
	   for($i=0;$i<$length;$i++){
	        $password .= $pattern{rand(0,61)};
	   }
	   return $password;
	}
	
	//convertit 0 1 en non oui
	function radioToText($valeur){
		$text="";
		//echo $valeur;	
		if($valeur==="0"){
			$text="NON";
		}else if($valeur==1){
			$text="OUI";
		}
		return $text;
	}
	 
	
	function statValeurSaisies($tableauVariables, $tableauValeurs){
		$nbValTotal=count($tableauVariables);
	}
	
	function sortBySize($expression){
		$tab=explode('%',$expression);
		$tab2=array();
		foreach($tab as $key=>$val){
			$tab2[$key]=strlen($val);
		}
		asort($tab2);
		$res = array_keys($tab2,array_pop($tab2));
		$longest = $tab[$res[0]];
		return $longest;
	}

}
?>