<?php
//Je recupere le nom de mon dossier courant=> j'appellerai ma session come ça.
//$myDirectory=$mySessionName= substr(dirname($_SERVER['REQUEST_URI']),1);
/*
$myDirectory=$mySessionName="NFAC";
session_name($myDirectory);
session_start();
*/
include("class/QueryMYSQL.class.php");
$myUtil=new Util(); 
 
 //echo $_GET['q']; 
 $q=utf8_decode($_GET['q']);
 
 $my_data=@mysql_real_escape_string($q);

 $queryMYSQL=new QueryMYSQL();
 $query=" SELECT AUTEUR FROM LIENVIDEO WHERE AUTEUR like '$q%' GROUP BY AUTEUR ORDER BY AUTEUR";
 $query2=" SELECT TITRE, AUTEUR FROM LIENVIDEO WHERE TITRE like '$q%' ORDER BY TITRE";
 $resultat=$queryMYSQL->select_n($query); 
 $resultat2=$queryMYSQL->select_n($query2);
 
 if(count($resultat)>0 || count($resultat2)>0){
 	$max=(count($resultat)>count($resultat2))?count($resultat):count($resultat2);
 	for($i=0;$i<$max;$i++){
 		//echo "test $i".$query." ".$resultat[$i]["NOM"]."\n";	
 		echo $myUtil->stripAccents($resultat[$i]["AUTEUR"])."\n";
 		echo $myUtil->stripAccents($resultat2[$i]["TITRE"])."\n";
 	}

  }
?>