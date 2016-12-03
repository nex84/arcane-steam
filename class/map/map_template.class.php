<?php

	class map_template
	{
		private $id;
		private $nom;
		private $db;
		
		public function __CONSTRUCT($id = null)
		{
			$this->db = new database_connector();
			if ($id !== null)
				$this->load($id);
			else
			{
				$this->id = null;
				$this->nom = '';
			}
		}
		
		public function set($propriete, $valeur)
		{
			switch ($propriete)
			{
				case ('nom'):
					$this->nom = $valeur;
					break;
			}
			return (false);
		}
		
		public function get($propriete)
		{
			switch ($propriete)
			{
				case ('id'):
					return ($this->id);
				case ('nom'):
					return ($this->nom);
			}
			return (false);
		}
				
		public function load($id)
		{
			$sql = select_templates_by_id($id);
			$data = $this->db->send_sql($sql);
			if ($data['count'] == 1)
			{
				$this->id = $data[1]['id'];
				$this->nom = $data[1]['nom'];
			}
			else
			{
				echo '<div class="error">Le template '.$id.' n\'existe pas.</div>';
			}
		}
		
		public function save()
		{
			if ($this->id == null)
			{
				$sql = insert_templates($this->nom);
				$this->id = $this->db->send_sql($sql);
			}
			else
			{
				$sql = update_templates($this->id, $this->nom);
				$this->db->send_sql($sql);
			}
		}
		
		public function delete()
		{
			if ($this->id !== null)
			{
				$sql = delete_templates($this->id);
				$res = $this->db->send_sql($sql);
				if ($res > 0)//si la suppression a réussie
					$this->id = null;
				return ($res);
			}
			return (0);
		}
	}


?>