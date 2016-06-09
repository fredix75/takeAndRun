<?php
	$liste=array(873,875,628,627,877,562,876,880);
	$videoV=$video->getVideoById($liste);
?>
	<div id="chapeau">
		<br/><br/><br/>
		<p>Plus qu'un style de musique, c'est un ph�nom�ne global qui, entre autres, a modifi� en profondeur la repr�sentation de la jeunesse, et la mani�re de la vivre. Catalyseur au conflit des g�n�rations ou facteur de communion sociale, le Rock a p�n�tr� bien des sph�res et des dimensions de la soci�t�.
			Sa d�finition s'est �largie avec le temps et couvre d�sormais de nombreux courants. Revenons un peu sur ses origines, ses influences premi�res.
		</p>
		<br/>
	</div>
	<br/><br/>
	<div class="classic">
		<div class="art1">
			<h2 style="color:red;">On parle de... Rock n'Roll ?</h2>
			<br/><br/><br/>
			<p>On pourrait traduire cette expression par <i>balancer et rouler</i>. C'est le Disc Jockey Alan Freed qui va populariser le terme en s'inspirant notament de l'argot du Rythm & Blues ("My Baby rocks me with her steady roll" - "Ma ch�rie me fait balancer avec son p'tit roulement"). 
			Ces mots ont le m�rite de bien �voquer le balancement propre � cette musique.
<br/>Le <strong><i>rock</i></strong> vient des accents inatendus sur les temps pairs (l'<i>after-beat</i> ou <i>back-beat</i>), renforc�s par la caisse claire, qui suscitent cette envie irresistible de se tr�mousser.
<br/>Le <strong><i>roll</i></strong> serait plut�t le d�hanchement suave, la mo�lle qui adoucit par son roulis r�gulier, ce que le rock apporte de saccad� et de heurt�.
<br/><br/>Nous tenons l� les deux composantes essentielles de cette musique: � la fois masculine et f�minine.
			</p>
			<br/><br/>
		</div>
		<div class="clip1">
		<?php
			$v=0;		
			echo $video->getAffichage($videoV[$v]['LIEN'],'100%','250');
			$v++;
		?>
		</div>
	</div>
	
	<div id="mississipi">
		<h2>Blues sur le Mississipi</h2>
		<img src="../IMAGES/dossier/mississipi.jpg" style="float:left;position:relative;"/>
		<p style="float:right;width:67%;margin-right:20px;">Le berceau qui l'a vu na�tre est le delta que forme le Mississipi avec son petit affluent, le Yazoo. Un triangle au sommet duquel se trouve Memphis. Nous sommes � l'ouest extr�me de l'�tat du Mississipi.
			<br/><br/>Parler du Rock & Roll et du Blues, c'est parler de l'Am�rique et de l'esclavage. Ce sont des descendants d'esclaves venus d'Afrique qui ont �labor� cette musique si active rythmiquement. 
			Mais nombre parmi les premiers bluesmen ont aussi une origine strictement am�ricaine: des indiens cherrokees. C'est le cas, par exemple, de Big Joe Williams. Ainsi, Ce <i>Blues du Delta</i> est le produit d'une rencontre entre l'Afrique et l'Am�rique sur le sol am�ricain.
		</p>
		<br/><br/>
	</div>
	<div class="black">
		<br/>&nbsp;<br/>
		<div class="bandeclips">
		<?php
		for($i=$v;$i<($v+3);$i++){
		?>
			<div class="clip2">
			<?php		
				echo $video->getAffichage($videoV[$i]['LIEN'],'100%','249');
			?>
			</div>
		<?php
		}
		$v=$v+3;
		?>
		</div>
		<div class="classic">
			<br/>&nbsp;<br/>
		</div>
		<div class="classic" style="margin-top:20px;padding:0px 20px;">
			<p>Les premiers bluesmen comme Charley Patton, Big Joe Williams, Son House ou Bukka White sont n�s � la fin du 19e si�cle ou au d�but du 20e. Ils �voluent dans un univers rural et leurs premiers enregistrements datent des ann�es 30. 
			Leurs guitares sont acoustiques, leur jeu balance subtilement entre un mart�lement d'accords avec une rythmique tr�s active et d�taill�e et des traits solistes qui empruntent parfois des effets "gliss�s" � la guitare hawaiienne.</p>
		</div>
		<div class="classic" style="width:100%;height:50px;">
			<br/><br/><br/>
		</div>	
		<div class="cadre4">
			<div id="ju">
				<div style="background-color:#333333;width:400px;padding:20px;position:relative;float:left;">
					<h2 style="color:red;">Une sonorit� ambig�e</h2>
					<p>Le Blues (et apr�s lui, le Rock n'Roll) repose sur 3 accords. Mais ceux-ci sont tr�s diff�rents de la tradition classique. Ce ne sont pas, le plus souvent, des accords parfaits "majeurs" (si c'�tait le cas, le blues sonnerait bien plat). 
					Au lieu de cela, ces accords sont enrichis par des notes qui lui sont, � priori, �trang�res: des intervalles de 7e qui changent toute la sonorit�, et des tierces mineures qui entretiennent une ambig�it� harmonique qui font h�siter entre tonnalit� majeure et tonnalit� mineure. 
					La tierce mineure peut �galement �tre jou�e en m�me temps que la majeure, dans une �pre dissonance.
						<br/><br/>On y trouve encore des quintes diminu�es si "douloureuses", qui expriment si bien la plainte, l'amertume et la langueur que portent les paroles.
						<br/><br/>
					</p>
				</div>
				<div style="width:33%;position:relative;float:left;font-style:italic;text-align:left;border-left:dotted 1px white;padding-left:40px;margin-left:50px;">
					<p>As tu jamais march�
					<br/>march�...
					<br/>le long de cette vieille route solitaire
					<br/>Nul endroit o� aller
					<br/>Nul endroit o� cr�cher,
					<br/>o� embarquer..
					<br/><br/>
					Tout semble si sombre
					<br/>le long de cette route...
					<br/>Je repense � ta fa�on de me quitter
					<br/>et � ce que ta m�re a dit.
					<br/><br/>
					<br/>Tout a l'air si solitaire
					<br/>quand on n'a pas d'abri
					<br/>au-dessus de sa t�te.
					<br/>Alors qu'on pourrait �tre � la maison
					<br/>dormant dans un lit de plumes.
					<br/><br/>
					&nbsp;&nbsp;&nbsp;Muddy Waters & Big Bill Bronzy					
					</p>
				</div>					
			</div>		
			<div style="width:auto;height:360px;position:relative;float:left;">
				<div style="width:440px;height:360px;position:relative;float:left;">
					<?php	
						echo $video->getAffichage($videoV[$v]['LIEN'],'100%','100%'); 
						$v++;
					?>
				</div>
				<div style="width:40%;background-color:#333333;padding:20px;position:relative;float:left;height:310px;">
					<p><br/><br/><br/><br/>Ces enrichissements harmoniques vont mettre � jour des gammes qui ne ressemblent pas du tout aux gammes classiques, en y ajoutant du rythme et du suave. (Il appara�t d'ailleurs, pour le chercheur Gerard HERZHAFT, que ce style doit beaucoup � la musique de la culture amerindienne).
						<br/><br/>C'est ce langage que vont pratiquer les premiers rockers, Tout comme ils vont emprunter aux bluesmen leur v�h�mence, leur narration � la premi�re personne, leur usage immoder� de l'argot populaire et leurs allusions licencieuses.
					</p>
				</div>
			</div>
		</div>
		<div style="position relative;float:left;">
			<br/><br/<br/>
			<h2 style="color:red;margin-left:20px;">Des L�gendes du Blues rural</h2>
			<br/>
		</div>			
	</div>
	<br/><br/>
	<div id="legendes" style="position:relative;float:left;">
		<div class="ticket">
			<div class="tickettexte">
				<br/><br/>
				<h3>Sonny Boy Williamson</h3>
				<p>Ses chansons sont remplies d'�vocation de personnages, de lieux, de routes du Delta, de d�tails tr�s ordinaires appel�s � devenir mythiques.</p>			
			</div>
			<div class="ticketclip">
			<?php	
				echo $video->getAffichage($videoV[$v]['LIEN'],'100%','180px'); 
				$v++;
			?>
			</div>
		</div>		
		<div class="ticket">
			<div class="ticketclip" style="margin-left:20px;">
			<?php	
				echo $video->getAffichage($videoV[$v]['LIEN'],'100%','180px'); 
				$v++;
			?>
			</div>
			<div class="tickettexte">
				<br/><br/>
				<h3>Arthur Crudup</h3>
				<p>D�ja, il marie la guitare, la batterie et la basse. Il fait office de figure tut�laire du Rock puisque ce qui sera le premier succ�s d'Elvis est une reprise d'un de ses morceaux, le fameux "That's all right".</p>	
			</div>
		</div>
		<div class="ticket">
			<div class="tickettexte">
				<br/><br/>
				<h3>Robert Johnson</h3>
				<p>Sa vie courte et aventureuse va constituer pour les premiers rockers une source d'inspiration et, h�las, un mod�le de destin tragique. On pr�tend qu'il aurait vendu son �me au Diable en �change d'�crire une musique magn�tique. Il est mort en 1938 � 27 ans, empoisonn� par un mari jaloux apr�s une vie d'errance.</p>			
			</div>
			<div class="ticketclip">
			<?php	
				echo $video->getAffichage($videoV[$v]['LIEN'],'100%','180px'); 
				$v++;
			?>
			</div>
		</div>
	</div>
	<div style="text-align:justify;margin-top:5px;position:relative;float:left;height:auto;">
		<img src="../IMAGES/dossier/house_yazoo.jpg" width="100%" />
	</div>
	<div>&nbsp;</div>
	<div style="background-color:black;color:white;position:relative;padding:20px;margin-top:-1.5em;">
		<p>Ces artistes enregistrent dans les ann�es 30 et 40, en une prise, des petits joyaux d'invention langagi�re, de gouaille et de d�sespoir m�l�s, des joyaux d'un sentiment musical parfaitement original, avec un mat�riau sonore certes tr�s simple, mais une vari�t� de modes de jeu, de menus inflexions et une intensit� d'expression qui font la richesse de cette musique aux sources du Rock & Roll.
			<br/><br/>Les plus jeunes bluesmen vont avoir l'ambition de quitter leur milieu rural - et leur mis�re - pour gagner les villes du nord, en particulier Chicago.
		</p>
		<br/><br/>
	</div>


	
	
