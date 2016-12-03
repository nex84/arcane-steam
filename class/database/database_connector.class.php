<?php

	function anti_path()
	{//retourne les ../../etc nécessaires pour retourner à la racine du site à partir du fichier php courant.
		$path = './';
		while (!file_exists($path.'.root.tag'))
		{
			$path .= '../';
		}
		if (ereg("\.\./", $path))
		{
			$path = ereg_replace("^\./", '', $path);
		}
		return ($path);
	}
	
	require_once(anti_path().'includes/database.inc.php');
	class database_connector
	{
		private $db_handler;
		
		public function __CONSTRUCT($autoconnect = false)
		{
			$this->db_handler = null;
			if ($autoconnect === true)
				$this->Connection();
		}
		
		public function Connection()
		{
			if (!($this->db_handler === null || $this->db_handler == 0))
			{
				if (!$this->Disconnection())
					return (false);
			}
			$this->db_handler = mysql_connect(DBHOST, DBUSER, DBPWD);
			if ($this->db_handler === false)
			{
				$this->db_handler = null;
				return (false);
			}
			else
			{
				if (mysql_select_db(DBNAME, $this->db_handler))
					return (true);
				else
				{
					$this->Disconnection();
					return (false);
				}
			}
		}
		
		public function Disconnection()
		{
			if (!($this->db_handler === null || $this->db_handler == 0))
			{
				if (is_resource($this->db_handler))
				{
					if (mysql_close($this->db_handler))
					{
						$this->db_handler = null;
						return (true);
					}
					else
						return (false);
				}
				else
					$this->db_handler = null;
				return (false);
			}
			return (true);
		}
		
		public function send_sql($sql, $debug = 0)
		{
			if ($debug != 0)
				echo $sql.'<br>';
			if ($this->db_handler === null || $this->db_handler == 0)
			{
				$this->Connection();
			}
			if (is_resource($this->db_handler))
			{
				$result = mysql_query($sql, $this->db_handler);
				if ($result === false)
				{
					echo '<div class="error"><br />Sql error on sql query : <br /><b>'.$sql.'</b><br />';
					echo 'Returned error : ' . mysql_error($this->db_handler) . '<br /></div>';
					return (false);
				}
				else
				{
					if (eregi('^INSERT', $sql))//dans le cas d'une requete insert on retourne l'identifiant créer
						return (mysql_insert_id($this->db_handler));
					else if (eregi('^SELECT', $sql))
					{//dans le case d'une requete select pon retourne les eregistrements sous forme de tableau
						$data = array();
						$n = 0;
						while ($row = mysql_fetch_assoc($result))
						{
							$n++;
							foreach ($row as $key => $val)
							{
								$data[$n][$key] = $val;
							}
						}
						$data['count'] = count($data);
						return ($data);
					}
					else if (	eregi('^UPDATE', $sql) || 
								eregi('^REPLACE ', $sql) ||
								eregi('^DELETE ', $sql))
					{//dans le cas d'ne requete de type insert update replace ou delete on retourne le nombre de lignes affectées par la requetes
						return (mysql_affected_rows($this->db_handler));
					}
					else
						return ($result);
				}
			}
		}
		
		public function protect_var($var)
		{
			if ($this->db_handler === null || $this->db_handler == 0)
				$this->Connection();
			if (is_resource($this->db_handler))
				return (mysql_real_escape_string($var, $this->db_handler));
			return ($var);
		}
		
		public function __DESTRUCT()
		{
			$this->Disconnection();
		}
	}

?>