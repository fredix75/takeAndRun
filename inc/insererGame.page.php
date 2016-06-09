
	<?php 
		$inputID=new InputAction('GAME_ID',$id,0,$tabl_variabError,0,'','',0);
		$inputID->setInput();
	?>
	<table width="200px">
		<tr>
			<th colspan=2>Titre<br/><?php
				$inputTITRE=new InputAction('GAME_TITRE',$gameV[0]['TITRE'],$actif,$tabl_variabError,40,'','',25);
				$inputTITRE->setInput();
			?></th>
			<th rowspan=2 style="width:300px;">Lien<br/><?php
				$textLIEN=new TextArea('GAME_LIEN',$gameV[0]['LIEN'],$actif,$tabl_variabError,20,3);
				$textLIEN->setTextArea()
			?></th>
		</tr>	
		<tr>
			<th colspan=2>Auteur<br/>
			<?php
				$inputAUTEUR=new InputAction('GAME_AUTEUR',$gameV[0]['AUTEUR'],$actif,$tabl_variabError,40,'','',25);
				$inputAUTEUR->setInput();
			?></th>
		</tr>
		<tr>
			<th>Catégorie<br/><?php
				$selectCATEGORIE=new SelectAction('GAME_CATEGORIE',$arrayCategorie,$gameV[0]['CATEGORIE'],$actif,$tabl_variabError,"afficheCacheSelectAutre");
				$selectCATEGORIE->setSelect("afficheCacheSelectAutre('genre')");
			?></th>
			<th>Année<br/><?php
				$selectANNEE=new SelectAction('GAME_ANNEE', $arrayAnnees, $gameV[0]['ANNEE'], $actif, $tabl_variabError);
				$selectANNEE->setSelect();
			?></th>
			<th rowspan=2>Chapo<br/><?php
				$textCHAPO=new TextArea('GAME_CHAPO',$gameV[0]['CHAPO'],$actif,$tabl_variabError,20,3);
				$textCHAPO->setTextArea();
			?></th>
		</tr>
		<tr>
			<th colspan=2>Genre<br/><?php
				$selectGENRE=new SelectAction('GAME_GENRE',$arrayGenre,$gameV[0]['GENRE'],$actif,$tabl_variabError);
				$selectGENRE->setSelect();
			?></th>
		</tr>	
		<tr>
			<td style="text-align:center;" colspan=3><?php
				$btnENRG=new Button('Submit', 'enrg_game', 'Enregistrer', $actif);
				$btnENRG->setButton();
			?></td>
		</tr>
	</table>
<?php	
if($gameV[0]["CATEGORIE"]!=2){ ?>
	<script type="text/javascript">
		$(function(){
			$('#genre').hide();
		});
	</script>
<?php } ?>	