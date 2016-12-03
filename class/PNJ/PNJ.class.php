<?php

class pnj{
		
	//Position
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_region = 0;
	
	
	private	$_id = '';
	private	$_name = '';
	private	$_avatar = '';
	private	$_descript = '';
	private	$_lvl = '';
	
	//caracteristique
	private	$_attaque = '';
	private	$_dmg = '';
	private	$_defense = '';
	private	$_defense_malus = '';
	private	$_nb_attaque = '';
	
	//HP
	private	$_hp = '';
	private	$_hp_now = '';
		
	
		
	public function __CONSTRUCT($id = null,$mode = '')
	{
		$this->db = new database_connector();
		if($mode == 'monster')
		{
			$this->loadMonster($id);
		}
	}
	
	private function get_monster_by_id($id){
		$sql = "SELECT n.lvl, n.nom, n.sprite, n.attaque, n.dmg, n.defense, n.defense_malus, n.nb_attaque, n.hp, n.hp_now, n.description, np.x, np.y, np.z, np.region FROM npc_mob n, npc_mob_position np WHERE n.id = np.id_npc AND n.id=".$id;
		
		return $sql;
	}
	
	private function loadMonster($id){
		//On recup le gammer ^^
		$sql =  $this->get_monster_by_id($id);
		$data = $this->db->send_sql($sql);
		if ($data['count'] == 1)
		{
		
			//Position
			$this->_x = $data[1]['x'];
			$this->_y = $data[1]['y'];
			$this->_z = $data[1]['z'];
			$this->_region = $data[1]['region'];
			
			
			$this->_id = $id;
			$this->_name = $data[1]['nom'];
			$this->_avatar = $data[1]['sprite'];
			$this->_descript = $data[1]['description'];
			$this->_lvl = $data[1]['lvl'];
			
			//caracteristique
			$this->_attaque = $data[1]['attaque'];
			$this->_dmg = $data[1]['dmg'];
			$this->_defense = $data[1]['defense'];
			$this->_defense_malus = $data[1]['defense_malus'];
			$this->_nb_attaque = $data[1]['nb_attaque'];
			
			//HP
			$this->_hp = $data[1]['hp'];
			$this->_hp_now = $data[1]['hp_now'];
		}
		else
		{
			echo("Une erreur est survenue lors du chargement de votre Monstre");
		}
	}
	
	public function mise_a_jour_pnj_touche($score,$degats_c,$att_somme,$def_somme,$id)
	{
		//$m = new PNJ($id);
		//intit
		$critique = 0;
		$mort = 0;
		//calcul point de vie restant
		
		$hp = $this->_hp_now - $degats_c;
		
		if($att_somme > ($def_somme * 2) || $def_somme < 0)
		{
			//prise critique malus
				$nb_malus = mt_rand(2,3);
				$this->prise_malus_pnj($this->get_id(),$nb_malus);
				$hp = $hp - ($degats_c/2);
				$degats_c += ($degats_c/2); 
				$critique = 1;
		}
		//XXXXXXXXXXXXXXXXXXXXXXX
		//calcul des malus en focntions de point de vie
		//XXXXXXXXXXXXXXXXXXXXXXX
		if($hp < $this->hp / 10)
		{	
			//prise beaucoup malus
			if($chance < 80)
			{
				$nb_malus = mt_rand(1,2);
				$this->prise_malus_pnj($this->get_id(),$nb_malus);
			}
		}
		else if($hp < $this->hp  / 4)
		{
			//prise faible malus
			if($chance < 50)
			{
				$nb_malus = mt_rand(1,2);
				$this->prise_malus_pnj($this->get_id(),$nb_malus);
			}
		}
		else if($hp < $this->hp  / 2)
		{
			//prise moyen malus
			if($chance < 30)
			{
				$nb_malus = mt_rand(1,2);
				$this->prise_malus_pnj($this->get_id(),$nb_malus);
			}
		}
		else if($hp < ($this->hp  * 9) / 10)
		{
			//prise difficule malus
			if($chance < 10)
			{
				$nb_malus = mt_rand(1,3);
				$this->prise_malus_pnj($this->get_id(),$nb_malus);
			}
		}
		
		//XXXXXXXXXXXXXXXXXXXXXXX
		//calcul de la perte de point de vie
		//XXXXXXXXXXXXXXXXXXXXXXX
		if($hp <= 0)
		{
			//mort
			$mort = 1;
			$this->mise_a_mort_pnj($this->get_id());
		}
		else
		{
			//vivant
			$this->mise_a_jour_pv_pnj($this->get_id(),$hp);
		}
		//XXXXXXXXXXXXXXXXXXX
		//enregistrement des valeur de retour
		//XXXXXXXXXXXXXXXXXX
		$tab_return['mort'] = $mort;
		$tab_return['critique'] = $critique;
		$tab_return['degat'] = $degats_c;
		return $tab_return;
	}
	
	public function prise_malus_pnj($id,$nb_malus)
	{
		$sql =  'UPDATE npc_mob SET defense_malus = defense_malus + '. $nb_malus .' WHERE id = "'. $id .'"';
		$this->db->send_sql($sql);
	}
	
	public function mise_a_jour_monstre_esquive($att_somme,$def_somme,$tab_def)
	{
		//inti
		$tab_return['critique'] = 0;
		$tab_return['gain'] = 0;
		$chance = mt_rand(1,100);
		//crtitique ?
		if($def_somme > $att_somme * 2)
			$tab_return['critique'] = 1;
		//gain ?
		if($chance < 6)
			$tab_return['gain'] = 1;
		
		if($chance < 51)
		{	
			$nb_malus = mt_rand(0,2);
			$this->prise_malus_pnj($this->id,$nb_malus);
		}
			
		return $tab_return;
	}
		
	public function mise_a_jour_pv_pnj($id,$hp)
	{
		$sql =  'UPDATE npc_mob SET hp_now = "'. $hp .'" WHERE id = "'. $id .'"';
		$this->db->send_sql($sql);
	}
	
	public function mise_a_mort_pnj($id)
	{
		//table npc_mob
		$sql =  'DELETE FROM npc_mob WHERE id = "'. $id .'"';
		$this->db->send_sql($sql);
		//npc_mob_pos
		$sql =  'DELETE FROM npc_mob_position WHERE id_npc = "'. $id .'"';
		$this->db->send_sql($sql);
	}
	

	public function get_x()
	{
		return $this->_x;
	}			
	public function get_y()
	{
		return $this->_y;
	}						
	public function get_z()
	{
		return $this->_z;
	}			
	public function get_region()
	{
		return $this->_region;
	}		
	public function get_id()
	{
		return $this->_id;
	}
	public function get_name()
	{
		return $this->_name;
	}
	public function get_avatar()
	{
		return $this->_avatar;
	}
	public function get_descript()
	{
		return $this->_descript;
	}
	public function get_attaque()
	{
		return $this->_attaque;
	}	
	public function get_dmg()
	{
		return $this->_dmg;
	}	
	public function get_defense()
	{
		return $this->_defense;
	}	
	public function get_defense_malus()
	{
		return $this->_defense_malus;
	}	
	public function get_nb_attaque()
	{
		return $this->_nb_attaque;
	}	
	public function get_hp_now()
	{
		return $this->_hp_now;
	}
	public function get_hp()
	{
		return $this->_hp;
	}
	public function get_lvl()
	{
		return $this->_lvl;
	}			
}

?>
	