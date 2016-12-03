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
$u = new joueur_data($_SESSION['id']);

// rappel de toute sles caracteritiques de bases classses par interet
echo '<div id="user">';
echo '<h1>Mes Caractéristiques</h1>';
 ?>
 <div  class="caract" >
<table width="100%" border="0">
	<tr class="td2" >
		<td class="td_moi" > Nom </td><td class="td_moi"> Valeur totale  </td><td  class="td_moi" > Base </td><td class="td_moi" > Bonus</td> 
	</tr>
	<tr>
		<td colspan="4"><h2> Caractéristiques d'attaque </h2></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Attaques </td><td class="td_moi"> <?=($u->get_att() + $u->get_att_bonus())?>  </td><td class="td_moi"> <?=($u->get_att())?> </td><td class="td_moi"><?=($u->get_att_bonus())?></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Dégats </td><td class="td_moi"> <?=($u->get_dam() + $u->get_dam_bonux())?>  </td><td class="td_moi"> <?=($u->get_dam())?> </td><td class="td_moi"><?=($u->get_dam_bonux())?></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Nombre d'attaques  </td><td class="td_moi"> <?=($u->get_nba() + $u->get_nba_bonus())?>  </td><td class="td_moi"> <?=($u->get_nba())?> </td><td class="td_moi"><?=($u->get_nba_bonus())?></td> 
	</tr>
	<tr>
		<td colspan="4"><h2> Caractéristiques magiques</h2> </td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Puissance Magique </td><td class="td_moi"><?=($u->get_mag() + $u->get_mag_bonus())?>  </td><td class="td_moi"> <?=($u->get_mag())?> </td><td class="td_moi"><?=($u->get_mag_bonus())?></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Force magique </td><td class="td_moi"> <?=($u->get_fm() + $u->get_fm_bonus())?>  </td><td class="td_moi"> <?=($u->get_fm())?> </td><td class="td_moi"><?=($u->get_fm_bonus())?></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Nombre de sorts </td><td class="td_moi"> <?=($u->get_nbs() + $u->get_nbs_bonus())?>  </td><td class="td_moi"> <?=($u->get_nbs())?> </td><td class="td_moi"><?=($u->get_nbs_bonus())?></td> 
	</tr>
	<tr>
		<td colspan="4"><h2> Caractéristiques de déplacement </h2></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Mouvement </td><td class="td_moi"> <?=($u->get_mov() + $u->get_mov_bonus())?>  </td><td class="td_moi"> <?=($u->get_mov())?> </td><td class="td_moi"><?=($u->get_mov_bonus())?></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Vision </td><td class="td_moi"> <?=($u->get_vis() + $u->get_vis_bonus())?>  </td><td class="td_moi"> <?=($u->get_vis())?> </td><td class="td_moi"><?=($u->get_vis_bonus())?></td> 
	</tr>
	<tr>
		<td colspan="4"><h2> Caractéristiques du personnage </h2></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Points de vie</td><td class="td_moi"> <?=($u->get_hp() + $u->get_hp_bonus())?>  </td><td class="td_moi"> <?=($u->get_hp())?> </td><td class="td_moi"><?=($u->get_hp_bonus())?></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Défense </td><td class="td_moi"><?=($u->get_def() + $u->get_def_bonus())?>  </td><td class="td_moi"> <?=($u->get_def())?> </td><td class="td_moi"><?=($u->get_def_bonus())?></td>
	</tr>
	<tr class="td1"> 
		<td class="td_moi"> Constitution </td><td class="td_moi"><?=($u->get_con() + $u->get_con_bonus())?>  </td><td class="td_moi"> <?=($u->get_con())?> </td><td class="td_moi"><?=($u->get_con_bonus())?></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Point d'exp&eacute;rience a investir </td><td colspan="3" class="td_moi"><?=($u->get_xp_invest())?></td>  
	</tr>
</table>	
</div>
<?
		
echo '<BR /><BR /><a href="./caract_up.php" class="lnk_user" ><img src="./images/cara.jpg" />Améliorer mes caractéristiques</a><br /><br />';
echo '<a href="./me.php" class="lnk_user">Retour</a><br /><br />';
echo '';
/*



*/

?>

</div>
</body>
</html>

