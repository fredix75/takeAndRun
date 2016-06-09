<?php
include_once('class/form/Button.class.php');
include_once('class/form/InputAction.class.php');
include_once('class/form/FileAction.class.php');
include_once('class/form/InputDate.class.php');
include_once('class/form/RadioAction.class.php');
include_once('class/form/SelectAction.class.php');
include_once('class/form/CheckboxAction.class.php');
include_once('class/form/TextArea.class.php');

if($_POST['sub_gestion']){
	$gestion->setUpdate();
	header("Location:index.page.php?link=gestion&cat=gererVideos&idTab=$idTab");
}

if($_POST['sub_vignette']){
	$gestion->setVignette();
	header("Location:index.page.php?link=gestion&cat=gererVignettes");
}

?>
<div id="content" style="width:100%">
	<br/>
	<h1 style="background-color:black;color:white;"=>L'Admin'</h1>
	<ul class="sous-menu">
		<li><a href="index.page.php?link=gestion&cat=config">configuration</a></li>
		<li><a href="index.page.php?link=gestion&cat=stats">stats</a></li>
		<li><a href="index.page.php?link=gestion&cat=gererVideos">vidéos</a></li>
		<li><a href="index.page.php?link=gestion&cat=gererVignettes">vignettes</a></li>
		<li><a href="index.page.php?link=gestion&cat=gererPortfolios">portfolios</a></li>
		<li><a href="index.page.php?link=gestion&cat=gererUser">utilisateurs</a></li>
	</ul>
	
	<br/>

		<br/><br/>
<?php
	if($_GET['cat']=="config"){
		phpinfo();	
	}elseif($_GET['cat']=="gererVideos"){
		
		if($_POST['OK_affiche']){
			$genre2=$_POST['SELHUM'];
			$_GET['humeur']=$genre2;
		}elseif($_GET['humeur']){
			$genre2=$_GET['humeur'];
		}

		if($_POST['ok_page']){
			$_GET['idTab']=	$_POST['PAGESELECT']-1;
		}elseif($_POST['IDTAB']){
			$_GET['idTab']=$_POST['IDTAB'];
		}

		if($_GET['idTab']){
			$idTab = $_GET['idTab'];
		}else $idTab = 0;

		$tailleBase=$video->getCount(2,$genre2);
		$taille=(int)($tailleBase[0]['COUNT']/25);
		if($tailleBase[0]['COUNT']%25!=0)	$taille+=1;
		$numero=$idTab*25;
		$arrayVideo=$video->getAllVideo($numero,$genre2);

?>
	Sélectionner un genre à afficher<br/>
	<form action="index.page.php?link=gestion&cat=gererVideos" method="POST">
<?php
		$selectGENRE1=new SelectAction("SELHUM",$arrayHumeur,$genre2,1,$tabl_variabError);
		$selectGENRE1->setSelect();
		$btnOK=new Button("submit","OK_affiche","OK",1);
		$btnOK->setButton();
?>		
	<br/><br/><br/>
	<table id="tabGestion" align="center" width=80%>
		<tr>
			<th></th>
			<th></th>
			<th>Auteur</th>
			<th>Titre</th>
			<th>Catégorie/Genre</th>
			<th>Année</th>
			<th>Priorité</th>
			<th>Période</th>
		</tr>
<?php
		for($i=0;$i<count($arrayVideo);$i++){
			$col=($i%2==0)?"#E6EEDD":"white";
?>
		<tr style="background-color:<?php echo $col;?>">
			<td><?php 
				$cbNUMV{$i}=new CheckboxAction("IDV[]",0,1,null,null,$arrayVideo[$i]['ID'],1);
				$cbNUMV{$i}->setCheckbox();
			?></td>
			<td><strong><?php echo $arrayVideo[$i]['ID']; ?></strong></td>
			<td style="text-align:left;"><a href="index.page.php?link=accueil&chercher=<?php echo $arrayVideo[$i]['AUTEUR']; ?>" target="_blank"><strong><?php echo $arrayVideo[$i]['AUTEUR']; ?></strong></a></td>
			<td><?php echo $arrayVideo[$i]['TITRE'] ?></td>
			<td style="text-align:left;"><?php echo $gestion->getCategorie($arrayVideo[$i]['CATEGORIE'],0, $arrayVideo[$i]['GENRE']); ?></td>
			<td><?php echo $arrayVideo[$i]['ANNEE'] ?></td>
			<td><?php echo $arrayVideo[$i]['PRIORITE'] ?></td>
			<td><?php echo $arrayVideo[$i]['PERIODE'] ?></td>
		</tr>
<?php
		}
		$inputIDTAB=new InputAction('IDTAB',$idTab,0,null,0);
		$inputIDTAB->setInput();
?>
	</table>
	<br/><br/>
	<table>
		<th>Appliquer une étiquette :<?php
			$selectGENRE=new SelectAction("HUMEUR",$arrayHumeur," ",1,$tabl_variabError);
			$selectGENRE->setSelect();
		?></td>
		<td><?php 
			$btnOK=new Button('submit','sub_gestion','OK',1);
			$btnOK->setButton();
		?></td>
	</table>

	</form>
	<br/><br/><br/><hr/>
<?php
		$myUtil->getIndex($idTab,$taille,"gestion&cat=gererVideos");
	}elseif($_GET['cat']=="gererVignettes"){
		$arrayVignette=$gestion->getVignette(3);
		if($_GET['delete_i']){		// suppresion d'une image
			$image=$arrayVignette[$_GET['delete_i']];
			unlink("IMAGES/vignettes/".$image);
			header('Location:index.page.php?link=gestion&cat=gererVignettes');
		}	
?>	
	<form action="index.page.php?link=gestion&cat=gererVignettes" method="POST" enctype="multipart/form-data">
	Uploader une Vignette Titre<br/>
<?php
		$inputFile=new FileAction('VIGNETTE','',1,$tabl_variabError,10);
		$inputFile->setFile();
		
		$btnOK=new Button('submit','sub_vignette','OK',1);
		$btnOK->setButton();	
?>
		<div id="plancheVignettes" style="background-color:grey;">
<?php
	for($i=1;$i<=18;$i++){
?>		
			<div id="<?php echo $i; ?>" class="vign" style="float:left;">
				<img style="margin-left:50px;" src="<?php echo 'IMAGES/vignettes/'.$arrayVignette[$i]; ?>" height="200px"/>
				<a href="index.page.php?link=gestion&cat=gererVignettes&delete_i=<?php echo $i;?>" onclick="return confirm('Etes vous sûr de vouloir virer cette image ?');"><img src="IMAGES/buttons/supprimer.png" title="supprimer l'image" width=20px /></a>
			</div>
<?php		
	}
?>
			<div class="loadmore" style="display:none;float:left;"><img src="IMAGES/buttons/loading.gif" /></div>
		</div>	
	</form>
	<script type="text/javascript">
 
$(function(){ // Quand le document est complètement chargé
 
	var load = false; // aucun chargement de commentaire n'est en cours
	var offset = $('.vign:last').offset(); 

	$(window).scroll(function(){ // On surveille l'évènement scroll
 
		/* Si l'élément offset est en bas de scroll, si aucun chargement 
		n'est en cours, si le nombre de commentaire affiché est supérieur 
		à 5 et si tout les commentaires ne sont pas affichés, alors on 
		lance la fonction. 
		*/

		if((offset.top-$(window).height()<= $(window).scrollTop()) 
		//if(($(window).scrollTop()>=offset.top-150)
		&& load==false && ($('.vign').size()>=18) && 
		($('.vign').size()<=<?php echo count($arrayVignette);?>)){ 
			// la valeur passe à vrai, on va charger
			load = true;

			//On récupère l'id du dernier commentaire affiché
			var last_id = $('.vign:last').attr('id');

			//On affiche un loader
			$('.loadmore').show();
 
			//On lance la fonction ajax
			$.ajax({
				url: './scroll_ajax.php',
				type: 'get',
				data: 'last='+last_id,
 
				//Succès de la requête
				success: function(data) {
 
					//On masque le loader
					$('.loadmore').fadeOut(500);
					/* On affiche le résultat après
					le dernier commentaire */
					//alert('off top='+offset.top+'\n wind height='+ $(window).height()+'\n diff='+(offset.top-$(window).height())+'\n id='+last_id+'\n taille='+$('.vign').size()+'\n scroll top='+ $(window).scrollTop()+'\n n='+n); 
					$('.vign:last').after(data);
					/* On actualise la valeur offset
					du dernier commentaire */
					offset = $('.vign:last').offset();
					//On remet la valeur à faux car c'est fini
					load = false;
				}
			});
		}
	});
});

</script>
<?php
	}elseif($_GET['cat']=="gererPortfolios"){
		if($_POST['DOSSIER']){
			$arrayImages=$gestion->getPortfolio($_POST['DOSSIER']);
			$dir="IMAGES/portfolios/".$_POST['DOSSIER']."/";
?>
		<table>
<?php
			for($i=1;$i<=count($arrayImages);$i++){
				$imageDecodes[$i]=utf8_decode($arrayImages[$i]);				
				if($_POST['TERME']){
					$image[$i]=str_ireplace($_POST['TERME'],"",$imageDecodes[$i]);	
				}else{
					$image[$i]=$imageDecodes[$i];
				}
				$imagesReEncod[$i]=$myUtil->stripAccents($image[$i]);
				if($arrayImages[$i]!=$imagesReEncod[$i]){
					rename($dir.$arrayImages[$i],$dir.$imagesReEncod[$i]);
					rename($dir."thumbs/".$arrayImages[$i],$dir."thumbs/".$imagesReEncod[$i]);
				}
?>
			<tr>
				<td><?php echo $arrayImages[$i]; ?></td>
				<td><?php echo $imagesReEncod[$i]; ?></td>
			</tr>
<?php
			}
?>
		</table>
<?php			
		}
?>
	<form action="index.page.php?link=gestion&cat=gererPortfolios" method="POST">
		Dossier:
<?php		
		$inputDir=new InputAction('DOSSIER','',1,$tabl_variabError,50);
		$inputDir->setInput();			
?>
	<br/>Terme à oter:
<?php
		$inputTerme=new InputAction('TERME','',1,$tabl_variabError,100);
		$inputTerme->setInput();			
?>
<br/>
<?php
		$btnOK=new Button("submit","sub_PF","OK",1);
		$btnOK->setButton();			
?>
	</form>
<?php
	}elseif($_GET['cat']=="stats"){
		$couleurs=array("#005CDE","#00A36A","#7D0096","#992B00","#DE000F","#ED7B00","#1C0C5C","#F0C3C3","#AA00CC","white","red","grey");
		shuffle($couleurs);

		// Composition Base Vidéos (sans musique)
		$arrayCategories=$video->getStats('CATEGORIE');
		
		$composition="";
		$key=array();
		for($i=0; $i<count($arrayCategories);$i++){
			if($arrayCategories[$i][0]!=2){
				$key[$i]=array_search($arrayCategories[$i][0],$arrayCategorie);
				$composition.='{label:"'.$key[$i].'", data:'.$arrayCategories[$i][1].', color:"'.$couleurs[$i].'"},';
			}
		}				
		$composition=substr($composition,0,-1);
		
		// Composition Base Musique 
		$arrayGenres=$video->getStats('GENRE');
		$compositionMUS="";
		$key=array();
		for($i=0; $i<count($arrayGenres);$i++){
			if($arrayGenres[$i][0]!=-1){
				$key2[$i]=array_search($arrayGenres[$i][0],$arrayGenre);
				$compositionMUS.='{label:"'.$key2[$i].'", data:'.$arrayGenres[$i][1].', color:"'.$couleurs[$i].'"},';
			}
		}
?>
<h2>Composition de la base</h2>	
<table style="width:30%;text-align:left">
	<tr>
		<th>Catégorie</th>
		<th>Nombre</th>
	</tr>
<?php	
$key3=array();
for($i=0; $i<count($arrayCategories);$i++){
	$key3[$i]=array_search($arrayCategories[$i][0],$arrayCategorie);
?>
	<tr>
		<td style="width:100px;"><a href="index.page.php?link=accueil&categorie=<?php echo $arrayCategories[$i][0];?>"><?php echo $key3[$i] ;?></a></td>
		<td style="width:50px;"><?php echo $arrayCategories[$i][1] ;?></td>
	</tr>
<?php	
}

?>
</table>
		
<h2>Composition de la base (hors Musique)</h2>
<div id="flot-placeholder" style="width:700px;height:400px;margin:0 100px;float:left"></div>

<h2>Composition de la base Musique</h2>
<div id="flot-placeholder2" style="width:700px;height:400px;margin:0 100px;float:left"></div>
<script>
var dataSet = [<?php echo $composition; ?>];
var dataSet2 = [<?php echo $compositionMUS; ?>];

var options = {
    series: {
        pie: {
            show: true,
            innerRadius: 0.5,
            label: {
                show: true
            }
        }
    }
};

$(document).ready(function () {
    $.plot($("#flot-placeholder"), dataSet, options);
    $.plot($("#flot-placeholder2"), dataSet2, options);
});


</script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/flot/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.time.js"></script>    
<script type="text/javascript" src="js/flot/jshashtable-2.1.js"></script>    
<script type="text/javascript" src="js/flot/jquery.numberformatter-1.2.3.min.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.pie.min.js"></script><script type="text/javascript" src="/js/flot/jquery.flot.symbol.js"></script>
<script type="text/javascript" src="js/flot/jquery.flot.axislabels.js"></script>
<?php		
	}elseif($_GET['cat']=="gererUser"){
		$arrayUsers=$gestion->getUsers();
?>
	<table>
<?php		
		for($i=0;$i<count($arrayUsers);$i++){
?>
		<tr>
			<td><?php echo $arrayUsers[$i]['LOGIN'] ;?></td>
			<td><?php echo $arrayUsers[$i]['MAIL'] ;?></td>
			<td><?php echo $myUtil->dateSQLtoAffiche($arrayUsers[$i]['DERNIERCONNECTION'],true) ;?></td>
		</tr>
		
<?php			
		}
?>
	</table>
<?php		
	}
?>
</div>