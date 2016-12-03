<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once('../../includes/fonctions_guilde.php');
require_once('../../includes/fonctions_class.php');
require_once('../../includes/fonction_sort.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');

//gestion changement de class
$u = new joueur_data($_SESSION['id']);



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

<?
if($_POST['class'] != "")
{
	//changement de class !
	
	$race = $u->get_race();
	$id_class = $u->get_idCLass();
	$new = $_POST['class'];
	$id_joueur = $_SESSION['id'];
	change_class_valide($id_joueur,$id_class,$new,$race); 
	//recuperatrion sort a saver
	$i  = 1;
	foreach($_POST as $key => $calue)
	{
		if(substr($key,0,4) == 'sort')
		{
			save_sort($id_joueur,$calue,$i);
			$i++;
		}
		
	}
	if($i==2)
	{
			save_sort($id_joueur,0,2);
	}
	?><script type="text/javascript"> ref(); </script> <?
}
//$u = new joueur_data($_SESSION['id']);
echo '<div id="user">';
echo '<h1>Changement de Class</h1>';
if($u->get_idClass() == 0)
{
	$class_aff = recup_first_liste_class($u->get_race());
}
else
{
	$class_aff = recup_liste_class($u->get_idCLass());
}	
echo '<h1>Selectionnez les sorts que vous souhaitez garder</h1>';
$liste_sort = get_liste_sort_for_keep($u->get_id(),$u->get_idCLass());
$liste_sort = get_liste_sort_for_keep($u->get_id(),$u->get_idCLass());
echo '<form name="frm" id="frm" method="POST">';
foreach($liste_sort as $key => $nom)
{
	if($nom['nom'] != "")
		echo '<br />' .$nom['nom']. '    <input type="checkbox" name="sort_'. $nom['id'] .'" value="'. $nom['id'] .'"><br />';
}
echo '<input type="hidden" value="" name="class" id="class">';
echo '</form>';
echo '<br />Co&ucirc;t du changement de classe  : '. return_prix_class($u->get_xp_class(),get_class_rang($u->get_idCLass())) . '<br /><br />';
foreach($class_aff as $key => $value)
{
	if($value['nom'] != "")
	echo '<div>     <a href="#" onClick="getDescription('.$value['id'].')">' . $value['nom'] . '</a></div><div  style="float:left" ><input type="submit" name="envoie" onClick="document.getElementById(\'class\').value='.$value['id'].'; document.frm.submit();" value="Changer de classe"> </div><div style="clear:both "> &nbsp;</div><br />';
}
echo '<div id="desc" style="width:300px" ></div>';
echo '<br /><br /><br /><a href="#" class="lnk_user" onclick="ref();">Fermer la fenêtre </a><br /><br />';

echo '</div>';
/*



*/

?>
<div 
<script language="javascript">

function getDescription(id)
{
    var _xhr=new HTTPObject();
    _xhr.setVar('container','zone_map');
	_xhr.addArg('idClass',id);
    _xhr.callBack('affDef');
    _xhr.post('./ajax/description.php');
}

function affDef(o,v){
	document.getElementById('desc').innerHTML=o.responseText
}

</script>


</body>
</html>

