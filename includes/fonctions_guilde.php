<? 
function get_guilde($id)
{
	//requette SQl
	$db = new database_connector();
	$querry = 'SELECT nom,desc_g,image_path,id,guildmaster FROM guilde_desc WHERE id='. $id .'';
	$data = $db->send_sql($querry);
	if($data['count'] == 1)
			return ($guild = $data[1]);
}

function get_guildmaster($id_guildmaster)
{
	$db = new database_connector();
	$querry = 'SELECT nom FROM users WHERE id='. $id_guildmaster .'';
	$data = $db->send_sql($querry);
	if($data['count'] == 1)
			return ($guild = $data[1]['nom']);
}

function change_guildmaster($name_j,$id_guilde)
{
	$db = new database_connector();
	$querry = 'UPDATE guilde_desc SET guildmaster=(SELECT id FROM users WHERE  nom="'. $name_j .'") WHERE id='. $id_guilde .'';
	$data = $db->send_sql($querry);

}

function change_desc($desc,$id_guilde)
{
	$db = new database_connector();
	$querry = 'UPDATE guilde_desc SET desc_g='.$desc.' WHERE id='. $id_guilde .'';
	$data = $db->send_sql($querry);

}

function change_nom($nom,$id_guilde)
{
	$db = new database_connector();
	$querry = 'UPDATE guilde_desc SET nom='.$desc.' WHERE id='. $id_guilde .'';
	$data = $db->send_sql($querry);

}

function get_liste_membres_guilde($id_guilde)
{
	$db = new database_connector();
	$querry = 'SELECT u.nom,c.lvl,p.x,p.y,c.id_user FROM users_caracts c, users_position p, users u  WHERE c.guilde='. $id_guilde .' AND c.id_user = p.id_user AND c.id_user = u.id';
	$data = $db->send_sql($querry);
	return $data;
}

function ajout_joueur_guilde($name_j,$id_guilde)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET guilde='.$id_guilde.' WHERE id_user=(SELECT id FROM users WHERE  nom="'. $name_j .'")';
	$db->send_sql($querry);

}

function suprime_joueur_guilde($name_j,$id_guilde)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET guilde=0 WHERE id_user=(SELECT id FROM users WHERE  nom="'. $name_j .'")';
	$db->send_sql($querry);

}

function quit_guilde($id)
{
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET guilde=0 WHERE id_user='. $id .'';
	echo $querry;
	$db->send_sql($querry);

}

?>