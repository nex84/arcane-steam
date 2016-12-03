<?php
	require_once('../../includes/functions.inc.php');
	$anti_path = return_anti_path();
	require_once($anti_path.'includes/constant.inc.php');
	require_once($anti_path.'includes/request.sql.php');
	
	if (isset($_POST['action']))
		$action = $_POST['action'];
	else
		$action = 'form_add';
		
	function traite_form($id = null)
	{
		if ($_FILES['img']['error'] == 0 || ($_FILES['img']['error'] == 4 && $id != null))
		{
			if ($_FILES['img']['error'] == 0)
			{
				$md5 = md5_file($_FILES['img']['tmp_name']);
				ereg('(.[[:alpha:]]{3})$', $_FILES['img']['name'], $ext);
				$img = $md5.$ext[1];
				if (!is_dir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH))
					mkdir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH);
				if (!is_dir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'maps/'))
					mkdir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'maps/');
				if (move_uploaded_file($_FILES['img']['tmp_name'], $_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'maps/'.$img))
				{
					$o = new map_map($id);
					$o->set('nom', $_POST['nom']);
					$o->set('img', $img);
					$o->save();
					unset($o);
				}
				else
				{
					echo '<div clas="error">Impossible de copier le fichier dans le répertoire de destination :<br />'.$img.'</div>';
				}
			}
			else
			{
				$o = new map_map($id);
				$o->set('nom', $_POST['nom']);
				$o->save();
				unset($o);
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Administration</title>
		<link href="<?php echo $anti_path; ?>css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="content">
			<div class="onglets">
					<div class="ongletcadre"><a href="./admin_template.src.php">Templates</a></div>
					<div class="ongletcadre"><a href="./admin_type.src.php">Types</a></div>
					<div class="ongletcadreselect">Carte</div>
					<div class="ongletcadre"><a href="./admin_region.src.php">R&eacute;gions</a></div>
					<div class="ongletcadre"><a href="./admin_world.src.php">Monde</a></div>
					<div class="ongletcadre"><a href="./admin_edit_region.src.php">Editeur de région</a></div>
			</div>
			<div class="cadreaveconglet">
				<?php
					switch ($action)
						{
							case ('edit'):
								$action = 'form_add';
								traite_form($_POST['id']);
								break;
							case ('form_edit'):
								$o = new map_map($_POST['id']);
								break;
							case ('add'):
								$action = 'form_add';
								traite_form();
								break;
							case ('delete'):
								$o = new map_map($_POST['id']);
								$o->delete();
								$action = 'form_add';
								break;
						}
						?>
						Liste des cartes existantes :<br />
						<?php
						$c = new database_connector();
						$data = $c->send_sql(select_map());
						echo '<table width="100%">';
						for ($n = 1; $n <= $data['count']; $n++)
						{
							echo '<tr><td>'.$data[$n]['nom']."</td>\n";
							echo "<td>
							<form action='./admin_map.src.php' method='post'><div>
								<input type='hidden' name='action' value='form_edit'>
								<input type='hidden' name='id' value='".$data[$n]['id']."'>
								<input type='submit' value='Modifier'></div></form>
							</td>\n";
							$test = $c->send_sql(count_nb_regions_by_map($data[$n]['id']));
							if ($test[1]['count'] == 0)
							{
								echo "<td>
								<form action='./admin_map.src.php' method='post'><div>
								<input type='hidden' name='action' value='delete'>
								<input type='hidden' name='id' value='".$data[$n]['id']."'>
								<input type='submit' value='Effacer'></div></form></td>\n";
							}
							else
								echo "<td>La carte possède ".$test[1]['count']." régions, impossible de l'effacer</td><br />\n";
							echo "</tr>\n";
						}
						echo '</table>';
						?>
						<hr />
						<?php
						switch ($action)
						{
							case ('form_add'):
								?>
								<form action="./admin_map.src.php" method="post" enctype="multipart/form-data"><table width="100%">
									<tr><td colspan="2"><b>Nouvelle carte</b></td></tr>
									<tr><td>Nom : </td><td><input type="hidden" name="action" value="add">
																					<input type="text" name="nom"></td></tr>
									<tr><td>Image : </td><td><input type="file" name="img"></td></tr>
									<tr><td colspan="2" align="center"><input type="submit" value="Ajouter"></td></tr>
								</table></form>
								<?php
								break;
							case ('form_edit'):
								echo '<form action="./admin_map.src.php" method="post" enctype="multipart/form-data"><table width="100%">
									<tr><td colspan="2"><b>Modification de la carte</b></td></tr>
									<tr><td>Nom : </td><td>
									<input type="hidden" name="action" value="edit">
									<input type="hidden" name="id" value="'.$o->get('id').'">
									<input type="text" name="nom" value="'.$o->get('nom').'"></td></tr>
									<tr><td colspan="2">Image :<br /><a href="'.$o->get('path_img').'">'.$o->get('path_img').'</a></td>
									<tr><td colspan="2" align="center"><input type="file" name="img"></td></tr>
									<tr><td colspan="2" align="center"><input type="submit" value="Modifier"></td></tr>
								</table></form>';
								break;
						}
				?>
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