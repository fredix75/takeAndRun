<?php
include_once("../FC/class/form/InputAction.class.php");
include_once("../FC/class/form/SelectAction.class.php");
include_once("../FC/class/form/Button.class.php");

if($changemdp->testVal()==false){
    		echo "<font color=\"red\">".$messageErreur."<br/></font>";
  	}
?>
<strong>Choisir une question secrete : </strong>
<hr>
<div align="left"><em>Cette question,&agrave; laquelle vous seul(e) pouvez r&eacute;pondre, servira &agrave; retrouver votre mot de passe si vous le perdez.</em></div>
<table width="100%" >
  <tr>
    <td width="40%"> <div align="left">Question : </div></td>
    <td><div align="left">
      <?php 
		$arrayQuestionSel[" "]=-1;
		$arrayQuestionSel["Quel est votre personnage historique pr�f�r� ?"]="0";
		$arrayQuestionSel["Quel est la marque de votre premi�re voiture ?"]="1";
		$arrayQuestionSel["Quel est le nom de votre animal de compagnie ?"]="2"; 
		$arrayQuestionSel["Quel est le nom de jeune fille de votre m�re ?"]="3";
		$arrayQuestionSel["Quel est le nom de votre ancien lyc�e ?"]="4";
		$arrayQuestionSel["Quel est le nom de votre star pr�f�r�e ?"]="5";
		$arrayQuestionSel["Quel est le pr�nom de votre p�re ?"]="6";
		$arrayQuestionSel["Quelle est le pr�nom de votre premier enfant ?"]="7";	
		$selectQuestion=new SelectAction("UTILISATEUR_QUESTION",$arrayQuestionSel,$arrayChangeMdp["UTILISATEUR_QUESTION"],1,$tabl_variabError);
		$selectQuestion->setSelect("");	
		?>
    </div>    </td>
  </tr>
  <tr>
    <td> <div align="left">R&eacute;ponse : </div></td>
    <td><div align="left">
      <?php $inputReponse = new InputAction("UTILISATEUR_REPONSE", $arrayChangeMdp["UTILISATEUR_REPONSE"],1, $tabl_variabError,20);
    	$inputReponse->setInput();
	?>
    </div>    </td>
  </tr>
</table>
<strong><br>
Choisir un nouveau  password : </strong>
<hr>
<div align="left"><em>Le mot de passe ne doit comporter que des lettres [a-z], [A-Z] et des chiffres [0-9]</em></div>
<table width="100%">
  <tr>    
    <td width="40%">
      <div align="left">
        <?php
    	if(is_null($oubli)){
    ?>
        Ancien mot de passe :
        <?php
    	}
    ?>
      </div></td>
    <td>
    <div align="left">
      <?php 
    	if(is_null($oubli)){
    		$inputOLDPASSWORD = new InputAction("UTILISATEUR_OLDPASSWORD", $arrayChangeMdp["UTILISATEUR_OLDPASSWORD"],1, $tabl_variabError,-2);
    		$inputOLDPASSWORD->setInput();
    	}
	?>
    </div>    </td>
  </tr>
  <tr>
    <td><div align="left">Nouveau mot de passe (6 caract&egrave;res) :</div></td>
    <td><div align="left">
      <?php $newPassword1 = new InputAction("UTILISATEUR_NEWPASSWORD1", $arrayChangeMdp["UTILISATEUR_NEWPASSWORD1"],1, $tabl_variabError,-2);
    	$newPassword1->setInput();
	?>
    </div>    </td>
  </tr>
  <tr>
    <td><div align="left">Confirmer le nouveau mot de passe :</div></td>
    <td><div align="left">
      <?php $newPassword2 = new InputAction("UTILISATEUR_NEWPASSWORD2", $arrayChangeMdp["UTILISATEUR_NEWPASSWORD2"],1, $tabl_variabError,-2);
    	$newPassword2->setInput();
	?>
    </div>    </td>
  </tr>
  <tr>
    <td>
      <?php $button=new Button("Submit","Submit","Valider",1);
		    $button->setButton();?>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
