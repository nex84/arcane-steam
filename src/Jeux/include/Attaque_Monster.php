<?
session_start();
require_once('../../../includes/functions.inc.php');
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

<?
//$db = new database_connector();

	$attaquant = new joueur_data($_SESSION['id']);
	$defender = new pnj($_REQUEST['id_def'],'monster');
	echo '<div id="user">';
	echo '<h1>Combat</h1>';
	echo '<table cellpadding="0" cellspacing="0" border="0" valign="top">';
	echo '	<tr>';
	echo '		<td width="250px" align="center">';
	echo '<h2>'.$attaquant->get_login().'</h2>';
	//check de l'avatar
	echo '<img src="../images/avatar_default.jpg"/>';
	echo '		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
	
	if(isAttaquableMonster($_SESSION['id'],$_REQUEST['id_def']))
	{
	echo '<a href="#" onClick="QuickAttakMonster('.$_SESSION['id'].','.$_REQUEST['id_def'].');">Attaque rapide</a><br>';
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
		if(isAttaquableMonster( $_SESSION['id'], $_REQUEST['id_def'],$data[$i]['range'] ))
		{
			//echo '<a href="#" onClick="QuickAttakSpell('.$_SESSION['id'].','.$_REQUEST['id_def'].','.$data[$i]['id'].',\''.$data[$i]['nom'].'\')">'.$data[$i]['nom'].'</a><br />';
		}
	}
	echo '		</td>';
	echo '		<td width="2" bgcolor="#FF9900"></td>';
	echo '		<td width="250px" align="center"  valign="top">';
	echo '<h2>'.$defender->get_name().'</h2>';
	echo '<img src="../images/avatar_default.jpg"/>';
	echo '		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
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
    _xhr.post('../ajax/quickSpellM.php');
}
function QuickAttakMonster(j,k)
{
    //On commence par créer l'objet
    var _xhr=new HTTPObject();
    //on renseigne ensuite les valeurs qui seront utiles pour le traitement de la saisie
    //Ici par exemple j'ai juste besoin d'un ID pour aller rechercher des valeurs associées
    _xhr.addArg('id_attak',j);
	_xhr.addArg('id_def',k);
    //On peut même ajouter des variables locales à l'objet
    //Je suppose ici que à chaque joueur correspond un élément asocié pour afficher les infos de son porso
    //Je stocke en référence l'ID de l'élément HTML ou je dois afficher le résultat du traitement
    _xhr.setVar('container','zone_caracteristique');
    //callBack est la fonction à appeler une fois le traitement terminé.
    // Cette valeur peut rester vide si il n'y a pas de retour à afficher
    _xhr.callBack('log_combat');
    //Ici, on fait un appel à la page getperso.php avec la méthode GET
    // L'url appelé ressemble à getjoueur.php?joueur_id=10&perso_id=54
    _xhr.post('../ajax/quickAttaqueM.php');
    //On veut indiquer que la recherche est en cours
    //On commence par faire apparaître la zone
}

function log_combatSpell(o,v)
{
	var response = o.responseText;
	var name= <? echo "'".$defender->get_name()."'"; ?>;
	var tab = response.split(';');
	
	var txt_touch = '';
	var txt_crit = '';
	
	if(tab[2] == 1) // critique
	{
		txt_crit = '<span style="color:#FF0000">(Critique)</span>';
	}
	txt_start = 'Vous lancer : ' + tab[8];
	
	
	if(tab[0] == 0) // toucher
	{
		txt_touch = '<span style="color:#55FF55">Vous avez toucher (' + tab[5] + ') ' + name + ' (' + tab[6] + ') pour ' + tab[1] + ' </span>' + txt_crit;
	}
	else
	{
		txt_touch = '<span style="color:#FF9900">'+ name + ' a esquiver (' + tab[6] + ') votre attaque (' + tab[5] + ')</span> ' + txt_crit;
	}
	
	var txt_final = txt_start + '<br />' + txt_touch + '<br />';
	
	txt_final += 'Vous avez gagner ' + tab[4] +' xp<br />';
	
	if(tab[3] == 1)
	{
		txt_final += name + ' est mort<br />';
	}
	else
	{
		txt_final += name + ' a survecus a votre asault<br />';
	}
	
	if(tab[9] == 0)
	{
		txt_final = txt_start + '<br />' +  tab[8] + ' a echouer<br />';
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
	//alert(response);
	var name= <? echo "'".$defender->get_name()."'"; ?>;
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
	if(tab[8] == 0)
	{
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
	}
	else
	{
		alert('L enemie a fui');
	}
	
	d.innerHTML = txt_final;
	
}

</script>

</body>
</html>

