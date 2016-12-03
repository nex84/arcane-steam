<?php


class map_type
{
	private $id;
	public 	$template;
	private $nom;
	private $img;
	private $depl_terrestre;
	private $depl_aerien;
	private $depl_naval;
	private $coef_depl;
	private $db;
	
	public function __CONSTRUCT($id = null)
	{
		$this->id = null;
		$this->template = null;
		$this->nom = null;
		$this->img = null;
		$this->depl_terrestre = null;
		$this->depl_aerien = null;
		$this->depl_naval = null;
		$this->coef_depl = null;
		$this->db = new database_connector();
		if ($id != null)
			$this->load($id);
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
			case ('depl_terrestre'):
				$this->depl_terrestre = $valeur;
				break;
			case ('depl_aerien'):
				$this->depl_aerien = $valeur;
				break;
			case ('depl_naval'):
				$this->depl_naval = $valeur;
				break;
			case ('coef_depl'):
				$this->coef_depl = $valeur;
				break;
			case ('template_id'):
				$this->template = new map_template($valeur);
				break;
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
			case ('img_path'):
				return ($this->return_path_image());
			case ('depl_terrestre'):
				return ($this->depl_terrestre);
			case ('depl_aerien'):
				return ($this->depl_aerien);
			case ('depl_naval'):
				return ($this->depl_naval);
			case ('coef_depl'):
				return ($this->coef_depl);
		}
		return (false);
	}
	
	public function load($id)
	{
		$data = $this->db->send_sql(select_types_by_id($id));
		$this->id = $data[1]['id'];
		$this->template = new map_template($data[1]['Templates_id']);
		$this->nom = $data[1]['nom'];
		$this->img = $data[1]['img'];
		$this->depl_terrestre = $data[1]['depl_terrestre'];
		$this->depl_aerien = $data[1]['depl_aerien'];
		$this->depl_naval = $data[1]['depl_naval'];
		$this->coef_depl = $data[1]['coef_depl'];
	}
	
	public function save()
	{
		if ($this->id === null)
		{
			$sql = insert_types($this->template->get('id'), $this->nom, $this->img, $this->depl_terrestre, $this->coef_depl, $this->depl_aerien, $this->depl_naval);
			$this->id = $this->db->send_sql($sql);
		}
		else
		{
			$sql = update_types($this->id, $this->nom, $this->img, $this->depl_terrestre, $this->coef_depl, $this->depl_aerien, $this->depl_naval);
			$this->db->send_sql($sql);
		}
	}
	
	public function delete()
	{
		if ($this->id !== null)
		{
			$sql = delete_types($this->id);
			if ($this->db->send_sql($sql) > 0)//si la suppression a réussie
				$this->id = null;
		}
	}
	
	private function return_path_image()
	{
		$path = return_anti_path().IMG_PATH.'templates/'.$this->template->get('id').'/'.$this->img;
		return ($path);
	}
}

?>