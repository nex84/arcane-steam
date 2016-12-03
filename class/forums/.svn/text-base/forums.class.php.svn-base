<?php

	class forums
	{
		
		private $data;
		private $db;
		private $dataZone;
		private $dataBalance;
		private $_balance = 0;
		private	$_id = '';
		private $_item;
		
		public function __CONSTRUCT()
		{
			$this->db = new database_connector();
		}
		
		public function addPost($idSection, $idUser, $titre)
		{
			$sql = "INSERT INTO forums_post(id_section, id_utilisateur, Titre) VALUES ('".addslashes($idSection)."','".addslashes($idUser)."','".addslashes($titre)."')";
			$this->data = $this->db->send_sql($sql);
			
			$sql = "SELECT id FROM forums_post ORDER BY id DESC LIMIT 1";
			$this->data = $this->db->send_sql($sql);
			
			return $this->data;
		}
		
		
		public function addMessage($idSection, $idUser, $message)
		{
			$sql = "INSERT INTO forums_message(id_post, id_utilisateur, message, Date) VALUES ('".addslashes($idSection)."','".addslashes($idUser)."','".addslashes($message)."','".getdate()."')";
			$this->data = $this->db->send_sql($sql);
		}
		
		public function getListSection($rank)
		{
			$sql = "SELECT id, nom FROM forums_section, (SELECT COUNT(id) as nbPost, id_section FROM forums_categorie WHERE Visible = 1 AND Permission = '".$rank."'  GROUP BY id_section) t WHERE Permission = '".$rank."' AND t.nbPost > 0 AND t.id_section = id ORDER BY ordre";
			$this->data = $this->db->send_sql($sql);
			
			return $this->data;
		}
		
		public function getListCategorie($rank, $idSection)
		{
			$sql = "SELECT  c.id, c.nom, t.nbPost FROM forums_categorie c LEFT OUTER JOIN (SELECT COUNT(id) as nbPost, id_section FROM forums_post GROUP BY id_section) t ON t.id_section = c.id WHERE c.Visible = 1 AND c.Permission = '".$rank."' AND c.id_section =  '".$idSection."' ";
			$this->data = $this->db->send_sql($sql);
			
			return $this->data;
		}
		
		public function getLink($idSection)
		{
			$sql = "SELECT c.id as catId, c.Nom as catNom, s.id as secId, s.Nom as secNom FROM forums_categorie c, forums_section s WHERE c.id_section = s.id AND  c.id = '".$idSection."'";
			$this->data = $this->db->send_sql($sql);
			
			return $this->data;
		}
		
		public function getListSubject($idSection)
		{
			$sql = "SELECT t.id, t.Titre, t.id_utilisateur, u.login  FROM forums_post t, users u WHERE u.id = t.id_utilisateur AND id_section = '".$idSection."'";
			$this->data = $this->db->send_sql($sql);
			
			return $this->data;
		}
	}
	
	?>