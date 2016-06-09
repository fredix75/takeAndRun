<br />
Veuillez r&eacute;pondre &agrave; la question suivante:<br /><br />

<?php
	include_once("../FC/class/form/InputAction.class.php");
	include_once("../FC/class/form/Button.class.php");
	if($testVal==false){
    		echo "<font color=\"red\">".$messageErreur."<br/></font>";
  	}
  	//print_r($arrayQuestion);
?>
<br />
<div align="center">
<table>    
    <tr>
      <td><div align="left">Question : </div></td>
      <td>
        <div align="left">
        <strong>
        <?php
		        switch($arrayQuestion[0]["QUESTION"]){
		          case 0:
		          echo"Quel est votre personnage historique préféré ?";
		          break;
		          
		          case 1:
		          echo"Quel est la marque de votre première voiture ?";
		          break;
		          
		          case 2:
		          echo"Quel est le nom de votre animal de compagnie ?";
		          break;
		          
		          case 3:
		          echo"Quel est le nom de jeune fille de votre mère ?";
		          break;
		          
		          case 4:
		          echo"Quel est le nom de votre ancien lycée ?";
		          break;
		          
		          case 5:
		          echo"Quel est le nom de votre star préférée ?";
		          break;
		          
		          case 6:
		          echo"Quel est le prénom de votre père ?";
		          break;
		          
		          case 7:
		          echo"Quelle est le prénom de votre premier enfant ?";
		          break;
		          
		          default:
		          echo" ";
		          break;
            }
		    ?></strong>
          </div></td>
    </tr>
    
    
	
	<tr>
      <td><div align="left">R&eacute;ponse:</div></td>
      <td><div align="left">        
       <?php 
		$input=new InputAction("UTILISATEUR_REPONSE",$arrayQuestion["UTILISATEUR_REPONSE"],1,$tabl_variabError,20);
 		$input->setInput();
 		
 		$inputLogin=new InputAction("UTILISATEUR_LOGIN",$login,1,$tabl_variabError,0);
 		$inputLogin->setInput();
		?>
      </div></td>
    </tr>
	
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
		<td>&nbsp;</td>
		<td><div align="left">
      	<?php $button = new Button("Submit","Submit","Envoyer", 1,"");
	    $button->setButton(); ?>
    </div></td>
	</tr>
</table>
</div>