<br />
<strong>Saisissez votre identifiant dans le champ ci-dessous. Ceci vous permettra de  r&eacute;initialiser votre mot de passe.</strong>
<br /><br />

<?php
	include_once("../FC/class/form/InputAction.class.php");
	include_once("../FC/class/form/Button.class.php");
	if($loginQuestion->testVal()==false){
    		echo "<font color=\"red\">".$messageErreur."<br/></font>";
  	}
?>

<div align="center">
<table width="400">   
    <tr>
      <td width="12%"><div align="left">Login</div></td>
      <td>
        
        <div align="left">
        <?php 
		$input=new InputAction("UTILISATEUR_LOGIN",$arrayloginQuestion["UTILISATEUR_LOGIN"],1,$tabl_variabError,15);
 		$input->setInput();
		?></div></td>
    </tr>
    
   
	
	<tr>
      <td><div align="left">Email</div></td>
      <td><div align="left">        
       <?php 
		$input=new InputAction("UTILISATEUR_EMAIL",$arrayloginQuestion["UTILISATEUR_EMAIL"],1,$tabl_variabError,35);
 		$input->setInput();
		?></div></td>
    </tr>
	
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
		<td>&nbsp;</td>
		<td><div align="left">
      	<?php $button = new Button("Submit","Submit","Valider", 1,"");
	    $button->setButton(); ?>
    </div></td>
	</tr>
</table>
</div>