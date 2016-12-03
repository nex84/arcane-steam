<?php

function change_level($tab_joueur)
{
	//####################################//
	// Donnée recupéré
	//####################################//
	// id_attaquant, exp, level
	//Apres gain xp, verification LVL pas changer 
		//calcul du level actuel
		$experience = $tab_joueur['exp'];
		$x = -1;
		//calcul de la tranche de level
			//formule 
	while($result <= $experience)
	{
		$x++;
		$y = $x;
		$result =floor( pow($y,4) + ($y*8) - pow(($y/20),4));
		$result =  substr(floor($result),0, -1) . 0;
	}
	if($x > $tab_joueur['level'])
	{
		maj_level($x,$tab_joueur['id']);
		return(1);
	}
	else
		return(0);
}

function maj_level($level,$id)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET lvl = "'. $level .'" WHERE id_users = "'. $id .'"';
	$db->send_sql($querry);
}

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
//      GESTION AHCAT CARACTERIQITQ§UE                                                      //
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
function get_casu($nom_cract)
{
	$db = new database_connector();
	$querry = 'SELECT cout FROM caracteristique WHERE `key` = "'. $nom_cract .'"';
	$data = $db->send_sql($querry);
	
	return($data[1]['cout']);
	
}

function prix_amelioration_caract($nb,$casualite)
{
	switch($casualite)
	{
		case 0 : 	$prix = $nb * 10 + pow($nb,2);
					break;
		case 1 : 	
					$prix = $nb * 50 + pow($nb,2) + pow($nb,3);
					break;
		case 2 : 	$prix = $nb * 50 + pow($nb,2) + pow($nb,3) + $nb * 75;
					break;
		case 3 : 	$prix = $nb * 1000;
					break;
		default : echo 'DTC';
	}
	return $prix;
}

function up_caract($id,$name_caract)
{
	//verification que la Key caratc existe
	$db = new database_connector();
	$y = new joueur_data($id);
	$querry = 'SELECT `key`,id FROM caracteristique WHERE `key` ="'. $name_caract .'"';
	$data = $db->send_sql($querry);
	if($data[1]['key'] == "")
		return ($tab_good['ok'] = 0);
	
	//recalcul du prix
	//on selectionne le nb de la key
	$querry = 'SELECT '.$data[1]['key'].'_nb  AS nb,xp_invest FROM users_caracts WHERE id_user ="'. $id .'"';
	$data2 = $db->send_sql($querry);
	$prix = class_modif_prix(prix_amelioration_caract($data2[1]['nb'],get_casu($name_caract)),$data[1]['id'],$y->get_idCLass());
	if($prix > $data2[1]['xp_invest'] || $data2[1]['xp_invest'] < 0 )
	{
		$tab_good['ok'] = 0;
		$tab_good['raison'] = 'Pas assez de point d\'investisement pour acheter cette amélioration';
		return ($tab_good);
	}
	achat_amelioration_caract($id,$prix,$name_caract,$data2[1]['nb']);
	
	return ($tab_good['ok'] = 1);
}

function achat_amelioration_caract($id,$prix,$nom,$nb)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET '.$nom.' = '.$nom.' + '.$nb.' , '.$nom.'_nb = '.$nom.'_nb + 1, xp_invest = xp_invest - '. $prix .' WHERE id_user = "'. $id .'"';
	$db->send_sql($querry);
}	

?>