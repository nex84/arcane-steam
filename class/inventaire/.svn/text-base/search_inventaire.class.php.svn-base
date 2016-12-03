<?php
	class search_inventaire
	{
		private $data;
		private $resultGlobal;
		
		public function __CONSTRUCT()
		{
			$this->db = new database_connector();
		}
				
		private function selectArmeByName($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Arme WHERE nomArme LIKE \''.$name.'\' ORDER BY nomArme';
			return($query);
		}
		private function selectArmureByName($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Armure WHERE nomArmure LIKE \''.$name.'\' ORDER BY nomArmure';
			return($query);
		}
		private function selectBouclierByName($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Bouclier WHERE nomBouclier LIKE \''.$name.'\' ORDER BY nomBouclier';
			return($query);
		}
		private function selectSortByName($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Sort WHERE nomSort LIKE \''.$name.'\' ORDER BY nomSort';
			return($query);
		}
		private function selectObjetByName($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Objet WHERE nomObjet LIKE \''.$name.'\' ORDER BY nomObjet';
			return($query);
		}
		public function search($name, $type)
		{
			switch($type)
			{
				case "arme":
					$this->data = $this->db->send_sql($this->selectArmeByName($name));
					break;
				case "armure":
					$this->data = $this->db->send_sql($this->selectArmureByName($name));
					break;
				case "bouclier":
					$this->data = $this->db->send_sql($this->selectBouclierByName($name));
					break;
				case "sort":
					$this->data = $this->db->send_sql($this->selectSortByName($name));
					break;
				case "objet":
					$this->data = $this->db->send_sql($this->selectObjetByName($name));
					break;
				default:
					$this->resultGlobal['arme'] = $this->db->send_sql($this->selectArmeByName($name));
					$this->resultGlobal['armure'] = $this->db->send_sql($this->selectArmureByName($name));
					$this->resultGlobal['bouclier'] = $this->db->send_sql($this->selectBouclierByName($name));
					$this->resultGlobal['sort'] = $this->db->send_sql($this->selectSortByName($name));
					$this->resultGlobal['objet'] = $this->db->send_sql($this->selectObjetByName($name));
					break;
			}
			
		}
		public function affichage()
		{
			debug($this->resultGlobal);
		}
	}

?>

