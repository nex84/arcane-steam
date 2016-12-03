<?php

class objet
{
	
	private $id;
	private $typ;
	private $nom;
	private $description;
	private $prix;
	private $poids;
	private $image;
	private $attaque;
	private $CA;
	private $mana;
	private $modifForce;
	private $modifCA;
	private $modifSagesse;
	private $modifDext;
	private $modifhp;
	private $modifmov;
	private $modifvis;
	private $modifdam;
	private $modifdef;
	private $modifatt;
	private $modifcon;
	private $modifnba;
	private $modifmag;
	private $modifnbs;
	private $modiffm;
	
	
	public function __CONSTRUCT($id = null)
	{
		//constructeur ^ppur recuperer les variable de reste
		$this->db = new database_connector();
		if ($id !== null)
		{
			$this->load($id);
		}
		else
		{
			$this->id = null;
		}
	}
	
	private function load($id)
	{
		//On recup le gammer ^^
		$sql =  'SELECT id,typ,nom,description,prix,poids,image,attaque,CA,mana,modifForce,modifCA,modifSagesse,modifDext,modifhp,modifmov,modifvis,modifdam,modifdef,modifatt,modifcon,modifnba,modifmag,modifnbs FROM objets WHERE id ="'.$id .'"';
		$data = $this->db->send_sql($sql);
		if ($data['count'] == 1)
		{
			$this->id = $data[1]['id'];
			$this->typ = $data[1]['typ'];
			$this->nom = $data[1]['nom'];
			$this->description = $data[1]['description'];
			$this->prix = $data[1]['prix'];
			$this->poids = $data[1]['poids'];
			$this->image = $data[1]['image'];
			$this->attaque = $data[1]['attaque'];
			$this->CA = $data[1]['CA'];
			$this->mana = $data[1]['mana'];
			//$this->modifForce = $data[1]['modifForce'];
			//$this->modifCA = = $data[1]['modifCA'];
			//$this->modifSagesse = $data[1]['ModifSagesse'];
			//$this->modifDext = = $data[1]['Dext'];
			$this->modifhp = $data[1]['modifhp'];
			$this->modifmov = $data[1]['modifmov'];
			$this->modifvis = $data[1]['modifvis'];
			$this->modifdam = $data[1]['modifdam'];
			$this->modifdef = $data[1]['modifdef'];
			$this->modifatt = $data[1]['modifatt'];
			$this->modifcon = $data[1]['modifcon'];
			$this->modifnba = $data[1]['modifnba'];
			$this->modifmag = $data[1]['modifmag'];
			$this->modifnbs = = $data[1]['modifnbs'];
			$this->modifnbs = = $data[1]['modiffm'];
		}
		else
		{
			echo("Une erreur est survenue lors du chargement de votre personnage");
		}
	}
	
	
	public function set_bonus_objet_equipe($id_joueur,$id_objet)
	{
		$this->db = new database_connector();
		//recuperation de l'objet
		$objet = new objet($id_objet);
		//recuperation des valeurs et des champ
		foreach($objet as $key => $value)
		{
			if(substr($key,0,5) == "modif")
			{	
				$tab_caract[$key] = $value
			}
		}
		//go enregistrement
		foreach($tab_caract as  $key => $value)
		{
			$querry = 'UPDATE users_caracts SET ' .$key. '_bonux = ' .$key. '_bonux + '. $value .' WHRE id_user = '. $id_joueur .'';
			$this->db->send_sql($sql);
		}
	}
	
	public function unset_bonus_objet_equipe($id_joueur,$id_objet)
	{
		$this->db = new database_connector();
		//recuperation de l'objet
		$objet = new objet($id_objet);
		//recuperation des valeurs et des champ
		foreach($this as $key => $value)
		{
			if(substr($key,0,5) == "modif")
			{	
				$tab_caract[$key] = $value
			}
		}
		//go enregistrement
		foreach($tab_caract as  $key => $value)
		{
			$querry = 'UPDATE users_caracts SET ' .$key. '_bonux = ' .$key. '_bonux - '. $value .' WHRE id_user = '. $id_joueur .'';
			$this->db->send_sql($sql);
		}
	}
	
	public function get_id()
	{
		return $this->id;
	}			
	
	public function get_typ()
	{
		return $this->typ;
	}			
	
	public function get_nom()
	{
		return $this->nom;
	}			
	
	public function get_description()
	{
		return $this->description;
	}			
	
	public function get_prix()
	{
		return $this->prix;
	}			
	
	public function get_poids()
	{
		return $this->poids;
	}			
	
	public function get_image()
	{
		return $this->image;
	}			
	
	public function get_attaque()
	{
		return $this->attaque;
	}			
	
	public function get_CA()
	{
		return $this->CA;
	}			
	
	public function get_mana()
	{
		return $this->mana;
	}			
	
	public function get_modifForce()
	{
		return $this->modifForce;
	}			
	
	public function get_modifCA()
	{
		return $this->modifCA;
	}			
	
	public function get_modifSagesse()
	{
		return $this->modifSagesse;
	}			
	
	public function get_modifDext()
	{
		return $this->modifDext;
	}		
	
	public function get_modifhp()
	{
		return $this->modifhp;
	}		
	
	public function get_modifmov()
	{
		return $this->modifmov;
	}		
	
	public function get_modifvis()
	{
		return $this->modifvis;
	}		
	
	public function get_modifdam()
	{
		return $this->modifdam;
	}		
	
	public function get_modifdef()
	{
		return $this->modifdef;
	}
			
	public function get_modifatt()
	{
		return $this->modifatt;
	}		
	
	public function get_modifcon()
	{
		return $this->modifcon;
	}		
	
	public function get_modifnba()
	{
		return $this->modifnba;
	}		
	
	public function get_modifmag()
	{
		return $this->modifmag;
	}	
	
	public function get_modifnbs()
	{
		return $this->modifnbs;
	}	
	
	public function get_modiffm()
	{
		return $this->modiffm;
	}	
	
	//Setter
	
	
	public function set_id($s)
	{
		return $this->id= $s;
	}			
	
	public function set_typ($s)
	{
		return $this->typ= $s;
	}			
	
	public function set_nom($s)
	{
		return $this->nom= $s;
	}			
	
	public function set_description($s)
	{
		return $this->description= $s;
	}			
	
	public function set_prix($s)
	{
		return $this->prix= $s;
	}			
	
	public function set_poids($s)
	{
		return $this->poids= $s;
	}			
	
	public function set_image($s)
	{
		return $this->image= $s;
	}			
	
	public function set_attaque($s)
	{
		return $this->attaque= $s;
	}			
	
	public function set_CA($s)
	{
		return $this->CA= $s;
	}			
	
	public function set_mana($s)
	{
		return $this->mana= $s;
	}			
	
	public function set_modifForce($s)
	{
		return $this->modifForce= $s;
	}			
	
	public function set_modifCA($s)
	{
		return $this->modifCA= $s;
	}			
	
	public function set_modifSagesse($s)
	{
		return $this->modifSagesse= $s;
	}			
	
	public function set_modifDext($s)
	{
		return $this->modifDext= $s;
	}		
	
	public function set_modifhp($s)
	{
		return $this->modifhp= $s;
	}		
	
	public function set_modifmov($s)
	{
		return $this->modifmov= $s;
	}		
	
	public function set_modifvis($s)
	{
		return $this->modifvis= $s;
	}		
	
	public function set_modifdam($s)
	{
		return $this->modifdam= $s;
	}		
	
	public function set_modifdef($s)
	{
		return $this->modifdef= $s;
	}
			
	public function set_modifatt($s)
	{
		return $this->modifatt= $s;
	}		
	
	public function set_modifcon($s)
	{
		return $this->modifcon= $s;
	}		
	
	public function set_modifnba($s)
	{
		return $this->modifnba= $s;
	}		
	
	public function set_modifmag($s)
	{
		return $this->modifmag= $s;
	}	
	
	public function set_modifnbs($s)
	{
		return $this->modifnbs= $s;
	}	
	
	public function set_modiffm($s)
	{
		return $this->modiffm= $s;
	}	
}

?>
		