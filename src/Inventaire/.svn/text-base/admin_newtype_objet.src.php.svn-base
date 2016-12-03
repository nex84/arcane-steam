<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	$db = new database_connector(true);
	$types = $db->send_sql(select_types_objets());
	for ($n = 1; $n <= $types['count']; $n++)
	{}
	$data = $db->send_sql(select_types_objets2());
	for ($n = 1; $n <= $data['count']; $n++)
	{
		$lst[] = $data[$n]['nom_type'];
	}
	
	if (isset($_POST['do']) AND $_POST['do'] == "add")
	{
		if ($_POST['nom'] == "")
			debug("Des informations sont manquantes...");
		else
		{
			if (verif_exist_type($_POST['nom']))
				debug("Un objet avec le m&ecirc;me nom existe d&eacute;j&agrave;...");
			else
			{
				
				//debug(num_or_null($_POST['prix']));
				
				//if (num_or_null($_POST['prix']) AND is_int($_POST['poids']) AND num_or_null($_POST['attaque']) AND num_or_null($_POST['CA']) AND num_or_null($_POST['mana']) AND num_or_null($_POST['modifForce']) AND num_or_null($_POST['modifCA']) AND num_or_null($_POST['modifDext']) AND num_or_null($_POST['modifSagesse']))
				//{
	//debug($lst);

					$db = new database_connector(true);
					$res = $db->send_sql(add_type_objet($_POST['nom']));
				//}
				//else
					//debug("Des informations sont erronn&eacute;es...");
			}
		}
	}	
	if (isset($_GET['do']) AND $_GET['do'] == "delete")
	{
		if (!isset($_GET['id']))
			debug("Erreur, l'id est manquant");
		else
		{
			//debug($_GET['id']);
			$db = new database_connector();
			$res2 = $db->send_sql(delete_type_objet($_GET['id']));
			
			//debug($res2);
			debug("Type d'objet supprim&eacute;...");
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
					<div class="ongletcadre"><a href="admin_create_objet.src.php">Cr&eacute;ation d'objets</a></div>
                    <div class="ongletcadreselect">Gestion des types</div>
									
			</div>
			<div class="cadreaveconglet">
			<h1>Gestion des Types d'objet</h1>
			<hr>
			<table width="100%" border="1" cellspacing="0" cellpadding="0">
            <tr>
            	<td><strong>--Nom--</strong></td>
                <td width="20" align="center">&nbsp;</td>
                <td width="20" align="center">&nbsp;</td>
            </tr>
            	<?php
					$data = $db->send_sql(select_types_objets2());
					for ($n = 1; $n <= $data['count']; $n++)
							{
								$lst[] = $data[$n]['nom_type'];
								echo '<tr>
										<td>'. $data[$n]['nom_type'].'</td>
										<td><a href="./admin_newtype_objet.src.php?id='.$data[$n]['id'].'&do=edit"><img src="../../images/autres/edit.png" border=0 /></td>
										<td><a href="./admin_newtype_objet.src.php?id='.$data[$n]['id'].'&do=delete"><img src="../../images/autres/delete.png" border="0" /></a>
										</td>
									  </tr>';
							}
				?>
            </table>
            <hr />
            <form action="admin_newtype_objet.src.php" method="post">
            <h1>Nouveau Type</h1>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
    				<td>
						<strong>Nom : </strong><input type="text" name="nom"  size="50" maxlength="255">&nbsp;<strong>*</strong><br /><br />
						<!--<strong>Icone :</strong><input type="file" name="image" size = "25">&nbsp;<strong>*</strong>-->
					</td>
  				</tr>
			</table>
<!--<br /><br />-->
			<input type="hidden" name="do" value="add">
			<input type="submit" value="Ajouter">
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
