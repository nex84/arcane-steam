<?php

	class map_map
	{
		private $id;
		private $nom;
		private $img;
		private $db;
		
		public function __CONSTRUCT($id = null)
		{
			$this->db = new database_connector();
			if ($id !== null)
				$this->load($id);
			else
			{
				$this->id = null;
				$this->nom = null;
				$this->img = null;
			}
		}
		
		public function get($propriete)
		{
			switch ($propriete)
			{
				case ('id'):
					return ($this->id);
				case ('nom'):
					return ($this->nom);
				case ('img'):
					return ($this->img);
				case ('path_img'):
					return ($this->return_path_image());
				default:
					return ('Propriété inéxistante : '.$propriete);
			}
			return (false);
		}
		
		public function set($propriete, $valeur)
		{
			switch ($propriete)
			{
				case ('nom'):
					$this->nom = $valeur;
					break;
				case ('img'):
					$this->img = $valeur;
					break;
			}
			return (false);
		}
		
		public function load($id)
		{
			$sql = select_map_by_id($id);
			$data = $this->db->send_sql($sql);
			if ($data['count'] == 1)
			{
				$this->id = $data[1]['id'];
				$this->nom = $data[1]['nom'];
				$this->img = $data[1]['img'];
			}
		}
		
		public function save()
		{
			if ($this->id == null)
			{
				$sql = insert_map($this->nom, $this->img);
				$this->id = $this->db->send_sql($sql);
			}
			else
			{
				$sql = update_map($this->id, $this->nom, $this->img);
				$this->db->send_sql($sql);
			}
		}
		
		public function delete()
		{
			if ($this->id !== null)
			{
				$sql = delete_map($this->id);
				$res = $this->db->send_sql($sql);
				if ($res > 0)//si la suppression a réussie
					$this->id = null;
				return ($res);
			}
			return (0);
		}
		
		private function return_path_image()
		{
			$path = return_anti_path().IMG_PATH.'maps/'.$this->img;
			return ($path);
		}
	}


?>