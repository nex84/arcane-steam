<?
session_start();
require_once('../../includes/functions.inc.php');
require_once('../../includes/constant.inc.php');
require_once('../../includes/fonctions_guilde.php');
require_once('../../includes/fonctions_class.php');
require_once('../../includes/request.sql.php');

$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="./style.css" rel="stylesheet" media="all" />

<!--  Prototype Window Class Part -->
<script type="text/javascript" src="../../js/prototype.js"> </script> 
<script type="text/javascript" src="../../js/effects.js"> </script>
<script type="text/javascript" src="../../js/window.js"> </script>

<script type="text/javascript" src="../../js/window_effects.js"> </script>
<script type="text/javascript" src="../../js/debug.js"> </script>
<script type="text/javascript" src="../../js/utility.js"> </script>
<script type="text/javascript" src="../../js/tinytip.js"> </script>
<script language="javascript">
	function ref(){
	window.parent.location.reload();
	}
	
	function hideAllMeTab(){
		document.getElementById('meTab_caracteristique').style.display = "none";
		document.getElementById('meTab_equipement').style.display = "none";
		document.getElementById('meTab_mail').style.display = "none";
	}
	
	function showMeTab(id)
	{
		hideAllMeTab();
		document.getElementById(id).style.display = "block";
	}
</script>

<link href="../../css/default.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/spread.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>

<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/debug.css" rel="stylesheet" type="text/css" >	 </link>


<title>~Arcane-steam - Les arcanes de la vapeur</title>
</head>

<body id="userMain">

<?
$u = new joueur_data($_SESSION['id']);
/*



*/

?>

<div id="user">
<img src="<?php echo $u->get_avatar(); ?>" alt="[ Avatar ]" height="100" style="float:left;"/>
<h1>&nbsp;&nbsp;<?php echo $u->get_nom(); ?></h1><br />
&nbsp;&nbsp;<?php echo $u->get_race(); ?> <?php echo $u->get_classe(); ?> de niveaux <?php echo $u->get_rang(); ?><br />
<?php if($u->get_guilde_name() != "")
{
	echo "&nbsp;&nbsp;&lt;".$u->get_guilde_name()."&gt;";
}
 ?>
<div class="clear"></div>
<h2>Mes Options</h2>
<a href="./caracteristique.php" class="lnk_mini"><img src="images/Caracteristique.png" alt="Caract" />Mes caractéristiques</a>
<a href="../perso/affiche_inventaire.php" class="lnk_mini"><img src="images/Stuff.png" alt="stuff" />Mon équipement</a>
<a href="#" class="lnk_mini" onclick="showMeTab('meTab_mail');"><img src="images/unread.png" alt="messagerie" />Ma messagerie</a>
<br />
<div id="meTab_caracteristique" style="display:none"></div>
<div id="meTab_equipement" style="display:none"></div>
<div id="meTab_mail" style="display:none">
<?php 
require_once($anti_path."src/Messagerie/Inbox.src.php");
?>
</div>
<h2>Mon compte</h2>
<a href="../perso/admin_change_mail.php" class="lnk_mini"><img src="images/changeMail.png" alt="Email" />Changer mon Email</a>
<a href="../perso/admin_change_passwd.php" class="lnk_mini"><img src="images/passzd.png" alt="password" />Changer mon mot de passe</a><br />
<br />

<br /><br /><br /><a href="#" class="lnk_mini" onclick="ref();"><img src="images/b_drop.png" alt="fermer" />Fermer la fenêtre </a><br />
<br />
</div>
</body>
</html>

