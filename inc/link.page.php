<?php
	$arrayRubriques=$lien->getRubriques();
	for($i=0;$i<count($arrayRubriques);$i++){
		$listeRubriques[$arrayRubriques[$i]['RUBRIQUE']]=$arrayRubriques[$i]['RUBRIQUE'];
	}
?>


	<table>
		<tr>
			<th style="text-align:right;">Nom</th>
			<td style="width:300px;">
	<?php
				$inputNOM=new InputAction('LIEN_NOM','',$actif,$tabl_variabError,40,'','',25);
				$inputNOM->setInput();
	?>
		</tr>	
		<tr>
			<th style="text-align:right;">Lien</th>
			<td><?php
				$inputLIEN=new InputAction('LIEN_LIEN','',$actif,$tabl_variabError,50,'','',20);
				$inputLIEN->setInput()
			?></td>
		</tr>
		<tr>
			<th style="text-align:right;">Rubrique</th>
			<td><?php
				$selectRubrique=new SelectAction('LIEN_RUBRIQUE',$listeRubriques,'',$actif,$tabl_variabError);
				$selectRubrique->setSelect();
			?></td>
		</tr>
		<tr>
			<td style="text-align:center;" colspan=2><?php
				$btnENRG=new Button('Submit', 'enrg_lien', 'Enregistrer', $actif);
				$btnENRG->setButton();
			?></td>
		</tr>
	</table>
