<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
	<meta name="description" content="Fré" />
	<meta name="keywords" content="Fré" />
	<meta name="author" content="FF" />
	<title>FréF</title>

	<link rel="icon" type="image/png" href="IMAGES/fav.gif" />
	<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="IMAGES/foot.gif" /><![endif]-->
	<link href="css/styl7.css" rel="stylesheet" type="text/css" media="screen,print" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>  
<body>
	<header>
		TEST
	</header>
<form action="test.php" method="POST">
<input class="rang" id="red" name="r1" type="range" min="0" max="255" value="128">
<input class="rang" id="green" name="r2" type="range" min="0" max="255" value="128">
<input class="rang" id="blue" name="r3" type="range" min="0" max="255" value="128">
  <input type="submit" value="Go">
</form>
<?php 
	print_r($_POST);
?>
	<footer>
	</footer>
<script>
	$('.rang').click(function(){
		red=$('#red').val();
		green=$('#green').val();
		blue=$('#blue').val();
		$('body').css("background-color","rgb("+red+","+green+","+blue+")");
	});

	$(function(){
		var red=$('#red').val();
		var green=$('#green').val();
		var blue=$('#blue').val();
		$('body').css("background-color","rgb("+red+","+green+","+blue+")");
	});
</script>	
</body>
</html>