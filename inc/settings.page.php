<br/>
<h2>choix du Thème</h2>
<br/>
<?php
	$arrayRadio=array('flech','green','blue','red');

	$radioTHEME=new RadioAction("THEME",$arrayRadio,'',1,$tabl_variabError);
	$radioTHEME->setRadio(0,"Défaut","",1);
?>
	<br/>
<?php	
	$radioTHEME->setRadio(1,"Mojito","",2);
?>
	<br/>
<?php
	$radioTHEME->setRadio(2,"Blue Lagoon","",3);
?>
	<br/>
<?php
	$radioTHEME->setRadio(3,"Sangria","",4);
?>
	<br/>
	<div align="center">
<?php
	$btnOK=new Button("submit","OK_theme","Ok",1);
	$btnOK->setButton();
?>
	</div>
<br/><br/>
