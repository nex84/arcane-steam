<?php

	

	function debug($var)
	{
		echo '<div class="error"><u>Information :</u><br /><pre>';
		print_r($var);
		echo '</pre></div>';
	}
	function debug_comment($var,$comment)
	{
		echo '<div class="error"><u>Information : '.$comment.'</u><br /><pre>';
		print_r($var);
		echo '</pre></div>';
	}

	function parse_POST()
	{
	//On empeche les char speciaux
		foreach($_POST as $key => $value)
		{
			$_POST[$key] = addslashes($value);
		}
		
	//On mouline certain char
		foreach($_POST as $key => $value)
		{
			$_POST[$key] = str_replace("<","&lt;",$value);
			$_POST[$key] = str_replace(">","&gt;",$value);
		}
	}
	
	function parse_GET()
	{
	//On empeche les char speciaux
		foreach($_GET as $key => $value)
		{
			$_GET[$key] = addslashes($value);
		}
		
	//On mouline certain char
		foreach($_GET as $key => $value)
		{
			$_GET[$key] = str_replace("<","&lt;",$value);
			$_GET[$key] = str_replace(">","&gt;",$value);
		}
	}
	
	function parse_REQUEST()
	{
	//On empeche les char speciaux
		foreach($_REQUEST as $key => $value)
		{
			$_REQUEST[$key] = addslashes($value);
		}
		
	//On mouline certain char
		foreach($_REQUEST as $key => $value)
		{
			$_REQUEST[$key] = str_replace("<","&lt;",$value);
			$_REQUEST[$key] = str_replace(">","&gt;",$value);
		}
	}

	function __autoload($class_name)
	{//charge automatiquement une classe
		$path = return_anti_path();
		ereg('([[:alnum:]]+)_', $class_name, $tab);
		if (ereg('../', $path))
		{
			$path = ereg_replace("^\./", '', $path);
		}
		if (isset($tab[1]))
			$path = $path.'class/'. $tab[1] .'/'. $class_name . '.class.php';
		else
			$path = $path.'class/'.$class_name . '.class.php';
		//echo $path.'<br />';
		@require_once($path);
	}
	
	function return_anti_path()
	{//retourne les ../../etc nécessaires pour retourner à la racine du site à partir du fichier php courant.
		$path = './';
		while (!file_exists($path.'.root.tag'))
		{
			$path .= '../';
		}
		if (ereg("\.\./", $path))
		{
			$path = ereg_replace("^\./", '', $path);
		}
		return ($path);
	}

	function fNumber($number, $userNbDec = 2)
	{
		if (is_numeric($number))
		{
			$str = strval($number);
			$nbDec = 0;
			$i = 0;
			$len = strlen($str);
			for ($n = $len - 2; $n >= 0; $n--)
			{
				$i++;
				if ($str[$n] == '.')
					$nbDec = $i;
			}
			if ($userNbDec < $nbDec)
				$nbDec = $userNbDec;
			return (number_format($number, $nbDec, ',', ' '));
		}
		else
			return ($number);
	}
	
	//fonctions de l'inventaire
	
	function recup_values($id)
	{
		$sql = 'SELECT * FROM `objets` WHERE id=' . $id;
		$db = new database_connector(true);
		$data = $db->send_sql($sql);
		for ($n = 1; $n <= $data['count']; $n++)
			{
				if ($data == NULL)
					debug("Id erronné");
				else
					return ($data);
			}
	}
	
	function create_objet($type, $nom, $description, $prix, $poids, $attaque, $CA, $mana, $modifForce, $modifCA, $modifDext, $modifSagesse)
	{
		$db = new database_connector(true);
		$data = $db->send_sql(insert_objets($type, $nom, $description, $prix, $poids, $attaque, $CA, $mana, $modifForce, $modifCA, $modifDext, $modifSagesse));
		debug("Nouvel objet cr&eacute;&eacute;...");
	}
	
		function update_objet($id, $type, $nom, $description, $prix, $poids, $attaque, $CA, $mana, $modifForce, $modifCA, $modifDext, $modifSagesse)
	{
		$db = new database_connector(true);
		$data = $db->send_sql(update_objets($id, $type, $nom, $description, $prix, $poids, $attaque, $CA, $mana, $modifForce, $modifCA, $modifDext, $modifSagesse));
		debug("Objet modifi&eacute;...");
	}

	
	function delete_objet($id)
	{
		$db = new database_connector(true);
		$data = $db->send_sql(suppr_objets($id));
		debug("Objet supprim&eacute;...");
	}
	
	function verif_exist($nom)
	{
		$db = new database_connector(true);
		$data = $db->send_sql(select_exist($nom));
		if ($data['count'] != 0)
			return (1);
		else
			return (0);
	}
	
	function verif_exist_type($nom)
	{
		$db = new database_connector(true);
		$data = $db->send_sql(select_exist_type($nom));
		if ($data['count'] != 0)
			return (1);
		else
			return (0);
	}
	
	function num_or_null($var)
	{
		//debug($var);
		if (ereg ("[0-9]*", $var) == TRUE OR $var == "")
			return (1);
		else
			return (0);
	}
	
	function update_before_delete($id)
	{
		$sql = "SELECT nom_type FROM `objets_types` WHERE id='" . $id ."';";
		
		$db = new database_connector();
		$data = $db->send_sql($sql);
		for ($n = 1; $n <= $data['count']; $n++)
		{}
		$sql2 = "UPDATE `objets` SET `typ` = 'Objet' WHERE typ='" . $data[1]['nom_type'] ."';";
		$data = $db->send_sql($sql2);
		
	}
	function create_new_user($usr_mail, $usr_passwd, $nom_perso, $race, $alignement, $mag, $def, $att, $con )
	{	
		//$sql_user = "INSERT INTO `users` VALUE ('', '$nom_perso', '$usr_passwd', '$usr_mail', '$race', '', '', '$alignement', '$nom_perso', '', '', '../../images/perso/sprite.png')";
		$sql_user = "INSERT INTO `users` SET login='$nom_perso', passwd='$usr_passwd', mail='$usr_mail', race='$race', alignement='$alignement', nom='$nom_perso', sprite='../../images/perso/sprite.png'";
		$sql_recup = "SELECT id FROM users WHERE login='".$nom_perso."'";
		
		$db = new database_connector();
		//insert tabe users
		$data = $db->send_sql($sql_user);
		
		//recup de l'id _user créé
		$id_user = $db->send_sql($sql_recup);
		//debug($id_user[1]['id']);
		
		//insert table users_caracts
		$race_c = new race($race,'nom');
		
		$sql_caracts = "INSERT INTO users_caracts SET
		`id_user`='".$id_user[1]['id']."',
		`hp`='".$race_c->load_caract($race_c->get_id(),'hp')."',
		`hp_bonux`='0',
		`hp_nb`='1',
		`mov`='".$race_c->load_caract($race_c->get_id(),'mov')."',
		`mov_bonux`='0',
		`mov_nb`='1',
		`vis`='".$race_c->load_caract($race_c->get_id(),'vis')."',
		`vis_bonux`='0',
		`vis_nb`='1',
		`dam`='".$race_c->load_caract($race_c->get_id(),'dam')."',
		`dam_bonux`='0',
		`dam_nb`='1',
		`def`='".($def + $race_c->load_caract($race_c->get_id(),'def'))."',
		`def_bonux`='0',
		`def_nb`='1',
		`att`='".($att + $race_c->load_caract($race_c->get_id(),'att'))."',
		`att_bonux`='0',
		`att_nb`='1',
		`con`='".($con + $race_c->load_caract($race_c->get_id(),'dam'))."',
		`con_bonux`='0',
		`con_nb`='1',
		`nba`='".$race_c->load_caract($race_c->get_id(),'nba')."',
		`nba_bonux`='0',
		`nba_nb`='1',
		`nbs`='".$race_c->load_caract($race_c->get_id(),'nbs')."',
		`nbs_bonux`='0',
		`nbs_nb`='1',
		`mag`='".($mag + $race_c->load_caract($race_c->get_id(),'mag'))."',
		`mag_bonux`='0',
		`mag_nb`='1',
		`fm`='".$race_c->load_caract($race_c->get_id(),'fm')."',
		`fm_bonux`='0',
		`fm_nb`='1',
		`gold`='0',
		`xp`='0',
		`xp_invest`='0',
		`xp_class`='0',
		`guilde`='0',
		`lvl`='1',
		`id_class`='0',
		`sort_save_1`='0',
		`sort_save_2`='0'
		";		
		
		
		$db2 = new database_connector();
		$data = $db2->send_sql($sql_caracts);
		
		//insert table users_caracts_now
		$sql_caracts_now = "INSERT INTO users_caracts_now SET
		`id_user`='".$id_user[1]['id']."',
		`hp`='".$race_c->load_caract($race_c->get_id(),'hp')."',
		`mov`='".$race_c->load_caract($race_c->get_id(),'mov')."',
		`nba`='".$race_c->load_caract($race_c->get_id(),'nba')."',
		`nbs`='".$race_c->load_caract($race_c->get_id(),'nbs')."',
		`malus_def`='0'
		";
		
		
		$db3 = new database_connector();
		$data = $db3->send_sql($sql_caracts_now);
		
		//insert table users_inventaire
		//$sql_inventaire = "INSERT INTO users_inventaire VALUE ('".$id_user[1]['id']."', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";
		$sql_inventaire = "INSERT INTO users_inventaire SET `id_user`='".$id_user[1]['id']."'";	
		$db4 = new database_connector();
		$data = $db4->send_sql($sql_inventaire);
		
		//insert table users_sac
		//$sql_inventaire = "INSERT INTO users_sac VALUE ('".$id_user[1]['id']."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')";	
		$sql_sac = "INSERT INTO users_sac SET `id_user`='".$id_user[1]['id']."'";
		$db5 = new database_connector();
		$data = $db5->send_sql($sql_sac);
		
		//inster position
		//$sql_position = "INSERT INTO users_position VALUE ('".$id_user[1]['id']."', '', '', '', '')";
		$u = new joueur_data($id_user[1]['id']);
		$pos = $u->spawn($u->get_id());
		
		$sql_position = "INSERT INTO users_position SET `id_user`='".$id_user[1]['id']."', x='". $pos['x'] ."', y='". $pos['y'] ."',z=1";
		$db6 = new database_connector();
		$data = $db6->send_sql($sql_position);
		
		//génération du hashcode de confirmation
		$vtf = substr($usr_passwd,mt_rand(2,4));
		$easteregg = "There is no Justice, only Me";
		$pattern = $easteregg . mt_rand() . $usr_mail . mt_rand() . $vtf . mt_rand() . $id_user[1]['id'] . mt_rand() . $nom_perso . time();
		$hashcode = sha1($pattern);
		
		//enregistrement du hashcode dans la table temp
		$sql_timeout = "INSERT INTO users_activation VALUE ('".$id_user[1]['id']."', '".$hashcode."', now())";
		$db7 = new database_connector();
		$data = $db7->send_sql($sql_timeout);
		
		//ENVOI MAIL CONFIRMATION
		$debut = "https://beta.arcane-steam.com";
		
		$url_conf = $debut."/src/perso/activate.php?hash=". $hashcode;
		$subject = "validation compte";
		$body = '<b>validation</b><br /><br />cliquer sur le lien pour confirmer l\'inscription ou copiez l\'adresse dans votre naviguateur :<br /><a href="'.$url_conf.'">'.$url_conf.'</a><br /><br /><br />Ceci est un mail automatique, veuillez ne pas y répondre.';
		$fromaddress = "noreply@arcane-steam.com";
		$fromname = "Arcane-Steam";
		$res = send_mail($usr_mail, $body, $subject, $fromaddress, $fromname, $attachments=false);
		//if ($res != true)
		//{
		//	debug("Erreur pendant l'envoi du mail de confirmation...");
		//}
		


		return(1);
	}

	function select_races()
	{
		$db = new database_connector();
		$sql = "SELECT id, nom, description, image, actif FROM race;";
		return $sql;
	}
	
	function select_caract()
	{
		$db = new database_connector();
		$sql = "SELECT * FROM caracteristique WHERE acces='public';";
		return $sql;
	}
	
		function select_users($id)
	{
		$db = new database_connector();
		$sql = "SELECT * FROM users 
				JOIN users_caracts ON users_caracts.id_user = users.id
				JOIN users_inventaire ON users_inventaire.id_user = users.id
				JOIN users_position ON users_position.id_user = users.id
				JOIN users_sac ON users_sac.id_user = users.id
				WHERE users.id = ".$id;
		return $sql;
		$get_user =  $db->send_sql($sql);
		
		if ($get_user['count'] == 1)
		{
			for ($n = 1; $n <= $get_user['count']; $n++)
			{
				// récupérer les champs et les données
			}
		}
		else
		{
			debug("ERREUR : données corrompues - duplicate entry");
		}
	}
	
	function activation_verif($login, $hash)
	{
		$db = new database_connector();
		//recup login => id
		$sql = "SELECT id, nom FROM users WHERE login='".$login."';";
		$get_id =  $db->send_sql($sql);
		
		if ($get_id['count'] == 1)
		{
			$id = $get_id[1]['id'];
		}
		else
		{
			debug("ERREUR : données corrompues - duplicate entry");
		}

		//compare id / hash
		$sql2 = "SELECT hashcode FROM users_activation WHERE id_user='".$id."'";
		$getinfos =  $db->send_sql($sql2);
		
		if ($getinfos['count'] == 1)
		{
			if ($hash == $getinfos[1]['hashcode'])
			{
				return(1);
			}
			else
			{
				debug("Erreur : Les informations saisies ne correspondent pas...");
				return(0);
			}
		}
		else
		{
			debug("ERREUR : données corrompues - duplicate entry");
			return(0);
		}
	}
	
	function activation_compte($login, $hash)
	{
		$db = new database_connector();
		
		//recup login => id
		$sql = "SELECT id, nom FROM users WHERE login='".$login."';";
		$get_id =  $db->send_sql($sql);
		
		if ($get_id['count'] == 1)
		{
			$id = $get_id[1]['id'];
		}
		else
		{
			debug("ERREUR : données corrompues - duplicate entry");
		}
		
		//update champ actif  dans la table users
		$sql = "UPDATE users SET actif=1 WHERE id='".$id."'";
		$db->send_sql($sql);
		
		//delete dans la table temporaire d'activation
		$sql = "DELETE FROM users_activation WHERE id_user='".$id."'";
		$db->send_sql($sql);
		return(1);
	}
	
	function reset_passwd($mail, $login)
	{
		$db = new database_connector();
		$sql = "SELECT id, mail FROM users WHERE login='".$login."';";
		$get_infos =  $db->send_sql($sql);
		
		//verif si login existe
		if ($get_infos['count'] == 1)
		{
			$mail_db = $get_infos[1]['mail'];
			
			//verif correspondance login/mail
			if ($mail !== $mail_db)
			{
				return(2);
			}
		
			//génération passwd
			$new_passwd = generatePassword();
			
			//enregistrement du nouveau mot de passe
			$sql2 = "UPDATE users SET passwd=md5('".$new_passwd."') WHERE login='".$login."';";
			$ok = $db->send_sql($sql2);	
		
			//envoi mail
			$subject = "Arcne-Steam - Nouveau mot de passe";
			$body = '<b>Vos nouveaux identifiants :</b><br /><br />Vous avez demand&eacute; &agrave; reg&eacute;n&eacute;rer votre mot de passe perdu.<br /><br /><i>Voici vos nouveaux identifiants de connexion &agrave; ~Arcane-Steam :</i><br />Login : '.$login.'<br />Mot de passe : '.$new_passwd.'<br /><br />Vous pouvez d&egrave;s &agrave; pr&eacute;sent vous connecter sur <a href="https://beta.arcane-steam.com">https://beta.arcane-steam.com</a><br /><br />N\'oubliez pas de changer votre mot de passe lors de votre prochaine connexion.<br /><br /><br />Ceci est un mail automatique, veuillez ne pas y répondre.';
			$fromaddress = "noreply@arcane-steam.com";
			$fromname = "Arcane-Steam";
			//$res = send_mail($usr_mail, $body, $subject, $fromaddress, $fromname, $attachments=false);
			$res = send_mail($mail_db, $body, $subject, $fromaddress, $fromname, $attachments=false);
			if ($res != true)
			{
				debug("Erreur pendant l'envoi du mail r&eacute;capitulatif...");
			}
			return(1);
		}
		elseif ($get_infos['count'] > 1)
		{
			debug("ERREUR : données corrompues - duplicate entry");
			return(0);
		}
		else
		{
			return(2);
		}
		
		
		
		
	}
	
	function generatePassword($length=12, $strength=7)
	{
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength & 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength & 2) {
			$vowels .= "AEUY";
		}
		if ($strength & 4) {
			$consonants .= '23456789';
		}
		if ($strength & 8) {
			$consonants .= '@#$%';
		}
	
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(mt_rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(mt_rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}
	
	function verif_mail($email)
	{
	
		// Auteur : bobocop (arobase) bobocop (point) cz
		// Traduction des commentaires par mathieu
		
		// Le code suivant est la version du 2 mai 2005 qui respecte les RFC 2822 et 1035
		// http://www.faqs.org/rfcs/rfc2822.html
		// http://www.faqs.org/rfcs/rfc1035.html
		
		$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // caractères autorisés avant l'arobase
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // caractères autorisés après l'arobase (nom de domaine)
									   
		$regex = '/^' . $atom . '+' .   // Une ou plusieurs fois les caractères autorisés avant l'arobase
		'(\.' . $atom . '+)*' .         // Suivis par zéro point ou plus
										// séparés par des caractères autorisés avant l'arobase
		'@' .                           // Suivis d'un arobase
		'(' . $domain . '{1,63}\.)+' .  // Suivis par 1 à 63 caractères autorisés pour le nom de domaine
										// séparés par des points
		$domain . '{2,63}$/i';          // Suivi de 2 à 63 caractères autorisés pour le nom de domaine
		
		// test de l'adresse e-mail
		if (preg_match($regex, $email))
		{
			return(1);
		}
		else
		{
			return(0);
		}

	}
	
	function keycode_generator()
	{
		//génération du key_code xxxx-xxxx-xxxx-xxxx
		$charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$key_code = '';
		for ($i = 0; $i != 3; $i++)
		{
			for ($j = 0; $j != 4; $j++)
			{
				$key_code .= $charset[mt_rand(0, 35)];
			}
			$key_code .= "-";
		}
		for ($j = 0; $j != 4; $j++)
		{
			$key_code .= $charset[mt_rand(0, 35)];
		}
		return($key_code);
	}
	
	function change_mail($new_mail, $login)
	{
		$db = new database_connector();
		$sql = "SELECT id, mail FROM users WHERE login='".$login."';";
		$get_infos =  $db->send_sql($sql);
		
		//verif si login existe
		if ($get_infos['count'] == 1)
		{
			
			
			$sql2 = "UPDATE users SET mail='".$new_mail."' WHERE login='".$login."';";
			$ok = $db->send_sql($sql2);	
		
			return(1);
		}
		elseif ($get_infos['count'] > 1)
		{
			debug("ERREUR : données corrompues - duplicate entry");
			return(0);
		}
		else
		{
			return(2);
		}
		
		
		
		
	}
		
		
	function isAttaquable($idAtt, $idDef, $range = 1)
	{
	//Recuperation des position Joueur pour active ou non l'attaque

		$id_JOUEUR = $idAtt;
		//Rapatriment X Y Z REGION Users
		$sql_vus = "SELECT users_position.* FROM users_position, users WHERE users.id = users_position.id_user AND users.actif = 1 AND id_user = ".$id_JOUEUR;
		$c = new database_connector();
		$data = $c->send_sql($sql_vus);
		if ($data['count'] == 1)
		{
			$x_JOUEUR =  $data[1]['x'];
			$y_JOUEUR =  $data[1]['y'];
			$z_JOUEUR =  $data[1]['z'];
			$region_JOUEUR =  $data[1]['region'];
		}
		
		//On recupere celle du joueurs present :
		
		$id_JOUEUR = $idDef;
		//Rapatriment X Y Z REGION Users
		$sql_vus = "SELECT users_position.* FROM users_position, users WHERE users.id = users_position.id_user AND users.actif = 1 AND id_user = ".$id_JOUEUR;
		$c = new database_connector();
		$data_adv = $c->send_sql($sql_vus);
		if ($data_adv['count'] == 1)
		{
			$x_ADV =  $data_adv[1]['x'];
			$y_ADV =  $data_adv[1]['y'];
			$z_ADV =  $data_adv[1]['z'];
			$region_ADV =  $data_adv[1]['region'];
		}
		
			if($x_ADV <= ($x_JOUEUR + $range) && $x_ADV >= ($x_JOUEUR - $range)) 
			{
				if($y_ADV <= ($y_JOUEUR + $range) && $y_ADV >= ($y_JOUEUR - $range)) 
				{
					return true;
				}
			}
		
		return false;
	}
		
		function isAttaquableMonster($idAtt, $idDef, $range = 1)
	{
	//Recuperation des position Joueur pour active ou non l'attaque

		$id_JOUEUR = $idAtt;
		//Rapatriment X Y Z REGION Users
		$sql_vus = "SELECT users_position.* FROM users_position, users WHERE users.id = users_position.id_user AND users.actif = 1 AND id_user = ".$id_JOUEUR;
		$c = new database_connector();
		$data = $c->send_sql($sql_vus);
		if ($data['count'] == 1)
		{
			$x_JOUEUR =  $data[1]['x'];
			$y_JOUEUR =  $data[1]['y'];
			$z_JOUEUR =  $data[1]['z'];
			$region_JOUEUR =  $data[1]['region'];
		}
		
		//On recupere celle du joueurs present :
		
		$id_JOUEUR = $idDef;
		//Rapatriment X Y Z REGION Users
		$sql_vus = "SELECT npc_mob_position.* FROM npc_mob_position WHERE id_npc = ".$id_JOUEUR;
		$c = new database_connector();
		$data_adv = $c->send_sql($sql_vus);
		if ($data_adv['count'] == 1)
		{
			$x_ADV =  $data_adv[1]['x'];
			$y_ADV =  $data_adv[1]['y'];
			$z_ADV =  $data_adv[1]['z'];
			$region_ADV =  $data_adv[1]['region'];
		}
		
			if($x_ADV <= ($x_JOUEUR + $range) && $x_ADV >= ($x_JOUEUR - $range)) 
			{
				if($y_ADV <= ($y_JOUEUR + $range) && $y_ADV >= ($y_JOUEUR - $range)) 
				{
					return true;
				}
			}
		return false;
	}
	///////////////////////////////////////////////////////////////////
	//
	//		NE PAS EFFACES CES LIGNE
	//
	//////////////////////////////////////////////////////////////////
	
	parse_POST();
	parse_GET();
	parse_REQUEST();
?>