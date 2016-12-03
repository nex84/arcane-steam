<?php
	require_once('../../includes/functions.inc.php');
	$anti_path = return_anti_path();
	require_once($anti_path.'includes/constant.inc.php');
	require_once($anti_path.'includes/request.sql.php');
	
	if (isset($_POST['action']))
		$action = $_POST['action'];
	else
		$action = 'form_add';
		
	function alter_cases_region($id_type, $cases, $id_region)
	{
		$region = new map_region_editor($id_region);
		foreach ($cases as $x => $tab)
		{
			foreach ($tab as $y => $val)
			{
				unset($region->cases[$x][$y]->type);
				$region->cases[$x][$y]->type = new map_type($id_type);
				$region->cases[$x][$y]->save();
			}
		}
		unset($region);
	}
	
	if (isset($_POST['id_type']) && isset($_POST['cases']) && isset($_POST['id_region']))
	{
		alter_cases_region($_POST['id_type'], $_POST['cases'], $_POST['id_region']);
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
					<div class="ongletcadre"><a href="./admin_map.src.php">Carte</a></div>
					<div class="ongletcadre"><a href="./admin_region.src.php">R&eacute;gions</a></div>
					<div class="ongletcadre"><a href="./admin_world.src.php">Monde</a></div>
					<div class="ongletcadreselect">Editeur de région</div>
			</div>
			<div class="cadreaveconglet">Choisissez la région : 
				<form action="./admin_edit_region.src.php" method="post">
					<select name="id_map" onChange="javascript:this.form.submit();">
					<?php
						$db = new database_connector();
						$data = $db->send_sql(select_map());
						for ($n = 1; $n <= $data['count']; $n++)
						{
							$map = $data[$n];
							$sel = '';
							if (isset($_POST['id_map']))
							{
								if ($_POST['id_map'] == $map['id'])
									$sel = 'selected';
							}
							elseif ($n == 1)
								$_POST['id_map'] = $map['id'];
							echo '<option value="'.$map['id'].'" '.$sel.'>'.$map['nom'].'</option>';
						}
					?>
					</select>
					<input type="hidden" name="old_id_map" value="<?php echo $_POST['id_map']; ?>">
					<select name="id_region" onChange="javascript:this.form.submit();">
                    <option value="" >-----------</option>
					<?php
						if (isset($_POST['old_id_map']))
						{
							if($_POST['id_map'] != $_POST['old_id_map'])
								unset($_POST['id_region']);
						}
						$db = new database_connector();
						$data = $db->send_sql(select_regions_by_id_map($_POST['id_map']));
						for ($n = 1; $n <= $data['count']; $n++)
						{
							$region = $data[$n];
							$sel = '';
							if (isset($_POST['id_region']))
							{
								if ($_POST['id_region'] == $region['id'])
									$sel = 'selected';
							}
							elseif ($n == 1)
								$_POST['id_region'] = $region['id'];
							echo '<option value="'.$region['id'].'" '.$sel.'>'.$region['nom'].'</option>';
						}
					?>
					</select>
				</form>
				<hr />
				<?php
				if (isset($_POST['id_region']) )
				{
					unset($region);
					$region = new map_region_editor($_POST['id_region']);
					$largeur = $region->get('width') * 40;
					$hauteur = $region->get('height') * 40;
					$db = new database_connector();
					$data = $db->send_sql(select_types_by_id_template($region->template->get('id')));
					//Affichage des types de terrain pour le template de la région
					echo '<form action="./admin_edit_region.src.php" method="post">
					<input type="hidden" name="id_region" value="'.$_POST['id_region'].'">
					<input type="hidden" name="id_map value="'.$_POST['id_map'].'">
					<table cellspacing="0" cellpadding="0">';
					$n = 1;
					while ($n <= $data['count'])
					{
						echo '<tr>';
						for ($i = $n; $i <= $data['count'] && $i - $n <= 10; $i++)
						{
							unset($type);
							$type = new map_type($data[$i]['id']);
							echo '<td><img src="'.$type->get('img_path').'" border="0" alt="'.$type->get('nom').'"></td>';
						}
						echo '</tr>';
						echo '<tr>';
						for ($i = $n; $i <= $data['count'] && $i - $n <= 10; $i++)
						{
							unset($type);
							$type = new map_type($data[$i]['id']);
							$chk = '';
							if (isset($_POST['id_type']))
							{
								if ($_POST['id_type'] == $type->get('id'))
									$chk = 'checked';
							}
							elseif ($i == 1)
								$chk = 'checked';
							echo '<td align="center"><input type="radio" name="id_type" value="'.$type->get('id').'" onclick="javascript:change_type(this);" '.$chk.'></td>';
						}
						echo '</tr>';
						$n = $n + 10;
					}
					echo '</table>';
					echo '<div class="hidden">';
					for ($y = 1; $y <= $region->get('height'); $y++)
					{
						for ($x = 1; $x <= $region->get('width'); $x++)
						{
							echo '<input type="checkbox" name="cases['.$x.']['.$y.']" id="'.$region->cases[$x][$y]->get('id').'">';
						}
					}
					echo '</div>';
				}
				?>
			</div>
			<?
        		require_once("../footer.php");
			?><br /><br />
			<input type="submit" value="Modifier">
			<div>
			<?php
			if (isset($_POST['id_region']) )
			{
				echo '<iframe name="framemap" scrolling="0" width="'.$largeur.'px" height="'.$hauteur.'px" frameborder="0" src="./admin_edit_map.iframe.php?id_region='.$_POST['id_region'].'">
					</iframe>';
				echo '<input type="submit" value="Modifier">';
				echo '</form>';
			}
			?>
			</div>
		</div>
	</body>
</html>
