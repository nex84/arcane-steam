<?php

	class map_case
	{
		private $id;
		private $x;
		private $y;
		public $type;
		public $region;
		
		private $db;
		
		public function __CONSTRUCT($id = null)
		{
			$this->db = new database_connector();
			if ($id !== null)
				$this->load($id);
			else
			{
				$this->id = null;
				$this->x = null;
				$this->y = null;
				$this->type = null;
				$this->region = null;
			}
		}
		
		public function get($propriete)
		{
			switch ($propriete)
			{
				case ('id'):
					return ($this->id);
				case ('x'):
					return ($this->x);
				case ('y'):
					return ($this->y);
			}
			return (false);
		}
		
		public function set($propriete, $valeur)
		{
			switch ($propriete)
			{
				case ('x'):
					$this->x = $valeur;
					break;
				case ('y'):
					$this->y = $valeur;
					break;
			}
			return (false);
		}
		
		public function load($id)
		{
			$sql = select_cases_by_id($id);
			$data = $this->db->send_sql($sql);
			$this->id = $data[1]['id'];
			$this->type = new map_type($data[1]['Types_id']);
			$this->region = new map_region($data[1]['Regions_id']);
			$this->x = $data[1]['x'];
			$this->y = $data[1]['y'];
		}
		
		public function save()
		{
			if ($this->id == null)
			{
				$sql = insert_cases($this->type->get('id'), $this->region->get('id'), $this->x, $this->y);
				$this->id = $this->db->send_sql($sql);
			}
			else
			{
				$sql = update_cases($this->id, $this->x, $this->y, $this->type->get('id'));
				$this->db->send_sql($sql);
			}
		}
		
		public function delete()
		{
			if ($this->id !== null)
			{
				$sql = delete_cases($this->id);
				$res = $this->db->send_sql($sql);
				if ($res > 0)//si la suppression a réussie
					$this->id = null;
				return ($res);
			}
			return (0);
		}
	}


?>