<?php

?>
<p>Vous avez vu cette page <span id="visites"></span> fois</p>
<script>
// Détection
if(typeof localStorage!='undefined') {
  // Récupération de la valeur dans web storage
  var nbvisites = localStorage.getItem('visites');
  // Vérification de la présence du compteur
  if(nbvisites!=null) {
    // Si oui, on convertit en nombre entier la chaîne de texte qui fut stockée
    nbvisites = parseInt(nbvisites);
  } else {
    nbvisites = 1;
  }
  // Incrémentation
  nbvisites++;
  // Stockage à nouveau en attendant la prochaine visite...
  localStorage.setItem('visites',nbvisites);
  // Affichage dans la page
  document.getElementById('visites').innerHTML = nbvisites;
} else {
  alert("localStorage n'est pas supporté");
}
</script>