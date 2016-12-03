<?php

##########################################################################
##  Cette contient la libraire pour la gestion de l'administration Race ##
##########################################################################
// inclusion de la lib de test
//include_once('../lib/lib_test.php');

class race
{
	// ID de la racce
	private $id;
	// nom de la race
	private $nom;
	// description de la race 
	private $description;
	// nom de l'image
	private $image;
	// jouable ou pas
	private $status;

	///////////////// Constructeur
	private function race($id,$nom,$description,$image,$status)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->description = $description;
		$this->image = $image;
		$this->status = $status;
		
	}
	
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	// les GET
	
	public function get_nom()
	{
		return $this->nom;
	}
	
	public function get_id()
	{
		return $this->id;
	}
	
	public function get_status()
	{
		return $this->status;
	}
	
	public function get_image()
	{
		return $this->image;
	}
	
	public function get_description()
	{
		return $this->description;
	}
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//  Cette fonction est la seule appeller pour les operation sur race
	// en cas de succes elle renvoie soit un objet, sois un tabelau soit une string
	// en cas d'echt un message d'erreur 
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	////////////////// La statique d'appel
	static public function gere_race($mode,$variable=null) 
	{	
		$db = new database_connector(true);
		// en fonction du mode on effectue differente operation
		switch($mode)
		{
		 	case 'recherche' : 	// ce mode demande considere $varaible comme une id de race
								// test sur les parametre d'entrÅE
								if(!is_numeric($variable) || $variable == null || is_array($variable))
								{
									 $error = 'Argument variable incorrect avec le mode<br />
										Verifier que votre arguement est non nul et numÈrque';
								} 
								else
								{
									// on recherche les info en SQL 
									$querry = 'SELECT * FROM race WHERE id="' . $variable .'"'; 
									$fetch = $db->send_sql($querry);
									
									// on cree l'objet
									$race = new race($fetch[1]['id'],$fetch[1]['nom'],$fetch[1]['description'],$fetch[1]['image'],$fetch[1]['status']);
								}
								break;
			case 'enregistre' : // ce mode  considere $varaible comme le tableau $_POST[]
								// test sur les parametre d'entrÅE
								if( $variable == null || !is_array($variable))
								{
									 $error = 'Argument variable incorrect avec le mode <br />
										Verifier que votre arguement soit non nul et un tableau';
								} 
								else
								{
									// Traitement des variables 
									//$varaible = traite_variable($variable);
									// on cree l'objet
									
									
									$race = new race($variable['id'],$variable['nom'],$variable['description'],$variable['image'],$variable['status']);
									// test des varialbes 
									
									if($race->verifaction_var($race) == false)
										$error = 'Les information envoyees pour enregistrement sont incorrectes ou corrompues';
									else
									{
										$race->enregistre($variable['action'],$race);
									}
								}
							break;
			case 'liste' : // ce mode considere $varaible comme un tableau d'arguement SQL
								// test sur les parametre d'entrÅE
								// Traitement des variables 
									
									// on recherche les info en SQL 
									$querry = 'SELECT * FROM race';
										// on recherche les clauses where
										if(count($variable) != 0 )
										{
											$varaible = traite_variable($variable);
											foreach($variable['where'] as $key => $where)
											{
												if($case == '' && $where != '')
													$querry .= 'WHERE';
													
											   $case = explode(';', $where);
											   $querry .=  $case[0] . ' ' . $case[1] . ' ' . $case[2] . ' AND '; 
											}
											$querry = substr($querry, '-1','3');
										}
									$querry .= ' ORDER BY nom';
									
									
									$fetch_liste = $db->send_sql($querry);
									
									// on set le tableau
									$race = $fetch_liste;
								
			
								break;
			case 'delete' : 	// ce mode demande considere $varaible comme une id de race
								// test sur les parametre d'entrÅE
								if(!is_numeric($variable) || $variable == null || is_array($variable))
								{
									 $error = 'Argument variable incorrect  avec le mode<br />
										Verifier que votre arguement soit non nul et numÈrque';
								} 
								else
								{
									// on recherche les info en SQL 
									$querry = 'DELETE FROM race WHERE id = "'.$variable.'"';
									$sol = $db->send_sql($querry);
									$race = 'delete rÈsussi';
								}
								break;
			default : $error = 'Vous n\' avez spÈcifiÅ&eacute; au;cun mode, <br />cette fonction se d&eacute;clare :
									gere_race( mode, {id_race}, {$_post})';
								break; 
		}
			
		if($error != '')
			return $error;
		else
			return $race;
			
 	}
		
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	// Cette fonction verifie l'integritÅEdes varialbes
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX		
	private function verifaction_var($race)
	{
	/*
		$nom = $race->get_nom();
		if(!texte($nom))
			return(false);
		$description = $race->get_description();
		 if(!texte($description))
			return(false);
		$image = $race->get_image();
		if(!texte($nom))
			return(false);
		$status = $race->get_status();
		 if(!texte($status))
			return(false);
		*/
		return(true);	
	}	
	
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//  Cette fonction s'occupe de l'enregistrement SQL
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	private function enregistre($action,$race)
	{
		$db = new database_connector(true);
		if($action == 'insert')
		{
			
			$nom = $race->get_nom();
			$image = $race->get_image();
			$description = $race->get_description();
			$status = $race->get_status();
			
			//on enregistre
			$querry = 'INSERT INTO race
						SET nom = "'. $nom .'",
						image = "'. $image .'",
						description = "'. $description .'",
						status = "'. $status .'"';
						
			
			$sol = $db->send_sql($querry);
			//enregistrement des caract en les settant a 0
			$id = mysql_insert_id();
			for($i=1; $i < 11; $i++)
			{
				$querry = 'INSERT INTO race_caract SET
											id_caract = "'.$i.'",
											modif_cout = 0,
											valeur = 0,
											id_race = "'. $id .'"
											';
			
				$sol = $db->send_sql($querry);
			}
			
			
			
		}
		if($action == 'update')
		{
			$id = $race->get_id();
			$nom = $race->get_nom();
			$image = $race->get_image();
			$description = $race->get_description();
			$status = $race->get_status();
			
			$querry = ' UPDATE race 
						SET nom = "'.$nom.'",
						image = "'.$image.'",
						description = "'. $description .'",
						status = "'.$status.'"
						WHERE id = "'.$id.'"';
			$sol = $db->send_sql($querry);
		}
	} 	
	
		
	
}


?>