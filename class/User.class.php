<?php

class User {

    function User() {
    }
    
    
    function setUpdate(){
    	if($_POST['HUMEUR'] && $_POST['IDV']){
			$update="UPDATE LIENVIDEO SET HUM1='".$_POST['HUMEUR']."' WHERE ";
			foreach($_POST['IDV'] as $key =>$value){
				if($key!=0){
					$update.=" OR ";
				}
				$update .="ID=".$value;
			}
		}
    	$queryMYSQL=new QueryMYSQL();
    	$queryMYSQL->query($update);
    }
    
    function setVignette(){
    	$extensions_ok = array('png', 'gif');
		$directory = 'IMAGES/vignettes/';

		// vérifications du type
		$ext=substr(strrchr($_FILES['VIGNETTE']['name'], '.'), 1);
		if( !in_array($ext, $extensions_ok )){
			echo 'Veuillez sélectionner un fichier de type png ou gif!';
		}
	
		// si valable: formatage du nom et copie du fichier
		else{
			// formatage du nom
			$suffix=rand(1,999).".".$ext;
			$dest_fichier=$_FILES['VIGNETTE']['name'].$suffix;										

			// copie du fichier
			move_uploaded_file($_FILES['VIGNETTE']['tmp_name'], $directory.$dest_fichier);
		}
    }
    
    function getVignette($arg=null){
    	$extensions_ok = array('png', 'gif');
    	if($arg==2){
    		$directory = 'IMAGES/dossier/';
    	}else{
			$directory = 'IMAGES/vignettes/';
    	}
		$image = array();
		$image2 = array();
		$res=array();
		if ($dh = opendir($directory)){
			$i=1;
    		while (($file = readdir($dh)) !== false){
     			// Vérifie de ne pas prendre en compte les dossier ...
     			if ($file != '...' && $file != '..' && $file != '.' && in_array(substr(strrchr($file, '.'), 1), $extensions_ok )){				
      				$image[$i] = $file;
      				$stat=stat($directory.$file);
      				$image2[$i] = $stat[9];
     				$i++;
     			}
     		}
     		closedir($dh);
     		if($arg==false){	// affiche une vignette au pif
     			$total = count($image);
     			$aleatoire = rand(1, $total);
     			$image_afficher = $image[$aleatoire];
     			$res=$directory.$image_afficher;
     		}elseif($arg==1){  // affiche la dernière vignette
     			asort($image2);
     			$tab = array_keys($image2,array_pop($image2));
     			$image_afficher = $image[$tab[0]];
     			$res=$directory.$image_afficher;
     		}elseif($arg==2){	// affiche une vignette pécise (guitare)
     			$image_afficher ="guitare.png";
				$res=$directory.$image_afficher;
     		}elseif($arg==3){	// affiche tout le dossier
     			$res=$image;
     		}
	     	
	     	return $res;
		}
    }
    
    
    function getPortfolio($dossier){
    	$extensions_ok = array('png', 'gif','jpg','jpeg','JPG','JPEG');
    	$directory = 'IMAGES/portfolios/'.$dossier.'/';
		$image = array();
		$image2 = array();
		if (is_dir($directory) && $dh = opendir($directory)){
			$i=1;
    		while (($file = readdir($dh)) !== false){
     			// Vérifie de ne pas prendre en compte les dossier ...
     			if ($file != '...' && $file != '..' && $file != '.' && in_array(substr(strrchr($file, '.'), 1), $extensions_ok )){				
      				$image[$i] = $file;
      				$stat=stat($directory.$file);
      				$image2[$i] = $stat[9];
     				$i++;
     			}
     		}
     		closedir($dh);
     		
     		return $image;
   		}else{
   			return false;
   		}
    }

    function getImgAccueil(){
    	$extensions_ok = array('png', 'gif','jpg','jpeg','JPG','JPEG');
    	$directory = 'IMAGES/connect/';
		$image = array();
		$image2 = array();
		if ($dh = opendir($directory)){
				$i=1;
	    		while (($file = readdir($dh)) !== false){
	     			// Vérifie de ne pas prendre en compte les dossier ...
	     			if ($file != '...' && $file != '..' && $file != '.' && in_array(substr(strrchr($file, '.'), 1), $extensions_ok )){				
	      				$image[$i] = $file;
	      				$stat=stat($directory.$file);
	      				$image2[$i] = $stat[9];
	     				$i++;
	     			}
	     		}
	     		closedir($dh);
	   			$total = count($image);
	   			$aleatoire = rand(1, $total);
	   			$image_afficher = $image[$aleatoire];
	   			$res=$directory.$image_afficher;
	     		return $res;
	   		}
		
    }

	function getUsers(){
		$queryMYSQL=new QueryMYSQL();
		$query="SELECT * FROM UTILISATEUR WHERE ID_GROUP_USER=2";
		$arrayRes=$queryMYSQL->select_n($query);
		return $arrayRes;
	}    
    
    function sendMail(){
    	$headers = "MIME-Version: 1.0" . "\r\n";
     	$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
     	$corps = '<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<title>Message de '.$_SESSION['login'].'</title>
					</head>
					<body>
						<style type="text/css">
							.myFont {
								font-family: Calibri, Verdana, sans-serif;
							}
						</style>
						<p class="myFont">Message de '.$_SESSION['login'].'<br>
						  <br />'.
						  	$_POST['TEXTE']	
						.'</p> 
					</body>
				</html>';
	 	mail ("fred_ric@hotmail.com", $_POST['OBJET'] , $corps, $headers,'T&R Tribune');
    }

	function getAutoComplete($table, $field, $search){
		$queryMYSQL=new QueryMYSQL();
		$query = 'SELECT `'.$field.'` FROM `'.$table.'` WHERE lower(`'.$field.'`) LIKE "'.$search.'%" ORDER BY `'.$field.'`';
		$arrayResult=$queryMYSQL->select($query);
		return $arrayResult;
	}

function getTest(){
	$queryMYSQL=new QueryMYSQL();
	//$query = 'SELECT `'.$field.'` FROM `'.$table.'` WHERE lower(`'.$field.'`) LIKE "'.$search.'%" ORDER BY `'.$field.'`';
	$query="SELECT AUTEUR FROM LIENVIDEO WHERE lower(`AUTEUR`) LIKE 'bea%' ORDER BY `AUTEUR`"; 
	$arrayResult=$queryMYSQL->select_n($query);
	//header("content-type: application/xml");
	echo '<?xml version="1.0" encoding="iso-8859-1" ?>';
	echo '<suggests>';
	for($i=0;$i<count($arrayResult);$i++){
		echo '<suggest>'.$arrayResult[$i]['AUTEUR'].'</suggest>';
	}
	echo '</suggests>';
//	return $arrayResult;
}

	function getCategorie($categ,$ok,$periode=null,$genre=null){
		switch($categ){
			case 1:
				$categorie="animation";
				$color="red";
				$link="movies&categorie=$categ";
				break;				
			case 2:
				$categorie="musique";
				$color="rgb(25,65,63)";
				$link="movies&categorie=$categ";
				break;
			case 3:
				$categorie="étrange!";
				$color="orange";
				$link="movies&categorie=$categ";
				break;
			case 4:
				$categorie="parodie";
				$color="black";
				$link="movies&categorie=$categ";
				break;
			case 5:
				$categorie="interview";
				$color="rgb(126,45,196)";
				$link="movies&categorie=$categ";
				break;
			case 6:
				$categorie="tv";
				$color="rgb(26,78,96)";
				$link="movies&categorie=$categ";
				break;
			case 7:
				$categorie="documentaire";
				$color="rgb(123,45,89)";
				$link="movies&categorie=$categ";
				break;
			case 8:
				$categorie="cinéma";
				$color="rgb(52,109,36)";
				$link="movies&categorie=$categ";
				break;
			case 9:
				$categorie="TimeLapse/Nature";
				$color="rgb(10,30,150)";
				$link="movies&categorie=$categ";
				break;
			case 15:
				$categorie="dossier";
				$color="rgb(138,100,152)";
				$link="dossier";
				break;								
			case 16:
				$categorie="edito";
				$color="rgb(50,56,25)";
				$link="accueil";
				break;
			case 17:
				$categorie="galerie";
				$color="rgb(125,255,125)";
				$link="dossier";
				break;	
			case 18:
				$categorie="presse";
				$color="rgb(125,255,125)";
				$link="presse";
				break;	
			default:
				$categorie="autre";
				$color="rgb(56,47,123)";
				$link="movies&categorie=$categ";				
				break;
		}
		
		if($genre){
			switch($genre){
				case 1:
					$style="jazz/blues";
					$color2="rgb(23,45,69)";
					
					break;
				case 2:
					$style="rock n'roll";
					$color2="rgb(56,05,122)";
					break;
				case 3:
					$style="rock/pop";
					$color2="rgb(78,100,30)";
					break;					
				case 4:
					$style="soul/funk";
					$color2="rgb(1,50,100)";
					break;
				case 5:
					$style="reggae/ragga/dub";
					$color2="rgb(85,21,110)";
					break;
				case 6:
					$style="chanson";
					$color2="rgb(5,12,87)";
					break;
				case 7:
					$style="punk/alternatif";
					$color2="rgb(45,96,12)";
					break;
				case 8:
					$style="hard-rock";
					$color2="rgb(120,16,72)";
					break;
				case 9:
					$style="blues-rock";
					$color2="rgb(80,80,00)";
					break;
				case 10:
					$style="electro/dj";
					$color2="rgb(00,50,100)";
					break;
				case 11:
					$style="world";
					$color2="rgb(00,50,100)";
					break;
				case 12:
					$style="roots/folk rock";
					$color2="rgb(00,50,100)";
					break;
				case 13:
					$style="rock progressif/psyché";
					$color2="rgb(00,50,100)";
					break;
				case 14:
					$style="variétés/pop";
					$color2="rgb(00,50,100)";
					break;
				case 15:
					$style="trip-hop";
					$color2="rgb(00,50,100)";
					break;										
				case 16:
					$style="afrobeat";
					$color2="rgb(00,50,100)";
					break;	
				default:
					$style="autre";
					$color2="rgb(23,45,69)";
					break;												
			}			
		}
		
		$categorie=htmlentities($categorie);
		$style=htmlentities($style);
		
		if($ok==0){
			$lien='<ul class="categorie">';
			$lien .='<a href="index.page.php?link='.$link.'">';
			$lien .='<li style="color:'.$color.'">'.$categorie.'</li></a>';			
			if($genre){
				$lien .='<a href="index.page.php?link='.$link.'&genre='.$genre.'"><li style="color:'.$color2.'">'.$style.'</li></a>';
			}
			$lien.='<a href="index.page.php?link=movies&periode='.$periode.'"><li class="spe">'.$periode.'</li></a>';
			$lien .='</ul>';
		}else{
			$lien='<ul class="categorie">';
			if($genre){
				$lien .='<a href="index.page.php?link=movies&categorie='.$categ.'&genre='.$genre.'"><li style="color:'.$color2.'">'.$style.'</li></a>';
			}else{
				$lien .='<a href="index.page.php?link=movies&categorie='.$categ.'"><li style="color:'.$color2.'">'.$categorie.'</li></a>';
			}
			$lien.='<a href="index.page.php?link=movies&periode='.$periode.'"><li class="spe">'.$periode.'</li></a>';
			$lien .='</ul>';
		}
		return $lien;
	}
	
	function getIndex($idTab,$taille,$link1,$linkOptionnel=null){

		if($_GET['genre']){
			$option='&genre='.$_GET['genre'];
		}elseif($_GET['categorie']){
			$option='&categorie='.$_GET['categorie'];
		}elseif($_GET['tri']=='id'){
			$option='&tri=id';
		}elseif($_GET['periode']){
			$option='&periode='.$_GET['periode'];
		}elseif($_GET['annee']){
			$option='&annee='.$_GET['annee'];
		}elseif($_GET['chercher']){
			$option='&chercher='.$_GET['chercher'];
		}
		$nbTab=$taille-1;
		$nbPage=$nbTab+1;
		$idPage=$idTab+1;
		$nexTab=$idTab+1;
		$prevTab=$idTab-1;
		
		$max=20;
		
		//génère un tableau de numéro de Pages
		$arrayPages=array();
		for($i=1;$i<=$taille;$i++){
			$arrayPages[$i]=$i;
		}		
		
		if($taille>$max){
			$size=$max;
		}else $size=$taille;
			
			
			for($k=0;$k<$size;$k++){
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
		
		if($taille>$max){
			if($idPage<$max+1){
	?>
				<a class="page" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo $max.$linkOptionnel.$option;?>"> ... </a>
	<?php
			}elseif($idPage>=$max+1){
	?>
				<a href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo $prevTab.$linkOptionnel.$option;?>"> ... </a>
	<?php
				echo $idPage;
				if($idPage<$nbPage){
	?>
					<a class="nextprev" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo$nexTab.$linkOptionnel.$option;?>">Suiv </a>&nbsp;
	<?php
				}
				
			}
			if($idPage<$nbPage){
	?>
				<a class="page" href="index.page.php?link=<?php echo $link1; ?>&idTab=<?php echo ($nbPage-10).$linkOptionnel.$option;?>">...</a>				<a class="page" href="index.page.php?link=<?php echo$link1?>&idTab=<?php echo$nbTab.$linkOptionnel.$option;?>"><?php echo$nbPage?></a>&nbsp; 
	<?php
			}
	?>
		<br/>
		<form action="index.page.php?link=<?php echo $link1.$linkOptionnel.$option; ?>" method=POST>
	<?php
			$selectPAGE=new SelectAction("PAGESELECT",$arrayPages,$idPage,1,$tabl_variabError);
			$selectPAGE->setSelect();
		
			$btnOK=new Button("Submit","ok_page","Ok",1);
			$btnOK->setButton();
	?>	
		</form>
	<?php
		}
	}

}
?>