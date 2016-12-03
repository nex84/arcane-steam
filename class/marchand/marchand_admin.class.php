<?php

	class marchand_admin
	{
		
		private $data;
		private $dataZone;
		private $dataBalance;
		private $_balance = 0;
		private	$_id = '';
		private $_item;
		
		public function __CONSTRUCT()
		{
			$this->db = new database_connector();
		}
		
		public function load($id)
		{
			if ($id != '')
			{
				$this->data = $this->db->send_sql($this->byId($id));
				$this->_id = $id;
			}
			else
				echo '<div class="error">Vous devez fournir un \'Identifiant\' num&eacute;rique</div>';
		}
		
		public function getItems()
		{
			$this->data = $this->db->send_sql($this->sqlGetItems());
			
			for ($i = 1; $i <= $this->data['count']; $i++)
			{
				$_item[''.$this->data[$i]['typ'].''][]['id'] = $this->data[$i]['id'];
				$idnow = 0;
				while(isset($_item[''.$this->data[$i]['typ'].''][$idnow]))
					$idnow++;
				
				$idnow--;
				 strlen($_item[''.$this->data[$i]['typ'].'']);
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['nom'] = $this->data[$i]['nom'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['description'] = $this->data[$i]['description'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['prix'] = $this->data[$i]['prix'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['image'] = $this->data[$i]['image'];
			}
			return($_item);
		}
		
		public function haveItems($id_item)
		{
			$query = 'SELECT * FROM Marchand_Items WHERE item_id=\''.$id_item.'\' AND marchand_id=\''.$this->_id .'\'';
			return($query);
		}
		
		public function addItems($id_item)
		{
			$this->data = $this->db->send_sql($this->haveItems($id_item));
			if ($this->data['count'] > 0) // On ajoute 1 Items
			{
				$sql = "UPDATE Marchand_Items SET actuelle = (actuelle + 1) WHERE item_id='".$id_item."' AND marchand_id='".$this->_id."';";
			}
			else // On crÈÈ l'items
			{
				$sql = "INSERT INTO Marchand_Items(marchand_id,item_id,nbMax,actuelle,rate) VALUES ('".$this->_id."','".$id_item."',1,1,1);";
			}
			$this->data = $this->db->send_sql($sql);
		}
		
		public function getMarchanStock($id)
		{
		
			$this->_id = $id;
			$this->data = $this->db->send_sql($this->sqlGetMarchanStock());
			
			for ($i = 1; $i <= $this->data['count']; $i++)
			{
				$_item[''.$this->data[$i]['typ'].''][]['id'] = $this->data[$i]['idItems'];
				$idnow = 0;
				while(isset($_item[''.$this->data[$i]['typ'].''][$idnow]))
					$idnow++;
				
				$idnow--;
				 strlen($_item[''.$this->data[$i]['typ'].'']);
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['nom'] = $this->data[$i]['nom'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['description'] = $this->data[$i]['description'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['prix'] = $this->data[$i]['prix'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['image'] = $this->data[$i]['image'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['qte'] = $this->data[$i]['qte'];
			}
			return($_item);
		}
		
		private function sqlGetMarchanStock()
		{
			$query = 'SELECT objets.*,Marchand_Items.id as idItems, Marchand_Items.actuelle as qte FROM objets,Marchand_Items WHERE objets.id = Marchand_Items.item_id AND Marchand_Items.marchand_id = '.$this->_id.' ORDER BY objets.typ,objets.nom';
			return($query);
		}
		
		private function sqlGetItems()
		{
			$query = 'SELECT * FROM objets ORDER BY typ,nom';
			return($query);
		}
		
		public function getItem($id)
		{
			$this->data = $this->db->send_sql($this->sqlGetItem());
			
			for ($i = 1; $i <= $this->data['count']; $i++)
			{
				$_item[''.$this->data[$i]['typ'].''][]['id'] = $this->data[$i]['id'];
				$idnow = 0;
				while(isset($_item[''.$this->data[$i]['typ'].''][$idnow]))
					$idnow++;
				
				$idnow--;
				 strlen($_item[''.$this->data[$i]['typ'].'']);
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['nom'] = $this->data[$i]['nom'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['description'] = $this->data[$i]['description'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['prix'] = $this->data[$i]['prix'];
				$_item[''.$this->data[$i]['typ'].''][$idnow ]['image'] = $this->data[$i]['image'];
			}
			return($_item);
		}
		
		private function sqlGetItem($id)
		{
			$query = 'SELECT * FROM objets WHERE id=\''.$id.'\' ORDER BY typ,nom';
			return($query);
		}
		
		public function getBalance()
		{
			if ($this->_id != '')
			{
				$this->dataBalance = $this->db->send_sql($this->sqlGetBalance());
				if ($this->dataBalance['count'] > 0)
					return ($this->dataBalance);
				else
					return(0);
			}
			else
				echo '<div class="error">Une erreur est survenue !!'.$_id.'</div>';
		}
		
		public function Recherche($name, $y=NULL, $x=NULL)
		{
			if ($x == NULL || $y == NULL)
				$this->data = $this->db->send_sql($this->byName($name));
			else
				$this->data = $this->db->send_sql($this->byPosition($x,$y));
		}
		
		private function byName($name)
		{
			$name = str_replace('*','%',$name);
			$query = 'SELECT * FROM Marchand WHERE name LIKE \''.$name.'\' ORDER BY name';
			return($query);
		}
		
		private function byPosition($x,$y)
		{
			$query = 'SELECT * FROM Marchand WHERE x = \''.$x.'\' AND y = \''.$y.'\' ORDER BY x,y';
			return($query);
		}
		
		private function byId($id)
		{
			$query = 'SELECT * FROM Marchand WHERE id = \''.$id.'\' ORDER BY id';
			return($query);
		}
		
		public function getData()
		{
			return($this->data);
		}
		
		public function getZone()
		{
			$query = 'SELECT id, nom FROM regions ORDER BY nom';
			$this->dataZone = $this->db->send_sql($query);
			
			return $this->dataZone;
		}
		
		private function sqlGetBalance()
		{
			$query = 'SELECT Marchand_Balance.Values,Marchand_Balance.Time FROM Marchand_Balance WHERE marchand_id = \''.$this->_id.'\'';
			return($query);
		}
		
		public function update($id,$name,$x,$y,$region,$description)
		{
			$query = 'UPDATE Marchand SET name = \''.$name.'\', x = '.$x.', y = '.$y.', Description = \''.$description.'\', region='.$region.' WHERE id = '.$id.';';
			$this->data = $this->db->send_sql($query);
		}
		
		public function my_isset($id)
		{
			
			$query = 'SELECT id FROM Marchand WHERE id = "'.addslashes($id).'"';
			$this->data = $this->db->send_sql($query);
			
			if ($this->data['count'] == 1)
			{
				return (1);
			}
			else
			{
				return (0);
			}
		}
		
		public function create($name,$x,$y,$region,$description)
		{
			$query = 'INSERT INTO Marchand(name,x,y,region,Description) VALUE(\''.$name.'\','.$x.','.$y.',\''.$region.'\',\''.$description.'\');';
			$this->data = $this->db->send_sql($query);
			$query = 'SELECT id FROM Marchand ORDER BY id DESC';
			$this->data = $this->db->send_sql($query);
			$time = date('Ymd');
			$query = 'INSERT INTO Marchand_Balance(marchand_id,Values,Time) VALUE(\''.$this->data[1]['id'].'\',\'10000\','.$time.',\''.$description.'\');';
			$this->data = $this->db->send_sql($query);
			return ($this->data[1]['id']);
		}
		
		public function affichage()
		{
			if ($this->data['count'] > 0)
			{
				echo '<table cellpadding="0" cellspacing="0" width="100%" >';
				echo '<tr style="background-color:#C0C0C0; border-bottom:1px #C0C0C0 solid;color:#FFFFFF;">';
				echo '<td>id</td>';
				echo '<td>Name</td>';
				echo '<td>x</td>';
				echo '<td>y</td>';
				echo '<td>Region</td>';
				echo '<td>Description</td>';
				echo '</tr>';
				
				for ($i = 1; $i <= $this->data['count']; $i++)
				{
					$regionName = '<font color="red">>Non atribuÅE</font>';
					$tmp = $this->getZone();
					$j = 1;
					while (isset($tmp[$j]))
					{
						if ($this->data[$i]['region'] == $tmp[$j]["id"])
							 $regionName = $tmp[$j]["nom"];
						$j++;
					}
					echo '<tr>';
					echo '<td style="border-bottom:1px #C0C0C0 solid;cursor:hand;" onclick="upadte('.$this->data[$i]['id'].')">'.$this->data[$i]['id'].'</td>';
					echo '<td style="border-bottom:1px #C0C0C0 solid;">'.stripslashes($this->data[$i]['name']).'</td>';
					echo '<td style="border-bottom:1px #C0C0C0 solid;">'.stripslashes($this->data[$i]['x']).'</td>';
					echo '<td style="border-bottom:1px #C0C0C0 solid;">'.stripslashes($this->data[$i]['y']).'</td>';
					echo '<td style="border-bottom:1px #C0C0C0 solid;">'.$regionName.'</td>';
					echo '<td style="border-bottom:1px #C0C0C0 solid;">'.stripslashes($this->data[$i]['Description']).'</td>';
					echo "</tr>";
				}
				echo '</table>';
			}
			else
			{
				echo '<span class="error">Aucun resultat</span>';
			}
		}
	}

?>

