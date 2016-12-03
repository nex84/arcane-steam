<?php

function lance_gain_exp_attaque($tab_joueur,$tab_adversaire)
{	
	//####################################//
	// Donnée recupéré
	//####################################//
	// id_attaquant, nb_attaque attaquand, rang attaquand, class attaquant
	// rang_defenseur, class defenseur , ort ou pas 
		
	//base d'exp gagnable
	$exp_base = 10;
	$diviseur_rang = 2;
	//formule
	$exp_base_gagner_frappe = ($exp_base / $tab_joueur['nb_attaque']) - (( $tab_joueur['rang'] - $tab_adversaire['rang'])/ $diviseur_rang);
	
	// modificateur lier a la class
	$modif_exp = get_modif_exp_class($tab_joueur['class']);
	$exp_base_gagner_frappe = $exp_base_gagner_frappe + $modif_exp;
	
	//modificteur lier a la mort
	if($tab_adversaire['mort'] == 1)
	{
		$plus =  5 - ($tab_joueur['rang'] - $tab_adversaire['rang']);
		if($plus < 0 )
			$plus = 0;
		$exp_base_gagner_frappe = $exp_base_gagner_frappe + $plus; 
	}
	$exp_base_gagner_frappe = floor($exp_base_gagner_frappe );
	// test pour exp tjs positive
	if( $exp_base_gagner_frappe < 1)
		$exp_base_gagner_frappe = 1;
	// Mise a jour
	maj_exp($tab_joueur['id'], $exp_base_gagner_frappe);
	maj_exp_class($tab_joueur['id'], $exp_base_gagner_frappe);
	return($exp_base_gagner_frappe);
}

function lance_gain_esquive($tab_joueur)
{	
	//####################################//
	// DOnnée recupéré
	//####################################//
	// id_joueur 
		
	//base d'exp gagnable
		$exp_base_esquive = 1;
	// Mise a jour
	maj_exp($tab_joueur['id'], $exp_base_esquive);
	maj_exp_class($tab_joueur['id'], $exp_base_esquive);
}

function perte_exp_mort($tab_joueur)
{	
	//####################################//
	// DOnnée recupéré
	//####################################//
	// id_joueur,rang, xp_invest 
		
	//base d'exp gagnable
	$pourcentage_xp_perte = 10;
	//formule de perte
	$perte = $tab_joueur['xp_invest'] / 10;
	// Mise a jour
	maj_exp_mort($tab_joueur['id'], $perte);
}


function maj_exp($joueur_id,$nb_exp)
{			
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET xp = xp + "'. $nb_exp .'", xp_invest = xp_invest + "'. $nb_exp .'" WHERE id_user = "'. $joueur_id .'"';
	$db->send_sql($querry);
}

function maj_exp_mort($joueur_id,$nb_exp)
{			
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET xp_invest = xp_invest - "'. nb_exp .'" WHERE id_user = "'. $joueur_id .'"';
	$db->send_sql($querry);
}

function maj_exp_class($joueur_id,$nb_exp)
{			
	$db = new database_connector();
	$querry = 'UPDATE users_caracts SET xp_class = xp_class + '. $nb_exp .' WHERE id_user = "'. $joueur_id .'"';
	$db->send_sql($querry);
}

function gain_xp_sort($tab_att,$mort,$score,$def_lvl)
{
	//base d'exp gagnable
	$exp_base = 2;
	//formule
		//base de gaine xp
	$exp_base_gagner_frappe = $exp_base + round($score/9);
		//calcul diff de rang
	$moins_rang = $tab_att['lvl'] -  $def_lvl;
		//verif que pas de modif si rang att plsu faible
	if($moins_rang < 0)
		$moins_rang = 0;
		//retrait de la diff de rang
	$exp_base_gagner_frappe -= $moins_rang;
	
	// modificateur lier a la class
	$modif_exp = get_modif_exp_class($tab_att['class']);
	$exp_base_gagner_frappe = $exp_base_gagner_frappe + $modif_exp;
	
	//modificteur lier a la mort
	if($mort == 1)
	{
		$plus =  4;
		$exp_base_gagner_frappe = $exp_base_gagner_frappe + $plus; 
	}
	$exp_base_gagner_frappe = floor($exp_base_gagner_frappe);
	// test pour exp tjs positive
	if( $exp_base_gagner_frappe < 1)
		$exp_base_gagner_frappe = 1;
	// Mise a jour
	maj_exp($tab_att['id_att'], $exp_base_gagner_frappe);
	maj_exp_class($tab_att['id_att'], $exp_base_gagner_frappe);
	return($exp_base_gagner_frappe);
}

function gain_xp_sort_non_attaque($tab_att,$mort,$score,$cible_lvl)
{
	//base d'exp gagnable
	$exp_base = 2;
	//formule
		//base de gaine xp
		//calcul diff de rang
		//verif que pas de modif si rang att plsu faible
		//retrait de la diff de rang
	// modificateur lier a la class
	$modif_exp = get_modif_exp_class($tab_joueur['class']);
	$exp_base_gagner_frappe = $exp_base_gagner_frappe + $modif_exp;

	$exp_base_gagner_frappe = floor($exp_base_gagner_frappe);
	// test pour exp tjs positive
	if( $exp_base_gagner_frappe < 1)
		$exp_base_gagner_frappe = 1;
	// Mise a jour
	maj_exp($tab_att['id_att'], $exp_base_gagner_frappe);
	maj_exp_class($tab_att['id_att'], $exp_base_gagner_frappe);
	return($exp_base_gagner_frappe);
}


?>