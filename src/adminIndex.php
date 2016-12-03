<?php
	@session_start();
	require_once('../includes/constant.inc.php');
	require_once('../includes/functions.inc.php');
	require_once('../includes/fonctions_guilde.php');
	require_once('../includes/fonctions_class.php');
	require_once('../includes/request.sql.php');
	
	if(!isset($_SESSION["id"]))
		header('Location: https://www.arcane-steam.com');
	
	$u = new joueur_data($_SESSION["id"],'caracts_now');
	
	if($u->get_isAdm() == 0)
		header('Location: https://www.arcane-steam.com');
	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Administration</title>
		<link href="../css/style.css" rel="stylesheet" type="text/css">	
	</head>
	<body>
		<div id="content">
			<div class="cadreaveconglet">
            <hr />
         	Bienvenus dans l'interface d'administration \o/
          	<hr />
            </div>
		<?
        	require_once("./footer.php");
		?>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
		<div style="clear:both;"></div>
	</body>
</html>

