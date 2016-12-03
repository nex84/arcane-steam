<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
if (!isset($_GET['id']))
		debug("ERREUR : l'id n'existe pas...");
	else
		$data = recup_values($_GET['id']);
		

	//récuperation des types
	$db = new database_connector(true);
	$types = $db->send_sql(select_types_objets());
	for ($n = 1; $n <= $types['count']; $n++)
	{}
	
	if (isset($_POST['do']) AND $_POST['do'] == "modify")
	{
		if ($_POST['type'] == "" OR $_POST['nom'] == "" OR $_POST['description'] == "" OR $_POST['prix'] == "" OR $_POST['poids'] == "" OR $_POST['attaque'] == "" OR $_POST['CA'] == "" OR $_POST['mana'] == "" OR $_POST['modifForce'] == "" OR $_POST['modifCA'] == "" OR $_POST['modifDext'] == "" OR $_POST['modifSagesse'] == "")
			debug("Des informations sont manquantes...");
		else
		{
//			if (verif_exist($_POST['nom']))
//				debug("Un objet avec le m&ecirc;me nom existe d&eacute;j&agrave;...");
//			else
//			{
				update_objet($_POST['id'], $_POST['type'], $_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['poids'], $_POST['attaque'], $_POST['CA'], $_POST['mana'], $_POST['modifForce'], $_POST['modifCA'], $_POST['modifDext'], $_POST['modifSagesse']);
//			}
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
					<div class="ongletcadreselect"><a href="./admin_liste_objet.src.php">Liste des objets</a></div>
					<div class="ongletcadre"><a href="./admin_create_objet.src.php">Cr&eacute;ation d'objets</a></div>
                    <div class="ongletcadre"><a href="./admin_newtype_objet.src.php">Gestion des types</a></div>
									
			</div>
			<div class="cadreaveconglet">
<h1>Modification</h1><hr>
			<form action="admin_modif_objet.src.php?id=<? echo $_GET['id']; ?>" method="post">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
  					<tr>
						<td>
						<strong>Type : </strong><select name="type">
						<?php
							for ($i = 1; $i <= $types['count']; $i++)
							{
						?>
            			<option value="<? echo $types[$i]['nom_type']; ?>" <?php  if (isset($data[1]['typ'])){ if ($data[1]['typ'] == $types[$i]['nom_type']){ echo " selected"; } }  ?>><? echo $types[$i]['nom_type']; ?></option>
            			<?php
							}
						?>		
		</select>&nbsp;<strong>*</strong>
		<br /><br />
		<strong>Nom : </strong><input type="text" name="nom"  size="50" maxlength="255" value="<? echo $data[1]['nom']; ?>">&nbsp;<strong>*</strong>
	</td>
  </tr>
  <tr>
    <td>
		<hr><strong>Description :</strong><br />
		<textarea name="description" cols="50" rows="5"><? echo $data[1]['description']; ?></textarea>&nbsp;<strong>*</strong>
	</td>
  </tr>
  </table><br />
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Prix : </strong><input name="prix" type="text" size="20" maxlength="55" value="<? echo $data[1]['prix']; ?>"><br />
		<strong>Poids : </strong><input name="poids" type="text" size="10" maxlength="25" value="<? echo $data[1]['poids']; ?>">&nbsp;<strong>*</strong>
	</td>
    <td><strong>Attaque : </strong><input name="attaque" type="text" size="10" maxlength="25" value="<? echo $data[1]['attaque']; ?>"><br />
		<strong>CA : </strong><input name="CA" type="text" size="10" maxlength="25" value="<? echo $data[1]['CA']; ?>"><br />
		<strong>Mana : </strong><input name="mana" type="text" size="10" maxlength="25" value="<? echo $data[1]['mana']; ?>"><br />
	</td>
  </tr>
</table>
<br><hr>
<h3>Modificateurs</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
										    <td><strong>Force : </strong><input name="modifForce" type="text" size="10" maxlength="25" value="<? echo $data[1]['modifForce']; ?>"></td>
										    <td><strong>CA : </strong><input name="modifCA" type="text" size="10" maxlength="25" value="<? echo $data[1]['modifCA']; ?>"></td>
										  </tr>  
										  <tr>	
											<td><strong>Dext&eacute;rit&eacute; : </strong><input name="modifDext" type="text" size="10" maxlength="25" value="<? echo $data[1]['modifDext']; ?>"></td>
										    <td><strong>Sagesse : </strong><input name="modifSagesse" type="text" size="10" maxlength="25" value="<? echo $data[1]['modifSagesse']; ?>"></td>
										  </tr>
										</table>
<br /><br />

			<input type="hidden" name="id" value="<? echo $data[1]['id']; ?>">
            <input type="hidden" name="do" value="modify">
			<input type="submit" value="Modifier">
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
