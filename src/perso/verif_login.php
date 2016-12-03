

<?php
	
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	$anti_path = return_anti_path();
	include $anti_path.'class/database/database_connector.class.php';



	function verif_login_unique($login)
	{
		$sql = "SELECT login FROM `users` WHERE login='" . $login ."';";
		$db = new database_connector();
		$data = $db->send_sql($sql);
		if ($data['count'] == 0)
			return(1);
		else
			return(0);
	}
	if(!verif_login_unique(addslashes($_REQUEST["login"])))
		echo 'KO';
	else
		echo 'OK';
?>