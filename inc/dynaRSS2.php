<?php 
if($link=="news"){
?>
<div style="background-color:#191970;padding:15px 10px;">
	<h1><?php echo ($arrayRSS[$j]['IMAGE'])?'<img src="IMAGES/news/'.$arrayRSS[$j]['IMAGE'].'" width="120px" />':$arrayRSS[$j]['TITRE'];?></h1>
</div>
<?php
}
?>
<div id="article-body2">
<?php
	for($i=0;$i<count($flux);$i++){
?>
		<div class="article"><a href="<?php echo $flux[$i]['link']; ?>" target="_blank">			
			<?php if(!$noCat[$j]){?><small style="font-weight:bold;"><?php echo $flux[$i]['category']; ?></small><?php } ?>
			<small style="float:right;"><?php echo  date("d-m-Y H:i",$flux[$i]['date_timestamp']); ?></small>
			<h2><?php echo $flux[$i]['title']; ?></h2>
			<div class="article-tx"><?php
				echo $flux[$i]['description'];
			?></div>
		</a></div>
<?php
	}
?>
</div>

