<?php
	require_once('../../includes/functions.inc.php');
	$anti_path = return_anti_path();
	require_once($anti_path.'includes/constant.inc.php');
	require_once($anti_path.'includes/request.sql.php');
	
	if (isset($_POST['action']))
		$action = $_POST['action'];
	else
		$action = 'form_add';
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
					<div class="ongletcadreselect">Monde</div>
					<div class="ongletcadre"><a href="./admin_edit_region.src.php">Editeur de région</a></div>
			</div>
			<div class="cadreaveconglet">Choisissez le monde : 
				<form action="./admin_world.src.php" method="post">
					<select name="id_map">
					<?php
						$db = new database_connector(true);
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
							echo '<option value="'.$map['id'].'" '.$sel.'>'.$map['nom'].'</option>';
						}
					?>
					</select>
					<input type="submit" value="Voir">
				</form>
				<hr />
				<?php
				if (isset($_POST['id_map']))
				{
					$data = $db->send_sql(select_distinct_Z_from_map($_POST['id_map']));
					echo 'Niveau :<form action="./admin_world.src.php" method="post">
					<input type="hidden" name="id_map" value="'.$_POST['id_map'].'">
					<select name="z" onchange="javascript:this.form.submit();">';
					for ($n = 1; $n <= $data['count']; $n++)
					{
						$axe = $data[$n];
						$sel = '';
						if (isset($_POST['z']))
						{
							if ($_POST['z'] == $axe['pos_z'])
								$sel = 'selected';
						}
						elseif ($n == 1)
						{
							$_POST['z'] = $axe['pos_z'];
							$sel = 'selected';
						}
						echo '<option value="'.$axe['pos_z'].'" '.$sel.'>'.$axe['pos_z'].'</option>';
					}
					echo '</select>
					</form>';
					if (isset($_POST['z']))
					{
						$min_x = null;
						$max_x = null;
						$min_y = null;
						$max_y = null;
						$data = $db->send_sql(select_region_with_pos_z($_POST['z'], $_POST['id_map']));
						for ($n = 1; $n <= $data['count']; $n++)
						{
							$r = $data[$n];	
							$region[$r['pos_x']][$r['pos_y']] = $r;
						}
						$calage_page_y = 200;
						$calage_page_x = 50;
						foreach ($region as $y => $region2)
						{
							foreach($region2 as $x => $r)
							{
								$pos_y = $y * 76 + $calage_page_y;
								$pos_x = $x * 76 + $calage_page_x;
								$style = "background: white; border: 1px solid black; width: 75px; height: 75px; position: absolute; top: ".$pos_y."px; left: ".$pos_x."px;";
								echo '<span style="'.$style.'">'.$r['nom'].'<br />{'.$r['pos_x'].';'.$r['pos_y'].'}</span>';
							}
						}
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