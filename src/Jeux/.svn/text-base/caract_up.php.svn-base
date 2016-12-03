<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'includes/fonctions_level.php');
require_once($anti_path.'includes/fonctions_class.php');
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
if($_POST['buy'] == "Acheter")
{
	 $tab_error = up_caract($_SESSION['id'],$_POST['caract']);
	 if($tab_error['ok'] == 0)
	 {
	 	$error =  '<h1>'. $tab_error['raison'] .'</h1>';
	 }
}
$u = new joueur_data($_SESSION['id']);

// rappel de toute sles caracteritiques de bases classses par interet
echo '<div id="user">';
echo $error;
echo '<h1>Mes améliorations :</h1>';
 ?>
<table border="0" cellpadding="0" cellspacing="0">
	<tr class="td1">
		<td class="td_moi"> Points d'exp&eacute;rience &agrave; investir </td><td colspan="3" class="td_moi"><?=($u->get_xp_invest())?></td>  
	</tr>
	<tr class="td2">
		<td class="td_moi" > Nom </td><td class="td_moi"> Nombre d'améliorations  </td><td class="td_moi"> Prix de l'amélioration </td><td class="td_moi">  Acheter </td> 
	</tr>
	<tr>
		<td colspan="4"  ><h2> Caractéristiques d'attaque </h2></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Attaque </td><td class="td_moi"> <?=($u->get_att_nb())?>  </td><td class="td_moi"><?=class_modif_prix(prix_amelioration_caract($u->get_att_nb(),get_casu('att')),8,$u->get_idClass())?>  </td><td class="td_moi">  <form method="post"> <input type="hidden" name="caract" value="att"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/>  <input type="submit" name="buy" value="Acheter" /> </form>  </td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Dégats </td><td class="td_moi"> <?=($u->get_dam_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_dam_nb(),get_casu('dam')),4,$u->get_idClass())?></td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="dam"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Nombre d'attaques  </td><td class="td_moi"> <?=($u->get_nba_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_nba_nb(),get_casu('nba')),10,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="nba"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr>
		<td colspan="4" ><h2> Caractéristiques magiques</h2> </td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Puissance Magique </td><td class="td_moi"><?=($u->get_mag_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_mag_nb(),get_casu('mag')),5,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="mag"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Force magique </td><td class="td_moi"> <?=($u->get_fm_nb())?>  </td><td class="td_moi"><?=class_modif_prix(prix_amelioration_caract($u->get_fm_nb(),get_casu('fm')),11,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="fm"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Nombre de sorts </td><td class="td_moi"> <?=($u->get_nbs_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_nbs_nb(),get_casu('nbs')),6,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="nbs"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr>
		<td colspan="4" ><h2> Caractéristiques de déplacement </h2></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Mouvements </td><td class="td_moi"> <?=($u->get_mov_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_mov_nb(),get_casu('mov')),2,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="mov"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Vision </td><td class="td_moi"> <?=($u->get_vis_nb())?>  </td><td class="td_moi"><?=class_modif_prix(prix_amelioration_caract($u->get_vis_nb(),get_casu('vis')),3,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="vis"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> <br />
	</tr>
	<tr>
		<td colspan="4" ><h2> Caractéristiques du personnage </h2></td> 
	</tr>
	<tr class="td1">
		<td class="td_moi"> Points de vie </td><td class="td_moi"> <?=($u->get_hp_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_hp_nb(),get_casu('hp')),1,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="hp"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
	<tr class="td2">
		<td class="td_moi"> Défense </td><td class="td_moi"><?=($u->get_def_nb())?>  </td><td class="td_moi"><?=class_modif_prix(prix_amelioration_caract($u->get_def_nb(),get_casu('def')),7,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="def"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td>
	</tr>
	<tr class="td1"> 
		<td class="td_moi"> Constitution </td><td class="td_moi"><?=($u->get_con_nb())?>  </td><td class="td_moi"> <?=class_modif_prix(prix_amelioration_caract($u->get_con_nb(),get_casu('con')),9,$u->get_idClass())?> </td><td class="td_moi"><form method="post"><input type="hidden" name="caract" value="con"/> <input type="hidden" value="<?=$_SESSION['id']?>" name="joueur"/><input type="submit" name="buy" value="Acheter" /> </form></td> 
	</tr>
</table>	
	
<?
	
echo '<br /><br /><a href="./caracteristique.php" class="lnk_user" >Retour</a><br /><br />';
echo '';
/*



*/

?>

</div>
</body>
</html>

