	<script src="js/util.js" type="text/javascript"></script>
	<script type="text/javascript">
	// SCRIPT MENU	
	$(document).ready( function () {
	    // On cache les sous-menus
	    // sauf celui qui porte la classe "open_at_load" :
	    $(".menu ul.subMenu:not('.open_at_load')").hide();
	    // On sélectionne tous les items de liste portant la classe "toggleSubMenu"
	
	    // et on remplace l'élément span qu'ils contiennent par un lien :
	    $(".menu li.toggleSubMenu span").each( function () {
	        // On stocke le contenu du span :
	        var TexteSpan = $(this).text();
	        $(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a>') ;
	    } ) ;
	
	    // On modifie l'évènement "click" sur les liens dans les items de liste
	    // qui portent la classe "toggleSubMenu" :
	    $(".menu li.toggleSubMenu > a").click( function () {
	        // Si le sous-menu était déjà ouvert, on le referme :
	        if ($(this).next("ul.subMenu:visible").length != 0) {
	            $(this).next("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } );
	        }
	        // Si le sous-menu est caché, on ferme les autres et on l'affiche :
	        else {
	            $(".menu ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") });
	            $(this).next("ul.subMenu").slideDown("normal", function () { $(this).parent().addClass("open") } );
	
	        }
	        // On empêche le navigateur de suivre le lien :
	        return false;
	    });
	
	} ) ;
	
	</script>
	<div id="pied">
		<br/>nFactory&#169;2011 - fred_ric@hotmail.com 
		<div id="trackCode" style="display:none;">
			<!-- START OF HIT COUNTER CODE -->
			<br><script language="JavaScript" src="http://www.counter160.com/js.js?img=9"></script><br><a href="http://www.000webhost.com"><img src="http://www.counter160.com/images/9/left.png" alt="Free web hosting" border="0" align="texttop"></a><a href="http://www.hosting24.com"><img alt="Web hosting" src="http://www.counter160.com/images/9/right.png" border="0" align="texttop"></a>
			<!-- END OF HIT COUNTER CODE --> 
		</div>
	</div>
</div>
</body>
</html>