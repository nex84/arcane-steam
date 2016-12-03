<?php 

##########################################################################
##  Cette class contient les methode d'action d'un personnage
## nommage des messages : 1 a afficher pour le jeu, 2 a logger, 3 test reussi
##########################################################################
class joueur_action
{
	private $donne_a;
	private $donne_s;
	
/*	private function action_perso();
	{
		//on sort toutes les informations des personnages realtives au actions
	}
	*/
	
	public function deplacement($donne)
	{
		## On recoit l'id du personnage, sa position, la ou il veut aller, type de terrain ##
		// 1 verification de la validite du deplacement
			
			// a la case est bien contigue
			$X = $donne['x']['aller'] - $donne['x']['depart'];
			$Y = $donne['y']['aller'] - $donne['y']['depart'];
			
			
			
			if(abs($X) > 1 || abs($Y) > 1)
				return $return = '2 deplacement interdit : case non contigue ';
			// b verification que le terrain est de type deplacment

			$querry = 'select ';
			// test du type de terrain
			/*
			if($type in_array())
				return $return = '1 deplacement interdit : Vous ne pouvez traverser ce type de terrain';
				*/
				
			// c verification que la case est vide
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//
					$querry = 'select id_joueur from position where x="'.$donne['x']['aller'].'" AND y="'.$donne['y']['aller'].'"';
					$result = mysql_query($querry);
					$fetch = mysql_fetch_assoc($result); 
			//
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			
			
			if($fetch['id_joueur'] != "")
				return $return = '1 deplacement interdit : case occupee';
				
			//d verification que ce sont les bonnes coordonnee de depart
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			//
					$querry = 'select id_joueur from position where x="'.$donne['x']['depart'].'" AND y="'.$donne['y']['depart'].'" AND id_joueur = "'. $donne['perso'] .'"';
					$result = mysql_query($querry);
					$fetch2 = mysql_fetch_assoc($result); 
			//
			//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
			if($fetch2['id_joueur'] == "")
				return $return = '2 Valeur transmise erronee volontairement : tentative de triche du joueur : '. $donne['perso'] .'';
			
				
		//2 deplacement
			// a ecriture en base 
			$querry = '	UPDATE position
						SET x="'.$donne['x']['aller'].'", y="'.$donne['y']['aller'].'"
						where x="'.$donne['x']['depart'].'" AND y="'.$donne['y']['depart'].'" AND id_joueur = "'. $donne['perso']  .'"';
						
			mysql_query($querry);
						
			// b verification qu'il n'y a pas de doublon
			$querry = 'select id_joueur from position where x="'.$donne['x']['aller'].'" AND y="'.$donne['y']['aller'].'"';
			$result = mysql_query($querry);
			while($fetch3[] = mysql_fetch_assoc($result)); 
			
			echo count($fetch3) . '<br />';
			if(count($fetch3) > 2)
			{
				//undo 
				$querry = '	UPDATE position
						SET x="'.$donne['x']['depart'].'", y="'.$donne['y']['depart'].'"
						where x="'.$donne['x']['aller'].'" AND y="'.$donne['y']['aller'].'" AND id = "'. $donne['perso']  .'"';
				mysql_query($querry);
				//verification que la case de retour est bien vide
				$ok = 'continue';
				$x_temp = $donne['x']['depart'];
				$y_temp = $donne['y']['depart'];
				while($ok != 'ok')
				{
					$querry = 'select id_joueur from position where x="'.$x_temp.'" AND y="'.$y_temp .'"';
					$result = mysql_query($querry);
					while($fetch4[] = mysql_fetch_assoc($result)); 
					if(count($fetch4) != 1)
					{
						//on change les coordonnes
						if( $x_temp > $y_temp + 2)
							$x_temp += 1;
						else
							$y_temp += 1;
 					}
					else
						$ok = 'ok';
				}
					$querry = '	UPDATE position
						SET x="'.$x_temp.'", y="'.$y_temp.'"
						where x="'.$donne['x']['aller'].'" AND y="'.$donne['y']['aller'].'" AND id = "'. $donne['perso']  .'"';
				mysql_query($querry);
					return $return = '1 Un fait du hasard c\'est produit , vous avez ete bouscule et desoriente. Vous voila a un autre endroit'; 
			}
		return $return = '3 le deplacement c\'est correctement deroule';
	}
	
	######################################################################################################################################
	######################################################################################################################################
	######################################################################################################################################
	######################################################################################################################################
	
	
	public function attaque($donne_A, $donne_D)
	{
		## On recoit l'id du personnage attaquant (A),l'ID de l'arme equiper, l'id du personnage defenseur (B),l'ID de l'arme equiper ##
		// 1 verification de la validite de  l'attaque
			//a verification position 
				//selection range attaque
				$querry = 'SELECT * FROM arme WHERE id = "'. $donne_A['id_arme'] .'"';
				//execution
				// selection positon joueur A et D
				$querry = 'SELECT x,y,id FROM position WHERE id = "'.$donne_A['id_joueur'] .'" AND id="'. $donne_D['id_joueur'] .'"';
				//exectution
				//verification
				if( abs($position[0]['x'] - $position[1]['x']) > $info_arme['range'] && abs($position[0]['y'] - $position[1]['y']) > $info_arme['range'] )
					return $return = '2 Attaque impossible : position des personnages incorrecte : attaquant'. $donne_A['id_joueur'] .'';
				
		// 2 attaque
		// a score attaquand
		$querry = 'SELECT attaque,degat,pv FROM perso WHERE id = "'. $donne_A['id_joueur'] .'"';	
			// execution
		$score_A = $A['attaque'] * $de_pour_attaque;
		//b score defenseur
		$querry = 'SELECT defense,degat,pv FROM perso WHERE id = "'. $donne_D['id_joueur'] .'"';	
			// execution
		$score_D = $D['attaque'] * $de_pour_attaque -  $D['malus'];
		
		//calcl bouns survie
		if($A['pv'] < $A['pv_max'] / 10)
			$score_A = $score_A + ( $score_A  * (mt_rand(1,10) / 100));
		if($D['pv'] < $D['pv_max'] / 10)
			$score_D = $score_D + ( $score_D  * (mt_rand(1,10) / 100));	
		if($score_A > $score_D)
		{
			//attaque reussi
				//a calcul degats
				$degats = $A['degat'] + $arme['degat'];
				$D['pv'] = $D['pv'] - $degats;
				if($D['pv'] <= O)
				{
					$D['pv'] = 'O';
				}
				$chance = mt_rand(0,100);
				$malus_plus = Get_malus_toucher($chance,$score_A,$score_D);
				//##############################
				//Update
				//##############################
					//element renvoyer
						//etat de l'attaque
							$return['etat'] = 'touche';
						//score attaquand
							$return['score_A'] = $score_A;
						//score defenseur
							$return['score_D'] = $score_D;
						//degats
							$return['degat'] = $degats ;
						//pv victime
							$return['pv_D'] = $D['pv'];
						//le malus suplementaire
							$return['malus'] = $malus_plus;
							
		}
		else
		{
			//attaque rate
			// si chance
			$chance = mt_rand(0,100);
			//fonction qui clacule a quel poucentage ont subit le maulus
			$malus_plus = Get_malus_esquiver($chance,$score_A,$score_D);
				//element renvoyer
						//etat de l'attaque
							$return['etat'] = 'esquive';
						//score attaquand
							$return['score_A'] = $score_A;
						//score defenseur
							$return['score_D'] = $score_D;
						//pv victime
							$return['pv_D'] = $D['pv'];
						//le malus suplementaire
							$return['malus'] = $malus_plus;
			
		
			//$defenseur = new Personne($donne_D['id_joueur']);
				//$attaquant = new Personne($donne_A['id_joueur']);
				
				//defenseur->mise_a_jour_attaque($defenseur,$attaquant,'rate');
				
		}
		
		return $return;
		// Mise a jour
	}
	
	
	
	
	
	
	/*
	public function equipement($donne)
	{
		## On recoit l'id du personnage, l'id de l'equip a equipe##
		// 1 on verfie que l'objet ets bien dans l'inventaire et uniquement dans celui du joueur;
		$querry = '' . $donne['id_pers'] . . $donne['id_obj'] ;
		//SQL
		if(count($recup) != 1)
			return $return = '2 objet non present dans l\'inventaire ou  dupliquer';
		//2 on verifie que le jouer peut l'equiper
			// a on sort les conditions pour equipement
			$querry = '' . $donne['obj'];
			$tab = explode(;,$recup['condition']);
			// b on verifie si le joeur verifie bien les conditions
			$querry = 'id';
			foreach($tab as $key => $value)
			{	
				'AND ' . $value;
			}
			//execution
			
			// si le jouer dans la liste
			if($donne_a['pers'] !in_array($recup))
				return $return = '1 Vous ne pouvez equipe cet objet';
		// 3 verification que le joueur a bien un emplacement de vide
			//a on recup l'emplcement de l'objet
			$emplacement = $recup['emplacement'];
			//on regarde si cette emplcament est chez le perosnnage
			$querry = '' . $emplacement ;
			if($recup_emp['emplcement'] != '')
				return $return = '1 Vous ne pouvez equiper 2 fois le meme objet';
			else
				$a ="b";
				//equiepement de l'objet	
			
			
			a voir avec cycy
	} 	
	*/
}

?>