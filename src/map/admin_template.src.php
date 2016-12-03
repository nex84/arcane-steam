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
					<div class="ongletcadreselect">Templates</div>
					<div class="ongletcadre"><a href="./admin_type.src.php">Types</a></div>
					<div class="ongletcadre"><a href="./admin_map.src.php">Cartes</a></div>
					<div class="ongletcadre"><a href="./admin_region.src.php">R&eacute;gions</a></div>
					<div class="ongletcadre"><a href="./admin_world.src.php">Monde</a></div>
					<div class="ongletcadre"><a href="./admin_edit_region.src.php">Editeur de rÈgion</a></div>
			</div>
			<div class="cadreaveconglet">Liste des templates existants :<br />
				<?php
					switch ($action)
						{
							case ('edit_form'):
								$o = new map_template($_POST['id']);
								break;
							case ('edit'):
								$o = new map_template($_POST['id']);
								$o->set('nom', $_POST['nom']);
								$o->save();
								$action = 'form_add';
								break;
							case ('add'):
								if (trim($_POST['nom']) != '')
								{
									$o = new map_template();
									$o->set('nom', $_POST['nom']);
									$o->save();
								}
								$action = 'form_add';
								break;
							case ('delete'):
								$o = new map_template($_POST['id']);
								$o->delete();
								break;
						}
					$c = new database_connector();
					$data = $c->send_sql(select_templates());
					echo '<table width="100%">';
					for ($n = 1; $n <= $data['count']; $n++)
					{
						echo '<tr><td>'.$data[$n]['nom']."</td>\n";
						echo "<td>
							<form action='./admin_template.src.php' method='post'><div>
							<input type='hidden' name='action' value='edit_form'>
							<input type='hidden' name='id' value='".$data[$n]['id']."'>
							<input type='submit' value='Modifier'></div></form></td>\n";
						$test = $c->send_sql(count_nb_type_by_template($data[$n]['id']));
						if ($test[1]['count'] == 0)
						{
							echo "<td>
							<form action='./admin_template.src.php' method='post'><div>
							<input type='hidden' name='action' value='delete'>
							<input type='hidden' name='id' value='".$data[$n]['id']."'>
							<input type='submit' value='Effacer'></div></form></td>\n";
						}
						else
							echo "<td>Ce template est utilisÅEpar ".$test[1]['count']." types, impossible de l'effacer</td><br />\n";
						
						echo "</tr>\n";
					}
					echo '</table>';
				?>
				<hr />
				<?php
				
				if ($action != 'edit_form')
				{
				?>
				<form action="./admin_template.src.php" method="post"><div>
					<input type="hidden" name="action" value="add" />
						Nouveau template : <br />
					<input type="text" name="nom" />
					<input type="submit" value="CrÈer" /></div>
				</form>
				<?php
				}
				else
				{
					echo '<form action="./admin_template.src.php" method="post"><div>
					<input type="hidden" name="action" value="edit" />
					<input type="hidden" name="id" value="'. $o->get('id') .'" />
						Modifier le template : <br />
					<input type="text" name="nom" value="'. $o->get('nom') .'" />
					<input type="submit" value="Modifier" /></div>
				</form>';
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
