<?php
class Message
{

	private $titre; 
	private $corps;
	private $lu;
	private $destinataire;
	private $emetteur;
	private $repondu;
	private $flag_rang_emetteur;
	private $flag_archiver;
	private $flag_box;
	private $flag_accuser_reception;
	private $id;
	private $liste_destinataire;
	private $mdate;
	
	
	// Getter 
	public function get_id()
	{
		return($this->id);
	} 
	
	public function get_titre()
	{
		return($this->titre);
	} 
	public function get_corps()
	{
		return($this->corps);
	} 
	public function get_emetteur()
	{
		return($this->emetteur);
	} 
	public function get_repondu()
	{
		return($this->repondu);
	} 
	public function get_flag_rang_emetteur()
	{
		return($this->flag_rang_emetteur);
	} 
	public function get_lu()
	{
		return($this->lu);
	} 
	public function get_flag_box()
	{
		return($this->flag_box);
	} 
	public function get_flag_archiver()
	{
		return($this->flag_archiver);
	} 
	public function get_flag_accuser_reception()
	{
		return($this->flag_accuser_recpetion);
	} 
	public function get_liste_destinataire()
	{
		return($this->liste_detinataire);
	} 
	
	public function get_mdate()
	{
		return($this->mdate);
	} 
	
	private function message($donne)
	{
		$this->id = $donne['id'];
		$this->titre = $donne['titre'];
		$this->corps = $donne['corps'];
		$this->emetteur = $donne['emetteur'];
		$this->repondu = $donne['flag_repondu'];
		$this->flag_rang_emetteur = $donne['flag_emetteur'];
		$this->flag_box = $donne['flag_box'];
		$this->lu = $donne['flag_lu'];
		$this->flag_archiver = $donne['flag_archiver'];
		$this->flag_accusrer_reception = $donne['flag_accusrer_reception'];
		$this->liste_destinataire = $donne['liste_destinataire'];
		$this->mdate = $donne['date'];
	}
	public function Message_construction($message)
	{
		//on crée le corps
			//on reucpere la signature et l'entete
			//SQL
		$corps_inter = $fetch['entete'] . '<br /><br /> ' . $this->corps . '<br /><br />' . $fetch['signature'];
		
		//construction
		$this->corps = $corps_inter;
		$this->repondu = 0;
		$this->lu = 0;
		$this->flag_accuser_reception = 0/*$donnee['flag_accuser_reception']*/;
		$this->destinataire = "";
		$this->flag_rang_emetteur = /*$donnee['flag_emetteur']*/ 0;
		$this->flag_archiver = 0;
		$this->flag_box = 0;
		
		return $this;
	}
	
	public function send_message($message,$destinataire)
	{
		//Cette fonction envoie le message : ie elle enregistre le message en base
		
		//Ecriture en bases
			$return =  $this->enregistre_message($message,$destinataire);
			if($return != 1)
			{
				$message_sortie = "Erreur d'envoie de message" . $return;
				return $message_sortie	;
			}
		$message_sortie = "message envoyer correctement";
		return $message_sortie	;
	}
	
	private function enregistre_message($message,$destinataire)
	{
		
		//Enregistrement d'un message en base	
		/*xxxxxxxxxxxxxxxxxx*/
		// longue chaine de test
		/*xxxxxxxxxxxxxxxxxx*/
			//phase 1 : test si le destinataire est le nom et si le destinataire existe
			
			
				// 1 verification de l'existence du personnage
				$querrt_test = 'SELECT id,login FROM users WHERE id ="'. $destinataire .'"';
				$res = mysql_query($querrt_test);
				$fetch = mysql_fetch_assoc($res);
				if(count($fetch) == 0)
					return $fetch['nom'] ." : Nom de personnage erronné ou inéxistant ";
			
			
			//phase 2 : verification des valeurs numeriques non modifiable par l'utilisateur
			/*if(!is_int($this->lu) || !is_int($this->emetteur) || !is_int($this->repondu) || !is_int($this->flag_rang_emetteur) 
			|| !is_int($this->flag_archiver) || !is_int($this->flag_box))
			{
				return " : Modification de paramètre non autorisé ";
			}
			*/
			//pahse 3 : verification des booléeins
			/*if((!is_bool(($this->lu))) || (!is_bool($this->repondu))) || (!is_bool($this->flag_archiver)))
				|| (!is_bool($this->flag_accuser_reception))))
			{
					return " : Modification de paramètre non autorisé ";
			}
			*/
			//phase Fin : Enregistrement du message
			
			
			$querry_save = "INSERT INTO message 
		 	(corps,flag_lu,destinataire,emetteur,flag_repondu,flag_emetteur,flag_archiver,flag_box,flag_accuser_recp,titre,liste_destinataire)
		 	VALUES
		 	('". $this->corps ."','". $this->lu ."','". $destinataire ."','". $this->emetteur ."','". $this->repondu ."',
		 	'". $this->flag_rang_emetteur ."','". $this->flag_archiver ."','". $this->flag_box ."','". $this->flag_accuser_reception ."',
			'". $this->titre ."','". $this->liste_destinataire ."')";
			//execution
			mysql_query($querry_save);
			return 1;
			
	}
	
	
	private function Affiche_formulaire_message()
	{
		//du html
	}
	
	private function Lire_message($message)
	{
		//du html
	}
	
	private function Supprime_message($id_messsge,$id_joueur)
	{
		//SQL test
		$querry_test = 'SELECT id FROm message WHERE id = "'. $id_message .'" AND id_destinataire = "'. $id_joueur .'"';
		//EXecution
		
	if( $fetch_test_1> 0)
	{
		//SQL DELETE
		$querry = 'DELETE FROM message WHERE HERE id = "'. $id_message .'" AND id_destinataire = "'. $id_joueur .'"';
		//Execution
	}
		
	}
	
	private function Transfert_message($id_messsge,$id_joueur)
	{
		//Cette fonction transfert un message vers un autre utilisataire
	}
	
	private function Archive_message($id_messsge,$id_joueur)
	{
		
	}

//////////////
	public static function dispatch_message($donne,$mode)
	{
		//test si l'id et lke nom sont concordant
		//$querry_t  = "SELECT nom,id FROM joueur WHERE id='". $donne['id'] ."' AND nom='". $donne['nom'] ."'";
		switch($mode)
		{
			case 'get_liste_g' : 		
								//on recupere la lite de message de la boite general
								$querry = 'SELECT * FROM message WHERE flag_box =0 AND flag_archiver =0 AND destinataire = "'. $donne['id'] .'"';
							
								$res =mysql_query($querry);
								while($fetch[] = mysql_fetch_assoc($res));			
								return($fetch);
								break;
			case 'get_liste_a' : 		
								//on recupere la lite de message de la boite archivage
								$querry = 'SELECT * FROM message WHERE flag_box =0 AND flag_archiver =1 AND destinataire = "'. $donne['id'] .'"';
							
								$res =mysql_query($querry);
								while($fetch[] = mysql_fetch_assoc($res));			
								return($fetch);
								break;
			case 'get_liste' : 		
								//on recupere la lite de message d'une box
								$querry = 'SELECT * FROM message WHERE flag_box ="'. $donne['box'] .'" AND flag_archiver =1 AND destinataire = "'. $donne['id'] .'"';
							
							
								$res =mysql_query($querry);
								while($fetch[] = mysql_fetch_assoc($res));			
								return($fetch);
								break;					
													
			case 'get_message' : 	
	
									//Cette fonction recupere un message en base de donnée et construit l'objet
									//SQL pour le message
									$querry = 'SELECT * FROM message WHERE id = "'. $donne['id_message'] .'" AND destinataire = "'. $donne['id'] .'"';
									
									//Execution
									$res = mysql_query($querry);
									$fetch = mysql_fetch_assoc($res);
								
									$message = new message($fetch);
									
									return $message;
									break;
									
			case 'set_lu' : 
								//SQL pour le message
								$querry = 'UPDATE message SET flag_lu = 1 WHERE id = "'. $donne['id_message'] .'" AND destinataire = "'. $donne['id'] .'"';
									
								//Execution
								$res = mysql_query($querry);
			
								break;		
			case 'enregistre' : 
								//creation du message
								
								$message = new message($donne);
								$message = $message->Message_construction($message);
								
								
								
								//envoie destinataire
								
								$tab_dest = explode(";",$donne['liste_destinataire']);
								$tab_dest[] = $donne['destinataire'];
								//transformation nom->id
								foreach($tab_dest as $key => $value)
								{
									
									$tab_dest[$key] = find_id($value);
									
									
								}
								
								
								foreach($tab_dest as $key => $value)
								{
									$liste = "";
									//cosntruction de la liste des utilisateur
									$destinataire = $value;
									foreach($tab_dest as $key2 => $value2)
									{
										if($value2 != $value)
										{
											$liste .= $value2 . ';';
										}
									}
									if($value != "")
									{
										$message->liste_destinataire = $donne['liste_destinataire'];
										 
										$retour = $message->send_message($message,$value);
										echo '<br />'.$retour ."<br />";
										sleep(2);
									}
								} 
								
								break;						
									
			default  : break;
		}
	}
}


?>