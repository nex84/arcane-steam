<?php
	class template_inventaire
	{
		private $data;
		private $resultGlobal;
		private $db;
		
		public function __CONSTRUCT()
		{
			echo "premier plop";
			$this->db = new database_connector();
			echo "deuxieme plop";
		}
				
		private function selectArme($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Arme WHERE nomArme LIKE \''.$name.'\' ORDER BY nomArme';
			return($query);
		}
		
		private function insertArme($data)
		{
			//$name = str_replace('*','%',$name);
			$query = 'INSERT INTO Arme (nomArme, descrArme, prixArme, attaqueArme, poidsArme, imageArme, modifForceArme, modifCAArme, modifDextArme, modifSagesseArme) VALUES (\''.$data["nomArme"].'\','.$data["descrArme"].','.$data["prixArme"].',\''.$data["attaqueArme"].'\',\''.$data["poidsArme"].'\',\''.$data["imageArme"].'\',\''.$data["modifForceArme"].'\',\''.$data["modifCAArme"].'\',\''.$data["modifDextArme"].'\',\''.$data["modifSagesseArme"].'\');';
			return($query);
		}
		
		private function updateArme($idArme, $data)
		{
			//$name = str_replace('*','%',$name);
			$query = 'UPDATE Arme SET nomArme=\''.$data["nomArme"].'\', descrArme=\''.$data["descrArme"].'\', prixArme=\''.$data["prixArme"].'\', attaqueArme=\''.$data["attaqueArme"].'\', poidsArme=\''.$data["poidsArme"].'\', imageArme=\''.$data["imageArme"].'\', modifForceArme=\''.$data["modifForceArme"].'\', modifCAArme=\''.$data["modifCAArme"].'\', modifDextArme=\''.$data["modifDextArme"].'\', modifSagesseArme=\''.$data["modifSagesseArme"].'\') WHERE idArme=\''.$data["idArme"].'\';';
			return($query);
		}
		
		
		public function execQuery($name)
		{
			$this->resultGlobal['arme'] = $this->db->send_sql($this->selectArme($name));
		}
		
		public function affichage()
		{
			debug($this->resultGlobal);
		}
	}

?>

