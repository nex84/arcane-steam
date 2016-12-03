<?
session_start();
require_once('../../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

require_once($anti_path.'includes/fonctions_attaque.php');
require_once($anti_path.'includes/fonctions_experience.php');
require_once($anti_path.'includes/fonctions_level.php');
require_once($anti_path.'includes/fonctions_class.php');
require_once($anti_path.'includes/fonctions_utilisation_point.php');


if(isset($_REQUEST['id_attak']) && isset($_REQUEST['id_def']))
{

/*
	// attaquant : attaque, id, bonus_attaque, lvl, nb_attaque
	//defenseur : defense, id, bonus_defense, malus def, lvl
*/

	$a =  new joueur_data($_REQUEST['id_attak'],'caracts_now');
	$d =  new joueur_data($_REQUEST['id_def'],'caracts_now');
	
	$tab_a['attaque'] = $a->get_att();
	$tab_a['id'] = $a->get_id();
	$tab_a['bonus_attaque'] = $a->get_att_bonus();
	$tab_a['lvl'] = $a->get_rang();
	$tab_a['nb_attaque'] = $a->get_nba();
	$tab_a['degats'] = $a->get_dam();
	$tab_a['degats_bonus'] = $a->get_dam_bonux();
	$tab_a['class_att'] = $a->get_idClass();

	$tab_d['defense'] = $d->get_def();
	$tab_d['id'] = $d->get_id();
	$tab_d['bonus_defense'] = $d->get_def_bonus();
	$tab_d['lvl'] = $d->get_rang();
	$tab_d['malus_def'] = $d->get_malus_def();
	$tab_d['hp'] = $d->get_hp_en_cours();
	$tab_d['class_def'] = $d->get_idClass();
	if($a->get_nba_now() > 0)
	{
		$res = quick_attaque($tab_a,$tab_d);
		depense_attaque($_REQUEST['id_attak']);
		$att = $a->get_nom().' a attaque '.$d->get_nom();
		$def = $a->get_nom().' vous a attaque';
		$a->log_evenment($att);
		$d->log_evenment($def);

		if($res['mort'] == 1)
		{
			$a->log_evenment($a->get_nom().' a tue '.$d->get_nom());
			$d->log_evenment('Vous aver etais tue par'.$a->get_nom());
		}
		echo $res['reussi'].';'.$res['degat'].';'.$res['critique'].';'.$res['mort'].';'.$res['exp'].';'.$res['score_att'].';'.$res['score_def'].';1';
	}
	else
	{
		echo '0;0;0;0;0;0;0;0';
	}
}

?>
