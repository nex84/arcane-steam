<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	$db = new database_connector(true);
	$types = $db->send_sql(select_types_objets());
	for ($n = 1; $n <= $types['count']; $n++)
	{}
	
	if (isset($_POST['do']) AND $_POST['do'] == "create")
	{
		if ($_POST['type'] == "" OR $_POST['nom'] == "" OR $_POST['description'] == "" OR $_POST['prix'] == "" OR $_POST['poids'] == "" OR $_POST['attaque'] == "" OR $_POST['CA'] == "" OR $_POST['mana'] == "" OR $_POST['modifForce'] == "" OR $_POST['modifCA'] == "" OR $_POST['modifDext'] == "" OR $_POST['modifSagesse'] == "")
			debug("Des informations sont manquantes...");
		else
		{
			if (verif_exist($_POST['nom']))
				debug("Un objet avec le m&ecirc;me nom existe d&eacute;j&agrave;...");
			else
			{
				
				//debug(num_or_null($_POST['prix']));
				
				//if (num_or_null($_POST['prix']) AND is_int($_POST['poids']) AND num_or_null($_POST['attaque']) AND num_or_null($_POST['CA']) AND num_or_null($_POST['mana']) AND num_or_null($_POST['modifForce']) AND num_or_null($_POST['modifCA']) AND num_or_null($_POST['modifDext']) AND num_or_null($_POST['modifSagesse']))
				//{
					create_objet($_POST['type'], $_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['poids'], $_POST['attaque'], $_POST['CA'], $_POST['mana'], $_POST['modifForce'], $_POST['modifCA'], $_POST['modifDext'], $_POST['modifSagesse']);
				//}
				//else
					//debug("Des informations sont erronn&eacute;es...");
			}
		}
	}	
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Administration</title>
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
					<div class="ongletcadre"><a href="admin_liste_objet.src.php">Liste des objets</a></div>
					<div class="ongletcadreselect">Cr&eacute;ation d'objets</div>
                    <div class="ongletcadre"><a href="./admin_newtype_objet.src.php">Gestion des types</a></div>
									
			</div>
			<div class="cadreaveconglet">
			<h1>Nouvel Objet</h1><hr>
			<form action="admin_create_objet.src.php" method="post">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<strong>Type : </strong><select name="type">
			<?php
				for ($i = 1; $i <= $types['count']; $i++)
				{
			?>
            		<option value="<? echo $types[$i]['nom_type']; ?>"><? echo $types[$i]['nom_type']; ?></option>
            <?php
				}
			?>		
		</select>&nbsp;<strong>*</strong>
		<br /><br />
		<strong>Nom : </strong><input type="text" name="nom"  size="50" maxlength="255">&nbsp;<strong>*</strong>
	</td>
  </tr>
  <tr>
    <td>
		<hr><strong>Description :</strong><br />
		<textarea name="description" cols="50" rows="5"></textarea>&nbsp;<strong>*</strong>
	</td>
  </tr>
  </table><br />
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Prix : </strong><input name="prix" type="text" size="20" maxlength="55"><br />
		<strong>Poids : </strong><input name="poids" type="text" size="10" maxlength="25">&nbsp;<strong>*</strong>
	</td>
    <td><strong>Attaque : </strong><input name="attaque" type="text" size="10" maxlength="25"><br />
		<strong>CA : </strong><input name="CA" type="text" size="10" maxlength="25"><br />
		<strong>Mana : </strong><input name="mana" type="text" size="10" maxlength="25"><br />
	</td>
  </tr>
</table>
<br><hr>
<h3>Modificateurs</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
										    <td><strong>Force : </strong><input name="modifForce" type="text" size="10" maxlength="25"></td>
										    <td><strong>CA : </strong><input name="modifCA" type="text" size="10" maxlength="25"></td>
										  </tr>  
										  <tr>	
											<td><strong>Dext&eacute;rit&eacute; : </strong><input name="modifDext" type="text" size="10" maxlength="25"></td>
										    <td><strong>Sagesse : </strong><input name="modifSagesse" type="text" size="10" maxlength="25"></td>
										  </tr>
										</table>
<br /><br />

			<input type="hidden" name="do" value="create">
			<input type="submit" value="Cr&eacute;er">
		</form>
	
			<hr>
			<i>Tous les champs sont obligatoires.</i>
			</div>
			<?
        		require_once("../footer.php");
			?>
		</div>
		
	</body>
</html>
