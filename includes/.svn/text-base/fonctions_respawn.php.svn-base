<?php

function spawn_cor($id)
{
	//init
	$ok = false;
	$db = new database_connector();
	//changement de coordonnée 
		//race du joueur 
	$querry = 'SELECT race FROM users WHERE id = '.$id.'';
	$data = $db->send_sql($querry);
		//envoei de focntion de coordonnée
		while($ok == false)
		{
			$cor = get_cor_res_by_race($data[1]['race']);
			//test case libre
			$querry = 'SELECT x,y FROM users_position WHERE x='. $cor['x'] .' AND y='. $cor['y'] .' AND z=1';
			$data2 = $db->send_sql($querry);
			if($data2[1]['x'] == "")
				$ok = true;
		}	
		return $cor;
}


function respawn_cor($id)
{
	//init
	$ok = false;
	$db = new database_connector();
	//changement de coordonnée 
		//race du joueur 
	$querry = 'SELECT race FROM users WHERE id = '.$id.'';
	$data = $db->send_sql($querry);
		//envoei de focntion de coordonnée
		while($ok == false)
		{
			$cor = get_cor_res_by_race($data[1]['race']);
			//test case libre
			$querry = 'SELECT x,y FROM users_position WHERE x='. $cor['x'] .' AND y='. $cor['y'] .' AND z=1';
			$data2 = $db->send_sql($querry);
			if($data2[1]['x'] == "")
				$ok = true;
		}	
		//mise a jour des coordonne et remise sur la carte
	$querry = 'UPDATE users_position SET x='. $cor['x'] .', y='. $cor['y'] .' , z= 1  WHERE id_user = '.$id.'';
	$db->send_sql($querry);
		//mise a 1 des att, sort et mouv, malus 0
	$querry = 'UPDATE users_caracts_now SET mov=1, nba=1 , nbs= 1, malus_def=0  WHERE id_user = '.$id.'';
	$db->send_sql($querry);
}

function get_cor_res_by_race($race)
{	
		//init
		$db = new database_connector();
		//selection des zones
		$querry = 'SELECT x_min,x_max,y_min,y_max FROM zone_respawn WHERE race="'. $race .'"';
		$data = $db->send_sql($querry);
		
		//hazard 
		$hazard = $data['count'];
		$haszard = mt_rand(1,$hazard);
		//cjoix de la zone
		$zone_recup = $data[$hazard];
		//recup coordonné
		$cor['x'] = mt_rand($zone_recup['x_min'],$zone_recup['x_max']);	
		$cor['y'] = mt_rand($zone_recup['y_min'],$zone_recup['y_max']);	
		return $cor;
}

?>