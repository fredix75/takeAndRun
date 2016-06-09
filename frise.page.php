<?php
	include_once("class/frise.class.php");
	
	$frise=new frise();
	
	$tableau=array("SUE","NOR","DNK","NDL","OCCI","FRA","STERG","STEG","GER","EMAUT","AUT","HUN","ITA","ANG","SCO","GB","ESP","POR");
	

foreach($tableau as $key=>$val){
	$array{$val}=$frise->getREGIME($val);
	$debut[$key]=$array{$val}[0]['DEBUT'];
}
	
foreach($debut as $key=>$val){
	if($key==0){
		$debut2=$val;
	}else{
		$debut2=($val<$debut2)?$val:$debut2;
	}
}

$debut2=floor($debut2/10)*10;
$fin=2014;
$fin2=2030;

$echelle=3;

?>


<style>
	.bande{
		height:100px;
		float:left;
		margin:20px 0px;
	}
	
	.segment{
		border:1px solid black;	
		float:left;
		height:100%;
		text-align:center;
		color:black;
	}
	.quignon{
		float:left;
		height:100%;		
	}
	
	.date{
		border:1px solid white;	
		float:left;
		height:20px;
		background-color:black;
		color:white;
		font-weight:bold;		
	}
</style>

<div class="bande" style="height:auto;width:<?php echo ($fin2-$debut2)*$echelle;?>px;margin-bottom:10px;">
<?php
	$i=$debut2;
	while($i<$fin2){
?>		
	<div class="date" style="width:<?php echo $echelle*10-2;?>px;"><?php echo $i; ?></div>
<?php		
		$i+=10;
	}

	foreach($tableau as $key=>$val){
		switch($val){
			
			case "OCCI":
				$height=280;
				$width=$array{$val}[0]['FIN']-$debut2;
				$quignon=$array{$val}[0]['DEBUT']-$debut2;
				$styl="";
				break;
			case "FRA":
				$height=100;
				$width=$fin-$array{"OCCI"}[0]['FIN'];
				$quignon=$array{$val}[0]['DEBUT']-$array{"OCCI"}[0]['FIN'];
				$styl="";
				break;			
			case "STERG":
				$height=420;
				$width=1648-$array{"OCCI"}[0]['FIN'];
				$quignon=$array{$val}[0]['DEBUT']-$array{"OCCI"}[0]['FIN'];
				$styl="";
				break;
			case "STEG":
				$height=340;
				$width=1806-1648;
				$quignon="";
				$styl="";
				break;
			case "GER":
				$height=100;
				$width=1949-1806;
				$quignon="";
				$styl="margin-bottom:0px;";
				break;
			case "ITA":
				$height=100;
				$width=$fin-1648;
				$quignon=$array{$val}[0]['DEBUT']-1648;
				$styl="";
				break;				
			case "EMAUT":
				$height=200;
				$width=1918-1806;
				$styl="";
				break;	
			case "AUT":
				$height=100;
				$width=$fin-1918;
				$styl="";
				break;
			case "HUN":
				$height=100;
				$width=$fin-1918;
				$styl="margin-top:0px;";
				break;
			case "ANG":
				$height=50;
				$width=1603-$debut2;
				$quignon=$array{$val}[0]['DEBUT']-$debut2;
				$styl="margin-bottom:0px;";
				break;						
			case "GB":
				$height=100;
				$width=$fin-1603;
				$quignon="";
				$styl="margin-top:-50px";
				break;	
			case "SCO":
				$height=50;
				$width=1603-$debut2;
				$quignon=$array{$val}[0]['DEBUT']-$debut2;
				$styl="margin-top:0px;";
				break;
			default:
				$height=100;
				$width=$fin-$debut2;
				$quignon=$array{$val}[0]['DEBUT']-$debut2;
				$styl="";
				break;
		}
?>		
	<div class="bande" style="height:<?php echo $height ?>px;width:<?php echo $width*$echelle;?>px;<?php echo $styl; ?>">
		<?php
			for($i=0;$i<count($array{$val});$i++){
				if(!$array{$val}[$i]['FIN'] || $array{$val}[$i]['FIN']==0 || $array{$val}[$i]['FIN']==null){
					$array{$val}[$i]['FIN']=2014;
				}
			
				$duree=$array{$val}[$i]['FIN']-$array{$val}[$i]['DEBUT'];			
				$dim=$duree*$echelle-2;
		
				if($i==0 && $array{$val}[0]['DEBUT']!=$debut2){
		?>
				<div class="quignon" style="width:<?php echo $quignon*$echelle;?>px;">&nbsp;</div>
		<?php			
				}
				if($duree>0){
					$type=$array{$val}[$i]['TYPE'];
					$bgcolor=$frise->getColor($type);
		?>		
				<div id="<?php echo $val.$i;?>" class="segment" style="width:<?php echo $dim;?>px;background-color:<?php echo $bgcolor;?>;"><?php echo $array{$val}[$i]['NOM']; ?><br/><?php echo $array{$val}[$i]['DEBUT']; ?>-<?php echo $array{$val}[$i]['FIN']; ?></div>
				<script type="text/javascript">
					$(function(){
						if($('#<?php echo $val.$i;?>').css('width').replace('px','')<=18 ){
							$('#<?php echo $val.$i;?>').text("");
						}else if($('#<?php echo $val.$i;?>').css('width').replace('px','')<=25 ){
							$('#<?php echo $val.$i;?>').css("font-size","60%");
						}else if($('#<?php echo $val.$i;?>').css('width').replace('px','')<=40 ){
							$('#<?php echo $val.$i;?>').css("font-size","80%");
						}
					});
				</script>
		<?php		
				}
			}
		?>		
	</div>
<?php
		if($val=="GER"){
?>
		<div class="bande" style="width:<?php echo (1990-1949)*$echelle;?>px;">
	<?php


			$duree=1990-1949;			
			$dim=$duree*$echelle-2;
			$bgcolor="#33CCFF";

	?>		
		<div id="RFA" class="segment" style="height:49%;width:<?php echo $dim;?>px;background-color:<?php echo $bgcolor;?>;">RFA<br/>1949-1990</div>
	<?php
			$bgcolor="grey";

	?>		
		<div id="RDA" class="segment" style="height:49%;width:<?php echo $dim;?>px;background-color:<?php echo $bgcolor;?>;">RDA<br/>1949-1990</div>	
	</div>	
	<div class="bande" style="width:<?php echo ($fin-1990)*$echelle;?>px;">
	<?php
		$duree=$fin-1990;			
		$dim=$duree*$echelle-2;
		$bgcolor="#33CCFF";

	?>		
		<div id="ALL" class="segment" style="width:<?php echo $dim;?>px;background-color:<?php echo $bgcolor;?>;">République Fédérale<br/>1990-</div>
	</div>
<?php
		}		
	}
?>	
</div>