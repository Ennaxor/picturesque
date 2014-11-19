<?php 
		session_start(); 
?>

<head>
	<meta charset="utf-8" />
	<title>
	<?php 
		if(isset($webTitle)) echo $webTitle;
	?>
	</title>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css" title="Estilo Principal"/>
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" title="Estilo Principal" />
	<link href="css/accesible.css" rel="alternate stylesheet" type="text/css" title="Estilo Accesible"  />
	<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
	<script src="js/style.js"></script>
	<script src="js/fillDate.js"></script>
	<script src="js/loginPopUp.js"></script>
	<script>cargarPagina();</script>
</head>