<?php
if($_POST['message']){
	$nom = $_SESSION['login'];               //On récupère le pseudo et on le stocke dans une variable
	$message = stripslashes($_POST['message']);            //On fait de même avec le message
	$ligne = '<strong>'.$nom.' ></strong> '.$message.'<br>';     //Le message est créé
	$leFichier = file('chat.htm');             //On lit le fichier chat.htm et on stocke la réponse dans une variable (de type tableau)
	array_unshift($leFichier, $ligne);       //On ajoute le texte calculé dans la ligne précédente au début du tableau
	file_put_contents('chat.htm', $leFichier); //On écrit le contenu du tableau $leFichier dans le fichier ac.htm
}
?>
	<div id="content" style="padding:3%;width:94%">
		<br/>
    	<h1><img src="IMAGES/nav/chat.png" />Chattez</h1>
    	<br/>
		<div id="conversation"></div><br />
      	<form action="" method="post" onSubmit="return false;">
	Entrez votre Texte:&nbsp;&nbsp;
<?php
			$inputMSG=new InputAction('message','',$actif,$tabl_variabError,100,'','',100);
			$inputMSG->setInput();
			$btnOK=new Button('button', 'envoyer', 'Ok', $actif);
			$btnOK->setButton();
?>
      	</form>
	</div>	
<script>
$(function() {
	afficheConversation();
    $('#envoyer').click(function() {
        var message = $('#message').val();
        $.post('index.page.php?link=chat', {'message': message }, function() {
        refresh();
        });
    });
    
    $(document).keypress(function (e){
        code = e.keyCode ? e.keyCode : e.which;
        if(code.toString() == 13){
	        var message = $('#message').val();
	        $.post('index.page.php?link=chat', {'message': message }, function() {
	        refresh();
       });
    }
	})
	setInterval(afficheConversation, 1000);
	    
	     
	function afficheConversation() {
	   $('#conversation').load('chat.htm');
	}
	    
	function refresh(){
		afficheConversation();	
	    $('#message').val('');
	    $('#message').focus();
	}
});
</script>