//fchau 20091007
//specifique AJAX
var xhr = null;
function getXhr(){
	if(window.XMLHttpRequest) // Firefox et autres
		xhr = new XMLHttpRequest();
	else if(window.ActiveXObject){ // Internet Explorer
		try {
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}else { // XMLHttpRequest non supporté par le navigateur
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
		xhr = false;
	}
}
///FIN SPECIFIQUE AJAX

// fonction getElement
function getel(elm) {
	return document.getElementById(elm);
}


function activateVisiteTest(){
	alert('coucou');	
}

function refreshVideo(){
	//cas où l'on choisit un nouveau patient, de suite=>desactive tout.
	$('#col01').html("<div style='width:500px;height:1000px;background-color:black;'></div>");
		getXhr();
// On défini ce qu'on va faire quand on aura la réponse
		xhr.onreadystatechange = function(){
// On ne fait quelque chose que si on a tout reçu et que le	serveur est ok
//		alert('test'+xhr.readyState+"status="+xhr.status);
		if(xhr.readyState == 4 && xhr.status == 200){			
			leselect = xhr.responseText;
// On se sert de innerHTML pour rajouter les options a la liste
			//document.getElementById('Visite').innerHTML =leselect;
			$('#col01').html(leselect);
		}
	}
// Ici on va voir comment faire du post
//ATTENTION AU LIEN=> C EST UN LIEN DIRECT
		xhr.open("POST","dynamic.php?link=dynaVideo",true);
// ne pas oublier ça pour le post
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
// ne pas oublier de poster les arguments
// ici, l'id de l'input
		xhr.send("refresh=video");
}


function validerPost(){

	//verifie si c'est une suppression ou un enregistrement
	valeur = $('#SUBMITORSUPPRIMER').val();
	
	if(valeur=="S"){
		//alert('delete');
		if(confirm("Voulez vous vraiment supprimer cette fiche ?")) {
		// les données sont ok, on peut envoyer le formulaire 			
			return true;
		} else {
		// sinon on affiche un message
		// et on indique de ne pas envoyer le formulaire
			return false;
		}
	}else{
		return true;
	}
	
}