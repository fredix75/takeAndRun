<?php
//include('QueryMYSQL.class.php');
//include('Formulaire.class.php');
//include('InsertSQL.class.php');

class frise {

    function frise() {
    }
    
    function getCHEFDETAT($pays){
		$queryMYSQL=new QueryMYSQL();
    	$query="SELECT * FROM FRISE WHERE PAYS='".$pays."' ORDER BY DATE1";
    	$arrayRES=$queryMYSQL->select_n($query);
    	return $arrayRES;
    }
    
    function getREGIME($pays){
		$queryMYSQL=new QueryMYSQL();
    	$query="SELECT * FROM REGIMES WHERE PAYS='".$pays."' ORDER BY DEBUT ASC";
    	$arrayRES=$queryMYSQL->select_n($query);
    	return $arrayRES;
    }    
    
    function getColor($type){
    	switch($type){
			case "MONARCHIE":
				$bgcolor="yellow";
				break;
			case "TROUBLE":
				$bgcolor="red";
				break;
			case "EMPIRE":
				$bgcolor="orange";
				break;							
			case "REPUBLIQUE":
				$bgcolor="#33CCFF";
				break;
			case "FASCISME":
				$bgcolor="grey";
				break;
			default:
				$bgcolor="white";
				break;
		}
		return $bgcolor;
    }
}
?>