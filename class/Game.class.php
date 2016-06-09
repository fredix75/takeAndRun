<?php
class Game extends Formulaire{
	var $titre		=	array('GAME_TITRE','input',0,'');
	var $auteur		=	array('GAME_AUTEUR','input',0,'');
	var $lien		=	array('GAME_LIEN','textarea',0,'');
	var $chapo		=	array('GAME_CHAPO','textarea',0);
	var $categorie	=	array('GAME_CATEGORIE','select',0,'');
	var $genre		=	array('GAME_GENRE','select',0,'');
	var $annee		=	array('GAME_ANNEE','select',0,'');
	
	function Game(){
		$this->variables=array($this->titre, $this->auteur, $this->lien, $this->chapo, $this->categorie, $this->genre, $this->annee);
	}
	
	function getGame($id=null){
		$queryMYSQL=new QueryMYSQL();
		if($id){
			$where=" WHERE ID=".$id;
		}
		
		$req="SELECT * FROM GAME".$where." ORDER BY TITRE;";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}
	
	function getCount($categorie=null,$genre=null,$periode=null,$annee=null){
		$queryMYSQL=new QueryMYSQL();
		if($genre){
			$where=" WHERE GENRE=".$genre;
		}elseif($categorie){
			$where=" WHERE CATEGORIE=".$categorie;
		}elseif($periode){
			$where=" WHERE PERIODE='".$periode."';";
		}elseif($annee){
			$where=" WHERE ANNEE='".$annee."';";
		}
		if(($genre || $categorie) && $periode){
			$where.=" AND PERIODE='".$periode."';";
		}
		$query="SELECT COUNT(*) as COUNT FROM GAME".$where;
		$res=$queryMYSQL->select_n($query);
		return $res;
	}
	 
	function getGameChronol($debut){
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT * FROM GAME ORDER BY ID DESC LIMIT $debut,7";
		$res=$queryMYSQL->select_n($query);
		return $res;
	} 
	 
	function getGameByCateg($categ,$debut=null,$id=null,$order=null,$genre=null){
		$queryMYSQL=new QueryMYSQL();
		if($debut) $debut .=',';
		if($id){
			$not=" AND ID !=".$id;
		}
		if($order){
			$order=" ORDER BY RAND()";
		}else{
			$order=" ORDER BY ID DESC";
		}
		if($genre){
			$colonne="GENRE=";
			$categ=$genre;
		}else{
			$colonne="CATEGORIE=";
		}
		$req="SELECT * FROM GAME WHERE ".$colonne.$categ.$not.$order." LIMIT ".$debut."7";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}

	function getGameByPeriode($periode,$debut=null,$id=null,$order=null){
		$queryMYSQL=new QueryMYSQL();
		if($debut) $debut .=',';
		if($id){
			$not=" AND ID !=".$id;
		}
		if($order){
			$order=" ORDER BY RAND()";
		}else{
			$order=" ORDER BY ID DESC";
		}
		$query="SELECT * FROM GAME WHERE PERIODE='".$periode."'".$not.$order." LIMIT ".$debut."7";
		$res=$queryMYSQL->select_n($query);
		return $res;
	}
	
	function getMultiC($requete){
		$queryMYSQL=new QueryMYSQL();
		$arrayRes=$queryMYSQL->select_n($requete);
		return $arrayRes;
	}
	
	function getGameById($array){
		$queryMYSQL=new QueryMYSQL();
		$texte=" WHERE ID=".$array[0];
		if(count($array)>1){
			for($i=1;$i<count($array);$i++){
				$texte.=" OR ID=".$array[$i];
			}
		}
		$query="SELECT * FROM GAME".$texte.";";
		$arrayRes=$queryMYSQL->select_n($query);
			// Mise en ordre du résultat de la requête
		$res=array();
		for($i=0;$i<count($array);$i++){
			for($j=0;$j<count($arrayRes);$j++){
				if($arrayRes[$j]['ID']==$array[$i]){
					$res[$i]=$arrayRes[$j];
				}
			}
		}
		return $res;
	}
	
	function getRef($id,$auteur,$titre,$annee=null){
		$myUtil=new Util();
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT * FROM GAME WHERE (LCASE(AUTEUR) LIKE LCASE('%".$myUtil->format_text_SQL($auteur)."%') OR LCASE(TITRE) LIKE LCASE('%".$myUtil->format_text_SQL($titre)."%')) AND ID !=".$id." ORDER BY RAND() LIMIT 5;";
		$arrayRes=$queryMYSQL->select_n($query);
		/*
		if(count($arrayRes)<5){
			$limit=5-count($arrayRes);
			$queryANNEE="SELECT * FROM GAME WHERE ANNEE='".$annee."' AND ID !=".$id." ORDER BY RAND() LIMIT ".$limit.";";
			$arrayResANNEE=$queryMYSQL->select_n($queryANNEE);
			if($arrayResANNEE){
				array_push($arrayRes,$arrayResANNEE);
			}
		}*/
		return $arrayRes;
	} 
	 
	function setGame($id=null){
		/*$lien1=stristr($this->variablesForm['GAME_LIEN'],'http://');
   		$lien2=stristr($lien1,'?');
   		$lien3=str_replace($lien2,'',$lien1);
   		if(strripos($lien3,'"')){
   			$lien2=stristr($lien3,'\"');
   			$lien4=str_replace($lien2,'',$lien3);
   			$this->variablesForm['GAME_LIEN']=$lien4;
   		}else{
   			$this->variablesForm['GAME_LIEN']=$lien3;
   		}*/

		$myqueryInsert= new InsertSQL('GAME', $this->variables, $this->variablesForm,$id);
	}	

	function removeGame($id){
		$queryMYSQL=new QueryMYSQL();
		$query="DELETE FROM GAME WHERE ID=".$id;
		$queryMYSQL->query($query);
	}

	function getAffichage($lien, $width, $height,$style=null){
		$frame='<object style="visibility: visible;'.$style.'" id="flashcontent" data="'.$lien.'" type="application/x-shockwave-flash" height="'.$height.'" width="'.$width.'"><param value="true" name="allowFullScreen"><param value="direct" name="wmode"></object>';
		return $frame;
	}

	function getCategorie($categ,$ok,$genre=null){
		switch($categ){
			case 1:
				$categorie="reflexion";
				$color="red";
				break;												
			default:
				$categorie="autre";
				$color="rgb(56,47,123)";
				break;
		}
		
		if($genre){
			switch($genre){
				case 1:
					$style="couleurs";
					$color2="rgb(23,45,69)";
					break;										
			}			
		}
		
		if($ok==0){
			$lien='<ul class="categorie">';
			$lien .='<a href="index.page.php?link=accueil&categorie='.$categ.'"><li style="color:'.$color.'">'.$categorie.'</li></a>';
			if($genre){
				$lien .='<a href="index.page.php?link=accueil&categorie='.$categ.'&genre='.$genre.'"><li style="color:'.$color2.'">'.$style.'</li></a>';
			}
			$lien .='</ul>';
		}else{
			if($genre){
				$lien='<ul class="categorie">';
				$lien .='<a href="index.page.php?link=accueil&categorie='.$categ.'&genre='.$genre.'"><li style="color:'.$color2.'">'.$style.'</li></a>';
				$lien .='</ul>';
			}
		}
		return $lien;
	}

	function chercher($mot){
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT * FROM GAME WHERE LCASE(TITRE) LIKE LCASE('%".$mot."%') OR LCASE(AUTEUR) LIKE LCASE('%".$mot."%') OR LCASE(CHAPO) LIKE LCASE('%".$mot."%') OR LCASE(TEXTE) LIKE LCASE('%".$mot."%') ORDER BY ID DESC;";
		$arrayChercher=$queryMYSQL->select_n($query);
		return $arrayChercher;
	}

	function getStats($t){
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT $t, COUNT($t) FROM GAME GROUP BY $t";
		$res=$queryMYSQL->select($query);
		return $res;
	}
}
?>