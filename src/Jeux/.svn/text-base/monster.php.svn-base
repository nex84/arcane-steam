<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
include $anti_path.'class/PNJ/PNJ.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');
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
<script language="javascript">
	function ref(){
	window.parent.location.reload();
	}
</script>

<link href="../../css/default.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/spread.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>

<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/debug.css" rel="stylesheet" type="text/css" >	 </link>


<title>~Arcane-steam - Les arcanes de la vapeur</title>
</head>

<body id="userMain">

<script type="text/javascript" src="../../js/wz_tooltip.js"> </script>

<div id="user">

<?
if(isset($_REQUEST['monster_id']))
{
$u = new pnj($_REQUEST['monster_id'],'monster');
echo '<h1>[#'.$u->get_id().'] - '.$u->get_name().'</h1>';

if(isAttaquableMonster($_SESSION['id'],$_REQUEST['monster_id']))
{
		echo '<img src="./images/sword_small.jpg"> <a class="lnk_user" href="./include/Attaque_Monster.php?id_def='.$_REQUEST['monster_id'].'">Attaquer '.$u->get_name().'</a><br/>';
}

	$me = new joueur_data($_SESSION['id']);
	$idClass = $me->get_idClass();
	
	//SELECT id, nom, image_path, range, type FROM sort WHERE id_class =
	$sql = "SELECT id, nom, image_path, range, type FROM sort WHERE id_class =".$idClass.' ORDER BY type;';
	
	$db = new database_connector();	
	$data = $db->send_sql($sql);
	
	//echo '<pre>';
	for($i = 0; $i <= $data['count'];$i++)
	{
		if(isAttaquableMonster( $_SESSION['id'], $_REQUEST['monster_id'],$data[$i]['range'] ))
		{
			//echo '<a class="lnk_user" href="./include/Attaque_Monster.php?id_def='.$_REQUEST['monster_id'].'">'.$data[$i]['nom'].'</a><br />';
		}
	}

echo '<h1>Description</h1>';
echo '<p>'.$u->get_descript().'</p>';
echo '<br /><br /><br /><a href="#" class="lnk_user" onclick="ref();">Fermer la fenêtre </a><br /><br />';
echo '</div>';
}


?>

</div>
</body>
</html>





