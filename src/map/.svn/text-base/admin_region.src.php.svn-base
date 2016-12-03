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
				if (!is_dir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'regions/'))
					mkdir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'regions/');
				if (@move_uploaded_file($_FILES['img']['tmp_name'], $_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'regions/'.$img))
				{
					$o = new map_region($id);
					$o->set('nom', $_POST['nom']);
					$o->set('pos_x', $_POST['pos_x']);
					$o->set('pos_y', $_POST['pos_y']);
					$o->set('pos_z', $_POST['pos_z']);
					$o->set('height', $_POST['heigth']);
					$o->set('width', $_POST['width']);
					$o->set('map_id', $_POST['id_map']);
					$o->set('template_id', $_POST['id_template']);
					$o->set('img', $img);
					$o->save();
					unset($o);
				}
				else
				{
					echo '<div clas="error">Impossible de copier le fichier dans le répertoire de destination :<br />'. $_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'regions/'.$img.'</div>';
				}
			}
			else
			{
				$o = new map_region($id);
				$o->set('nom', $_POST['nom']);
				$o->set('pos_x', $_POST['pos_x']);
				$o->set('pos_y', $_POST['pos_y']);
				$o->set('pos_z', $_POST['pos_z']);
				$o->set('height', $_POST['heigth']);
				$o->set('width', $_POST['width']);
				$o->set('map_id', $_POST['id_map']);
				$o->set('template_id', $_POST['id_template']);
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
					<div class="ongletcadre"><a href="./admin_map.src.php">Cartes</a></div>
					<div class="ongletcadreselect">R&eacute;gions</div>
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
						case ('add'):
							$action = 'form_add';
							traite_form();
							break;
						case ('delete'):
							$o = new map_region($_POST['id']);
							$o->delete();
							$action = 'form_add';
							break;
						case ('form_edit'):
							$o = new map_region($_POST['id']);
							break;
					}
					?>
					<form action="./admin_region.src.php" method="post" enctype="multipart/form-data">
					Carte &agrave; laquelle appartient la r&eacute;gion : 
					<?php
					$c = new database_connector();
					$data = $c->send_sql(select_map());
					
					echo '<select name="id_map">';
					for ($n = 1; $n <= $data['count']; $n++)
					{
						$sel = '';
						if ($action != 'form_edit')
						{
							if (!isset($_POST['id_map']) && $n == 1)
								$_POST['id_map'] = $data[$n]['id'];
							if (isset($_POST['id_map']))
							{
								if ($_POST['id_map'] == $data[$n]['id'])
									$sel = 'selected';
							}
						}
						else
						{

							if ($o->map->get('id') == $data[$n]['id'])
								$sel = 'selected';
						}
						echo '<option value="'.$data[$n]['id'].'" '.$sel.'>'.$data[$n]['nom'].'</option>';
					}
					echo '</select>';
					?>
					<br />Template appliqu&eacute; &agrave; la r&eacute;gion : 
					<?php
					$c = new database_connector();
					$data = $c->send_sql(select_templates());
					echo '<select name="id_template">';
					for ($n = 1; $n <= $data['count']; $n++)
					{
						$sel = '';
						if (isset($_POST['id_template']))
						{
							if ($_POST['id_template'] == $data[$n]['id'])
								$sel = 'selected';
						}
						elseif ($action == 'form_edit')
						{
							if ($o->template->get('id') == $data[$n]['id'])
								$sel = 'selected';
						}
						echo '<option value="'.$data[$n]['id'].'" '.$sel.'>'.$data[$n]['nom'].'</option>';
					}
					echo '</select>';
					?>
					<hr />
					<?php
					switch ($action)
					{
						case ('form_edit'):
							echo '<table width="100%">
								<tr><td colspan="2"><b>Nouvelle r&eacute;gion</b></td></tr>
								<tr><td>Nom : </td><td><input type="hidden" name="action" value="edit">
<input type="hidden" name="id" value="'.$o->get('id').'">				
<input type="text" name="nom" value="'.$o->get('nom').'"></td></tr>
<tr><td>Position X : </td><td><input type="text" name="pos_x" value="'.$o->get('pos_x').'"></td></tr>
<tr><td>Position Y : </td><td><input type="text" name="pos_y" value="'.$o->get('pos_y').'"></td></tr>
<tr><td>Position Z : </td><td><input type="text" name="pos_z" value="'.$o->get('pos_z').'"></td></tr>
<tr><td>Largeur : </td><td><input type="text" name="width" value="'.$o->get('width').'"></td></tr>
<tr><td>Hauteur : </td><td><input type="text" name="heigth" value="'.$o->get('height').'"></td></tr>
<tr><td colspan="2">Image : <br />
<a href="'.$o->get('img_path').'">'.$o->get('img_path').'</a></td>
<tr><td colspan="2" align="center"><input type="file" name="img"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Modifier"></td></tr>
							</table>';
							break;
						case ('form_add'):
							?>
							<table width="100%">
								<tr><td colspan="2"><b>Nouvelle r&eacute;gion</b></td></tr>
								<tr><td>Nom : </td><td><input type="hidden" name="action" value="add">
														<input type="text" name="nom"></td></tr>
								<tr><td>Position X : </td><td><input type="text" name="pos_x" value="0"></td></tr>
								<tr><td>Position Y : </td><td><input type="text" name="pos_y" value="0"></td></tr>
								<tr><td>Position Z : </td><td><input type="text" name="pos_z" value="0"></td></tr>
								<tr><td>Largeur : </td><td><input type="text" name="width" value="25"></td></tr>
								<tr><td>Hauteur : </td><td><input type="text" name="heigth" value="25"></td></tr>
								<tr><td>Image : </td><td><input type="file" name="img"></td></tr>
								<tr><td colspan="2" align="center"><input type="submit" value="Ajouter"></td></tr>
							</table>
							<?php
							break;
					}
				?>
			</div></form>
			<div class="ongletsgauche">
			<div class="ongletcadregauche">
			<b>Liste des r&eacute;gions :</b>
			<table>
			<?php
				$c = new database_connector();
				if ($action == 'form_edit')
					$data = $c->send_sql(select_regions_by_id_map($o->map->get('id')));
				else
					$data = $c->send_sql(select_regions_by_id_map($_POST['id_map']));
				//debug($data);
				for ($n = 1; $n <= $data['count']; $n++)
				{
					echo '<tr><td>'.$data[$n]['nom'].' ('.$data[$n]['pos_x'].';'.$data[$n]['pos_y'].';'.$data[$n]['pos_z'].')'."</td>\n
					<td><form action='./admin_region.src.php' method='post'>
					<input type='hidden' name='id' value='".$data[$n]['id']."'>
					<input type='hidden' name='action' value='form_edit'>
					<input type='submit' value='Modifier'></form></td>\n<td>
					<form action='./admin_region.src.php' method='post'>
					<input type='hidden' name='id' value='".$data[$n]['id']."'>
					<input type='hidden' name='action' value='delete'>
					<input type='submit' value='Supprimer'></form></td>\n</tr>\n";
				}
			?>
			</table>
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