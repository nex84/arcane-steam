<?php

class joueur_caract
{	
	private $db;
	private $id;
	private $table_caract;
	
	
	public function __CONSTRUCT($id = null)
	{
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
	
		$sql =  $this->get_caract_by_id($id);
		$data = $this->db->send_sql($sql);
		if ($data['count'] > 0)
		{
			for ($i = 0; $i < $data['count']; $i++)
			{
				$this->table_caract[$data[$i]['nom']]['valeur'] = $data[$i]['valeur'];
				$this->table_caract[$data[$i]['nom']]['valeur_max'] = $data[$i]['valeur_max'];
			}
		}
		else
		{
			echo("Une erreur est survenue lors du chargement de votre personnage");
		}
	}
	
	
	public function get_data()
	{
		return $this->table_caract;
	}
	
	
	private function get_caract_by_id($v)
	{
		$s = "SELECT uc.valeur, uc.valeur_max, c.nom FROM users_caracteristique as uc, caracteristique as c WHERE uc.id_cara = c.id AND uc.id_users = ".$v;
		return $s;
	}
	
}


?>