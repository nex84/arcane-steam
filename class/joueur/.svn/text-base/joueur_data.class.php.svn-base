<?php

	class joueur_data
	{
		
		private $db;
		private $id;
		private $login;
		private $mail;
		private $position_x;
		private $position_y;
		private $position_z;
		private $region;
		private $race;
		private $classe;
		private $level;
		private $gold;
		private $guilde;
		private $alignement;
		private $attaque;
		private $CA;
		private $dext;
		private $sagesse;
		private $xp;
		private $xp_invest;
		private $xp_class;
		private $rang;
		private $idClass;
		private $nom;
		private $avatar;
		private $con;
		private $con_bonus;
		private $fm;
		private $fm_bonus;
		
		/*Caracteristique du player*/
		private $hp_en_cours;
		private $att;
		private $att_bonus;
		private $def;
		private $def_bonus;
		private $nba;
		private $malus_def;
		private $dam;
		private $dam_bonux;
		private $nba_now;
		private $nbs_now;
		private $hp_now;
		private $mov_now;
		private $con_nb;
		private $hp_nb;
		private $mov_nb;
		private $nba_nb;
		private $nbs_nb;
		private $mag_nb;
		private $fm_nb;
		private $dam_nb;
		private $att_nb;
		private $def_nb;
		private $vis_nb;
		
		private $is_adm;
		
		public $_sql;
		
		public function __CONSTRUCT($id = null,$mode = '')
		{
		
			$this->is_adm = 0;
			//constructeur ^ppur recuperer les variable de reste
			$this->db = new database_connector();
			if ($id !== null)
			{
				if($mode == "caracts_now" )
				{
					$sql =  'SELECT hp,malus_def, nba, nbs,mov FROM users_caracts_now WHERE id_user ="'.$id .'"';
					$data2 = $this->db->send_sql($sql);
					$this->hp_en_cours = $data2[1]['hp'];
					$this->malus_def = $data2[1]['malus_def'];
					$this->nba_now = $data2[1]['nba'];
					$this->nbs_now = $data2[1]['nbs'];
					$this->mov_now = $data2[1]['mov'];
					
					
					$this->load($id);
				}	
				else
				{
					$this->load($id);
				}
			}
			else
			{
				$this->id = null;
			}
		}
		
		private function load($id)
		{
			//On recup le gammer ^^
			$sql =  $this->get_joueur_by_id($id);
			$data = $this->db->send_sql($sql);
			if ($data['count'] == 1)
			{
				$this->id = $data[1]['id'];
				$this->login = $data[1]['login'];
				$this->mail = $data[1]['mail'];
				$this->position_x = $data[1]['position_x'];
				$this->position_y = $data[1]['position_y'];
				$this->position_z = $data[1]['position_z'];
				$this->region = $data[1]['region'];
				$this->race = $data[1]['race'];
				$this->classe = $data[1]['classe'];
				$this->level = $data[1]['level'];
				$this->gold = $data[1]['gold'];
				$this->alignement = $data[1]['alignement'];
				$this->attaque = $data[1]['attaque'];
				$this->CA = $data[1]['CA'];
				$this->dext = $data[1]['dext'];
				$this->sagesse = $data[1]['sagesse'];
				$this->nom= $data[1]['nom'];
				$this->avatar= $data[1]['image'];
				$this->is_adm = $data[1]['adm'];
				
				$sql =  'SELECT xp,lvl,guilde,xp_class,xp_invest,nba,nba_bonux,att,att_bonux,def,def_bonux,dam,dam_bonux,id_class, con, con_bonux, fm, fm_bonux,mag,mag_bonux,nbs,nbs_bonux,mov,mov_bonux,vis,vis_bonux,hp,hp_bonux,hp_nb,att_nb,vis_nb,dam_nb,mov_nb,def_nb,mag_nb,nbs_nb,nba_nb,fm_nb  FROM users_caracts WHERE id_user ="'.$this->id .'"';
				$data2 = $this->db->send_sql($sql);
				$this->rang = $data2[1]['lvl'];
				$this->xp = $data2[1]['xp'];
				$this->guilde = $data2[1]['guilde'];
				$this->xp_invest = $data2[1]['xp_invest'];
				$this->nba = $data2[1]['nba'];
				$this->nba_bonus = $data2[1]['nba_bonux'];
				$this->nba_nb = $data2[1]['nba_nb'];
				$this->att = $data2[1]['att'];
				$this->att_bonus = $data2[1]['att_bonux'];
				$this->att_nb = $data2[1]['att_nb'];
				$this->def = $data2[1]['def'];
				$this->def_bonus = $data2[1]['def_bonux'];
				$this->def_nb = $data2[1]['def_nb'];
				$this->dam = $data2[1]['dam'];
				$this->dam_bonux = $data2[1]['dam_bonux'];
				$this->dam_nb = $data2[1]['dam_nb'];
				$this->idClass = $data2[1]['id_class'];
				$this->mov = $data2[1]['mov'];
				$this->mov_bonus = $data2[1]['mov_bonux'];
				$this->mov_nb = $data2[1]['mov_nb'];
				$this->con = $data2[1]['con'];
				$this->con_bonus = $data2[1]['con_bonux'];
				$this->con_nb = $data2[1]['con_nb'];
				$this->fm = $data2[1]['fm'];
				$this->fm_bonus = $data2[1]['fm_bonux'];
				$this->fm_nb = $data2[1]['fm_nb'];
				$this->mag = $data2[1]['mag'];
				$this->mag_bonus = $data2[1]['mag_bonux'];
				$this->mag_nb = $data2[1]['mag_nb'];
				$this->nbs = $data2[1]['nbs'];
				$this->nbs_bonus = $data2[1]['nbs_bonux'];
				$this->nbs_nb = $data2[1]['nbs_nb'];
				$this->vis = $data2[1]['vis'];
				$this->vis_bonus = $data2[1]['vis_bonux'];
				$this->vis_nb = $data2[1]['vis_nb'];
				$this->hp = $data2[1]['hp'];
				$this->hp_bonus = $data2[1]['hp_bonux'];
				$this->hp_nb = $data2[1]['hp_nb'];
				$this->xp_class = $data2[1]['xp_class'];
				
				
				//recuperation du nom de la classe
				$sql =  'SELECT nom FROM class_desc WHERE id ="'.$this->idClass .'"';
				$data3 = $this->db->send_sql($sql);
				$this->classe = $data3[1]['nom'];
				
				//recuperation du nom de la classe
				$sql =  'SELECT z FROM users_position WHERE id_user ="'.$this->id .'"';
				$data4 = $this->db->send_sql($sql);
				$this->position_z = $data4[1]['z'];
				
			}
			else
			{
				echo("Une erreur est survenue lors du chargement de votre personnage");
			}
		}
		
		public function get_guilde_name()
		{
			$tab = get_guilde($this->guilde);
			return $tab['nom'];
		}
		
		public function log_evenment($ligne)
		{
			$ligne = addslashes($ligne);
			$con = new database_connector();
			//veri_nb_evenement
			$sql = "SELECT count(id_user)as nb FROM  users_evenement WHERE id_user =". $this->id ."";
			$data = $con->send_sql($sql);
			if($data[1]['nb'] < 30 )
			{
				$con_1 = new database_connector();
				$sql =  'INSERT INTO users_evenement (id_user,evenement,date) VALUES ('. $this->id .',"'.$ligne.'",now())';
				$this->_sql = $sql;
				$con_1->send_sql($sql);
			}
			else
			{
				$con_1 = new database_connector();
				//decoupâge dis emect
				$sql = 'SELECT date FROM users_evenement WHERE id_user = '. $this->id .' ORDER BY date DESC LIMIT 1'; 
				$last_date = $con_1->send_sql($sql);
				$sql =  'UPDATE users_evenement SET date=now(), evenement="'. $ligne .'" WHERE id_user='. $this->id .' AND date= "'.$last_date[1]['date'] .'"';
				$con_1->send_sql($sql);
			}
		}
		
		
		public function prise_malus($id,$nb_malus)
		{
			$sql =  'UPDATE users_caracts_now SET malus_def = malus_def + '. $nb_malus .' WHERE id_user = "'. $id .'"';
			$this->db->send_sql($sql);
		}
		
		public function mise_a_jour_pv($id,$hp)
		{
			$sql =  'UPDATE users_caracts_now SET hp = "'. $hp .'" WHERE id_user = "'. $id .'"';
			$this->db->send_sql($sql);
		}
		
		public function spawn($id)
		{
			$cor = spawn_cor($this->id);
			return $cor;
		}
		
		public function respawn()
		{
			if($this->position_z == 0)
			{
				respawn_cor($this->id);
				return $vie=1;
			}
			else
			{
				return $vie=0;
			}
		}
		
		//GET SET
		public function get_idClass()
		{
			return $this->idClass;
		}
		public function get_id()
		{
			return $this->id;
		}
		
		public function get_login()
		{
			return $this->login;
		}
		
		public function get_mail()
		{
			return $this->mail;
		}
		
		public function get_position_x()
		{
			return $this->position_x;
		}
		
		public function get_position_y()
		{
			return $this->position_y;
		}
		public function get_nom()
		{
			return $this->nom;
		}
		
		public function get_position_z()
		{
			return $this->position_z;
		}
		
		public function get_region()
		{
			return $this->region;
		}
		
		public function get_race()
		{
			return $this->race;
		}
		
		public function get_classe()
		{
			return $this->classe;
		}
		
		public function get_xp()
		{
			return $this->xp;
		}
		
		public function get_xp_class()
		{
			return $this->xp_class;
		}
		
		public function get_xp_invest()
		{
			return $this->xp_invest;
		}
		
		public function get_level()
		{
			return $this->level;
		}
		
		public function get_gold()
		{
			return $this->gold;
		}
		
		public function get_guilde()
		{
			return $this->guilde;
		}
		
		public function get_alignement()
		{
			return $this->alignement;
		}
		
		public function get_attaque()
		{
			return $this->attaque;
		}
		
		public function get_CA()
		{
			return $this->CA;
		}
		
		public function get_dext()
		{
			return $this->dext;
		}
		
		public function get_sagesse()
		{
			return $this->sagesse;
		}
		public function get_rang()
		{
			return $this->rang;
		}
		
		public function get_hp_en_cours()
		{
			return $this->hp_en_cours;
		}

		public function get_att()
		{
			return $this->att;
		}
		
		public function get_att_bonus()
		{
			return $this->att_bonus;
		}
		
		public function get_att_nb()
		{
			return $this->att_nb;
		}
		
		public function get_def()
		{
			return $this->def;
		}
		
		public function get_def_bonus()
		{
			return $this->def_bonus;
		}
		
		public function get_def_nb()
		{
			return $this->def_nb;
		}
		
		public function get_nba()
		{
			return $this->nba;
		}
		public function get_nba_bonus()
		{
			return $this->nba_bonus;
		}
		
		public function get_nba_nb()
		{
			return $this->nba_nb;
		}
		
		public function get_nba_now()
		{
			return $this->nba_now;
		}
		
		public function get_malus_def()
		{
			return $this->malus_def;
		}
		
		public function get_dam()
		{
			return $this->dam;
		}
		
		public function get_dam_bonux()
		{
			return $this->dam_bonux;
		}
		
		public function get_dam_nb()
		{
			return $this->dam_nb;
		}
		
		public function get_nbs_now()
		{
			return $this->nbs_now;
		}	
		public function get_avatar()
		{
			return $this->avatar;
		}	
		
		public function get_con()
		{
			return $this->con;
		}	
		public function get_con_bonus()
		{
			return $this->con_bonus;
		}	
		
		public function get_con_nb()
		{
			return $this->con_nb;
		}
		
		public function get_fm()
		{
			return $this->fm;
		}	
		public function get_fm_bonus()
		{
			return $this->fm_bonus;
		}	
		
		public function get_fm_nb()
		{
			return $this->fm_nb;
		}	
		
		public function get_mag()
		{
			return $this->mag;
		}	
		
		public function get_mag_bonus()
		{
			return $this->mag_bonus;
		}	
		
		public function get_mag_nb()
		{
			return $this->mag_nb;
		}	
		
		public function get_nbs()
		{
			return $this->nbs;
		}	
		
		public function get_nbs_bonus()
		{
			return $this->nbs_bonus;
		}	
		
		public function get_nbs_nb()
		{
			return $this->nbs_nb;
		}	
		
		public function get_mov()
		{
			return $this->mov;
		}	
		
		public function get_mov_bonus()
		{
			return $this->mov_bonus;
		}	
		
		public function get_mov_nb()
		{
			return $this->mov_nb;
		}	
		
		public function get_mov_now()
		{
			return $this->mov_now;
		}	
		
		public function get_vis()
		{
			return $this->vis;
		}	
		
		public function get_vis_bonus()
		{
			return $this->vis_bonus;
		}	
		
		public function get_vis_nb()
		{
			return $this->vis_nb;
		}	
		
		public function get_hp()
		{
			return $this->hp;
		}	
		
		public function get_hp_bonus()
		{
			return $this->hp_bonus;
		}	
		
		public function get_hp_nb()
		{
			return $this->hp_nb;
		}	
		
		public function get_isAdm()
		{
			return $this->is_adm;
		}	
		
		//////////////////////////////////////
		
		public function set_login($s)
		{
			$this->login = $s;
		}
		
		public function set_mail($s)
		{
			$this->mail = $s;
		}
		
		public function set_position_x($s)
		{
			$this->position_x = $s;
		}
		
		public function set_position_y($s)
		{
			$this->position_y = $s;
		}
		
		public function set_position_z($s)
		{
			$this->position_z = $s;
		}
		
		public function set_region($s)
		{
			$this->region = $s;
		}
		
		public function set_race($s)
		{
			$this->race = $s;
		}
		
		public function set_classe($s)
		{
			$this->classe = $s;
		}
		
		public function set_xp($s)
		{
			$this->xp = $s;
		}
		
		public function set_xp_invest($s)
		{
			$this->xp_invest = $s;
		}
		
		public function set_level($s)
		{
			$this->level = $s;
		}
		
		public function set_gold($s)
		{
			$this->gold = $s;
		}
		
		public function set_guilde($s)
		{
			$this->guilde = $s;
		}
		
		public function set_alignement($s)
		{
			$this->alignement = $s;
		}
		
		public function set_attaque($s)
		{
			$this->attaque = $s;
		}
		
		public function set_CA($s)
		{
			$this->CA = $s;
		}
		
		public function set_dext($s)
		{
			$this->dext = $s;
		}
		
		public function set_sagesse($s)
		{
			$this->sagesse = $s;
		}
		public function set_rang($s)
		{
			$this->rang = $s;
		}
		public function set_hp_en_cours($s)
		{
			$this->hp_en_cours = $s;
		}
		public function set_avatar($s)
		{
			$this->avatar = $s;
		}
		
		
		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
		//  Partie de gestion der mort                //
		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
		//static zone
		public function mise_a_mort()
		{
			$this->db = new database_connector();
			//perte XP
			$tab_info_joueur['id'] = $this->get_id();
			$tab_info_joueur['xp_invest'] = $this->get_xp_invest();
			//fonction de perte d'exp
			perte_exp_mort($tab_info_joueur);
			//remise des pv au max
			$this->restart_pv($this->get_id());
			//ecrsemement des coordonnée __  axe Z = 0 ___
			$this->change_axe_mort($this->get_id());
		}
		
		public function restart_pv($id)
		{
			//on recupere le nombre de pv max et on met cette valeur dans la vie actuel
			$sql =  'UPDATE users_caracts_now SET hp = (SELECT (hp + hp_bonux) FROM users_caracts WHERE id_user ='. $id .')  WHERE id_user ='. $id;
			$this->db->send_sql($sql);
		}
		
		public function change_axe_mort($id)
		{
			//MAJ
			$sql =  'UPDATE users_position SET z =0  WHERE id_user ='. $id .' ';
			$this->db->send_sql($sql);
		}
		
		
		static public function do_action_perso($action, $valeur)
		{
			switch ($action)
			{
				//note proctection : trouve run moyen de faire coorespondre l'id envoyer a une valeur en session pour eviter tout changement d'id apr un joueurs	
				case "mouvement" : 		//chargement des variables
					//verification + new_pos
					if(is_int($valeur['joueur_dep']))
					{
						##ou un SQL , a voir samedi 
						$perso_mouv = new perso_pos($valeur);	
						//chargement
						$donne['chargement'] = 'ok';
						$donne['x']['depart'] = $perso_mouv->x; 
						$donne['y']['depart'] = $perso_mouv->y;
						$donne['x']['aller'] = $valeur['x'];
						$donne['y']['aller'] = $valeur['y'];
					} 	
					//lancement de la fonctions	
					if($donne['chargement'] == 'ok')
					{
						$buffer_class = new joueur_action();
						$retour = $buffer_class.depalcement($donne);
						if(substr(0,1,$retour) == 3)
							$return['evenement'] = 'Deplacement reussi';	
					}
					break;
				case "attaque" : 
					//verif integrite des valeurs
					//chargement varaibles			
					//lancement fonctions
					//mise a jour des valeurs	
							//MAJ defenseur
							//MAJ attaquant	

					break;
				default : break;
			}
			return $return;
		}	
		
		// -> SQL ZONE
		public function get_joueur_by_id($id)
		{
			$s = "SELECT * FROM users where id = ".$id;
			return $s;
		}
		
		//UPDATE
		public function update_by_champ($s,$v)
		{
			$s = 'UPDATE users SET '.$s.'='.$v.'  WHERE id = '.$id;
			return $s;
		}
		
		
		
	}

?>
		