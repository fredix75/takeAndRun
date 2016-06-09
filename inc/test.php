<?php

?>
<p>Vous avez vu cette page <span id="visites"></span> fois</p>
<script>
// D�tection
if(typeof localStorage!='undefined') {
  // R�cup�ration de la valeur dans web storage
  var nbvisites = localStorage.getItem('visites');
  // V�rification de la pr�sence du compteur
  if(nbvisites!=null) {
    // Si oui, on convertit en nombre entier la cha�ne de texte qui fut stock�e
    nbvisites = parseInt(nbvisites);
  } else {
    nbvisites = 1;
  }
  // Incr�mentation
  nbvisites++;
  // Stockage � nouveau en attendant la prochaine visite...
  localStorage.setItem('visites',nbvisites);
  // Affichage dans la page
  document.getElementById('visites').innerHTML = nbvisites;
} else {
  alert("localStorage n'est pas support�");
}
</script>