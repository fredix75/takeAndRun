<?php 
if($link=="news"){
?>
<div style="background-color:<?php echo ($color)?$color:"#708090"; ?>;padding:15px 10px;border-radius:10px 10px 0px 0px;">
	<h1><?php echo ($arrayRSS[$j]['IMAGE'])?'<img src="IMAGES/news/'.$arrayRSS[$j]['IMAGE'].'" width="120px" />':$arrayRSS[$j]['TITRE'];?></h1>
</div>
<?php
}
?>
<div id="article-body" style="background-color:<?php echo ($color)?$color:"#708090"; ?>;">
<?php
	for($i=0;$i<=6;$i++){
		//$fluxRSS->getArticle($flux[$i],$arrayRSS[$j]['NOCAT']);
?>
		<div class="article" style="border-left:3px dotted <?php echo ($color)?$color:"#708090"; ?>;"><a href="<?php echo $flux[$i]['link']; ?>" target="_blank">			
			<?php if(!$arrayRSS[$j]['NOCAT'] && $link=="news"){?><small style="font-weight:bold;"><?php echo $flux[$i]['category']; ?></small><?php } 
					elseif($link!="news") {?><img src="IMAGES/news/<?php echo $flux[$i]['image'];?>" height=15px /><?php } ?>			
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

