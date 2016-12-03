<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	if (!isset($_POST['search']))
		$search = '';
	else
		$search = $_POST['search'];

	//debug($search);
	//debug($_POST['type_obj']);
	
	//récupération de la liste des types d'objests
	$db = new database_connector();
	$types = $db->send_sql(select_types_objets());
	for ($n = 1; $n <= $types['count']; $n++)
	{}
	if (isset($_GET['do']) AND $_GET['do'] == "delete")
	{
		if (isset($_GET['id']))
			delete_objet($_GET['id']);
		else
			debug("ERREUR : pr&eacute;ciser l'id &agrave; supprimer...");
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
					<div class="ongletcadreselect">Liste des objets</div>
					<div class="ongletcadre"><a href="./admin_create_objet.src.php">Cr&eacute;ation d'objets</a></div>
                    <div class="ongletcadre"><a href="./admin_newtype_objet.src.php">Gestion des types</a></div>
									
			</div>
			<div class="cadreaveconglet">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left">
		<form action="./admin_liste_objet.src.php" method="post">
			Type d'objet : <select name="type_obj">
            <option value="0" <?php if (isset($_POST['type_obj'])){ if ($_POST['type_obj'] == "0"){ echo " selected"; } } ?>>-TOUS-</option>
            <?php
				for ($i = 1; $i <= $types['count']; $i++)
				{
			?>
            		<option value="<? echo $types[$i]['nom_type']; ?>" <?php if (isset($_POST['type_obj'])){ if ($_POST['type_obj'] == $types[$i]['nom_type']){ echo " selected"; } } ?>><? echo $types[$i]['nom_type']; ?></option>
            <?php
				}
			?>
			</select>
            <input type="hidden" name="search" value="<? echo $_POST['search']; ?>">
			<input type="submit" value="Filtrer">
		</form>
	</td>
    <td align="right">
		<form action="./admin_liste_objet.src.php" method="post">
			<input type="hidden" name="type_obj" value="<? echo $_POST['type_obj']; ?>">
            <input type="text" name="search" <?php if (isset($search)){ echo 'value="'.$search.'"';}?>>
			<input type="submit" value="Rechercher">
		</form>
	</td>
  </tr>
</table>

				<hr />
				<?php
							echo '<table width="100%" border="1" cellspacing="0" cellpadding="0">
  									<tr>
									  	<td colspan="7">&nbsp;</td>
									  	<td colspan="4" align="center">Modificateurs</td>
									  	<td colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td>Image</td>
									    <td>Nom</td>
    									<td>Prix</td>
										<td>Poids</td>
    									<td>Attaque</td>
    									<td>CA</td>
    									<td>Mana</td>
    									<td>Force</td>
    									<td>CA</td>
    									<td>Dext&eacute;rit&eacute;</td>
									    <td>Sagesse</td>
    									<td>&nbsp;</td>
									    <td>&nbsp;</td>
  									</tr>
							';
						if (isset($_POST['type_obj']))
						{
							$data = $db->send_sql(select_objets($_POST['type_obj'], $search));
						}
						else
						{
							$data = $db->send_sql(select_objets(0, $search));
						}
							for ($n = 1; $n <= $data['count']; $n++)
							{
								echo '<tr>
											<td align="center"><img src="img/'.$data[$n]['typ'].'.jpg"></td>
											<td><a href="admin_affiche_objet.src.php?id='.$data[$n]['id'].'">'.$data[$n]['nom'].'</a></td>
											<td align="center">'.$data[$n]['prix'].'</td>
											<td align="center">'.$data[$n]['poids'].'</td>
											<td align="center">'.$data[$n]['attaque'].'</td>
											<td align="center">'.$data[$n]['CA'].'</td>
											<td align="center">'.$data[$n]['mana'].'</td>
											<td align="center">'.$data[$n]['modifForce'].'</td>
											<td align="center">'.$data[$n]['modifCA'].'</td>
											<td align="center">'.$data[$n]['modifDext'].'</td>
											<td align="center">'.$data[$n]['modifSagesse'].'</td>
											<td><a href="./admin_modif_objet.src.php?id='.$data[$n]['id'].'"><img src="../../images/autres/edit.png" border=0 /></td>
											<td><a href="./admin_liste_objet.src.php?do=delete&id='.$data[$n]['id'].'"><img src="../../images/autres/delete.png" border="0" /></a></td>
										</tr>
								';
							}
							echo '</table>';
						//}
					?>
				<hr />
				<script>

				function openBox(nom,text)
				{
					var win = new Window({className: "dialog", width:350, height:400, zIndex: 100, resizable: true, title: nom, showEffect:Effect.BlindDown, hideEffect: Effect.SwitchOff, draggable:true, wiredDrag: true})
					win.getContent().innerHTML= text;
					//win.setStatusBar("Status bar info");
					win.setStatusBar("~ Arcane Steam");
					win.showCenter();
				}
				</script>
				<!--<p align="center">
					[&nbsp;Pr&eacute;c&eacute;dent&nbsp;-&nbsp;
					1&nbsp;-&nbsp;
					2&nbsp;-&nbsp;
					Suivant&nbsp;]
				</p>-->
			</div>
			<?				
				require_once("../footer.php");
			?>

		</div>
		
	</body>
</html>

