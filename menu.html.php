<ul class="menu">
	<li class="toggleSubMenu"><span>CATEGORIES</span>
		<ul class="subMenu">
<?php
	$key=array();
	for($i=0; $i<count($arrayCategories);$i++){
		$key[$i]=array_search($arrayCategories[$i][0],$arrayCategorie)
?>
			<li><a href="index.page.php?link=movies&categorie=<?php echo $arrayCategories[$i][0];?>"><?php echo $key[$i] ;?></a></li>
<?php	
		}
?>
		</ul>
	</li>
	<li class="toggleSubMenu"><span>PERIODES</span>
		<ul class="subMenu">
<?php
	for($i=0; $i<count($arrayPeriodes);$i++){
?>
			<li><a href="index.page.php?link=movies&periode=<?php echo $arrayPeriodes[$i][0];?>"><?php echo $arrayPeriodes[$i][0] ;?><img src="IMAGES/menu/<?php echo $arrayPeriodes[$i][0]?>.png" width=30px /></a></li>
<?php	
		}
?>
		</ul>
	</li>
	<li class="toggleSubMenu"><span>DOSSIERS</span>
		<ul class="subMenu">
			<li><a href="index.page.php?link=dossier&cat=rock">Une histoire du Rock</a></li>
		</ul>
	</li>
	<hr/>
<?php
	$limit=count($arrayRubriques);
	for($i=0;$i<$limit;$i++){
?>
	<li class="toggleSubMenu"><span><?php echo $arrayRubriques[$i]['RUBRIQUE']; ?></span>
		<ul class="subMenu">
<?php
		for($j=0;$j<count($arrayLiens);$j++){
			if($arrayLiens[$j]['RUBRIQUE']==$arrayRubriques[$i]['RUBRIQUE']){
?>
			<li><a href="http://<?php echo $arrayLiens[$j]['LIEN']; ?>" title="<?php echo $arrayLiens[$j]['NOM']; ?>" target="_blank">
			<?php 
				if($arrayLiens[$j]['IMAGE']){
			?>
					<img src="IMAGES/menu/<?php echo $arrayLiens[$j]['IMAGE']; ?>"  height=30px />
			<?php		
				}else{
					echo $arrayLiens[$j]['NOM']; 
				}
			?>
			</a></li>
<?php			
			}
		}
?>		
		</ul>
	</li>
<?php
	}
?>	
</ul>