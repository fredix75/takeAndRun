<?php
require_once("QueryMYSQL.class.php");
 
 class Identification {
 	var $login, $password, $arrayLogin, $groupUser;
 	
 	function Identification($login, $password) {
     	$this->login=$login;
     	$this->password=$password;
     	
   		$queryMySQL=new QueryMYSQL();
       	$query="select LOGIN,PASSWORD, ID_GROUP_USER from UTILISATEUR where LOGIN='$login'";
      	$this->arrayLogin=$queryMySQL->select($query);
 	}  	
     
    //methode qui teste le pwd
    function ident(){
      	if(count($this->arrayLogin)==1){
			if($this->arrayLogin[0][1]==$this->password){	
      			$this->groupUser=$this->arrayLogin[0][2];
      			$_SESSION['group_user']=$this->arrayLogin[0][2];
      			$_SESSION['login']=$this->arrayLogin[0][0];
      			return true;
      		}else{	//  le mot de passe est incorrect
			?>
      		<script>alert("Votre mot de passe est erroné.\nFaites un effort de concentration, vous avez droit à une autre chance");</script>
      		<?php
      			return false;	
      		}
      	}else{	// Le login n'existe pas
      		?>
      		<script>alert("Votre Login ne correspondent pas à quelque chose de connu. J'ai du mal à vous reconnaître.\nPeut-être n'existez vous tout simplement pas.\nOn va pas tergiverser, c'est pas mon problème... En tout cas, cette tentative de connexion est un échec..");</script>
      		<?php
      		return false;
      	}
    }    
    
    
 }
?>