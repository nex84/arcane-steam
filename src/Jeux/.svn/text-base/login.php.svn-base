<?
session_start();
ob_start();
//$_SESSION['affpub'] = 1;
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');

//__autoload("joueur_data");
$error = "";
if (isset($_POST['sub']))
{
	if (isset($_POST['login']) && $_POST['login'] !="")
	{
		if (isset($_POST['password']) && $_POST['password'] != "")
		{
			$login = addslashes($_POST['login']);
			$password = md5(addslashes($_POST['password']));
			
			$c = new database_connector(true);
			$data = $c->send_sql("SELECT * FROM  users WHERE users.actif = 1 AND login = '".$login."' and passwd='".$password."'");
			if ($data['count'] == 1)
			{
					//if (chk_crypt($_POST['code'])) 
					//{
						$_SESSION['idGuild'] = $data[1]['guilde'];
						$_SESSION['login'] = $data[1]['login'];
						$_SESSION['id'] = $data[1]['id'];
						header("Location:jeux.php");
					//}
					//else
						//$error = "Code de securiter invalide";				
			}
			else
				$error = "Login / Mot de passe incorrect";
		}
		else
		{
			$error = "Tout les champs sont obligatoires.";
		}
	}
	else
	{
		$error = "Tout les champs sont obligatoires.";
	}
}
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

<link href="../../css/default.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/spread.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>

<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
<link href="../../css/debug.css" rel="stylesheet" type="text/css" >	 </link>


<title>~Arcane-Steam - login</title>
</head>

<script language="javascript" type="text/javascript">
function inscription()
{
	var win = new Window({className: "dialog", title: "Arcane-Steam // Inscription", top:70, left:100, width:800, height:600, url: "../perso/admin_inscription.src.php", showEffectOptions: {duration:1.5}}) 
	win.show(); 
}
function reset_passwd()
{
	var win = new Window({className: "dialog", title: "Arcane-Steam // R&eacute;initialisation du mot de passe", top:70, left:100, width:800, height:600, url: "../perso/admin_reset_passwd.src.php", showEffectOptions: {duration:1.5}}) 
	win.show(); 
}
</script>

<body id="loginMain">

<div id="containerLogin">

<div id="mainLogin">
<img src="../../images/autres/logo.jpg" width="500" />
<div id="loginWelcom" style="background-position:bottom">
	<span class="titlenew">Bienvenue !</span>
	<p>
Vous êtes sur le point d'entrer dans l'univers d'Arcanis.<br />
Pour cela vous devez vous identifier afin de retrouver votre héros.

	</p>
	<span class="titlenew">Derni&egrave;re news:</span>
	<p>
		<?
			$c = new database_connector();
			$data = $c->send_sql("SELECT date, auteur, titre, corps FROM  news WHERE isPublish=1 ORDER BY id DESC LIMIT 1");
			if ($data['count'] == 1)
			{
				echo '<b>'.$data[1]['titre'].'</b><br />';
				echo '<i> le '.$data[1]['date'].' - '.$data[1]['auteur'].'</i><br />';
				echo $data[1]['corps'];
			}
		?>
	</p>
	<hr />
	<span class="titlenew">Vous n'avez pas encore de compte ?</span>
	<p>
		Cela ne prendra que quelques instants en suivant <a href="javascript:inscription();">ce lien</a>	</p>
	<hr />
	<span class="titlenew">Vous avez perdu votre mot de passe ?</span>
	<p>
	  Reg&eacute;n&eacute;rez-en un <a href="javascript:reset_passwd();">ici</a>
	</p>
	<hr />
	<span class="titlenew">En cas de probl&egrave;me :</span>
	<p>
		Contacter l'administrateur : <a href="mailto:szpytma[dot]cyril[at]gmail[dot]com">Ici</a><br />
		Reporter un abus : <a href="mailto:szpytma[dot]cyril[at]gmail[dot]com">Ici</a><br /><br />
	</p>
	<hr />
	<span class="copy">
		&copy; Arcanis 2006 - <?php echo date('Y'); ?>
	</span>
</div>

<div id="login">


<span class="titlenew">Veuillez vous identifier :</span>
<?
if ($error != "")
{
	echo '
	<div class="clear"></div>
	<div id="Error">
	'.$error .'
	</div>
	<div class="clear"></div>
	';
}
?>

<p>
<form action="" method="post" name="frm">
	Login :<br />
	<input type="text" name="login" class="s" /><br />
	Mot de passe :<br />
	<input type="password" name="password" class="s" /><br /><br />
	<?php //dsp_crypt(0,0); ?><br />
	<!--Recopier le code :<br />
	<input type="text" name="code" class="s"><br /><br />-->
	<input type="hidden" name="sub" value="1" />
	<input type="submit" name="Submit" class="s" value="Login" />
</form>
</p>
<br /><br />
<div class="clear"></div>
<div id="Warning">
<b>ATTENTION :</b><br />
Votre identifiant et votre mot de passe  sont PERSONNELS.<br />
Ne les divulguez pas.<br />
En aucun cas nous vous les demanderons.	<br />
</div>
<div class="clear"></div>
</div>

<?
if (isset($_SESSION['affpub']))
echo '
<div class="clear">&nbsp;</div>
<div id="loginPub">
	<span class="titlenew">Publicit&eacute; :</span>
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
</div>
<div class="clear">&nbsp;</div>';
?>
</div>
<div class="clear">&nbsp;</div>
</div>

</body>
</html>
<? ob_end_flush(); ?>