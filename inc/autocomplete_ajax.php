<?php
/******************************************
# Auteur : Julien Theler - www.twiip.ch
# Contact : julien.theler@twiip.ch
# Licence : CC-by-nc
******************************************/
//Sécurité pour empêcher d'interroger la base librement : liste des table et des champs utilisables
/*
$check = array(
	'LIENVIDEO' => array('AUTEUR')
);

$table = (isset($_GET['table']) ? $_GET['table'] : '');
$field = (isset($_GET['field']) ? $_GET['field'] : '');
$search = (isset($_GET['search']) ? $_GET['search'] : '');

if(isset($check[$table]) && in_array($field, $check[$table])){ //Vérification
	if($table && $field && $search){
		$search = strtolower($search);
		$arrayResult=$gestion->getAutoComplete($table,$field,$search);
		header("content-type: application/xml;charset=utf-8");
		echo '<?xml version="1.0" encoding="UTF-8" ?>';
		echo '<suggests>';
		for($i=0; $i<count($arrayResult); $i++){
			echo utf8_encode('<suggest>'.$arrayResult[$i].'</suggest>');
		}
		echo '</suggests>';
//		print_r($arrayResult);
	}
}
else{
	die('Requête interdite');
}*/
$table="LIENVIDEO";
$field="AUTEUR";
$search="be";
$arrayResult=$gestion->getAutoComplete($table,$field,$search);
//print_r($arrayResult);
header('Content-Type: text/xml;charset=utf-8');
echo(utf8_encode("<?xml version='1.0' encoding='UTF-8' ?><options>"));
echo "<animaux>";
echo "<dauphin>";
echo "truc";
echo "</dauphin>";
echo "</animaux>";
/*
if (isset($_GET['debut'])) {
    $debut = utf8_decode($_GET['debut']);
} else {
    $debut = "";
}

$debut = strtolower($debut);
$liste=array();
for($i=0;$i<count($arrayResult);$i++){
	array_push($liste,$arrayResult[$i][0]);	
}
//print_r($liste);

function generateOptions($debut,$liste) {
    $MAX_RETURN = 10;
    $i = 0;
    foreach ($liste as $element) {
        if ($i<$MAX_RETURN && substr($element, 0, strlen($debut))==$debut) {
            echo(utf8_encode("<option>".$element."</option>"));
            $i++;
        }
    }
}

generateOptions($debut,$liste);

echo("</options>");*/
?>
