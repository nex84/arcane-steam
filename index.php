<?

session_start();
ob_start();
//$_SESSION['affpub'] = 1;
require_once('./includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');

$error = "";
if (isset($_POST['sub']))
{
	if (isset($_POST['login']) && $_POST['login'] !="")
	{
		if (isset($_POST['password']) && $_POST['password'] != "")
		{
			$login = addslashes($_POST['login']);
			$password = md5(addslashes($_POST['password']));
			$c = new database_connector();
			$data = $c->send_sql("SELECT * FROM  users WHERE users.actif = 1 AND login = '".$login."' and passwd='".$password."'");
			//echo '<pre>'.print_r($data).'</pre>';
			if ($data['count'] == 1)
			{
						$_SESSION['idGuild'] = $data[1]['guilde'];
						$_SESSION['login'] = $data[1]['login'];
						$_SESSION['id'] = $data[1]['id'];			
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
    <link href="./css/style.css" rel="stylesheet" media="all" />
    
    <!--  Prototype Window Class Part -->
    <script type="text/javascript" src="./js/prototype.js"> </script> 
    <script type="text/javascript" src="./js/effects.js"> </script>
    <script type="text/javascript" src="./js/window.js"> </script>
    
    <script type="text/javascript" src="./js/window_effects.js"> </script>
    <script type="text/javascript" src="./js/debug.js"> </script>
    
    <link href="./css/default.css" rel="stylesheet" type="text/css" />	 
    <link href="./css/spread.css" rel="stylesheet" type="text/css" />	 
    <link href="./css/alert.css" rel="stylesheet" type="text/css" />	 
    <link href="./css/alert_lite.css" rel="stylesheet" type="text/css" />	
    <link href="./css/alphacube.css" rel="stylesheet" type="text/css" />	
    <link href="./css/debug.css" rel="stylesheet" type="text/css" />
    
    
    <title>~Arcane-Steam - Home </title>
    </head>

	
    <body>
    
        <div id="contentMain">
        
            <div id="mainLogin"><img src="./images/autres/logo.jpg" width="500" alt="Logo Arcane-steam" /></div>
            
            <?php
            require_once("logbar.php");
			if(isset($_REQUEST['action']))
			{
				
				if($_REQUEST['action'] == "seeNews")
				{
					require_once("./src/news/VisualiserUneNews.src.php");
					require_once("./src/Commentaire/listCommentaire.src.php");
					require_once("./src/Commentaire/postCommentaire.src.php");
				}
				if($_REQUEST['action'] == "recherche")
				{
					require_once("./src/perso/rechercher.src.php");				
				}
				if($_REQUEST['action'] == "seeUser")
				{
					require_once("./src/perso/visualiser.src.php");
				}
				if($_REQUEST['action'] == "seeArchive")
				{
					require_once("./src/news/Archive.src.php");
				}
				if($_REQUEST['action'] == "forum")
				{
					require_once("class/forums/forums_list.php");
				}
				if($_REQUEST['action'] == "createPost")
				{
					require_once("class/forums/forums_AddPost.php");
				}
				if($_REQUEST['action'] == "logout")
				{
					if(isset($_SESSION['id']))
						unset($_SESSION['id']);
						
					header('Location: http://www.arcane-steam.com/');
				}
			}
			else if(isset($_REQUEST['idForums']))
			{
				require_once("class/forums/forums_SubList.php");
			}
			else
			{
				require_once('default.php');
			}
			
			?>
		</div>
        <div style="float:right">
            <p>
            <a href="http://validator.w3.org/check?uri=referer"><img
                src="http://www.w3.org/Icons/valid-xhtml10-blue"
                alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a> <br />
             <a href="http://www.mozilla.com/"><img
                src="images/getfirefox.png"
                alt="Get FireFox" height="15" width="80" /></a>          </p>
	</div>
        <div class="clear"></div>
    </body>
</html>