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
require_once($anti_path.'includes/fonction_sort.php');


if(isset($_REQUEST['id_attak']) && isset($_REQUEST['id_def']) && isset($_REQUEST['id_spell']))
{

/*
	// attaquant : attaque, id, bonus_attaque, lvl, nb_attaque
	//defenseur : defense, id, bonus_defense, malus def, lvl
*/

	$a =  new joueur_data($_REQUEST['id_attak'],'caracts_now');
	$d =  new joueur_data($_REQUEST['id_def'],'caracts_now');
	
	/* ATT : id_sort,puissance_magique,id_att,fm_att,bonus_fm,lvl,class*/
	/* CIBLE id_cible,hp,fm_def,bonus_fm,lvl,class*/
	
	$tab_a['id_sort'] =	$_REQUEST['id_spell'];
	$tab_a['puissance_magique'] = $a->get_mag();
	$tab_a['id_att'] = $a->get_id();
	$tab_a['fm_att'] = $a->get_fm();
	$tab_a['bonus_fm'] = $a->get_fm_bonus();
	$tab_a['lvl'] = $a->get_rang();
	$tab_a['class'] =  $a->get_idClass();
	
	$tab_d['id_cible'] = $d->get_id();
	
	$tab_d['fm_def'] = $d->get_fm();
	$tab_d['bonus_fm'] = $d->get_fm_bonus();
	
	$tab_d['lvl'] = $d->get_rang();
	$tab_d['hp'] = $d->get_hp_en_cours();
	$tab_d['class'] = $d->get_idClass();
	if($a->get_nbs_now() > 0)
	{
		$res = lance_sort($tab_a,$tab_d);
		depense_sort($_REQUEST['id_attak']);
		//print_r($res);
		$a->log_evenment($a->get_nom().' a lancer un sort sur '.$d->get_nom());
		$d->log_evenment($a->get_nom().' vous a lancer un sort');
		if($res['mort'] == 1)
		{
			$a->log_evenment($a->get_nom().' a tue '.$d->get_nom());
			$d->log_evenment('Vous aver etais tue par'.$a->get_nom());
		}
		echo $res['esquive'].';'.$res['degat'].';'.$res['critique'].';'.$res['mort'].';'.$res['xp'].';'.$res['fm_att'].';'.$res['fm_def'].';1;'.$_REQUEST['spell'].';'.$res['reussi'];
	}
	else
	{
		echo '0;0;0;0;0;0;0;0;'.$_REQUEST['spell'];
	}
}

?>
