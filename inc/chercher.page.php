<?php
$tabl_variabError; 
$actif=1;
$array12=array(1,2);

$radioCHERCHE=new RadioAction("CHOIX_CHERCHER",$array12,$_POST["CHOIX_CHERCHER"],$actif,$tabl_variabError,"afficheCache");
$radioCHERCHE->setRadio(0,"Chercher","affiche('cherche_simple');cache('cherche_multic');",1);
?>
&nbsp;
<?php
$radioCHERCHE->setRadio(1,"Recherche multicritères","cache('cherche_simple');affiche('cherche_multic');",2);

if($_POST['CHOIX_CHERCHER']==2){?>
	<script type="text/javascript">
		$(function(){
			$('#cherche_simple').hide();
		});
	</script>
<?php }
?>
<br/><br/><br/>
<div id="cherche_simple">
	<img src='IMAGES/nav/loupe.png' width=60px style="float:left;"/>
	<?php 
		$inputID=new InputAction('VIDEO_CHERCHER',$_POST['VIDEO_CHERCHER'],1,$tabl_variabError,20,'','',50);
		$inputID->setInput();
	?>
	<?php
		$btnENRG=new Button('Submit', 'chercher', 'OK', $actif);
		$btnENRG->setButton();
	?>
</div>

<div id="cherche_multic" style="display:none;">
	<h2>Chercher selon plusieurs Critères:</h2>
	<table id="multic" style="">
		<tr>
			<td style="width:20px;"><?php
				$cbCHOIXPERIODE=new CheckboxAction("CB_CHOIXPERIODE",($_POST['CB_CHOIXPERIODE'])?1:0,$actif,$tabl_variabError,"afficheCacheCheckBox");
				$cbCHOIXPERIODE->setCheckbox("afficheCacheCB('CB_CHOIXPERIODE','choix_periode')");
				if($_POST['CB_CHOIXPERIODE']){
	?>
					<script type="text/javascript">
						$(function(){
							$('#choix_periode').show();
						});
					</script>
	<?php				
				}
			
			?></td>
			<th style="width:150px;">Année/Période</th>
			<th style="width:150px;"><div id="choix_periode" style="display:none;"><?php
					$array12=array(1,2);
					$radioCHOIXPERIODE=new RadioAction("CHOIX_PERIODE",$array12,$_POST["CHOIX_PERIODE"],$actif,$tabl_variabError);
					$radioCHOIXPERIODE->setRadio(0,"par période","affiche('parperiode');cache('parannee');",1);
					echo "&nbsp;";
					$radioCHOIXPERIODE->setRadio(1,"par année","cache('parperiode');affiche('parannee');",2);
				?><div id="parperiode" style="display:none;"><?php 	
					foreach($arrayPeriode as $key=>$value){
						if($value!=-1){
						$cbPERIODE= new CheckboxAction('PERIODE'.$key,($_POST['PERIODE'.$key])?1:0,1,$tabl_variabError);
						$cbPERIODE->setCheckbox();
						echo $value."<br/>";
						}
					}
			?></div>
			<div id="parannee" style="display:none;"><?php
					$selectANNEE=new SelectAction("ANNEES",$arrayAnnees,$_POST['ANNEES'],1,$tabl_variabError);
					$selectANNEE->setSelect();
			?></div></div></th>
		</tr>
		<tr>
			<td style=""><?php
				$cbCATEG=new CheckboxAction("CB_CATEG",($_POST['CB_CATEG'])?1:0,1,$tabl_variabError);
				$cbCATEG->setCheckbox("afficheCacheCB('CB_CATEG','cb_categ')");
			?></td>
			<th>Catégorie:</th> 
			<th><div id="cb_categ" style="display:none"><?php
				$selectCATEG=new SelectAction("CATEG",$arrayCategorie,$_POST['CATEG'],1,$tabl_variabError);
				$selectCATEG->setSelect("afficheCacheSelect('CATEG','2','cb_genre','cb_genre');");
			?>
				<div id="cb_genre" style="display:none"><br/><?php
					$selectGENRE=new SelectAction("GENRE",$arrayGenre,$_POST['GENRE'],1,$tabl_variabError);
					$selectGENRE->setSelect();
				?></div>
			</div></th>		
		</tr>
		<tr>
			<td style=""><?php
				$cbPRIO=new CheckboxAction("CB_PRIO",($_POST['CB_PRIO'])?1:0,1,$tabl_variabError,"");
				$cbPRIO->setCheckbox("afficheCacheCB('CB_PRIO','cb_prio')");
			?></td>
			<th>Priorité:</th> 
			<th><div id="cb_prio" style="<?php echo (!$_POST['CB_PRIO'])?"display:none":""; ?>;"><?php
				$selectPRIO=new SelectAction("PRIO",$arrayPriorite,$_POST['PRIO'],1,$tabl_variabError);
				$selectPRIO->setSelect();
			?></div></th>		
		</tr>
		<tr>
			<td colspan=3 style="text-align:center;"><?php
				$btnOK=new Button('Submit','ok_multicrit','OK',1);
				$btnOK->setButton();
			?></td>
		</tr>
	</table>
	<?php		
	//print_r($_POST);
				if($_POST['CHOIX_PERIODE']==1){ ?>
					<script type="text/javascript">
						$(function(){
							$('#parperiode').show();
						});
					</script>
				<?php }
				if($_POST['CB_CHOIXPERIODE']==2){ ?>
					<script type="text/javascript">
						$(function(){
							$('#parannee').show();
						});
					</script>
	<?php 		}
			 if ($_POST['CB_CATEG']){ ?>
					<script type="text/javascript">
						$(function(){
							$('#cb_categ').show();
						});
					</script>
	<?php 		 	
				 if ($_POST['CATEG']==2){ ?>
					<script type="text/javascript">
						$(function(){
							$('#cb_genre').show();
						});
					</script>
	<?php 		
			 	}
			 }
	?>
</div>
