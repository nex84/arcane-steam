<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	if (!isset($_GET['id']))
		debug("ERREUR : l'id n'existe pas...");
	else
		$data = recup_values($_GET['id']);

	//debug($data);
	
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
					<div class="ongletcadreselect">Liste des objets</div>
					<div class="ongletcadre"><a href="./admin_create_objet.src.php">Cr&eacute;ation d'objets</a></div>
                    <div class="ongletcadre"><a href="./admin_newtype_objet.src.php">Gestion des types</a></div>
									
			</div>
			<div class="cadreaveconglet">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><img src="img/<?php echo $data[1]['typ']; ?>.jpg"></td>
    <td><h1><?php echo $data[1]['nom']; ?></h1></td>
  </tr>
  <tr>
    <td colspan="2">
		<hr><br /><br /><strong>Description :</strong><br />
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
			<tr><td><?php echo nl2br(htmlentities($data[1]['description'])); ?></td></tr>
		</table>
	</td>
  </tr>
  </table><br />
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Prix : </strong><?php echo $data[1]['prix']; ?><br />
		<strong>Poids : </strong><?php echo $data[1]['poids']; ?>
	</td>
    <td><strong>Attaque : </strong><?php echo $data[1]['attaque']; ?><br />
		<strong>CA : </strong><?php echo $data[1]['CA']; ?><br />
		<strong>Mana : </strong><?php echo $data[1]['mana']; ?><br />
	</td>
  </tr>
</table>
<br><hr>
<h3>Modificateurs</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
										    <td><strong>Force : </strong><?php echo $data[1]['modifForce']; ?></td>
										    <td><strong>CA : </strong><?php echo $data[1]['modifCA']; ?></td>
										  </tr>  
										  <tr>	
											<td><strong>Dext&eacute;rit&eacute; : </strong><?php echo $data[1]['modifDext']; ?></td>
										    <td><strong>Sagesse : </strong><?php echo $data[1]['modifSagesse']; ?></td>
										  </tr>
										</table>
<br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
		<form action="admin_modif_objet.src.php" method="get">
			<input type="hidden" name="id" value="<?php echo $data[1]['id']; ?>"
			<input type="submit" value="Modifier">
		</form>
	</td>
    <td align="right">
		<form action="admin_liste_objet.src.php" method="get">
			<input type="submit" value="Retour">
		</form>
	</td>
  </tr>
</table>
</div>
		<?
        	require_once("../footer.php");
		?>
		</div>
		
	</body>
</html>
