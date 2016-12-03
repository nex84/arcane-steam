<?php

session_start();
require_once("./css/message_box.css");
require_once("./class/box.class.php");
require_once("./class/message.class.php");
require_once("./ouverture_sgbd.php");
require_once("./fonction/function_pack1.php");
require("../../includes/functions.inc.php");
$anti_path = return_anti_path();
require($anti_path . "/includes/request.sql.php");
require($anti_path . "/includes/constant.inc.php");
require_once($anti_path . "/class/database/database_connector.class.php");

$u = new joueur_data($_SESSION['id']); 
$tab['id'] = $_SESSION['id'];
$tab['nom'] = $u->get_login();
//recuperation des parametre passer en get
if($_GET['box'] == "g")
{
	$liste_message = message::dispatch_message($tab,get_liste_g);
}
else if($_GET['box'] == "a")
{
	$liste_message = message::dispatch_message($tab,get_liste_a);
}
else
{
	$tab['box'] = $_GET['box'];
	$liste_message = message::dispatch_message($tab,get_liste);
}

for($i=0; $i < count($liste_message) - 1; $i++)
{

	//recuperation du nom de l'emeteur
			//$emetteur = get_emetteur($liste_message[$i]['emetteur']);
	//on positionne le CSS
	if($liste_message[$i]['flag_lu'] == 0)
	{
		$css_message = "message_lu_non";
		$css_expediteur = "expediteur_lu_non";
		$css_titre = "titre_lu_non";
		$css_repondre = "repondre_lu_non";
		$css_trans = "transferé_lu";
		$css_suprimer = "suprimer_lu";
	}
	else
	{
		if($liste_message[$i]['flag_repondu'] == 0)
		{
			$css_message = "message_lu";
			$css_expediteur = "expediteur_lu";
			$css_titre = "titre_lu";
			$css_repondre = "repondre_non";
			$css_trans = "transferé_lu";
			$css_suprimer = "suprimer_lu";
		}
		else
		{
			$css_message = "message_lu";
			$css_expediteur = "expediteur_lu";
			$css_titre = "titre_lu";
			$css_repondre = "repondre_lu";
			$css_trans = "transferé_lu";
			$css_suprimer = "suprimer_lu";
		}
	}
	if(strlen($liste_message[$i]['titre']) > 40 )
	{
		$liste_message[$i]['titre'] = substr($liste_message[$i]['titre'],0,37);
		$liste_message[$i]['titre'] .= '...';
	}
	
echo '
<div class="'.$css_message .'"> 
	<a href="#" class="'. $css_expediteur .'"><div> '.$emetteur .'</div></a>
	<a target="blank" href="./lire_message.php?message='. $liste_message[$i]['id'] .'&box='. $liste_message[$i]['flag_box'].'" class="'. $css_titre .'"><div>'. $liste_message[$i]['titre'] .'</div></a>
	<a href="#" class="'.$css_repondre .'" >	<div> Rep </div></a>
	<a href="#" class="'. $css_trans .'">	<div> Trans</div></a>
	<div class="select"> 
		<select name="archive_select">
			<option class="first" value=""> Archivage ... </option>
			<option value="0"> archive simple </option>
		';
			//remplissage du select 
			$liste_box = box::dispatch_box($tab,get_liste);
			for($j=0; $j < count($liste_box) - 1;$j++)
			{
				echo '<option value="'. $liste_box[$j]['id'] .'"> '. $liste_box[$j]['name'] .' </option>';
			}
		echo '
		</select> 
	</div>
	<a href="#" class="'. $css_suprimer .'"><div> Sup </div></a>
</div>';

}
 ?>	