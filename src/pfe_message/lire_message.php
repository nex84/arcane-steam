<?php

session_start();
// fichier inclu
require_once("./css/message.css");
require_once("./class/box.class.php");
require_once("./class/message.class.php");
require_once("./ouverture_sgbd.php");
require("../../includes/functions.inc.php");
require_once("./fonction/function_pack1.php");
$anti_path = return_anti_path();
require($anti_path . "/includes/request.sql.php");
require($anti_path . "/includes/constant.inc.php");
require_once($anti_path . "/class/database/database_connector.class.php");
$u = new joueur_data($_SESSION['id']); 
$tab['id'] = $_SESSION['id'];
$tab['nom'] = $u->get_login();


//recuperation du get et envoie de la fonction
if($_GET['message'] == "" || ereg("[1-9]",$_GET['message']) == FALSE)
{
	echo 'parametre de message modifier';
	exit;
}
else
{
	$tab['id_message'] = $_GET['message'];
	
	// le message passe en lu !
	message::dispatch_message($tab,'set_lu');
	//recuperation du message
	$message = message::dispatch_message($tab,'get_message');
	$_SESSION['corps_message'] = $message->get_corps();
	//gestion des CSS necessaire
	if($message->get_liste_destinataire() == "")
		$css_l_d = "envoyer_liste_inactif";
	else
		$css_l_d = "envoyer_liste";
}
?>

<div id="encadrer">
	<div class="titre"><h3> <?php echo $message->get_titre() ?>  </h3></div>
	<div id="envoyer_conteneur">	
		<div class="envoyer_menu"><h4> Ce message à été écrit par : </h4></div>
		<div class="envoyer_liste"> <?php echo $message->get_emetteur() ?> </div>	
		<div class="<?php echo $css_l_d ?>"> Voir les personnes en copie </div>
		<div class="envoyer_menu"> Date d'envoie :<br /> <?php echo $message->get_mdate() ?> </div>
	</div>
	<div id="message"> 
		<iframe width="590px" height="480px" scrolling="yes" frameborder="0" src="./corps_message.php">
		</iframe>	
	</div>
	<div id="barre_action">
		<div class="barre_item"> Repondre   </div>
		<div class="barre_item"> Transferer </div>
		<div class="barre_item"> 
			<select name="archive_select">
			<option class="first" value=""> Archivage ... </option>
			<option value="0"> archive simple </option>
		<?php 
			//remplissage du select 
			$liste_box = box::dispatch_box($tab,get_liste);
			for($j=0; $j < count($liste_box) - 1;$j++)
			{
				echo '<option value="'. $liste_box[$j]['id'] .'"> '. $liste_box[$j]['name'] .' </option>';
			}
		?>
		</select> 
		</div>
		<div class="barre_item"> Effacer  </div>
		<div class="barre_item"> Fermer </div>

	</div>
	
	
	
	
</div>
