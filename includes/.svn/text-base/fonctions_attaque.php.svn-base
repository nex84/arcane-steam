<?php


function quick_attaque($tab_att,$tab_def)
{
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	// donne recuperer
	// attaquant : attaque, id, bonus_attaque, lvl, nb_attaque,degats,degats_bonus, class_att
	//defenseur : defense, id, bonus_defense, malus_def, lvl, hp,class_def, type
	//test si il ets attaquable
	//init 
	$return['can'] = 1;
	
	if(!isset($tab_def['type']))
	{
		if(isAttaquable($tab_att['id'], $tab_def['id']) == false)
			return ($return['can'] = 0);
		else
			$return['can'] = 1;
	}
	else
	{
		if(isAttaquableMonster($tab_att['id'], $tab_def['id']) == false)
		{
			return ($return['can'] = 0);
		}
		else
			$return['can'] = 1;
	}
	

	
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	//  Calcul des scores                            //
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	
		//calcul score attaque
	$att_somme = 0;
	for($i = 0; $i < $tab_att['attaque']; $i++)
	{
		$att_somme += mt_rand(1,6);
	}
		//ajout des bonus attaque
	$att_somme += $tab_att['bonus_attaque'];
		
		//calcul defense
	$def_somme = 0;
	for($i = 0; $i < $tab_def['defense']; $i++)
	{
		$def_somme += mt_rand(1,6);
	}
		//ajout des bonus denfense
	$def_somme += ($tab_def['bonus_def'] - $tab_def['malus_def']);
	
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	//  Calcul du combat                             //
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	
	$score = $att_somme - $def_somme;

	if($score > 0)
		$suite = "touche";
	else
		$suite = "esquive";
		
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	//  mise a jour du combat                       //
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
	if($suite == "touche")
	{
		//caclul de degats
		$degats = 0;
		for($i = 0; $i < $tab_att['degats']; $i++)
		{
			$degats += mt_rand(1,4);
		}
			//ajout des bonus attaque
		$degats += $tab_att['degats_bonus'];
		//perte point de vie, bouns def
		if($tab_def['type'] == 'monstre')
		{
			$m = new pnj($tab_def['id'],'monster');
			$tab_return = $m->mise_a_jour_pnj_touche($score,$degats,$att_somme,$def_somme,$tab_def['id']);
			//gain exp
				//creation des tableaux
				
				$tab_joueur['id'] = $tab_att['id'];
				$tab_joueur['nb_attaque'] = $tab_att['nb_attaque'];
				$tab_joueur['rang'] = $tab_att['lvl'];
				$tab_adversaire['mort'] = $tab_return['mort'];
				$tab_adversaire['rang'] = $tab_def['lvl'];
				$tab_adversaire['class'] = $tab_def['class_def'];
				$tab_joueur['class'] = $tab_att['class_att'];
				//fonction  de calcul d'exp
			$exp_gagne = lance_gain_exp_attaque($tab_joueur,$tab_adversaire);
				//mise a jour du tableau de renvoie
			$tab_return['exp'] = $exp_gagne;
			$tab_return['degat'] = $degats;
			$tab_return['reussi'] = 1;
			$tab_return['score_att'] = $att_somme;
			$tab_return['score_def'] = $def_somme;
			$tab_return['can'] = 1;
			return $tab_return;		
		}
		else
		{
			$tab_return = mise_a_jour_defenseur_touche($score,$degats,$att_somme,$def_somme,$tab_def);
			//gain exp
				//creation des tableaux
				$tab_joueur['id'] = $tab_att['id'];
				$tab_joueur['nb_attaque'] = $tab_att['nb_attaque'];
				$tab_joueur['rang'] = $tab_att['lvl'];
				$tab_adversaire['mort'] = $tab_return['mort'];
				$tab_adversaire['rang'] = $tab_def['lvl'];
				$tab_adversaire['class'] = $tab_def['class_def'];
				$tab_joueur['class'] = $tab_att['class_att'];
				//fonction  de calcul d'exp
			$exp_gagne = lance_gain_exp_attaque($tab_joueur,$tab_adversaire);
				//mise a jour du tableau de renvoie
			$tab_return['exp'] = $exp_gagne;
			$tab_return['degat'] = $degats;
			$tab_return['reussi'] = 1;
			$tab_return['score_att'] = $att_somme;
			$tab_return['score_def'] = $def_somme;
			$tab_return['can'] = 1;
			return $tab_return;		
		}
	}
	if($suite == "esquive")
	{
		if($tab_def['type'] == 'monstre')
		{
			$degats = 0;
			$m = new pnj($tab_def['id'],'monster');
			//perte point de vie, bouns def
			$tab_return = $m->mise_a_jour_monstre_esquive($att_somme,$def_somme,$tab_def);
			//gain exp
				//fonction  de calcul d'exp
				//mise a jour du tableau de renvoie
			$tab_return['score_att'] = $att_somme;
			$tab_return['score_def'] = $def_somme;
			$tab_return['exp'] = 0;
			$tab_return['degat'] = 0;
			$tab_return['reussi'] = 0;
			$tab_return['mort'] = 0;
			$tab_return['critique'] = 0;
			$tab_return['can'] = 1;
			return $tab_return;		
		}
		else
		{
			$degats = 0;
			//perte point de vie, bouns def
			$tab_return = mise_a_jour_defenseur_esquive($att_somme,$def_somme,$tab_def);
			//gain exp
				//fonction  de calcul d'exp
			if($tab_return['critique'] == 1 || $tab_return['gain'] == 1)
			{
				//creation des tableaux
				$tab_joueur['id'] = $tab_def['id'];
				lance_gain_esquive($tab_joueur);
			}
				//mise a jour du tableau de renvoie
			$tab_return['score_att'] = $att_somme;
			$tab_return['score_def'] = $def_somme;
			$tab_return['exp'] = 0;
			$tab_return['degat'] = 0;
			$tab_return['reussi'] = 0;
			$tab_return['mort'] = 0;
			$tab_return['critique'] = 0;
			$tab_return['can'] = 1;
			return $tab_return;		
		}
	}
	
}

function mise_a_jour_defenseur_touche($score,$degats_c,$att_somme,$def_somme,$tab_def)
{
	//intit
	$u = new joueur_data($tab_def['id']);
	$critique = 0;
	$mort = 0;
	//calcul point de vie restant
	$hp = $tab_def['hp'] - $degats_c;
	if($att_somme > ($def_somme * 2) || $def_somme < 0)
	{
		//prise critique malus
			$nb_malus = mt_rand(2,3);
			$u->prise_malus($tab_def['id'],$nb_malus);
			$hp = $hp - ($degats_c/2);
			$degats_c += ($degats_c/2); 
			$critique = 1;
	}
	//XXXXXXXXXXXXXXXXXXXXXXX
	//calcul des malus en focntions de point de vie
	//XXXXXXXXXXXXXXXXXXXXXXX
	if($hp < $tab_def['hp_base'] / 10)
	{	
		//prise beaucoup malus
		if($chance < 80)
		{
			$nb_malus = mt_rand(1,2);
			$u->prise_malus($tab_def['id'],$nb_malus);
		}
	}
	else if($hp < $tab_def['hp_base'] / 4)
	{
		//prise faible malus
		if($chance < 50)
		{
			$nb_malus = mt_rand(1,2);
			$u->prise_malus($tab_def['id'],$nb_malus);
		}
	}
	else if($hp < $tab_def['hp_base'] / 2)
	{
		//prise moyen malus
		if($chance < 30)
		{
			$nb_malus = mt_rand(1,2);
			$u->prise_malus($tab_def['id'],$nb_malus);
		}
	}
	else if($hp < ($tab_def['hp_base'] * 9) / 10)
	{
		//prise difficule malus
		if($chance < 10)
		{
			$nb_malus = mt_rand(1,3);
			$u->prise_malus($tab_def['id'],$nb_malus);
		}
	}
	
	//XXXXXXXXXXXXXXXXXXXXXXX
	//calcul de la perte de point de vie
	//XXXXXXXXXXXXXXXXXXXXXXX
	if($hp <= 0)
	{ 
		//mort
		$mort = 1;
		$u->mise_a_mort();
	}
	else
	{
		//vivant
		$u->mise_a_jour_pv($tab_def['id'],$hp);
	}
	//XXXXXXXXXXXXXXXXXXX
	//enregistrement des valeur de retour
	//XXXXXXXXXXXXXXXXXX
	$tab_return['mort'] = $mort;
	$tab_return['critique'] = $critique;
	$tab_return['degat'] = $degats_c;
	
	return $tab_return;
}

function mise_a_jour_defenseur_esquive($att_somme,$def_somme,$tab_def)
{
	//inti
	$u = new joueur_data($tab_def['id']);
	$tab_return['critique'] = 0;
	$tab_return['gain'] = 0;
	$chance = mt_rand(1,100);
	//crtitique ?
	if($def_somme > $att_somme * 2)
		$tab_return['critique'] = 1;
	//gain ?
	if($chance < 6)
		$tab_return['gain'] = 1;
	
	if($chance < 51)
	{	
		$nb_malus = mt_rand(0,2);
		$u->prise_malus($tab_def['id'],$nb_malus);
	}
		
	return $tab_return;
}
?>