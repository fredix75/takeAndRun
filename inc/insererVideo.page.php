
	<?php 
		$inputID=new InputAction('VIDEO_ID',$id,0,$tabl_variabError,0,'','',0);
		$inputID->setInput();
	?>
	<table>
		<tr>
			<th colspan=3>Titre<br/><?php
				$inputTITRE=new InputAction('VIDEO_TITRE',$videoV['VIDEO_TITRE'],$actif,$tabl_variabError,40,'','',25);
				$inputTITRE->setInput();
			?></th>
			<th rowspan=2 style="width:300px;">Lien<br/><?php
				$textLIEN=new TextArea('VIDEO_LIEN',$videoV['VIDEO_LIEN'],$actif,$tabl_variabError,20,3);
				$textLIEN->setTextArea("completeInfos();")

			?></th>
			<th rowspan=5>Texte<br/><?php
				$textTEXTE=new TextArea('VIDEO_TEXTE',$videoV['VIDEO_TEXTE'],$actif,$tabl_variabError,30,12);
				$textTEXTE->setTextArea();
			?></th>
		</tr>	
		<tr>
			<th colspan=2>Auteur<br/>
			<?php
				$inputAUTEUR=new InputAction('VIDEO_AUTEUR',$videoV['VIDEO_AUTEUR'],$actif,$tabl_variabError,40,'','',25);
				$inputAUTEUR->setInput();
			?></th>
		</tr>
		<tr>
			<th>Catégorie<br/><?php
				$selectCATEGORIE=new SelectAction('VIDEO_CATEGORIE',$arrayCategorie,$videoV['VIDEO_CATEGORIE'],$actif,$tabl_variabError);
				$selectCATEGORIE->setSelect("afficheCacheSelectAutre('genre')");
			?></th>
			<th>Piorité<br/><?php
				$selectPRIORITE=new SelectAction('VIDEO_PRIORITE',$arrayPriorite,$videoV['VIDEO_PRIORITE'],$actif,$tabl_variabError);
				$selectPRIORITE->setSelect();?>
			</th>
			<th>Humeur<br/><?php
				$selectHUM1=new SelectAction('VIDEO_HUM1',$arrayHumeur,$videoV['VIDEO_HUM1'],$actif,$tabl_variabError);
				$selectHUM1->setSelect();?><br/><?php
				$selectHUM2=new SelectAction('VIDEO_HUM2',$arrayHumeur,$videoV['VIDEO_HUM2'],$actif,$tabl_variabError);
				$selectHUM2->setSelect();?>
			</th>			
			<th rowspan=3>Chapo<br/><?php
				$textCHAPO=new TextArea('VIDEO_CHAPO',$videoV['VIDEO_CHAPO'],$actif,$tabl_variabError,20,5);
				$textCHAPO->setTextArea();
			?></th>
		</tr>
		<tr>
			<th colspan=3>Genre<br/><?php
				$selectGENRE=new SelectAction('VIDEO_GENRE',$arrayGenre,$videoV['VIDEO_GENRE'],$actif,$tabl_variabError);
				$selectGENRE->setSelect();
			?></th>
		</tr>	
		<tr>
			<th>Année<br/><?php
				$selectANNEE=new SelectAction('VIDEO_ANNEE', $arrayAnnees, $videoV['VIDEO_ANNEE'], $actif, $tabl_variabError,"selPeriode");
				$selectANNEE->setSelect("selPeriode('VIDEO_ANNEE')");
			?></th>
			<th colspan=2>Période<br/><?php	
				$selectPERIODE=new SelectAction('VIDEO_PERIODE',$arrayPeriode,$videoV['VIDEO_PERIODE'],$actif,$tabl_variabError);
				$selectPERIODE->setSelect();
			?></th>
		</tr>
		<tr>
			<td style="text-align:center;" colspan=5><?php
				$btnENRG=new Button('Submit', 'enrg_video', 'Enregistrer', $actif);
				$btnENRG->setButton();
			?></td>
		</tr>
	</table>
<?php	
if($videoV[0]["CATEGORIE"]!=2){ ?>
	<script type="text/javascript">
		$(function(){
			$('#genre').hide();
		});
	</script>
<?php } ?>

	<script type="text/javascript">	
	function completeInfos(){
		var link= $('#VIDEO_LIEN').val();

		if (~link.indexOf('vimeo')){
			var part=link.split('/');
			var key=part[part.length-1];
			url='http://vimeo.com/api/v2/video/'+key+'.json';
			var res=file_get_contents(url);
			var obj=jQuery.parseJSON(res);

			$('#VIDEO_TITRE').val(obj[0].title);
			$('#VIDEO_AUTEUR').val(obj[0].user_name);
			var date_up=obj[0].upload_date;
			var annee=date_up.substring(0,4);
			$('#VIDEO_ANNEE').val(annee);
			selPeriode('VIDEO_ANNEE');

			var newLink='//player.vimeo.com/video/'+key;
			$('#VIDEO_LIEN').val(newLink);
	
		}else if(~link.indexOf('youtube')){
			var part0=link.split('#');
			link=part0[0];			
			var part=link.split('=');
			var key=part[part.length-1];
			url='https://gdata.youtube.com/feeds/api/videos/'+key+'?v=2&alt=jsonc';
			var res=file_get_contents(url);
			var obj=jQuery.parseJSON(res);
			
			$('#VIDEO_TITRE').val(obj.data.title);			
			$('#VIDEO_AUTEUR').val(obj.data.title);
			var date_up=obj.data.uploaded;
			var annee=date_up.substring(0,4);
			$('#VIDEO_ANNEE').val(annee);
			selPeriode('VIDEO_ANNEE');
			
			var newLink='//www.youtube.com/embed/'+key;
			$('#VIDEO_LIEN').val(newLink);
		}else if(~link.indexOf('daily')){
			var part0=link.split('?');
			link=part0[0];			
			var part=link.split('/');
			var key=part[part.length-1];
			url='https://api.dailymotion.com/video/'+key+'?fields=title,duration,created_time';
			var res=file_get_contents(url);
			var obj=jQuery.parseJSON(res);
			
			$('#VIDEO_TITRE').val(obj.title);			
			var date_up=new Date(obj.created_time*1000);
			var annee=date_up.getFullYear();

			$('#VIDEO_ANNEE').val(annee);
			selPeriode('VIDEO_ANNEE');
			
			var newLink='http://www.dailymotion.com/embed/video/'+key;
			$('#VIDEO_LIEN').val(newLink);
		}
	}
		
	</script>	