<?php
include_once('class/User.class.php');

$gestion=new User();
$arrayVignette=$gestion->getVignette(3);
for($i=($_GET['last']+1);$i<($_GET['last']+19);$i++){
	if($arrayVignette[$i]){
?>
	<div id="<?php echo $i; ?>" class="vign" style="float:left;">
		<img  style="margin-left:50px;" src="<?php echo 'IMAGES/vignettes/'.$arrayVignette[$i]; ?>" height="200px"/>
		<a href="index.page.php?link=gestion&cat=gererVignettes&delete_i=<?php echo $i;?>" onclick="return confirm('Etes vous sûr de vouloir virer cette image ?');"><img src="IMAGES/buttons/supprimer.png" title="supprimer l'image" width=20px /></a>		
	</div>
<?php
	}else{
		break;
	}
}
?>