<?php
	
	function get_inventaire($id)
	{
		$db = new database_connector();
		$corps = array("tete", "medaillon", "bras_droite", "bras_gauche", "torse", "bracelet_droite", "bracelet_gauche", "main_droite", "main_gauche", "bague_droite", "bague_gauche", "ceinture", "jambes", "pieds");
		
		foreach($corps as $key)
		{
			$sql = "SELECT objets.nom, image FROM `objets` JOIN users_inventaire ON objets.id=users_inventaire.".$key." WHERE users_inventaire.id_user=".$id;
			$res = $db->send_sql($sql);
			$inventaire[$key] = $res[1]["nom"];
			$inventaire[$key.'_image'] = $res[1]["image"];
		}
		return($inventaire);
	}
?>