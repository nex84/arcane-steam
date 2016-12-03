<?php
	require_once('../../includes/functions.inc.php');
	$anti_path = return_anti_path();
	require_once($anti_path.'includes/constant.inc.php');
	require_once($anti_path.'includes/request.sql.php');
	
	if (isset($_POST['action']))
		$action = $_POST['action'];
	elseif (isset($_GET['action']))
		$action = $_GET['action'];
	else
		$action = 'form_add';
		
	function traite_form($id = null)
	{
		if ($_FILES['img']['error'] == 0 || ($_FILES['img']['error'] == 4 && $id != null))
		{
			if ($_FILES['img']['error'] == 0)
			{
				$image_sizes = getimagesize($_FILES['img']['tmp_name']);
				if ($image_sizes[0] != IMG_MAP_WIDTH OR $image_sizes[1] != IMG_MAP_HEIGHT)
				{
					echo '<div class="error">Taille de votre image : <br />Largeur : '.$image_sizes[0].'px<br />Hauteur : '.$image_sizes[1].'px<br /><br />';
					echo 'La taille de l\'image doit Ítre : <br />Largeur : '.IMG_MAP_WIDTH.'px<br />Hauteur : '.IMG_MAP_HEIGHT.'px<br /><br /></div>';
				}
				else
				{
					$dir = $_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'templates/'.$_POST['id_template'];
					$md5 = md5_file($_FILES['img']['tmp_name']);
					ereg('(.[[:alpha:]]{3})$', $_FILES['img']['name'], $ext);
					$img = $md5.$ext[1];
					if (!is_dir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH))
						mkdir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH);
					if (!is_dir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'templates/'))
						mkdir($_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'templates/');
					if (!is_dir($dir))
						mkdir($dir);
					if (move_uploaded_file($_FILES['img']['tmp_name'], $_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'templates/'.$_POST['id_template'].'/'.$img))
					{
						$o = new map_type($id);
						$o->set('nom', $_POST['nom']);
						$o->set('img', $img);
						$o->set('template_id', $_POST['id_template']);
						$o->set('depl_terrestre', $_POST['depl_terrestre']);
						$o->set('depl_aerien', $_POST['depl_aerien']);
						$o->set('depl_naval', $_POST['depl_naval']);
						$o->set('coef_depl', $_POST['coef_depl']);
						$o->save();
						unset($o);
					}
					else
					{
						echo '<div clas="error">Impossible de copier le fichier dans le rÈpertoire de destination :<br />'.$_FILES['img']['tmp_name'], $_SERVER['ARCANE_PATH'].'/'.IMG_PATH.'templates/'.$_POST['id_template'].'/'.$img.'</div>';
					}
				}
			}
			else
			{
			
				$o = new map_type($id);
				$o->set('nom', $_POST['nom']);
				$o->set('template_id', $_POST['id_template']);
				$o->set('depl_terrestre', $_POST['depl_terrestre']);
				$o->set('depl_aerien', $_POST['depl_aerien']);
				$o->set('depl_naval', $_POST['depl_naval']);
				$o->set('coef_depl', $_POST['coef_depl']);
				$o->save();
				unset($o);
			}
		}
		else
		{
			debug($_FILES['img']);
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
					<div class="ongletcadreselect">Types</div>
					<div class="ongletcadre"><a href="./admin_map.src.php">Cartes</a></div>
					<div class="ongletcadre"><a href="./admin_region.src.php">R&eacute;gions</a></div>
					<div class="ongletcadre"><a href="./admin_world.src.php">Monde</a></div>
					<div class="ongletcadre"><a href="./admin_edit_region.src.php">Editeur de rÈgion</a></div>
			</div>
			<div class="cadreaveconglet">
				<form action="./admin_type.src.php" method="post">
					<div>SÈlectionnez un template : <br />
						<select name="id_template" onChange="javascript:this.form.submit();">
							<?php
								$sel = 'selected';
								if (isset($_POST['id_template']) == false && isset($_GET['id_template']) == false)
									echo "<option $sel>Template ...</option>\n";
								$c = new database_connector();
								$data = $c->send_sql(select_templates());
								for ($n = 1; $n <= $data['count']; $n++)
								{
									if (isset($_POST['id_template']) == false && isset($_GET['id_template']) == false)
										$sel = '';
									else
									{
										if (isset($_POST['id_template']))
											$id_template = $_POST['id_template'];
										elseif (isset($_GET['id_template']))
											$id_template = $_GET['id_template'];
										if ($id_template == $data[$n]['id'])
											$sel = 'selected';
										else
											$sel = '';
									}
									echo "<option value='".$data[$n]['id']."' $sel>".$data[$n]['nom']."</option>\n";
								}
							?>
						</select>
					</div>
				</form>
				<hr />
				<?php
				
					switch ($action)
						{
							case ('edit_form'):
								$o = new map_type($_GET['id']);
								break;
							case ('edit'):
								traite_form($_POST['id']);
								$action = 'form_add';
								break;
							case ('delete'):
								$o = new map_type($_POST['id']);
								$o->delete();
								$action = 'form_add';
								break;
							case ('add'):
								$action = 'form_add';
								traite_form();
								break;
						}
					if (isset($_POST['id_template']) || isset($_GET['id_template']))
					{
						if (isset($_POST['id_template']))
							$id_template = $_POST['id_template'];
						elseif (isset($_GET['id_template']))
							$id_template = $_GET['id_template'];
						$data = $c->send_sql(select_types_by_id_template($id_template));
						if ($data['count'] == 0)
							echo 'Aucun ÈlÈment appartenant ÅEce template.<br />';
						else
						{
							for ($n = 1, $i = 1; $n <= $data['count']; $n++, $i++)
							{
								$path = return_anti_path().IMG_PATH.'templates/'.$data[$n]['Templates_id'].'/'.$data[$n]['img'];
								echo '<a href="./admin_type.src.php?action=edit_form&id='.$data[$n]['id'].'&id_template='.$id_template.'"><img src="'.$path.'" border="0" alt="'.$data[$n]['nom'].'"></a>';
								if ($i == 7)
								{
									echo "<br>\n";
									$i = 0;
								}
							}
						}
						switch ($action)
						{
							case ('edit_form'):
								echo '<form action="./admin_type.src.php" method="post" enctype="multipart/form-data"><table width="100%">
<tr><td>Nom : </td><td><input type="hidden" name="action" value="edit">
<input type="hidden" name="id_template" value="'.$id_template.'">
<input type="hidden" name="id" value="'.$o->get('id').'">
<input type="text" name="nom" value="'.$o->get('nom').'"></td></tr>
<tr><td colspan="2">Image : <br /><a href="'.$o->get('img_path').'">'.$o->get('img_path').'</a></td></tr>
<tr><td></td><td><input type="file" name="img"></td></tr>';
$chkn = '';
$chko = '';
if ($o->get('depl_terrestre') == 0)
	$chkn = 'checked';
else
	$chko = 'checked';
echo '<tr><td>DÈplacement terrestre : </td><td>	<label>Non <input type="radio" name="depl_terrestre" value="0" '.$chkn.'></label>
<label>Oui <input type="radio" name="depl_terrestre" value="1" '.$chko.'></label></td></tr>';
$chkn = '';
$chko = '';
if ($o->get('depl_aerien') == 0)
	$chkn = 'checked';
else
	$chko = 'checked';
echo '<tr><td>DÈplacement aÈrien : </td><td>	<label>Non <input type="radio" name="depl_aerien" value="0" '.$chkn.'></label>
<label>Oui <input type="radio" name="depl_aerien" value="1" '.$chko.'></label></td></tr>';
$chkn = '';
$chko = '';
if ($o->get('depl_naval') == 0)
	$chkn = 'checked';
else
	$chko = 'checked';
echo '<tr><td>DÈplacement naval : </td><td>	<label>Non <input type="radio" name="depl_naval" value="0" '.$chkn.'></label>
<label>Oui <input type="radio" name="depl_naval" value="1" '.$chko.'></label></td></tr>
<tr><td>CoÈfficient de dÈplacement : </td><td><input type="text" name="coef_depl" value="'.$o->get('coef_depl').'"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Modifier"></td></tr>
								</table></form>
								<form action="./admin_type.src.php" method="post"><input type="hidden" name="action" value="delete">
<input type="hidden" name="id_template" value="'.$id_template.'">
<input type="hidden" name="id" value="'.$o->get('id').'"><table width="100%">
								<tr><td align="center"><input type="submit" value="Effacer"></td></tr>
								</table>
								</form>';
								break;
							case ('form_add'):
								?>
								<form action="./admin_type.src.php" method="post" enctype="multipart/form-data"><table width="100%">
									<tr><td>Nom : </td><td><input type="hidden" name="action" value="add">
																					<input type="hidden" name="id_template" value="<?php echo $id_template; ?>">
																					<input type="text" name="nom"></td></tr>
									<tr><td>Image : </td><td><input type="file" name="img"></td></tr>
								<tr><td>DÈplacement terrestre : </td><td>	<label>Non <input type="radio" name="depl_terrestre" value="0" checked></label>
																													<label>Oui <input type="radio" name="depl_terrestre" value="1"></label></td></tr>
									<tr><td>DÈplacement aÈrien : </td><td>	<label>Non <input type="radio" name="depl_aerien" value="0" checked></label>
																														<label>Oui <input type="radio" name="depl_aerien" value="1"></label></td></tr>
									<tr><td>DÈplacement naval : </td><td>	<label>Non <input type="radio" name="depl_naval" value="0" checked></label>
																														<label>Oui <input type="radio" name="depl_naval" value="1"></label></td></tr>
									<tr><td>CoÈfficient de dÈplacement : </td><td><input type="text" name="coef_depl"></td></tr>
									<tr><td colspan="2" align="center"><input type="submit" value="Ajouter"></td></tr>
								</table></form>
								<?php
								break;
						}
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