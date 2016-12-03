<?
class race
{
	private $db;
	private $id;
	private $nom;
	private $status;
	private $image;
	private $desc_c;
	private $hp;
	private $mov;
	private $vis;
	private $nba;
	private $nbs;
	private $fm;
	private $mag;
	private $att;
	private $def;
	private $dam;
	private $con;
	
	public function __CONSTRUCT($id = null,$mode)
		{
			//constructeur ^ppur recuperer les variable de reste
			$this->db = new database_connector();
			if ($id !== null)
			{
				if($mode == 'nom')
				{
					$this->load_by_name($id);
				}
				else
				{
					$this->load($id);
				}
			}
			else
			{
				$this->id = null;
			}
		}
		
		private function load_by_name($id)
		{
			
			//On recup la race
			$sql =  'SELECT id,nom,description,status,image FROM race WHERE nom="'. $id .'"';
			$data = $this->db->send_sql($sql);
			if ($data['count'] == 1)
			{
				$this->id = $data[1]['id'];
				$this->nom = $data[1]['nom'];
				$this->status = $data[1]['status'];
				$this->image = $data[1]['image'];
				$this->desc_c = $data[1]['description'];
				
			}
			else
			{
				echo("Une erreur est survenue lors du chargement de votre personnage");
			}
		}
		
		
		
		private function load($id)
		{
			
			//On recup la race
			$sql =  'SELECT id,nom,description,status,image FROM race WHERE id='. $id .'';
			$data = $this->db->send_sql($sql);
			if ($data['count'] == 1)
			{
				$this->id = $data[1]['id'];
				$this->nom = $data[1]['nom'];
				$this->status = $data[1]['status'];
				$this->image = $data[1]['image'];
				$this->desc_c = $data[1]['description'];
				
			}
			else
			{
				echo("Une erreur est survenue lors du chargement de votre personnage");
			}
		}
		
		public function load_caract($id,$name_caract)
		{
			$this->db = new database_connector();
			//recup id
			$sql = 'SELECT id FROM caracteristique WHERE `key`="'. $name_caract .'"';
			$data = $this->db->send_sql($sql);
			//get_cout
			$sql = 'SELECT valeur FROM race_caract WHERE id_race='.$id.' AND id_caract = '. $data[1]['id'] .'';
			$data2 = $this->db->send_sql($sql);
			//get_cout
			return $data2[1]['valeur'];
		}
		
		public function get_id()
		{
			return $this->id;
		}
	
}

?>