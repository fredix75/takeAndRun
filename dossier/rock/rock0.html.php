<?php
$page=($_GET['page'])?$_GET['page']:1;
$table=array();
$table[1]="Le Blues du Delta";
$table[2]="Go to Chicago";
$table[3]="Country Music";

?>

<link href="css/dossier.css" rel="stylesheet" type="text/css" media="screen,print" />

	<div id="dossier">
		<div id="dossTitre">
			<?php echo $gestion->getCategorie(15,0,0); ?>
			<br/><br/>
			<h1>Une Histoire du Rock</h1>
			<br/><br/><br/>
			<div id="dossNav">
				<ul>
<?php
				 for($i=1;$i<=count($table);$i++){
?>
					<li>
<?php
					if($i!=$page){					
?>
						<a href="index.page.php?link=dossier&page=<?php echo $i; ?>">
<?php
					}
					echo $table[$i];
					
					if($i!=$page){
?>
						</a>
<?php
					}
?>					
					</li>
<?php
				}
?>
				</ul>
			</div>
		</div>

<?php	include('rock'.$page.'.html.php'); ?>	

		<div style="width:100%;position:relative;float:left;background-color:#333333;color:white;padding:0px 0px 20px 0px;">
			navigation ->>>>
			Crédits ->>>>>>
		</div>
	</div>

