	<?php 
	
	$arrayCatFlux=array("",1,2,3,4);
	
		$inputID=new InputAction('FLUX_ID',$id,0,$tabl_variabError,0,'','',0);
		$inputID->setInput();
	?>
	<table width="200px">
		<tr>
			<th>Titre<br/><?php
				$inputTITRE=new InputAction('FLUX_TITRE',"",$actif,$tabl_variabError,40,'','',25);
				$inputTITRE->setInput();
			?></th>
		</tr>
		<tr>
			<th>Catégorie<br/><?php
				$selectCAT=new SelectAction('FLUX_CAT',$arrayCatFlux,"",$actif,$tabl_variabError);
				$selectCAT->setSelect();
			?></th>
		</tr>
		<tr>
			<th style="width:300px;">Lien<br/><?php
				$textLIEN=new TextArea('FLUX_LIEN',"",$actif,$tabl_variabError,20,3);
				$textLIEN->setTextArea()
			?></th>
		</tr>
		<tr>
			<th>Image<br/><?php
				$inputIMAGE=new InputAction('FLUX_IMAGE',"",$actif,$tabl_variabError,40,'','',25);
				$inputIMAGE->setInput();
			?></th>
		</tr>			
		<tr>
			<td style="text-align:center;" colspan=3><?php
				$btnENRG=new Button('Submit', 'enrg_flux', 'Enregistrer', $actif);
				$btnENRG->setButton();
			?></td>
		</tr>
	</table>	