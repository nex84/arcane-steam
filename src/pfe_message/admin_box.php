<?php 

//ouverture de la session
session_start();
require_once("./css/message_box.css");
require_once("./class/box.class.php");
require_once("./class/message.class.php");
require_once("./fonction/function_affichage_pack1.php");
require_once("./ouverture_sgbd.php");
require("../../includes/functions.inc.php");
require_once("./fonction/function_pack1.php");
$anti_path = return_anti_path();
require($anti_path . "/includes/request.sql.php");
require($anti_path . "/includes/constant.inc.php");
require_once($anti_path . "/class/database/database_connector.class.php");

$u = new joueur_data($_SESSION['id']); 
$tab['id'] = $_SESSION['id'];
$tab['nom'] = $u->get_login();

if($_GET['action'] == "delete")
{
	$tab['box'] = $_GET['box'];
	box::dispatch_box($tab,"delete_box");
	$_GET['action'] = "liste";
}
if($_GET['action'] == "nouveau")
{
		if($_GET['moment'] == "1")
			admistration_box_form_creation($tab);
		if($_GET['moment'] == "2")
		{
			$tab['nom_box'] = $_POST['nom_box'];
			box::dispatch_box($tab,"new_box");
			$_GET['action'] = "liste";
		}
}
unset($_POST);
if($_GET['action'] == "" || $_GET['action'] == "liste")
	admistration_box($tab);


?>