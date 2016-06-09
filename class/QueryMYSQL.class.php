<?php
include_once("Util.class.php");

# 2007-11-02 fchau Classe générant une requête et stocke les données dans un array si c'est un select

 class QueryMYSQL {
    var $query,/*$myarray,*/$connect;
    var $hostname, /*$login, $password,*/ $dbname;
    var $myUtil;
    

#Constructeur du select: charge les param de la base,et la requête    
    function QueryMYSQL($base=null) {
      	
      	$projectAdress=session_name();
      	//SI LA SESSION LOGIN EXISTE SE CONNECTE A LA BASE EN FCTN DES COMPTES
		include("inc/connexionDb.php");

      	$id_connexion = mysql_connect ($hostname,$loginDb,$pwdDb);
      	$this->connect=$id_connexion;
		$access_db = mysql_select_db($dbname, $this->connect);
		
		//j'instancie mon objet util me permettra de faire un mail en cas d'erreur Sql';
		$this->hostname=$hostname;
		$this->dbname=$dbname;
		$this->myUtil=new Util();
    }

#Fonction de select        
    function select($query_select) {
	   	if(isset($_GET["debug"])){
			echo $query_select."<br/>";
		}
# execute la requete
		$query_result = mysql_query($query_select,$this->connect);
		
		if (!$query_result) {
    		die('<br/>Requête invalide : ' . mysql_error()."<br/>".$query_select);    		
		}
# fetch les donnees
		$i=0;
	  	while($dataLigne=mysql_fetch_array($query_result,MYSQL_NUM)){
	  		for($j=1;$j<=count($dataLigne);$j++){
	  			$k=$j-1;	  		
	  			//$this->myarray[$i][$k]= $dataLigne[$k];
	  			$myarray[$i][$k]= $dataLigne[$k];
	  		}
	  		$i++;
		}
		//$result.="</suggests>";
# Fermer la connection
	  	//MYSQL_close($this->connect);	  	
	  	//return $this->myarray;
	  	if(isset($_GET["debug"])){
	  		print_r($myarray)."<br/>";
	  	}
	 	return $myarray;
    }
    

    
#Fonction de select  qui garde le nom des champs en tant qu'index.      
	function select_n($query_select){
		if(isset($_GET["debug"])){
			echo $query_select."<br/>";	
		}
		
		$query_result = mysql_query($query_select,$this->connect);
		if (!$query_result) {
    		die('<br/>Requête invalide : ' . mysql_error()."<br/>".$query_select);    		
		}
		
			  
	  	$i=0;
	  	if(mysql_num_rows($query_result)!=0)
	  		while($donnees=mysql_fetch_array($query_result,MYSQL_ASSOC)){
				if($donnees != null)
	  				foreach($donnees as $index => $value){
						//echo "<br />L'index est $index ";
        				//$this->myarray[$i][$index] = $value;
        				$myarray[$i][$index] = $value;
      				}
      			$i++;
	  		}
		//mysql_close($this->connect);
	  	//return $this->myarray;
	  	if(isset($_GET["debug"])){
	  		print_r($myarray)."<br/>";
	  	}
	  	
	  	return $myarray;
    }
    
    
#Fonction de requete autre (insert, update, delete...)        
	function query($query) {
# execute la requete
		echo $query."<br/>";
	  	$query_result = mysql_query($query,$this->connect);
	  	if (!$query_result) {

    		die('<br/>Requête invalide : ' . mysql_error()."<br/>".$query);    		
		}
	  	
    }       
 }
?>