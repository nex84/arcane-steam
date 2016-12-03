<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once('../../includes/fonctions_guilde.php');
require_once('../../includes/fonctions_class.php');
require_once('../../includes/fonctions_guilde.php');
require_once('../../includes/fonction_sort.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');

//gestion changement de class
$u = new joueur_data($_SESSION['id']);
//chargement de la guilde
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


<title>~Arcane-steam - Les arcanes de la vapeur</title>
</head>

<body id="userMain">

<?


if($_GET['lien'] == 'done' && $_POST['action'] == "")
{
	$affiche = "no";
	if($_GET['what'] == 'ajout')
	{
		echo '<div id="user">';
		echo '<h1> Ajouter un membre </h1>';
		echo '<div> <form method="POST" >Entrer le nom du joueur  : <input type="text" name="nom" value="" /> <input type="submit" name="action"  value="lunch"><input type="hidden" name="what" value="ajout" /></form> </div><br /><br />';
		echo '<br /><br /><br /><div><div /><a href="#" onclick="back();"> Retour </a>';
	}
	if($_GET['what'] == 'sup')
	{
		echo '<div id="user">';
		echo '<h1> Suprimer un membre </h1>';
		echo '<div> <form method="POST" >Entrer le nom du joueur  : <input type="text" name="nom" value="" /> <input type="submit" name="action"  value="lunch"><input type="hidden" name="what" value="sup" /></form> </div><br /><br />';
		echo '<br /><br /><br /><div><div /><a href="#" onclick="back();"> Retour </a>';
	}
	if($_GET['what'] == 'new')
	{
		echo '<div id="user">';
		echo '<h1> Changer de Guildmaster </h1>';
		echo '<div> <form method="POST" >Entrer le nom du joueur  : <input type="text" name="nom" value="" /> <input type="submit" name="action"  value="lunch"><input type="hidden" name="what" value="new" /></form> </div><br /><br />';
		echo '<br /><br /><br /><div><div /><a href="#" onclick="back();"> Retour </a>';
	}
	if($_GET['what'] == 'depart')
	{
		$id = $u->get_id();
		$guilde = $u->get_guilde();
		quit_guilde($id);
		?><script language="javascript">
	function ref(){
	window.parent.location.reload();
	}
	ref();</script><?
		
	}
}
else if($_POST['action'] == 'lunch')
{
	$affiche = "no";;
	if($_POST['what'] == 'ajout')
	{
		//recuperation parametre
		$nom = addslashes($_POST['nom']);
		$guilde = $u->get_guilde();
		ajout_joueur_guilde($nom,$guilde);
		$message = $nom . " a été ajouté &agrave; la guilde";
		
	}
	if($_POST['what'] == 'sup')
	{
		//recuperation parametre
		$nom = addslashes($_POST['nom']);
		$guilde = $u->get_guilde();
		suprime_joueur_guilde($nom,$guilde);
		$message = $nom . " a été retiré de la guilde";
	}
	if($_POST['what'] == 'new')
	{
		$nom = addslashes($_POST['nom']);
		$guilde = $u->get_guilde();
		change_guildmaster($nom,$guilde);
		$message = $nom . " est le nouveau GuildMaster";
	}
}
if($affiche == "" || $message != "") 
{
	$guilde = get_guilde($u->get_guilde());
	$liste_membres_guilde = get_liste_membres_guilde($u->get_guilde());
	//$u = new joueur_data($_SESSION['id']);
	echo '<div id="user">';
	echo '<h1>'.$guilde['nom'].'</h1>';
	echo '<div> <i>'. $guilde['desc_g']   .'</i></div><br />';
	echo '<div> Guildmaster : '. get_guildmaster($guilde['guildmaster'])  .'</div><br />';
	echo '<h2>Liste des membres de la guilde</h2>';
	echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
	echo '<tr>';
    echo '	<td class="td2">Login</td>';
    echo '    <td class="td2">Level</td>';
    echo '    <td class="td2">Position X / Y</td>';
    echo '</tr>';
	foreach($liste_membres_guilde as $key => $value)
	{
		if($value['nom'] != "")
			echo '<tr><td> '. $value['nom'] .' </td><td>'. $value['lvl'] .' </td><td>  x = '. $value['x'] .' / y = '. $value['y'] .' </td></tr>';
	}
	
	echo '</table>';
	
	echo '<br /><br /><h2>Mes options</h2>';
	if($guilde['guildmaster'] == $_SESSION['id'])
	{
		
		echo '<div><a href="'.$PHP_SELF.'?lien=done&what=ajout" class="lnk_mini"><img src="images/addGuild.png" alt="add" />  Ajouter un membre</a> </div><br />';
		echo '<div><a href="'.$PHP_SELF.'?lien=done&what=sup" class="lnk_mini"><img src="images/remouveGuild.png" alt="del" />  Supprimer un membre </a></div><br />';
		echo '<div> <a href="'.$PHP_SELF.'?lien=done&what=new" class="lnk_mini"><img src="images/passGuild.png" alt="change" /> Changer le GuildMaster </a></div><br />';
	}
	else
	{
		echo '<br /><div><a href="'.$PHP_SELF.'?lien=done&what=depart" class="lnk_mini"><img src="images/leave.png" alt="leave" /> Demissionner de la guilde </a> </div><br />';
	}
	
	echo '</div>';
	/*
	
	
	
	*/
}
?>

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

