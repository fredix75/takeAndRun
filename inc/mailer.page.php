<br/>
<h2>Envoyer un Message au Taulier</h2>
<br/>
	Objet:<br/>
<?php
	$inputOBJET=new InputAction("OBJET","",1,$tabl_variabError,60,"","",60);
	$inputOBJET->setInput();
?>
	<br/>
	Message:<br/>
<?php
	$txtMAIL=new TextArea("TEXTE","",1,$tabl_variabError,40,8);
	$txtMAIL->setTextArea();
?>
	<br/>
	<div align="center">
<?php
	$btnOK=new Button("submit","Send","Envoyer",1);
	$btnOK->setButton();
?>
	</div>
<br/><br/>