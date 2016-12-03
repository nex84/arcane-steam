<?php

	function count_nb_type_by_template($id_template)
	{
		$sql = "SELECT count(ty.id) as count FROM templates te, types ty WHERE ty.Templates_id = te.id AND te.id=".$id_template;
		return ($sql);
	}
	
	function count_nb_regions_by_map($id)
	{
		$sql = "SELECT count(r.id) as count FROM map m, regions r WHERE m.id = r.Map_id AND m.id=".$id;
		return ($sql);
	}
	//TEMPLATES
	function select_templates()
	{
		$sql = 'SELECT * FROM `templates` ORDER BY id';
		return ($sql);
	}
	
	function select_templates_by_id($id)
	{
		$sql = 'SELECT * FROM `templates` WHERE id=' . $id;
		return ($sql);
	}
	
	function insert_templates($nom)
	{
		$sql = "INSERT INTO `templates` VALUE ('', '$nom')";
		return ($sql);
	}
	
	function update_templates($id, $nom)
	{
		$sql = "UPDATE `templates` SET nom='$nom' WHERE id=$id";
		return ($sql);
	}
	
	function delete_templates($id)
	{
		$sql = 'DELETE FROM `templates` WHERE id=' . $id;
		return ($sql);
	}
	//FIN TEMPLATES
	
	//TYPES
	function select_types()
	{
		$sql = 'SELECT * FROM `types` ORDER BY id';
		return ($sql);
	}
	
	function select_types_by_id($id)
	{
		$sql = 'SELECT * FROM `types` WHERE id=' . $id;
		return ($sql);
	}
	
	function select_types_by_id_template($id)
	{
		$sql = 'SELECT * FROM `types` WHERE Templates_id=' . $id;
		return ($sql);
	}
	
	function insert_types($t_id, $nom, $img, $depl_terrestre, $coef_depl, $depl_aerien, $depl_naval)
	{
		$sql = "INSERT INTO `types` VALUE ('', $t_id, '$nom', '$img', '$depl_terrestre', '$coef_depl', '$depl_aerien', '$depl_naval')";
		return ($sql);
	}
	
	function update_types($id, $nom, $img, $depl_terrestre, $coef_depl, $depl_aerien, $depl_naval)
	{
		$sql = "UPDATE `types` SET
												nom='$nom',
												img='$img',
												depl_terrestre='$depl_terrestre',
												coef_depl='$coef_depl',
												depl_aerien='$depl_aerien',
												depl_naval='$depl_naval'
											WHERE id=$id";
		return($sql);
	}
	
	function delete_types($id)
	{
		$sql = 'DELETE FROM `types` WHERE id=' . $id;
		return ($sql);
	}
	//FIN TYPE
	
	//CASES
	function select_cases()
	{
		$sql = 'SELECT * FROM `cases` ORDER BY id';
		return ($sql);
	}
	
	function select_cases_by_id($id)
	{
		$sql = 'SELECT * FROM `cases` WHERE id=' . $id;
		return ($sql);
	}
	
	function select_cases_by_id_region($id)
	{
		$sql = 'SELECT * FROM `cases` WHERE Regions_id=' . $id;
		return ($sql);
	}
	
	function insert_cases($id_type, $id_region, $x, $y)
	{
		$sql = "INSERT INTO `cases` VALUE ('', $id_type, $id_region, $x, $y)";
		return ($sql);
	}
	
	function update_cases($id, $x, $y, $id_type)
	{
		$sql = "UPDATE `cases` SET x=$x, y=$y, Types_id=$id_type WHERE id=$id";
		return ($sql);
	}
	
	function delete_cases($id)
	{
		$sql = 'DELETE FROM `cases` WHERE id=' . $id;
		return ($sql);
	}
		function delete_Allcases($id)
	{
		$sql = 'DELETE FROM `cases` WHERE Regions_id=' . $id;
		return ($sql);
	}
	//FIN CASES
	
	//MAPS
	function select_map()
	{
		$sql = 'SELECT * FROM `map` ORDER BY id';
		return ($sql);
	}
	
	function select_map_by_id($id)
	{
		$sql = 'SELECT * FROM `map` WHERE id=' . $id;
		return ($sql);
	}
	
	function insert_map($nom, $img)
	{
		$sql = "INSERT INTO `map` VALUE ('', '$nom', '$img')";
		return ($sql);
	}
	
	function update_map($id, $nom, $img)
	{
		$sql = "UPDATE `map` SET nom='$nom', img='$img' WHERE id=$id";
		return ($sql);
	}
	
	function delete_map($id)
	{
		$sql = 'DELETE FROM `map` WHERE id=' . $id;
		return ($sql);
	}
	//FIN MAPS
	
	//REGIONS
	function select_distinct_Z_from_map($map_id)
	{
		$sql = "SELECT DISTINCT pos_z FROM `regions` WHERE Map_id=$map_id";
		return ($sql);
	}
	
	function select_region_with_pos($x, $y, $z, $map_id)
	{
		$sql = "SELECT * FROM `regions` WHERE pos_x=$x AND pos_y=$y AND pos_z=$z AND Map_id=$map_id";
		return ($sql);
	}
	
	function select_region_with_pos_z($z, $map_id)
	{
		$sql = "SELECT * FROM `regions` WHERE pos_z=$z AND Map_id=$map_id";
		return ($sql);
	}
	
	function select_regions()
	{
		$sql = 'SELECT * FROM `regions` ORDER BY id';
		return ($sql);
	}
	
	function select_regions_by_id($id)
	{
		$sql = 'SELECT * FROM `regions` WHERE id=' . $id;
		return ($sql);
	}
	
	function select_regions_by_id_map($id)
	{
		$sql = 'SELECT * FROM `regions` WHERE Map_id=' . $id;
		return ($sql);
	}
	
	function insert_regions($t_id, $m_id, $nom, $img, $pos_x, $pos_y, $pos_z, $width, $heigth)
	{
		$sql = "INSERT INTO `regions` VALUE ('', $m_id, $t_id, '$nom', $pos_x,  $pos_y, $pos_z, $width, $heigth, '$img')";
		return ($sql);
	}
	
	function update_regions($id, $nom, $img, $pos_x, $pos_y, $pos_z, $width, $heigth, $map_id, $template_id)
	{
		$sql = "UPDATE `regions` SET
												nom='$nom',
												img='$img',
												pos_x=$pos_x,
												pos_y=$pos_y,
												pos_z=$pos_z,
												width=$width,
												heigth=$heigth,
												Map_id=$map_id,
												Templates_id=$template_id
											WHERE id=$id";
		return ($sql);
	}
	
	function delete_regions($id)
	{
		$sql = 'DELETE FROM `regions` WHERE id=' . $id;
		return ($sql);
	}
	//FIN REGIONS
	
	//DEBUT INVENTAIRE
		function select_objets($type, $search)
	{
		$search = str_replace('*','%',$search);
		//$sql = "SELECT * FROM `objets` WHERE typ='". $type ."' AND nom LIKE '%". $search ."%' ORDER BY nom ASC";
		$sql = "SELECT * FROM `objets` WHERE( typ='". $type ."' OR '". $type ."'='0') AND nom LIKE '%". $search ."%' ORDER BY nom ASC";
		return ($sql);
	}

		function select_exist($nom)
	{
		$sql = "SELECT * FROM `objets` WHERE nom='".$nom."'";
		return ($sql);
	}
	
		function select_exist_type($nom)
	{
		$sql = "SELECT nom_type FROM `objets_types` WHERE nom_type='".$nom."'";
		return ($sql);
	}	
	
		function select_types_objets()
	{
		//$sql = 'SELECT DISTINCT typ FROM objets ORDER BY typ ASC';
		$sql = 'SELECT nom_type FROM objets_types ORDER BY nom_type ASC';
		return ($sql);
	}
	
		function select_types_objets2()
	{
		$sql = 'SELECT id, nom_type FROM objets_types ORDER BY nom_type ASC';
		return ($sql);
	}
	
	function insert_objets($type, $nom, $description, $prix, $poids, $attaque, $CA, $mana, $modifForce, $modifCA, $modifDext, $modifSagesse)
	{
		$sql = "INSERT INTO `objets` (typ, nom, description, prix, poids, attaque, CA, mana, image, modifForce, modifCA, modifDext, modifSagesse) VALUES ('$type', '$nom', '$description', $prix, $poids, $attaque, $CA, $mana, '', $modifForce, $modifCA, $modifDext, $modifSagesse)";
		return ($sql);
	}
	
	function suppr_objets($id)
	{
		$sql = "DELETE FROM `objets` WHERE id=" . $id;
		return ($sql);
	}
	
	
	function update_objets($id, $type, $nom, $description, $prix, $poids, $attaque, $CA, $mana, $modifForce, $modifCA, $modifDext, $modifSagesse)
	{
		$sql = "UPDATE `objets` SET 
									typ = '$type',
									nom = '$nom',
									description = '$description',
									prix = $prix,
									poids = $poids,
									attaque = $attaque,
									CA = $CA,
									mana = $mana,
									image = '',
									modifForce = $modifForce,
									modifCA = $modifCA,
									modifDext = $modifDext,
									modifSagesse = $modifSagesse
								WHERE id = $id";
		return ($sql);
	}
	
	function add_type_objet($nom)
	{
		
		$sql = "INSERT INTO `objets_types` SET nom_type = '".$nom."'";
		return ($sql);
	}
		
	function delete_type_objet($id)
	{
		update_before_delete($id);
		$sql = "DELETE FROM `objets_types` WHERE id='" . $id ."';";
		return ($sql);
	}
	
	
		
	//FIN INVENTAIRE
	
	//DEBUT INSCRIPTION
	
	function select_alignements()
	{
		$sql = "SELECT nom, code_align FROM Alignement;";
		return ($sql);
	}
	
	//FIN INSCRIPTION
	
?>