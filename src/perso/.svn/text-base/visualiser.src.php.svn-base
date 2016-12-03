<?php
require_once('./includes/fonctions_guilde.php');
require_once('./includes/fonctions_class.php');
if(isset($_REQUEST['idUser']))
{

	$u = new joueur_data($_REQUEST['idUser']);
	echo '<img src="'.$u->get_avatar().'" alt="[ Avatar ]" height="100" style="float:left;"/>';
	echo '<h1>&nbsp;&nbsp;'.$u->get_nom().'</h1><br />';
	echo '&nbsp;&nbsp;'.$u->get_race().' '.$u->get_classe().' de niveaux '.$u->get_rang().'<br />';
	if($u->get_guilde_name() != "")
	{
		echo "&nbsp;&nbsp;<".$u->get_guilde_name().">";
	}
	
	echo '<div class="clear"></div>';
}

?>
