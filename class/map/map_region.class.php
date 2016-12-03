<?php


class map_region
{
	private $id;
	
	public 	$template;
	public	$map;
	
	private $nom;
	private $pos_x;
	private $pos_y;
	private $pos_z;
	private $width;
	private $height;
	private $img;
	
	private $db;
	
	public function __CONSTRUCT($id = null)
	{
		$this->id = null;
		$this->template = null;
		$this->map = null;
		$this->nom = null;
		$this->pos_x = null;
		$this->pos_y = null;
		$this->width = null;
		$this->height = null;
		$this->img = null;
		$this->db = new database_connector();
		if ($id !== null)
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
			case ('pos_x'):
				$this->pos_x = $valeur;
				break;
			case ('pos_y'):
				$this->pos_y = $valeur;
				break;
			case ('pos_z'):
				$this->pos_z = $valeur;
				break;
			case ('width'):
				$this->width = $valeur;
				break;
			case ('height'):
				$this->height = $valeur;
				break;
			case ('map_id'):
				$this->map = new map_map($valeur);
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
			case ('pos_x'):
				return ($this->pos_x);
			case ('pos_y'):
				return ($this->pos_y);
			case ('pos_z'):
				return ($this->pos_z);
			case ('width'):
				return ($this->width);
			case ('height'):
				return ($this->height);
			default:
				return('PropriétEinéxistante : '.$propriete);
		}
		return (false);
	}
	
	public function load($id)
	{
		$data = $this->db->send_sql(select_regions_by_id($id));
		$this->id = $data[1]['id'];
		$this->template = new map_template($data[1]['Templates_id']);
		$this->map = new map_map($data[1]['Map_id']);
		$this->nom = $data[1]['nom'];
		$this->img = $data[1]['img'];
		$this->pos_x = $data[1]['pos_x'];
		$this->pos_y = $data[1]['pos_y'];
		$this->pos_z = $data[1]['pos_z'];
		$this->width = $data[1]['width'];
		$this->height = $data[1]['heigth'];
	}
	
	public function save()
	{
		if ($this->id === null)
		{
			$res = $this->db->send_sql(select_region_with_pos($this->pos_x, $this->pos_y, $this->pos_z, $this->map->get('id')));
			if ($res['count'] <= 0)
			{//si les coordonnées sont libres
				$sql = insert_regions($this->template->get('id'), $this->map->get('id'), $this->nom, $this->img, $this->pos_x, $this->pos_y, $this->pos_z, $this->width, $this->height);
				$this->id = $this->db->send_sql($sql);
			}
			else
			{
				echo '<div class="error"><b>Erreur :</b><br />
				Une région existe déjEaux coordonnées {'.$this->pos_x.';'.$this->pos_y.';'.$this->pos_z.'}<br />
				C\'est la r&eacute;gion '.$res[1]['id'].' : '.$res[1]['nom'].'
				</div>';
			}
		}
		else
		{
			$res = $this->db->send_sql(select_region_with_pos($this->pos_x, $this->pos_y, $this->pos_z, $this->map->get('id')));
			if ($res['count'] <= 0)
			{//si les coordonnées sont libres
				$sql = update_regions($this->id, $this->nom, $this->img, $this->pos_x, $this->pos_y, $this->pos_z, $this->width, $this->height, $this->map->get('id'), $this->template->get('id'));
				$this->db->send_sql($sql);
			}
			elseif ($res[1]['id'] == $this->id)
			{
				$sql = update_regions($this->id, $this->nom, $this->img, $this->pos_x, $this->pos_y, $this->pos_z, $this->width, $this->height, $this->map->get('id'), $this->template->get('id'));
				$this->id = $this->db->send_sql($sql);
			}
			else
			{
				echo '<div class="error"><b>Erreur :</b><br />
				Une région existe déjEaux coordonnées {'.$this->pos_x.';'.$this->pos_y.';'.$this->pos_z.'}<br />
				C\'est la r&eacute;gion '.$res[1]['id'].' : '.$res[1]['nom'].'
				</div>';
			}
			
			$sql = delete_Allcases($this->id);
			$this->db->send_sql($sql);
		}
	}
	
	public function delete()
	{
		if ($this->id !== null)
		{
			$sql = delete_regions($this->id);
			if ($this->db->send_sql($sql) > 0)//si la suppression a réussie
				$this->id = null;
		}
	}
	
	private function return_path_image()
	{
		$path = return_anti_path().IMG_PATH.'regions/'.$this->img;
		return ($path);
	}
}

?>