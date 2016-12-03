<?php
    session_name( "phpfreechat" );
    session_start();
	
	require_once "src/phpfreechat.class.php"; // ajustez le chemin
	require_once('../includes/constant.inc.php');
	require_once('../includes/functions.inc.php');
	$anti_path = return_anti_path();
	include $anti_path.'class/database/database_connector.class.php';
	include $anti_path.'class/joueur/joueur_data.class.php';
	$u = new joueur_data('1');
	$params["serverid"] = md5(__FILE__);
 	//$params["nick"]     = $u->get_login(); // ce pseudo peut-�e r�p� depuis une base de donn�
	$params["title"] = "Arcane-Steam - La taverne du MAX boure";
	$params["channels"] = array('Arcane-tavern','Ma guild','my private show room');
	
  	$chat = new phpFreeChat($params);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Arcane-steam : guilde de test</title>
	</head>
    	<body>
      		<?php $chat->printChat(); ?>
    	</body>
</html>
