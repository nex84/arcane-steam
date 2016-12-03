<?php

class box
{
	
	private $db;
	private $datas;
	public $data; 
		
	public function __CONSTRUCT()
	{
		$this->db = new database_connector();
	}
	
	public function getData()
	{
		return($this->datas);
	}
	
	public function getAllMessageInBox($donne)
	{
		$query = 'SELECT m.*, u.login FROM `message` m, users u WHERE m.destinataire = \''.$donne['id'].'\' and u.id = m.emetteur';
		$this->datas = $this->db->send_sql($query);
	}
	
	public function dispatch_box($donne,$mode)
	{
	
		//test si l'id et lke nom sont concordant
		//$querry_t  = "SELECT nom,id FROM joueur WHERE id='". $donne['id'] ."' AND nom='". $donne['nom'] ."'";
		switch($mode)
		{
			case 'get_liste' : 		
								//on recupere la lite des box ainsi que le nombre de message non lu dans les box
								$query = '
								SELECT b.num, b.name, e.message_non_lu from box b left join
								(select count(m.flag_box) as message_non_lu , m.flag_box from message m WHERE m.flag_lu=0 AND destinataire="'.$donne['id'].'" AND flag_box <> 0 GROUP BY m.flag_box)
								  e on ( b.id = e.flag_box)';
								$this->data = $this->db->send_sql($query);				
								break;
								
			case 'get_non_lu' : 	
						
							//on recupere la lite des box ainsi que le nombre de message non lu dans les box
							$query = ' SELECT count(flag_lu) as nb from message WHERE flag_lu = 0 AND flag_archiver = 0 and flag_box = 0 AND destinataire="'.$donne['id'].'"';
							$this->data = $this->db->send_sql($query);
							break;
			case 'delete_box' : 		
							//on recupere la lite des box ainsi que le nombre de message non lu dans les box
							$querry = 'DELETE FROM box WHERE num="'.$donne['box'].'" AND id_joueur="'.$donne['id'].'"';
							$this->db->send_sql($querry);
							
							//on enleve les messages de la box supprimer
							$querry = 'UPDATE message SET flag_box = 0 , flag_archiver = 0 WHERE flag_box ="'. $donne['box'] .'" AND destinataire ="'.$donne['id'].'"';
							$this->db->send_sql($querry);
							//on reaffetce des nums plsu petits
							$querry_liste = 'SELECT id,num FROM box WHERE num > "'.$donne['box'].'" AND id_joueur="'.$donne['id'].'"';
							$res = $this->db->send_sql($querry_liste);
							while($fetch_liste[] = mysql_fetch_assoc($res));
							for($i =0;$i < count($fetch_liste) - 1; $i++)
							{
								$querry = 'UPDATE box SET num = num-1 WHERE  id="'.$fetch_liste[$i]['id'].'"';
								$this->db->send_sql($querry);
								
								//rapatriement des messagfes dans les boites
								$querry = 'UPDATE message SET flag_box = "'. ($fetch_liste[$i]['num'] - 1).'" WHERE flag_box ="'. $fetch_liste[$i]['num'] .'" AND destinataire ="'.$donne['id'].'"';
								$this->db->send_sql($querry);
								//echo $querry . '<br />';
								
							}
							
							break;
			
			case 'new_box' : 		
						//on recup le dernier id de box
						$querry_max = 'SELECT max(num) FROM box WHERE id_joueur="'. $donne['id'] .'"';
						$res =$this->db->send_sql($querry_max);
						$fetch = mysql_fetch_assoc($res);	
						
						//creation de la boite
						$querry = 'INSERT INTO box
									(num,id_joueur,name)
									VALUES ("'.($fetch['max(num)'] + 1) .'","'. $donne['id'] .'","'.addslashes($donne['nom_box']).'")';
						$this->db->send_sql($querry);
						break;
						
			default  : break;
		}
	}
}

?>