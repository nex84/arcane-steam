<?php

function get_liste_sort_for_keep($id_j,$id_c)
{
	$db = new database_connector();
	$querry = 'SELECT nom,id FROM sort WHERE id_class = '.$id_c.'';
	$data = $db->send_sql($querry);
	
	$querry = 'SELECT nom,id FROM sort WHERE id = (SELECT sort_save_1 FROM users_caracts WHERE id_user = '. $id_j .')';
	$data2 = $db->send_sql($querry);
	if($data2['count'] = 1)
		$data[] = $data2[1];

	$querry = 'SELECT nom,id FROM sort WHERE id = (SELECT sort_save_2 FROM users_caracts WHERE id_user = '. $id_j .')';
	$data3 = $db->send_sql($querry);
	if($data3['count'] = 1)
		$data[] = $data3[1];
	return($data);
}

function strtonum($str)
{
    $str = preg_replace('`([^+\-*=/\(\)\d\^<>&|\.]*)`','',$str);
    if(empty($str))$str = '0';
    else eval("\$str = $str;");
    return $str;
}


function lance_sort($tab_att,$tab_cible)
{
	/*XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX*/
	/*Variable demande : */
	/* ATT : id_sort,puissance_magique,id_att,fm_att,bonus_fm,lvl,class*/
	/* CIBLE id_cible,hp,fm_def,bonus_fm,lvl,class*/
	/**/
	/**/
	//selection du sort demande
	$db = new database_connector();
	$querry = 'SELECT type,zone_effet,range,formule_math,rate FROM sort WHERE id = '.$tab_att['id_sort'].'';
	$data = $db->send_sql($querry);
	//verification du range
	if(isAttaquable($tab_att['id_att'], $tab_cible['id_cible'],$data[1]['range']) == false)
	{
		return ($return['reussi'] = 0);
	}
	
	//transformation de la formule pour qu'elle soit calculable
	$formule = str_replace("&puis&",$tab_att['puissance_magique'],$data[1]['formule_math']);
	
	
	$result = floor(strtonum($formule));
	//gestion des sort de zone plsu tard
	//chargement de la suite ne focntion du type
	switch($data[1]['type'])
	{
		case 'attaque' : 	$return = lance_sort_attaque($data,$tab_att,$tab_cible,$result);
							break;
		case 'defense' : 	$return = lance_sort_defense($data,$tab_att,$tab_cible,$result);
							break;
		case 'soin' : 		$return = lance_sort_soin($data,$tab_att,$tab_cible,$result);
							break;
		case 'buff' : 		$return = lance_sort_buff($data,$tab_att,$tab_cible,$result);
							break;
		default : echo 'pas au bon endroit'; break;
	}
				$return['degat'] = $result;
				$return['critique'] = 0;
				return $return;
}


function lance_sort_attaque($data,$tab_att,$tab_cible,$result)
{
	//init
	$u = new joueur_data($tab_cible['id_cible']);
	$return['reussi'] = 1;
	$return['mort'] = 0;
	$return['xp'] = 0;
	$return['esquive'] = 0;
		//calcul score
	$nb_fm_att = 0;
	for($i = 0; $i < $tab_att['fm_att']; $i++)
	{
		$nb_fm_att += mt_rand(1,9);
	}
		//ajout des bonus attaque
	$nb_fm_att += $tab_att['bonus_fm'];
	$return['fm_att']= $nb_fm_att;
	
	$nb_fm_def = 0;
	for($i = 0; $i < $tab_cible['fm_def']; $i++)
	{
		$nb_fm_def += mt_rand(1,9);
	}
		//ajout des bonus attaque
	$nb_fm_def += $tab_cible['bonus_fm'];
	$return['fm_def']= $nb_fm_def;
	
	$score = $nb_fm_att - $nb_fm_def;
	//calcul rate
	$de = mt_rand(1,100);

	if($de < $data[1]['rate'])
		$return['reussi'] = 0;
	else if($nb_fm_att < $nb_fm_def)
	{
		$return['esquive'] = 1;
		$return['reussi'] = 0;
	}
	else
	{
		$return['reussi'] = 1;
		//perte en hp
		$hp = $tab_cible['hp'] - $result;
		
		//verification si pas mort
		if($hp < 1)
		{
			//mort
			$return['mort'] = 1;
			$u->mise_a_mort();
		}
		else
		{
			$u->mise_a_jour_pv($tab_cible['id_cible'],$hp);
		}
		//gain XP
		$return['xp'] = gain_xp_sort($tab_att,$return['mort'],$score,$tab_cible['lvl']);
		
	}
	
	return $return;
}
function lance_sort_soin($data,$tab_att,$tab_cible,$result)
{
	//init
	$db = new database_connector();
	$u = new joueur_data($tab_cible['id']);
	$return['reussi'] = 1;
	$return['xp'] = 0;
	$caract = $data[1]['caract_impacter'];
	$de = mt_rand(1,100);
		//recuperation nom du champ
	$querry = 'SELECT key FROM caracteristique WHERE id = '.$data[1]['caract_impacter'].'';
	$data2 = $db->send_sql($querry);
		//Verification pas rater
	if($de < $data[1]['rate'])
		$return['reussi'] = 0;
	else
	{
		//soin de la cracteristique
		$querry = 'UPDATE users_caracts_now SET '.$data[2]['key'].' = '. $data[2]['key'] .' + '. $result .' WHERE id_user = '.$tab_cible['id_cible'].'';
		$db->send_sql($querry);
		
		//gain xp
		$return['xp'] = gain_xp_sort_non_attaque($tab_att,$return['mort'],$score,$tab_cible['lvl']);
	}
	return $return;
}
function lance_sort_defense($data,$tab_att,$tab_cible,$result)
{
	//init
	$db = new database_connector();
	$u = new joueur_data($tab_cible['id']);
	$return['reussi'] = 1;
	$return['xp'] = 0;
	$caract = $data[1]['caract_impacter'];
	$de = mt_rand(1,100);
		//recuperation nom du champ
	$querry = 'SELECT key FROM caracteristique WHERE id = '.$data[1]['caract_impacter'].'';
	$data2 = $db->send_sql($querry);
		//Verification pas rater
	if($de < $data[1]['rate'])
		$return['reussi'] = 0;
	else
	{
		//soin de la cracteristique
		$querry = 'UPDATE users_caracts_now SET '.$data[2]['key'].' = '. $data[2]['key'] .' + '. $result .' WHERE id_user = '.$tab_cible['id_att'].'';
		$db->send_sql($querry);
		
		//gain xp
		$return['xp'] = gain_xp_sort_non_attaque($tab_att,$return['mort'],$score,$tab_cible['lvl']);
	}
	return $return;
}

function get_sort_by_class($id)
{
	$db = new database_connector();
	$querry = 'SELECT id,nom,type,`desc` FROM sort WHERE id_class = '. $id .'';
	$data = $db->send_sql($querry);
	return $data;
}

function save_sort($id_j,$id_s,$id_save)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET sort_save_'.$id_save.' = '.$id_s.' WHERE id_user = '. $id_j .'';
	$db->send_sql($querry);
}


?>