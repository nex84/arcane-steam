<?php

function test_change_class($exp_class,$rang_class)
{
	//Cette fonction test si le joueur peut changer de classe
		//calcul du cut en fonction du rang
		$cout = $rang_class * 250;
		if($exp_class > $cout)
			return 1;
}

function get_class_rang($id)
{
	$db = new database_connector();
	$querry = 'SELECT rang FROM class_desc WHERE id = '. $id .'';
	$data = $db->send_sql($querry);
	return $data[1]['rang'];
		
}

function return_prix_class($exp_class,$rang_class)
{
	//Cette fonction test si le joueur peut changer de classe
		//calcul du cut en fonction du rang
		$cout = $rang_class * 250;
		return $cout;
}

function get_class_by_id($id)
{
	//Cette fonction test si le joueur peut changer de classe
		//calcul du cut en fonction du rang
	$db = new database_connector();
	$querry = 'SELECT id,nom,`desc` FROM class_desc WHERE id = '. $id .'';
	$data = $db->send_sql($querry);
	return $data;
}

function recup_liste_class($id)
{
	//Cette fonction test si le joueur peut changer de classe
		//calcul du cut en fonction du rang
	$db = new database_connector();
	$querry = 'SELECT id,nom,`desc` FROM class_desc WHERE pere = '. $id .'';
	$data = $db->send_sql($querry);
	return $data;
}

function recup_first_liste_class($race)
{
	//Cette fonction test si le joueur peut changer de classe
		//calcul du cut en fonction du rang
	$db = new database_connector();
	$querry = 'SELECT id,nom,`desc` FROM class_desc WHERE rang = 1 AND race="'. $race .'"';
	$data = $db->send_sql($querry);
	return $data;
}

function change_class_choix($id,$race,$class)
{
	//Cette fonction liste les classes possibles d'evolution
	$db = new database_connector();
	$querry = 'SELECT id,desc,nom FROM class_desc WHERE id_user = "'. $id .'" AND pere = '.$class.' AND race = '.$race.'';
	$data = $db->send_sql($querry);
	return $data;
}

function change_class_valide($id,$id_class,$new,$race)
{

	//verification que la class est bien un fils
	$db = new database_connector();
	$querry = 'SELECT id,rang FROM class_desc WHERE id = "'. $new .'" AND pere = '.$id_class.' AND race = "'.$race.'"';
	$data = $db->send_sql($querry);
		if($data['count'] == "")
			return "changement interdit connard !";
	//MISE a jour
		//caclul du cout
		$cout = ($data[1]['rang'] - 1 ) * 250;
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET id_class = '.$new.', xp_class = xp_class - '. $cout .' WHERE id_user = '. $id .'';
	$data = $db->send_sql($querry);
	return $data;
}

function get_modif_exp_class($id_class)
{
	$db = new database_connector();
	$querry = 'SELECT bonus FROM class_modificator WHERE id_class = '. $id_class .' AND id_caract = 0';
	$data = $db->send_sql($querry);
	return $data[1]['bonus'];
}

function class_modif_prix($prix,$id_ame,$id_class)
{
	//selection de modificateur
	$db = new database_connector();
	$querry = 'SELECT modificateur FROM class_modificator_prix WHERE id_class = '. $id_class .' AND id_caract = '. $id_ame .'';
	$data = $db->send_sql($querry);
	// modification du prix
	$new_prix = floor($prix * $data[1]['modificateur']);
	if($new_prix == "" || $new_prix == 0)
		$new_prix = 1;
	return $new_prix;
}


?>