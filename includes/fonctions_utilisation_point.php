<?php

function depense_attaque($id)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts_now SET nba = nba - 1 WHERE id_user =  '. $id .'';
	$data = $db->send_sql($querry);
}

function depense_mouvement($id)
{
	//requette
	$db = new database_connector();
	$querry = 'UPDATE users_caracts_now SET mov = mov - 1 WHERE id_user =  '. $id .'';
	$data = $db->send_sql($querry);
}
function depense_sort($id)
{
	//requette
	$db = new database_connector();
	$querry = 'UPDATE users_caracts_now SET nbs = nbs - 1 WHERE id_user =  '. $id .'';
	$data = $db->send_sql($querry);
}
?>