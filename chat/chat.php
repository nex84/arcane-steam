<?php
	@session_start();
	require_once('../includes/constant.inc.php');
	require_once('../includes/functions.inc.php');
	require_once('../includes/fonctions_guilde.php');
	require_once('../includes/fonctions_class.php');
	require_once('../includes/request.sql.php');
	$anti_path = return_anti_path();
	include $anti_path.'class/database/database_connector.class.php';
	include $anti_path.'class/joueur/joueur_data.class.php';
	require_once "src/phpfreechat.class.php"; // ajustez le chemin
	$u = new joueur_data($_SESSION["id"],'caracts_now');
	$params["serverid"] = md5(__FILE__);
 	$params["nick"]     = $u->get_nom(); // ce pseudo peut-êe répé depuis une base de donné
	
	require_once('index.php');
?>	