<?php

//recuperation de l'id de la class
session_start();
$id = $_REQUEST['idClass'];
require_once('../../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

require_once($anti_path.'includes/fonctions_attaque.php');
require_once($anti_path.'includes/fonctions_experience.php');
require_once($anti_path.'includes/fonctions_level.php');
require_once($anti_path.'includes/fonctions_class.php');
require_once($anti_path.'includes/fonction_sort.php');
require_once($anti_path.'includes/fonctions_utilisation_point.php');

$class = get_class_by_id($id);
$liste_sort = get_sort_by_class($id);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="./style.css" rel="stylesheet" media="all" />

<!--  Prototype Window Class Part -->
<script type="text/javascript" src="../../js/prototype.js"> </script> 
<script type="text/javascript" src="../../js/effects.js"> </script>
<script type="text/javascript" src="../../js/window.js"> </script>

<script type="text/javascript" src="../../js/window_effects.js"> </script>
<script type="text/javascript" src="../../js/debug.js"> </script>
<script type="text/javascript" src="../../js/utility.js"> </script>
<script type="text/javascript" src="../../js/tinytip.js"> </script>

<link href="../../css/default.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/spread.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>

<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/debug.css" rel="stylesheet" type="text/css" >	 </link>


<title>~Arcane-steam Les arcanes de la vapeur</title>
</head>

<body>

<?
$u = new joueur_data($_SESSION['id']);
echo '<div id="user">';
echo '<u>Description de la class : '. $class['1']['nom'] .'</u><br /><br />';
echo '<div>'. $class['1']['desc'] .' </div><br /><br /><br /><br />';
echo '<u>Liste des sort associés</u><br />';
foreach($liste_sort as $key => $value)
{
	echo 'nom : '. $value['nom'] .'<br />';
	echo 'type : '. $value['type'] .'<br />';
	echo 'Description : '. $value['desc'] .'<br />';
}
echo '</div>';
/*
*/
?>
</body>
</html>