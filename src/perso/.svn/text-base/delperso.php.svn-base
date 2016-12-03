<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	require_once('../../includes/mail.inc.php');

if (isset($_GET["id"]))
{
	delete_id($_GET["id"]);
}
elseif (isset($_GET["login"]))
{
	delete_login($_GET["login"]);
}
else
{
	debug("error - $_GET : ".$_GET);
}

function delete_id($id)
	{
		$db = new database_connector();
		
		$sql_users = "DELETE FROM users WHERE id='".$id."'";
		$sql_activation = "DELETE FROM users_activation WHERE id_user='".$id."'";
		$sql_caracts = "DELETE FROM users_caracts WHERE id_user='".$id."'";
		$sql_inventaire = "DELETE FROM users_inventaire WHERE id_user='".$id."'";
		$sql_position = "DELETE FROM users_position WHERE id_user='".$id."'";
		$sql_sac = "DELETE FROM users_sac WHERE id_user='".$id."'";
		
		
		$data = $db->send_sql($sql_users);
		$data = $db->send_sql($sql_activation);
		$data = $db->send_sql($sql_caracts);
		$data = $db->send_sql($sql_inventaire);
		$data = $db->send_sql($sql_position);
		$data = $db->send_sql($sql_sac);

		debug("User supprimé ...");
	}

function delete_login($login)
	{
		$db = new database_connector();
		
		
		//recup de l'id _user
		$sql_recup = "SELECT id FROM users WHERE login='".$login."'";
		$id_user = $db->send_sql($sql_recup);
		
		$sql_users = "DELETE FROM users WHERE login='".$login."'";
		$sql_activation = "DELETE FROM users_activation WHERE id_user='".$id_user."'";
		$sql_caracts = "DELETE FROM users_caracts WHERE id_user='".$id_user."'";
		$sql_inventaire = "DELETE FROM users_inventaire WHERE id_user='".$id_user."'";
		$sql_position = "DELETE FROM users_position WHERE id_user='".$id_user."'";
		$sql_sac = "DELETE FROM users_sac WHERE id_user='".$id_user."'";
		
		
		$data = $db->send_sql($sql_users);
		$data = $db->send_sql($sql_activation);
		$data = $db->send_sql($sql_caracts);
		$data = $db->send_sql($sql_inventaire);
		$data = $db->send_sql($sql_position);
		$data = $db->send_sql($sql_sac);

		debug("User supprimé ...");
	}
?>