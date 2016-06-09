<?php
	$liste=array(282,283,157,285);
	$videoV=$video->getVideoById($liste);
?>
	<div id="chapeau">
		<br/><br/><br/>
		<p>Nombre de musiciens noirs de l'ouest du mississipi ont gagn&eacute; les centres urbains du Nord au cours des ann&eacute;es 40. Ils y trouvent une sc&egrave;ne blues d&eacute;ja consitu&eacute;e avec une pr&eacute;dilection pour une orchestration &eacute;largie avec piano et cuivres et une influence du jazz ...</p>
		<br/>
	</div>
	<div>
		<img src="../IMAGES/dossier/chicago.jpg"  width:"400px" />
	    <p>
	    	La rencontre de la campagne et de la ville; de la sophistication jazzy
      		et de la rude m&eacute;lancolie du Delta du Mississipi va produire des &eacute;tincelles.
    	</p>
	</div>
	<div>
<?php
		$v=0;
		echo $video->getAffichage($videoV[$v]['LIEN'],'60%','350');
		$v++;
?>	
	</div>
	<div>
	<p>
		Le blues d'un Lonnie Johnson par exemple, avec sa v&eacute;locit&eacute; pianistique, son c&ocirc;t&eacute; swingant, son humour en demi teinte, est en total contraste avec la rage des bluesmen sudistes.
	</p>
	</div>
	<?php
		echo $video->getAffichage($videoV[$v]['LIEN'],'60%','350');
		$v++;
?>	