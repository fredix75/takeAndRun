<div id="content" style="width:100%;">
<?php
	if($_GET["cat"]=="slide"){
		include("dossier/slide.page.php");
	}
	
	if($_GET["cat"]=="rock"){
		include("dossier/rock/rock0.html.php");
?>
</div>
<?php
	}else{
		//liste des dossiers 
    	$directory = 'IMAGES/portfolios/';
		if ($dh = opendir($directory)){
			$j=1;
    		while (($file = readdir($dh)) !== false){
     			// Vérifie de ne prendre en compte que les dossier
     			if (is_dir($directory.$file) && $file != '...' && $file != '..' && $file != '.'){	
     				$doss[$j]=$file;
     				// va chercher une image de presentation pour chaque dossier
     				$arrayPortfolio=$gestion->getPortfolio($doss[$j]);
					shuffle($arrayPortfolio);
					$im[$j]=$doss[$j]."/".$arrayPortfolio[0];
     				// cree le nom du lien
     				$linkdoss[$j]=str_ireplace(" ","_",$doss[$j]);
     				$j++;
     			}
    		}
		}
?>
<div class="categ"><?php echo $gestion->getCategorie(15,0); ?></div>
	<ul id="menudossier">
		<a href="index.page.php?link=dossier&cat=rock"><li>Histoire du Rock</li></a>
<?php
		for($i=1;$i<=count($doss);$i++){
?>	
		<a href="index.page.php?link=dossier&cat=slide&s=<?php echo $linkdoss[$i]; ?>" onMouseOver="affichePic('<?php echo $directory; ?>','<?php echo $im[$i]; ?>','<?php echo $linkdoss[$i]; ?>')"><li><?php echo $doss[$i]; ?></li></a>
<?php
		}
?>	
	</ul>
	<div id="imagePres" >
		<div style="background-color: rgba(0, 0, 0, 0.4);padding:20px 0px;">
		<?php echo $gestion->getCategorie(17,0); ?>

			<a class="link" href=""><h2></h2></a>
		</div>
		<br/>
		<a class="link" href=""><img src=""/></a>
	</div>
</div>
<script src="js/affichePic.js" type="text/javascript"></script>
<?php
	}
?>
