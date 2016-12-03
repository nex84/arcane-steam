<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
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
 
  	<link href="../../css/default.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/spread.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/alert.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/debug.css" rel="stylesheet" type="text/css" />
		
		<?php
			if (isset($_POST['updateDone']))
			{
				$update = new marchand_admin();
				$name = addslashes($_POST['name']);
				$x = addslashes($_POST['x']);
				$y = addslashes($_POST['y']);
				$description = addslashes($_POST['description']);
				$id = addslashes($_POST['idMarchand']);
				$region = addslashes($_POST['region']);
				$update->update($id,$name,$x,$y,$region,$description);
			}
			else if (isset($_POST['Creation']))
			{
				$creation = new marchand_admin();
				$name = addslashes($_POST['name']);
				$x = addslashes($_POST['x']);
				$y = addslashes($_POST['y']);
				$region = addslashes($_POST['region']);
				$description = addslashes($_POST['description']);;
				$_POST['idMarchand'] = $creation->create($name,$x,$y,$region,$description);
			}
		?>
		
	</head>
	<body>
		<div id="content">
			<div class="onglets">
					<div class="ongletcadre"><a href="./admin_liste_marchand.src.php">Liste des marchand</a></div>
					<div class="ongletcadreselect">
						<?php
							if (isset($_POST['idMarchand']))
								echo "Update de marchand";
							else
								echo "Création de marchand";
						?>
					</div>
					<div class="ongletcadre"><a href="./admin_stock_marchand.src.php">Creation des stocks</a></div>
					<div class="ongletcadre"><a href="#">Gestion des profit</a></div>
			</div>
			<div class="cadreaveconglet">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				  	<td align="left">
						<?php
							if (isset($_POST['idMarchand']))
							{
								echo 'Marchand id : '.$_POST['idMarchand'];
							}
						?>
					</td>
					<td align="right">
						<form action="" method="post">
							Id :<input type="text" name="idMarchand" style="width:50px;">
							<input type="submit" value="Rechercher">
							<input type="hidden" name="texte" value="1">
						</form>
					</td>
				  </tr>
				</table>
				<hr />
				<?php
				if (isset($_POST['idMarchand']))
				{
					$search = new marchand_admin();
					$search->load(addslashes($_POST['idMarchand']));
					$data = $search->getData();
					echo '<form action="" method="post">';
					echo 'Name : <input type="text" name="name" value="'.stripslashes($data[1]['name']).'" /><br>';
					echo 'X : <input type="text" name="x" value="'.stripslashes($data[1]['x']).'" /><br>';
					echo 'Y : <input type="text" name="y" value="'.stripslashes($data[1]['y']).'" /><br>';
					echo 'Regions : <select name="region">';
					echo '<option value="0">--> Aucune <--</option>';
					$reg = new marchand_admin();
					$region = $reg->getZone();
					$i = 1;
					while (isset($region[$i]))
					{
						$select = "";
						if ($data[1]['region'] == $region[$i]["id"]) 
							$select =' selected="selected" ';
						echo '<option value="'.$region[$i]["id"].'"'.$select.'>'.$region[$i]["nom"].'</option>';
						$i++;
					}
					echo '</select><br />';
					echo 'Description : <textarea name="description" rows="5" cols="50">'.stripslashes($data[1]['Description']).'</textarea><br>';
					echo '--------<br/>';
					echo '<input type="submit" value="Update">';
					echo '<input type="hidden" name="idMarchand" value="'.$data[1]['id'].'" />';
					echo '<input type="hidden" name="updateDone" value="1" />';
					echo '</form>';
					echo '<hr>';
					echo '<u>Donnée non modifiable ici :</u><br /><br />';
					$balance = $search->getBalance();
				
					echo 'Balance du marchand : '.$balance[1]['Values'].'<br />';
					echo 'Update du marchand : '.$balance[1]['Time'].'<br />';
				}
				else
				{
					echo '<form action="" method="post">';
					echo 'Name : <input type="text" name="name" value="" /><br>';
					echo 'X : <input type="text" name="x" value="" /><br>';
					echo 'Y : <input type="text" name="y" value="" /><br>';
					echo 'Regions : <select name="region">';
					echo '<option value="0">--> Aucune <--</option>';
					$reg = new marchand_admin();
					$region = $reg->getZone();
					$i = 1;
					while (isset($region[$i]))
					{
						echo '<option value="'.$region[$i]["id"].'">'.$region[$i]["nom"].'</option>';
						$i++;
					}
					echo '</select><br />';
					echo 'Description : <textarea name="description" rows="5" cols="50"></textarea><br>';
					echo '--------<br/>';
					echo '<input type="submit" value="Save">';
					echo '<input type="hidden" name="Creation" value="1" />';
					echo '</form>';
				}
				?>
				<hr />
			</div>
		<?
        	require_once("../footer.php");
		?>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
		<div style="clear:both;"></div>
	</body>
</html>

