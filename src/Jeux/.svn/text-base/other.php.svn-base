<?

session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
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
<script language="javascript">
	function ref(){
	window.parent.location.reload();
	}
</script>

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


<title>~Arcane-steam - Les arcanes de la vapeur</title>
</head>

<body id="userMain">
<script type="text/javascript" src="../../js/wz_tooltip.js"> </script>
<?
if(isset($_REQUEST['joueur_id']))
{
	$u = new joueur_data($_REQUEST['joueur_id']);
	
	echo '<div id="user">';
	echo '<h1>Options</h1>';
	echo '<br />Rang :  '. $u->get_rang() .'   |  Exp&eacute;rience  : '. $u->get_xp() .'  |  Classe  : '. $u->get_classe() .'   |  Race  : '. $u->get_race() .'  <br/ ><br /> ';
	echo '<a href="#" class="lnk_user" onclick="messagerie();"><img src="./images/envelope.jpg" />Envoyer un message a '.$u->get_login().'</a><br /><br />';
	
	if(isAttaquable( $_SESSION['id'], $_REQUEST['joueur_id'],1))
	{
		//'.$_REQUEST['joueur_id'].'
		echo '<img src="./images/sword_small.jpg"> <a onmouseover="Tip(\'Tente une attaqua standard sur le joueur '.$u->get_login().'\')" onmouseout="UnTip()" class="lnk_user" href="./include/Attaque_JcJ.php?id_def='.$_REQUEST['joueur_id'].'">Attaquer '.$u->get_login().'</a><br /><br />';
	}
	
	$me = new joueur_data($_SESSION['id']);
	$idClass = $me->get_idClass();
	
	//SELECT id, nom, image_path, range, type FROM sort WHERE id_class =
	$sql = "SELECT id, nom, image_path, `range`, `type`, `desc`, rate, formule_math  FROM sort WHERE id_class =".$idClass.' ORDER BY type;';
	
	$db = new database_connector();	
	$data = $db->send_sql($sql);
	
	//echo '<pre>';
	for($i = 0; $i <= $data['count'];$i++)
	{
		if(isAttaquable( $_SESSION['id'], $_REQUEST['joueur_id'],$data[$i]['range'] ))
		{
			$str_sec = "<h2>".$data[$i]['nom']."</h2><br /><br /><i>".$data[$i]['desc']."</i><br /><br />Chance de toucher <b>".(100 - $data[$i]['rate'])."</b><br />Range : <b>".$data[$i]['range']."</b><br/>Type <b>".$data[$i]['type']."</b><br/>Degat <b>".str_replace("&puis&","Puissance magique",$data[$i]['formule_math'])."</b>";
		
			echo '<a onmouseover="Tip(\''.addslashes($str_sec).'\')" onmouseout="UnTip()" class="lnk_user" href="./include/Attaque_JcJ.php?id_def='.$_REQUEST['joueur_id'].'">'.$data[$i]['nom'].'</a><br /><br />';
		}
	}
	//echo print_r($data);
	//echo '</pre>';
	
	
	echo '<br /><br /><br /><a href="#" class="lnk_user" onclick="ref();">Fermer la fenêtre </a><br /><br />';
echo '</div>';
	
	echo '</div>';
}
?>
</body>
</html>
