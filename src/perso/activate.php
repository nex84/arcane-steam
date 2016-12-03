<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	
	$db = new database_connector();
	
	if (!isset($_GET['hash']))
	{
		debug("Erreur : Le code d'activation est erron&eacute;...");
	}
	
	if (isset($_POST['login']) && isset($_POST['hash']))
	{
		//activation du compte
		$verif = 0;
		$verif = activation_verif($_POST['login'], $_POST['hash']);
		if ($verif == 1)
		{
			$res = activation_compte($_POST['login'], $_POST['hash']);
			if ($res == 1)
				header("Location: https://dev.arcane-steam.com/src/Jeux/login.php");

		}
		else
		{
			debug("Erreur : Les informations fournies ne correspondent pas...");
		}
	}
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Activation</title>
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		
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

  	<style>
      #myDialogId .myButtonClass {
      padding:3px;
      font-size:20px;
      width:100px;
      }
      #myDialogId .ok_button {
      color:#2F2;
      }
      #myDialogId .cancel_button {
      color:#F88;
      }
  </style>
		
		
		
	</head>
	<body>
	<div id="content">
			<div class="cadreaveconglet">
			<h1>ACTIVATION DU COMPTE</h1>
            <br />
                    <fieldset>
                    Pour terminer la procédure d'inscription, veuillez indiquer votre login et cliquer sur le bouton "Activer".
					
                    <form method="post">
						<b>Login : </b><input name="login" type="text"><br /><br />
						<input type="hidden" name="hash" value="<?php echo $_GET['hash']; ?>">
						<input type="submit" name="valid" value="Activer &gt;">
                    </form>
                    </fieldset>
				
			</div>
		</div>
		
	</body>
</html>
