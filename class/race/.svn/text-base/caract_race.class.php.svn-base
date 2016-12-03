<?php  

//include_once('../lib/lib_test.php');
##########################################################################
##  Cette contient la libraire pour la gestion de l'administration
## des caracteritisque des races Race ##
##########################################################################

class caract_race
{	
	// les vies de la race
	private $hp;
	//les mouvement
	private $mouvement;
	// la vue
	private $vue;
	//puissance magique
	private $pm;
	//nombre de sort
	private $nb_sort;
	//defense
	private $defense;
	//attaque
	private $attaque;
	// constitution
	private $constitution;
	//nombre attaque
	private $nb_att;

	private function caract_race($hp, $mouvement, $vue, $pm, $nb_sort, $defense, $attaque, $constitution, $nb_att)
	{
		$this->hp = $hp;
		$this->mouvement = $mouvement;
		$this->vue = $vue;
		$this->pm = $pm;
		$this->nb_sort = $nb_sort;
		$this->defense = $defense;
		$this->attaque = $attaque;
		$this->constitution = $constitution;
		$this->nb_att = $nb_att;
	}
	
	
	static public function gere_race_caract($mode, $variable)
	{
		$db = new database_connector(true);
		switch($mode)
		{			
			case 'enregistre' : 	
								//verification 1
								if(!is_array($variable))
								{
									 $error = 'Argument variable incorrect  avec le mode<br />
										Verifier que votre arguement est non nul et array';
								}
								else
								{
									//$varaible = traite_variable($variable);
									// le SQL 
									if($variable['type'] == 'caract')
									{
									   // boucle d'enregistrement
									   for($i = 1; $i < 11; $i++)
									   {
									   		$querry = 'INSERT INTO race_caract SET
															id_variable = "'.$i.'",
															valeur = "'. $variable[$i] .'",
															id_race = "'. $variable['id_race'].'"';
											
											$query = $db->send_sql($querry);
										}
									 }
									 if($variable['type'] == 'cout')
									 {
									 	  // boucle d'enregistrement
									   for($i = 1; $i < 11; $i++)
									   {
									   		$querry = 'INSERT INTO race_caract SET
															id_caract = "'.$i.'",
															modif_cout = "'. $variable[$i] .'",
															id_race = "'.$variable['id_race'] .'"';
											
											$fetch = $db->send_sql($querry);
										}
									 }
								}	
			
							break;
			case 'edite' : //verification 1
								if(!is_array($variable))
								{
									 $error = 'Argument variable incorrect  avec le mode<br />
										Verifier que votre arguement est non nul et array';
								}
								else
								{
									//$varaible = traite_variable($variable);
									// le SQL 
									if($variable['type'] == 'caract')
									{
									   // boucle d'enregistrement
									   for($i = 1; $i < 11; $i++)
									   {
									   		$querry = 'UPDATE race_caract SET
															
															valeur = "'. $variable[$i] .'"
															WHERE id_race = "'. $variable['id_race'] .'" AND id_caract = "'.$i.'"';
											
											$fetch = $db->send_sql($querry);
											
											
										}
									 }
									 if($variable['type'] == 'cout')
									 {
									 	  // boucle d'enregistrement
									   for($i = 1; $i < 11; $i++)
									   {
									   		$querry = 'UPDATE race_caract SET
															
															modif_cout = "'. $variable[$i] .'"
															WHERE id_race = "'.$variable['id_race'] .'" AND id_caract= "'.$i.'"';
											
											$fetch = $db->send_sql($querry);
											
										}
									 }
								}	
			
							break;
			case 'voir' :  
							if(!is_numeric($variable))
							{
								 $error = 'Argument variable incorrect avec le mode<br />
										Verifier que votre arguement est non nul et numérque';
							}
							else
							{
								//les informations
								$querry = 'SELECT * FROM race_caract WHERE id_race = "'. $variable .'" ORDER BY id_caract ASC';
								$fetch = $db->send_sql($querry);
								$return = $fetch;
							}
			
							break;
		}
		
							return($return);
	}
}

?>