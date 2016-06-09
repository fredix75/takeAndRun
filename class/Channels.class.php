<?php

class Channel extends Formulaire{
	var $titre		=	array('CHANNEL_TITRE','input',1,"Cette cha�ne n'a pas de titre");
	var $auteur		=	array('CHANNEL_AUTEUR','input',1,"Cette cha�ne n'a pas d'auteur");
	var $lien		=	array('CHANNEL_LIEN','textarea',1,"Cette cha�ne n'a pas de lien");

	
	function Channel(){
		$this->variables=array($this->titre, $this->auteur, $this->lien);
	}
	
	function getAllVideo($num=null,$humeur=null){
		$queryMYSQL=new QueryMYSQL();
		$debut=($num)?$num.",":"";
		if($humeur){
			$where=" WHERE HUM1=".$humeur;
		}else{
			$where=" WHERE HUM1='0'";
		}
		// utilis� ds Gestion.
		// filtr� sur cat�gorie musique
		$req="SELECT * FROM LIENVIDEO ".$where." ORDER BY ID";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}

	function getVideo($id=null,$limit=null){
		$queryMYSQL=new QueryMYSQL();
		if($id){
			$where=" ID=".$id;
		}else{
			$where=" PRIORITE=1";
		}
		if($limit){
			$lim=" LIMIT ".$limit;
		}else{
			$lim=" LIMIT 7";
		}
		$req="SELECT * FROM LIENVIDEO WHERE".$where." ORDER BY RAND()".$lim;
		$res=$queryMYSQL->select_n($req);
		if(!$id && !$limit){
			$req2="SELECT * FROM LIENVIDEO WHERE PRIORITE=2 ORDER BY RAND() LIMIT 1";
			$res2=$queryMYSQL->select_n($req2);
			$res[7]=$res2[0];
		}elseif($id && !$limit){
			$res=parent::getVal($res);
		}else{
			$req2="SELECT * FROM LIENVIDEO WHERE PRIORITE=2 ORDER BY RAND() LIMIT 4";
			$res2=$queryMYSQL->select_n($req2);
			$res[28]=$res2[0];
			$res[29]=$res2[1];
			$res[30]=$res2[2];
			$res[31]=$res2[3];			
		}
		return $res;
	}
	
	function getCount($categorie=null,$genre=null,$periode=null,$annee=null){
		$queryMYSQL=new QueryMYSQL();
	
		$where=" WHERE 1";
		if($genre){
			$where .=" AND GENRE=".$genre;
		}elseif($categorie){
			$where .=" AND CATEGORIE=".$categorie;
		}elseif($periode){
			$where .=" AND PERIODE='".$periode."';";
		}elseif($annee){
			$where .=" AND ANNEE='".$annee."';";
		}
		if(($genre || $categorie) && $periode){
			$where.=" AND PERIODE='".$periode."';";
		}

		$query="SELECT COUNT(*) as COUNT FROM LIENVIDEO".$where;
		$res=$queryMYSQL->select_n($query);
		return $res;
	}
	 
	function getVideoChronol($debut){
		$queryMYSQL=new QueryMYSQL();
		if($_SESSION['group_user']==1){
			$order="ID ASC, ";
		}else{
			$where="WHERE PRIORITE=1 ";
		}
		$query="SELECT * FROM LIENVIDEO ".$where."ORDER BY ".$order."ID DESC LIMIT $debut,28";
		$res=$queryMYSQL->select_n($query);
		return $res;
	} 
	 
	function getVideoByCateg($categ,$debut=null,$id=null,$order=null,$genre=null){
		$queryMYSQL=new QueryMYSQL();
		if($_SESSION['group_user']!=1){
			$prio=" AND PRIORITE=1 ";
		}
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
		$req="SELECT * FROM LIENVIDEO WHERE ".$colonne.$categ.$prio.$not.$order." LIMIT ".$debut."28";
		$res=$queryMYSQL->select_n($req);
		return $res;
	}

	function getVideoByPeriode($periode,$debut=null,$id=null,$order=null){
		$queryMYSQL=new QueryMYSQL();
		if($debut) $debut .=',';
		if($_SESSION['group_user']!=1){
			$prio=" AND PRIORITE=1 ";
		}
		if($id){
			$not=" AND ID !=".$id;
		}
		if($order){
			$order=" ORDER BY RAND()";
		}else{
			$order=" ORDER BY ID DESC";
		}
		$query="SELECT * FROM LIENVIDEO WHERE PERIODE='".$periode."'".$prio.$not.$order." LIMIT ".$debut."28";
		$res=$queryMYSQL->select_n($query);
		return $res;
	}
	
	function getMultiC($requete){
		$queryMYSQL=new QueryMYSQL();
		$arrayRes=$queryMYSQL->select_n($requete);
		return $arrayRes;
	}
	
	function getVideoById($array){
		$queryMYSQL=new QueryMYSQL();
		$texte=" WHERE ID=".$array[0];
		if(count($array)>1){
			for($i=1;$i<count($array);$i++){
				$texte.=" OR ID=".$array[$i];
			}
		}
		$query="SELECT * FROM LIENVIDEO".$texte.";";
		$arrayRes=$queryMYSQL->select_n($query);
			// Mise en ordre du r�sultat de la requ�te
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
		$query="SELECT * FROM LIENVIDEO WHERE (LCASE(AUTEUR) LIKE LCASE('%".$myUtil->format_text_SQL($auteur)."%') OR LCASE(TITRE) LIKE LCASE('%".$myUtil->format_text_SQL($titre)."%')) AND ID !=".$id." ORDER BY RAND() LIMIT 5;";
		$arrayRes=$queryMYSQL->select_n($query);
		return $arrayRes;
	} 
	
	function verifyVideo($id=null){
		$myUtil=new Util();
		$queryMYSQL=new QueryMYSQL();
		if($id){
			$where="ID!=".$id." AND ";
		}		
		$query="SELECT * FROM LIENVIDEO WHERE ".$where."(LIEN='".$this->variablesForm['VIDEO_LIEN']."' OR (LCASE(AUTEUR) LIKE LCASE('%".$myUtil->format_text_SQL($this->variablesForm['VIDEO_AUTEUR'])."%') AND LCASE(TITRE) LIKE LCASE('%".$myUtil->format_text_SQL($this->variablesForm['VIDEO_TITRE'])."%')));";
		$arrayRes=$queryMYSQL->select_n($query);
		if (count($arrayRes)>0){
			return $arrayRes[0]['ID'];
		}else{
			return false;
		}		
	}
	
	 
	function setVideo($id=null){
		$lien1=stristr($this->variablesForm['VIDEO_LIEN'],'//');
   		$lien2=stristr($lien1,'?');
   		$lien3=str_replace($lien2,'',$lien1);
   		if(strripos($lien3,'"')){
   			$lien2=stristr($lien3,'\"');
   			$lien4=str_replace($lien2,'',$lien3);
   			$this->variablesForm['VIDEO_LIEN']=$lien4;
   		}else{
   			$this->variablesForm['VIDEO_LIEN']=$lien3;
   		}
   		$lien5="youtube.com/v/";
   		if(strripos($this->variablesForm['VIDEO_LIEN'],$lien5)){
   			$this->variablesForm['VIDEO_LIEN']=str_replace('/v/','/embed/',$this->variablesForm['VIDEO_LIEN']);
   		}
   		$test=$this->verifyVideo($id);
		if($test==false){
			$myqueryInsert= new InsertSQL('LIENVIDEO', $this->variables, $this->variablesForm,$id);
			return false;
		}else{
			return $test;
		}
	}	

	function removeVideo($id){
		$queryMYSQL=new QueryMYSQL();
		$query="DELETE FROM LIENVIDEO WHERE ID=".$id;
		$queryMYSQL->query($query);
	}

	function getAffichage($lien, $width, $height,$style=null){	
		$part="http://www.youtube.com/embed/";
		$part2="//www.youtube.com/embed/";
		$part3="http://www.dailymotion.com/embed/video/";
		$vid="http://www.youtube.com/v/";
		$vidDM="http://www.dailymotion.com/swf/";
		if(mb_substr($lien, 0, strlen($part))==$part){
			$vid.=substr($lien,strlen($part));
			$frame='<object type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" data="'.$vid.'&amp;rel=0" style="'.$style.'">';
			$frame.='<param name="movie" value="'.$vid.'&amp;rel=0" />';
			$frame.='<param name="allowfullscreen" value="true" />';
			$frame.='</object>';
		}elseif(mb_substr($lien, 0, strlen($part2))==$part2){
			$vid.=substr($lien,strlen($part2));
			$frame='<object type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" data="'.$vid.'&amp;rel=0" style="'.$style.'">';
			$frame.='<param name="movie" value="'.$vid.'&amp;rel=0" />';
			$frame.='<param name="allowfullscreen" value="true" />';
			$frame.='</object>';
		}elseif(mb_substr($lien, 0, strlen($part3))==$part3){
			$vid=$vidDM.substr($lien,strlen($part3));
			$frame='<object type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" data="'.$vid.'" style="'.$style.'">';
			$frame.='<param name="movie" value="'.$vid.'"></param>';
			$frame.='<param name="allowFullScreen" value="true"></param>';
			$frame.='<param name="allowScriptAccess" value="always"></param>';
			$frame.='</object>';
		}

		else{
		$frame="<iframe width='".$width."' height='".$height."' src='".$lien."?rel=0' frameborder=0 allowfullscreen style='".$style."'></iframe>";
	}				
		return $frame;
	}

	function getImgVideo($lien, $width, $height,$style=null){	
		$yt1="http://www.youtube.com/watch?v=";
		$yt2="&feature=youtube_gdata";
		$vid="http://img.youtube.com/vi/";
		if(mb_substr($lien, 0, strlen($yt1))==$yt1){
			$vid.=substr($lien,strlen($yt1));
			$vid=str_replace($yt2,'',$vid);
			$vid.="/0.jpg";
			$frame="<img src='".$vid."' width=".$width." height=".$height." />";
		}else{
			$frame=$this->getAffichage($lien, $width, $height,$style);
		}				
			return $frame;
	}

	function formatLink($lien){	
		$supp="&feature=youtube_gdata";
		$link=str_replace($supp,'',$lien);		
		return $link;
	}

	function chercher($mot){
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT * FROM LIENVIDEO WHERE LCASE(TITRE) LIKE LCASE('%".$mot."%') OR LCASE(AUTEUR) LIKE LCASE('%".$mot."%') OR LCASE(CHAPO) LIKE LCASE('%".$mot."%') OR LCASE(TEXTE) LIKE LCASE('%".$mot."%') ORDER BY ID DESC;";
		$arrayChercher=$queryMYSQL->select_n($query);
		return $arrayChercher;
	}

	function getStats($t){
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT $t, COUNT($t) FROM LIENVIDEO GROUP BY $t";
		$res=$queryMYSQL->select($query);
		return $res;
	}

}
?>