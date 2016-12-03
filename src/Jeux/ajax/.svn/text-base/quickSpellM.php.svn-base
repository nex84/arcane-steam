<?
session_start();
require_once('../../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
include $anti_path.'class/PNJ/PNJ.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

require_once($anti_path.'includes/fonctions_attaque.php');
require_once($anti_path.'includes/fonctions_experience.php');
require_once($anti_path.'includes/fonctions_level.php');
require_once($anti_path.'includes/fonctions_class.php');
require_once($anti_path.'includes/fonctions_utilisation_point.php');
require_once($anti_path.'includes/fonction_sort.php');


if(isset($_REQUEST['id_attak']) && isset($_REQUEST['id_def']) && isset($_REQUEST['id_spell']))
{

/*
	// attaquant : attaque, id, bonus_attaque, lvl, nb_attaque
	//defenseur : defense, id, bonus_defense, malus def, lvl
*/

	$a =  new joueur_data($_REQUEST['id_attak'],'caracts_now');
	$d =  new pnj($_REQUEST['id_def'],'monster');
	
	
	$tab_a['id_sort'] =	$_REQUEST['id_spell'];
	$tab_a['puissance_magique'] = $a->get_mag();
	$tab_a['id_att'] = $a->get_id();
	$tab_a['fm_att'] = $a->get_fm();
	$tab_a['bonus_fm'] = $a->get_fm_bonus();
	$tab_a['lvl'] = $a->get_rang();
	$tab_a['class'] =  $a->get_idClass();


	$tab_d['id_cible'] = $d->get_id();
	
	$tab_d['fm_def'] = '2';
	$tab_d['bonus_fm'] = '4';
	
	$tab_d['lvl'] = $d->get_lvl();
	$tab_d['hp'] = $d->get_hp_now();
	$tab_d['class'] = 150;

/*
	$tab_d['defense'] = $d->get_defense();
	$tab_d['id'] = $d->get_id();
	$tab_d['bonus_defense'] = '0';
	$tab_d['lvl'] = $d->get_lvl();
	$tab_d['malus_def'] = $d->get_defense_malus();
	$tab_d['hp'] = $d->get_hp_now();
	$tab_d['class_def'] = '';
	$tab_d['type'] = 'monstre';
	*/
	if($a->get_nbs_now() > 0)
	{
		$res = lance_sort($tab_a,$tab_d);
			depense_sort($_REQUEST['id_attak']);
			$a->log_evenment($a->get_nom().' a lancer un sort sur '.$d->get_nom());
			if($res['mort'] == 1)
			{
				$a->log_evenment($a->get_nom().' a tue '.$d->get_nom());
			}
			echo $res['esquive'].';'.$res['degat'].';'.$res['critique'].';'.$res['mort'].';'.$res['xp'].';'.$res['fm_att'].';'.$res['fm_def'].';1;'.$_REQUEST['spell'].';'.$res['reussi'];
	}
	else
	{
		echo '0;0;0;0;0;0;0;0;'.$_REQUEST['spell'];
	}
}

?>
