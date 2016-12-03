<?
session_start();
require_once('../../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
require_once($anti_path.'includes/fonctions_respawn.php');
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');

$_SESSION['c_perso'] = new joueur_data($_SESSION['id'],'caracts_now');
?>
<table width="100%" cellpadding="0" cellspacing="0" style="">
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	
	<tr class="td1">
			<td  width="33%" class="td_moi_g"> HP </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_hp_en_cours().' / '. $_SESSION['c_perso']->get_hp() . ' + '. $_SESSION['c_perso']->get_hp_bonus()?>   </td>
	</tr>
	<tr class="td2">
			<td width="33%" class="td_moi_g"> Mouvement </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_mov_now().' / '. $_SESSION['c_perso']->get_mov() . ' + '. $_SESSION['c_perso']->get_mov_bonus()?>   </td>
	</tr>
	<tr class="td1">
			<td width="33%" class="td_moi_g" > Nombre d'attaque </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_nba_now().' / '. $_SESSION['c_perso']->get_nba() . ' + '. $_SESSION['c_perso']->get_nba_bonus()?>   </td>
	</tr>
	<tr class="td2">
			<td width="33%" class="td_moi_g" > Nombre de sort </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_nbs_now().' / '. $_SESSION['c_perso']->get_nbs() . ' + '. $_SESSION['c_perso']->get_nbs_bonus()?>   </td>
	</tr>
	<tr class="td1">
			<td width="33%" class="td_moi_g" > Malus defensif </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_malus_def()?>   </td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
			<td colspan="3">&nbsp;</td>
	</tr>
	<tr class="td2">
			<td width="33%" class="td_moi_g" > Attaque </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_att() . ' + '. $_SESSION['c_perso']->get_att_bonus()?> </td>
	</tr>
	<tr class="td1">
			<td width="33%" class="td_moi_g" > Defense </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_def() . ' + '. $_SESSION['c_perso']->get_def_bonus()?> </td>
	</tr>
	<tr class="td2">
			<td width="33%" class="td_moi_g" > Degats </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_dam() . ' + '. $_SESSION['c_perso']->get_dam_bonux()?>   </td>
	</tr>
	<tr class="td1">
			<td width="33%" class="td_moi_g" > Puissance magique </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_mag() . ' + '. $_SESSION['c_perso']->get_mag_bonus()?>   </td>
	</tr>
	<tr class="td2">
			<td width="33%" class="td_moi_g" > Force magique </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_fm() . ' + '. $_SESSION['c_perso']->get_fm_bonus()?> </td>
	</tr>
	<tr class="td1">
			<td width="33%" class="td_moi_g" > Vision </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_vis() . ' + '. $_SESSION['c_perso']->get_vis_bonus()?>   </td>
	</tr>
	<tr class="td2">
			<td width="33%" class="td_moi_g" > Constitution </td><td colspan="2" class="td_moi" ><?=$_SESSION['c_perso']->get_con() . ' + '. $_SESSION['c_perso']->get_con_bonus()?>  </td>
	</tr>
	</table>