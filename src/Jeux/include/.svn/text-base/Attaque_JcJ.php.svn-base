<?
session_start();
require_once('../../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../style.css" rel="stylesheet" media="all" />

<!--  Prototype Window Class Part -->
<script type="text/javascript" src="../../../js/prototype.js"> </script> 
<script type="text/javascript" src="../../../js/effects.js"> </script>
<script type="text/javascript" src="../../../js/window.js"> </script>

<script type="text/javascript" src="../../../js/window_effects.js"> </script>
<script type="text/javascript" src="../../../js/debug.js"> </script>
<script type="text/javascript" src="../../../js/utility.js"> </script>
<script type="text/javascript" src="../../../js/tinytip.js"> </script>

<link href="../../css/default.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/spread.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>

<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/debug.css" rel="stylesheet" type="text/css" >	 </link>


<title>~Arcane-steam Les arcanes de la vapeur</title>
</head>

<body id="userMain">
<script type="text/javascript" src="../../../js/wz_tooltip.js"> </script>
<?
//$db = new database_connector();
	$attaquant = new joueur_data($_SESSION['id']);
	$defender = new joueur_data($_REQUEST['id_def']);
	echo '<div id="user">';
	echo '<h1>Combat</h1>';
	echo '<table cellpadding="0" cellspacing="0" border="0" valign="top">';
	echo '	<tr>';
	echo '		<td width="250px" align="center">';
	echo '<h2>'.$attaquant->get_login().'</h2>';
	//check de l'avatar
	echo '<img src="../images/avatar_default.jpg"/>';
	echo '		<br /><br />';
	if(isAttaquable( $_SESSION['id'], $_REQUEST['id_def']))
	{
		echo '<a href="#" onClick="QuickAttak('.$_SESSION['id'].','.$_REQUEST['id_def'].');">Attaque rapide</a><br />';
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
		if(isAttaquable( $_SESSION['id'], $_REQUEST['id_def'],$data[$i]['range'] ))
		{
			$str_sec = "<h2>".$data[$i]['nom']."</h2><br /><br /><i>".$data[$i]['desc']."</i><br /><br />Chance de toucher <b>".(100 - $data[$i]['rate'])."</b><br />Range : <b>".$data[$i]['range']."</b><br/>Type <b>".$data[$i]['type']."</b><br/>Degat <b>".str_replace("&puis&","Puissance magique",$data[$i]['formule_math'])."</b>";
			echo '<a onmouseover="Tip(\''.addslashes($str_sec).'\')" onmouseout="UnTip()" href="#" onClick="QuickAttakSpell('.$_SESSION['id'].','.$_REQUEST['id_def'].','.$data[$i]['id'].',\''.$data[$i]['nom'].'\')">'.$data[$i]['nom'].'</a><br />';
		}
	}
	
	echo '		</td>';
	echo '		<td width="2" bgcolor="#FF9900"></td>';
	echo '		<td width="250px" align="center"  valign="top">';
	echo '<h2>'.$defender->get_login().'</h2>';
	echo '<img src="../images/avatar_default.jpg"/>';
	echo '		<br /><br />';
	echo '		</td>';
	echo '	</tr>';
	echo '	<tr>';
	echo '		<td colspan="3" align="center">';
	echo '			<h2>Journal de combat</h2>';
	echo '		</td>';
	echo '	</tr>';
	
	echo '	<tr>';
	echo '		<td colspan="3" align="center">';
	echo '			<div id="divJournalDeCombat"></div>';
	echo '		</td>';
	echo '	</tr>';
	
	echo '</table>';
	echo '</div>';
?>

<script language="javascript">

function QuickAttakSpell(j,k,id,s)
{
    var _xhr=new HTTPObject();
    _xhr.addArg('id_attak',j);
	_xhr.addArg('id_def',k);
	_xhr.addArg('spell',s);
	_xhr.addArg('id_spell',id);
    _xhr.setVar('container','zone_caracteristique');
    _xhr.callBack('log_combatSpell');
    _xhr.post('../ajax/quickSpell.php');
}

function QuickAttak(j,k)
{
    var _xhr=new HTTPObject();
    _xhr.addArg('id_attak',j);
	_xhr.addArg('id_def',k);
    _xhr.setVar('container','zone_caracteristique');
    _xhr.callBack('log_combat');
    _xhr.post('../ajax/quickAttaque.php');
}

function log_combatSpell(o,v)
{
	var response = o.responseText;
	var name= <? echo "'".$defender->get_login()."'"; ?>;
	var tab = response.split(';');
	
	var txt_touch = '';
	var txt_crit = '';
	
	if(tab[2] == 1) // critique
	{
		txt_crit = '<span style="color:#FF0000">(Critique)</span>';
	}
	txt_start = 'Vous lancez : ' + tab[8];
	
	
	if(tab[0] == 0) // toucher
	{
		txt_touch = '<span style="color:#55FF55">Vous avez touché (' + tab[5] + ') ' + name + ' (' + tab[6] + ') pour ' + tab[1] + ' </span>' + txt_crit;
	}
	else
	{
		txt_touch = '<span style="color:#FF9900">'+ name + ' a esquiver (' + tab[6] + ') votre attaque (' + tab[5] + ')</span> ' + txt_crit;
	}
	
	var txt_final = txt_start + '<br />' + txt_touch + '<br />';
	
	txt_final += 'Vous avez gagné ' + tab[4] +' xp<br />';
	
	if(tab[3] == 1)
	{
		txt_final += name + ' est mort<br />';
	}
	else
	{
		txt_final += name + ' à survecus votre assaut.<br />';
	}
	
	if(tab[9] == 0)
	{
		txt_final = txt_start + '<br />' +  tab[8] + ' a échoué<br />';
	}
	
	if(tab[7] == 1)
	{
		var d = document.getElementById('divJournalDeCombat');
		var t = d.innerHTML;
		
		txt_final += t;
	}
	else
	{
		alert('Vous n avez plus asser de P.S');
	}
	
	d.innerHTML = txt_final;
	
}

function log_combat(o,v)
{
	var response = o.responseText;
	var name= <? echo "'".$defender->get_login()."'"; ?>;
	var tab = response.split(';');
	
	var txt_touch = '';
	var txt_crit = '';
	
	if(tab[2] == 1) // critique
	{
		txt_crit = '<span style="color:#FF0000">(Critique)</span>';
	}
	
	if(tab[0] == 1) // toucher
	{
		txt_touch = '<span style="color:#55FF55">Vous avez toucher (' + tab[5] + ') ' + name + ' (' + tab[6] + ') pour ' + tab[1] + ' </span>' + txt_crit;
	}
	else
	{
		txt_touch = '<span style="color:#FF9900">'+ name + ' a esquiver (' + tab[6] + ') votre attaque (' + tab[5] + ')</span> ' + txt_crit;
	}
	
	var txt_final = txt_touch + '<br />';
	
	txt_final += 'Vous avez gagner ' + tab[4] +' xp<br />';
	
	if(tab[3] == 1)
	{
		txt_final += name + ' est mort<br />';
	}
	else
	{
		txt_final += name + ' a survecus a votre asault<br />';
	}
	
	if(tab[7] == 1)
	{
		var d = document.getElementById('divJournalDeCombat');
		var t = d.innerHTML;
		
		txt_final += t;
	}
	else
	{
		alert('Vuos n avez plus asser de P.A');
	}
	
	d.innerHTML = txt_final;
	
}

</script>

</body>
</html>

