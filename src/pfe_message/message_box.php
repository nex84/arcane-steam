<?php
//ouverture de la session
session_start();


require("../../includes/functions.inc.php");
$anti_path = return_anti_path();
require_once($anti_path . "class/joueur/joueur_data.class.php");
require_once($anti_path . "/includes/request.sql.php");
require_once($anti_path . "/includes/constant.inc.php");
require_once($anti_path . "/class/database/database_connector.class.php");
require_once("./fonction/function_pack1.php");

//inclusion
require_once("./css/message_box.css");
require_once("./class/box.class.php");
require_once("./class/message.class.php");
require_once("./ouverture_sgbd.php");

$u = new joueur_data($_SESSION['id']); 
$tab['id'] = $_SESSION['id'];
$tab['nom'] = $u->get_login();
//corps du programme tout ca passer en fonctions ua fur et a mesure

//1 construction de la page : 
	// a recuperation des boxs
	$liste_box = box::dispatch_box($tab,get_liste);
	// b recuperation nombre message non lu boite normal
	$box_n_non_lu = box::dispatch_box($tab,get_non_lu);

if($_GET['box'] == "")
{
	$_GET['box']  = "g";
}
	//calcul des CSS pour les boites generiques
	//CSS pour la boite genral
	if($_GET['box'] == "g" )
		$css_g = "ouver_2";
	else
	{
		if($box_n_non_lu['nb'] != 0)
			$css_g =  "ouver_3";
		else
			$css_g = "ouver";
	}
	
	//CSS pour la boite archivage
	if($_GET['box'] == "a" )
		$css_a = "ouver_2";
	else
		$css_a = "ouver";

?>

<html>

<head>
</head>

<body>
	
<div id="div_1">
<!-- les onglets des box !  -->
<?php 

?>
<a href="<?php echo $PHP_SELF?>?box=g" class="<?php echo $css_g?>"><div > Boite général (<?php echo $box_n_non_lu['nb']?>) </div></a>

<a href="<?php echo $PHP_SELF?>?box=a" class="<?php echo $css_a?>"><div> message d'archivage </div></a>

<?php 

//boucle des boxs partucliere

for($i=0; $i < count($liste_box) - 1;$i++)
{
	if($_GET['box'] == $liste_box[$i]['num'])
		$css = "ouver_2";
	else
	{
		if($liste_box[$i]['message_non_lu'] != NULL)
			$css =  "ouver_3";
		else
		{
			$css = "ouver";
			$liste_box[$i]['message_non_lu'] = 0;
		}
	}
	
	echo '<a href="'.$PHP_SELF.'?box='.$liste_box[$i]['num'].'" class="'.$css.'"><div>  '. $liste_box[$i]['name'] .' ('. $liste_box[$i]['message_non_lu'] .')</div></a>';
}
?>
<div class="conteneur_message">
<iframe width="800" height="450" scrolling="yes" frameborder="0" src="./liste_message.php?box=<?php echo $_GET['box'] ?>"></iframe>
	</div>
<div id="menu_message">
	<a href="./message_form.php" class="item_menu"><div> Ecrire un message </div></a>	
	<a href="#" class="item_menu"><div> Administration de ma messagerie</div></a>
	<a href="./admin_box.php" class="item_menu"><div>Administration de mes box</div></a>
	<a href="#" class="item_menu" onclick="javascript:window.close();"><div> Fermer </div></a>

</div>	

</div>



</body> 
</htl>