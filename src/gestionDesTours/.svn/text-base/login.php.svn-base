<?php


function check_debut_tour($id)
{
	$db = new database_connector();
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	//               GESTION RESPAWN
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	$querry = 'SELECT z FROM  users_position WHERE id_user = '.$id.'';
	$data = $db->send_sql($querry);
	if($data[1]['z'] == 0)
	{
		//rechangement de coordonne pour zone de respawn
		respawn($id);
	}
}


?>