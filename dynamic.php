<?php
ob_start();
session_start();
	
$link=$_GET['link'];
	
if($link=='deconnect'){
	session_destroy();
	header("Location:index.page.php");	
}
?>
<html>
	<head>
	</head>
	<body>
	<?php
	switch($link){
		case 'dynaVideo':
			include("inc/dynaVideo.html.php");
			break;
	}
?>
	</body>
</html>
<?php
ob_end_flush();
?>