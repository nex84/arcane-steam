<?php
//ouverture de la session
session_start();
//inclusion
require_once("./css/message_form.css");
require_once("./class/box.class.php");
require_once("./class/message.class.php");
require_once("./ouverture_sgbd.php");
require_once("./fonction/function_pack1.php");
require("../../includes/functions.inc.php");
$anti_path = return_anti_path();
require($anti_path . "class/joueur/joueur_data.class.php");
require($anti_path . "/includes/request.sql.php");
require($anti_path . "/includes/constant.inc.php");
require($anti_path . "/class/database/database_connector.class.php");
require_once("./fonction/function_pack1.php");

$u = new joueur_data($_SESSION['id']); 
echo 'ici';

//recuperation du form
if($_POST['fonction'] == "enregistrer")
{
	$_POST['emetteur'] = $_SESSION['id'];
	$_POST['id'] = $_SESSION['id'];
	$_POST['nom'] = $u->get_login();
	message::dispatch_message($_POST,enregistre);
	unset($_GET);
	echo 'vos message ont été envoyer  . <br /> <a href="./message_box.php"> revenir a la messagerie</a> . <br /><a href="message_form.php"> ecrire un nouveau message </a> <br /> fermer ';
	//include("./message_box.php");
}
else
{
//le formulaire

?>


<form action="<?php echo $PHP_SELF?>" method="post"	>
<input type="hidden" name="fonction" value="enregistrer">
<div id="encadrer">
	<div class="liste_destinataire" > Destinataire :
		<input type="text" name="destinataire"  />
	</div><<a href="./message_box.php"><div> fermer </div></a>
	<div class="liste_destinataire">  Destinataire(s) : 
		<textarea cols="55" name="liste_destinataire"  ></textarea>
	</div>
	<div class="objet" > Objet du message :
		<input type="text" name="titre"  />
	</div>
	<div class="corps"><textarea cols="84" rows="25" name="corps"  ></textarea></div>
	<div class="b_envoyer"> <input type="submit" name="env" value="Envoyer le message"></div>


</div>
</form>
<?php } ?>