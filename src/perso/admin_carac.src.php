<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	$db = new database_connector();
	
	if (!isset($_POST["user_mail"]) || !isset($_POST["user_passwd"]) || !isset($_POST["nom_perso"]) || !isset($_POST["race"]) || !isset($_POST["alignement"]))
	{
		debug('ERREUR : des informations sont manquantes<br /><a href="admin_inscription.src.php">Retour</a>');
	}
	else
	{
		$user_mail = $_POST["user_mail"];
		$user_passwd = $_POST["user_passwd"];
		$nom_perso = $_POST["nom_perso"];
		$race = $_POST["race"];
		$alignement = $_POST["alignement"];
	}
	
	//recuperation caracteritique
	$get_caract =  $db->send_sql(select_caract());
	for ($n = 1; $n <= $get_caract['count']; $n++)
	{}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Inscription</title>
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
			<div class="onglets">
					
                    <div class="ongletcadre">Inscription</div>
					<div class="ongletcadre">Personnage</div>
					<div class="ongletcadreselect">Caract&eacute;ristiques</div>				
					<div class="ongletcadre">Termin&eacute;</div>				

			</div>
			<div class="cadreaveconglet">
			<h1>CARACT&Eacute;RISTIQUES</h1>
                
                Points &agrave; r&eacute;partir : <input id="pts" type="text" size="7" maxlength="7" readonly="true" value="2">
                    <form action="admin_profil.src.php" method="post">
                    <br /><fieldset><br />
                    	<legend>R&eacute;partition</legend>
						<table border="0" cellpadding="0" cellspacing="0">
						<?php
						
							for($i=1; $i < $get_caract['count'] + 1; $i++)
							{
								$nom = $get_caract[$i]['nom'];
								echo '<tr><td>'. $nom . ' :&nbsp;</td><td><input name="'.$get_caract[$i]['key'].'" readonly="true" id="'.$nom.'" type="text" size="5" maxlength="3" value="0">&nbsp;<a href="javascript:add(\''.$nom.'\')">(+)</a>&nbsp;<a href="javascript:substract(\''.$nom.'\')">(-)</a></td></tr>';
							}
						
						?>
						</table>
						
						<!--
                    	Attaque :&nbsp;&nbsp;&nbsp;<input name="pts_attaque" type="text" size="5" maxlength="3">&nbsp;<a>(+)</a>&nbsp;<a>(-)</a><br /><br />
                        Armure :&nbsp;&nbsp;&nbsp;&nbsp;<input name="pts_armure" type="text" size="5" maxlength="3">&nbsp;<a>(+)</a>&nbsp;<a>(-)</a><br /><br />
                        Dext&eacute;rit&eacute; :&nbsp;<input name="pts_dext" type="text" size="5" maxlength="3">&nbsp;<a>(+)</a>&nbsp;<a>(-)</a><br /><br />
                        Sagesse :&nbsp;<input name="pts_sagesse" type="text" size="5" maxlength="3">&nbsp;<a>(+)</a>&nbsp;<a>(-)</a><br /><br />-->
                </fieldset>
				<p align="right">
                <input name="user_mail" type="hidden" value="<?php echo $user_mail; ?>">
                <input name="user_passwd" type="hidden" value="<?php echo $user_passwd; ?>">
                <input name="nom_perso" type="hidden" value="<?php echo $nom_perso; ?>">
                <input name="race" type="hidden" value="<?php echo $race; ?>">
                <input name="alignement" type="hidden" value="<?php echo $alignement; ?>">
                <input name="valid" type="submit" value="Terminer &gt;">
                </p>     
            	</form>
                
			</div>
		</div>
		<script language="javascript" type="text/javascript">
			var total=document.getElementById('pts');
		
			function add(obj)
			{
				if (total.value == 0)
				{
					alert('Plus aucun points disponibles...');
				}
				else
				{
					total.value = parseInt(total.value,10) - 1;
					document.getElementById(obj).value = parseInt(document.getElementById(obj).value,10) + 1;
					
				}
			
			}
			function substract(obj)
			{
				if (document.getElementById(obj).value == 0)
				{}
				else
				{
					total.value = parseInt(total.value,10) + 1;
					document.getElementById(obj).value = parseInt(document.getElementById(obj).value,10) - 1;
				}
				
			}
		</script>
	</body>
</html>
