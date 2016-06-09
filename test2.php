<?php

$wikipediaURL = 'http://nfactory.comlu.com/index.page.php?link=accueil';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $wikipediaURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Le blog de Samy Dindane (www.dinduks.com)');
$resultat = curl_exec ($ch);
curl_close($ch);

$page=new DOMDocument();
$page->loadHTML($resultat);
//echo $resultat;
//print_r($page->saveHTML());
/*
foreach($page->getElementsByTagName('div') as $div){
	if($div->getAttribute('id') == "node-1130473"){
		$description = '<p>' . $div->getElementsByTagName('p')->item(0)->nodeValue. '</p>';
		
	}
}

echo $description;

*/


?>