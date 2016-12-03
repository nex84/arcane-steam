<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	require_once('../../includes/mail.inc.php');
	require_once("../../class/race/race.class.php");
	require_once("../../class/joueur/joueur_data.class.php");
	require_once("../../includes/fonctions_respawn.php");
	require_once("../../class/mail/Class.SMTP.php");	
	
	$db = new database_connector();
	//recuperation caracteritique
	$get_caract =  $db->send_sql(select_caract());
	$count=0;
	for ($n = 1; $n <= $get_caract['count']; $n++)
	{
		foreach ($_POST as $key => $value)
		{
			if ($key == $get_caract[$n]['nom'])
			{
				$count++;
			}
		}
	}
	
	//debug($_POST);
	

	if (!isset($_POST["user_mail"]) || !isset($_POST["user_passwd"]) || !isset($_POST["nom_perso"]) || !isset($_POST["race"]) || !isset($_POST["alignement"]))
	{
		if ($count != $get_caract['count'])
		debug('ERREUR : des informations sont manquantes<br /><a href="admin_inscription.src.php">Retour</a>');
	}
	else
	{
		$user_mail = $_POST["user_mail"];
		$user_passwd = $_POST["user_passwd"];
		$nom_perso = $_POST["nom_perso"];
		$race = $_POST["race"];
		$alignement = $_POST["alignement"];
		
		$mag = $_POST["mag"];
		$def = $_POST["def"];
		$att = $_POST["att"];
		$con = $_POST["con"];

//		$pts_attaque = $_POST["pts_attaque"];
//		$pts_armure = $_POST["pts_armure"];
//		$pts_dext = $_POST["pts_dext"];
//		$pts_sagesse = $_POST["pts_sagesse"];
	}
	
	if ($_POST["do"] == "save")
	{
		$secu = 1;
		//create_new_user($usr_mail, $usr_passwd, $nom_perso, $race, $alignement, $mag, $def, $att, $con )
		$status = create_new_user($user_mail, $user_passwd, $nom_perso, $race, $alignement, $mag, $def, $att, $con);
		if ($status == 1)
		{
			debug('Compte créé...<br />');
		}
		else
		{
			debug("Erreur...");
		}
	}
	
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Inscription</title>
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<script language="javascript">
			function ref()
			{
				window.parent.location.reload();
			}
	</script>
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
			<div class="onglets">
					
                    <div class="ongletcadre">Inscription</div>
					<div class="ongletcadre">Personnage</div>
					<div class="ongletcadre">Caract&eacute;ristiques</div>				
					<div class="ongletcadreselect">Termin&eacute;</div>				

			</div>
			<div class="cadreaveconglet">
			<h1>RECAPITULATIF</h1>
            <br />
                    <fieldset>
                    <br />
                    Mail : <? echo $user_mail; ?><br>
                    
                    <hr>
                    Nom du perso : <? echo $nom_perso; ?><br>
                    Race : <? echo $race; ?><br>
                    alignement : <? echo $alignement; ?><br>
                    <hr>
                    
					<?php
						
							for($i=1; $i < $get_caract['count'] + 1; $i++)
							{
								$key = $get_caract[$i]['key'];
								$nom = $get_caract[$i]['nom'];
								echo $nom . ' :&nbsp; '.$_POST[$key].'<br />';
							}
						
						?><br />
					
					
					
                    
                    <form method="post" action="admin_profil.src.php">
					
                    	<input name="user_mail" type="hidden" value="<?php echo $user_mail; ?>">
                		<input name="user_passwd" type="hidden" value="<?php echo $user_passwd; ?>">
                		<input name="nom_perso" type="hidden" value="<?php echo $nom_perso; ?>">
                		<input name="race" type="hidden" value="<?php echo $race; ?>">
                		<input name="alignement" type="hidden" value="<?php echo $alignement; ?>">
						
						
						<?php

							for($i=1; $i < $get_caract['count'] + 1; $i++)
							{
								$key = $get_caract[$i]['key'];
								
								echo '<input name="'.$key.'" type="hidden" value="'. $_POST[$key] .'">';
							}
						
						?>

                        <input name="do" type="hidden" value="save">
						<br />Un mail de confirmation vous sera envoy&eacute; à la cr&eacute;ation du compte.<br />
                        <?php
						
							if ($secu != 1)
							{
								echo '<input name="valid" type="submit" value="Valider &gt;">';
							}
							else
							{
								//echo '<input name="valid" type="button" value="Retour &gt;" onclick="ref();">';
							}
							
						?>
                    </form>
                    </fieldset>
				
			</div>
		</div>
		
	</body>
</html>
