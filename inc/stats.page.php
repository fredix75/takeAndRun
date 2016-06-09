<?php

$arrayCategories=$video->getStats('CATEGORIE');

?>
<table style="width:30%;text-align:left">
	<tr>
		<th>Catégorie</th>
		<th>Nombre</th>
	</tr>
<?php
$key=array();
for($i=0; $i<count($arrayCategories);$i++){
	$key[$i]=array_search($arrayCategories[$i][0],$arrayCategorie);
?>
	<tr>
		<td style="width:100px;"><a href="index.page.php?link=accueil&categorie=<?php echo $arrayCategories[$i][0];?>"><?php echo $key[$i] ;?></a></td>
		<td style="width:50px;"><?php echo $arrayCategories[$i][1] ;?></td>
	</tr>
<?php	
}

?>
</table>
