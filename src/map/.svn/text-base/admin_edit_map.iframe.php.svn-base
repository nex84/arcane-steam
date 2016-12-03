<?php
	require_once('../../includes/functions.inc.php');
	$anti_path = return_anti_path();
	require_once($anti_path.'includes/constant.inc.php');
	require_once($anti_path.'includes/request.sql.php');
	
?>
<script language="Javascript">
	function change_checkbox(id, chk)
	{
		chk_parent = window.parent.document.getElementById(id);
		chk_parent.checked  = chk.checked;
	}
</script>

<?php
	
	
	if (isset($_GET['id_region']) )
	{
		echo '<input type="hidden" name="type" id="type" value="">';
		unset($region);
		$region = new map_region_editor($_GET['id_region']);
		for ($y = 1; $y <= $region->get('height'); $y++)
		{
			$pos_y = ($y - 1) * IMG_MAP_HEIGHT;
			for ($x = 1; $x <= $region->get('width'); $x++)
			{
				$pos_x = ($x - 1) * IMG_MAP_WIDTH;
				echo '<div style="
				background-image:url('.$region->cases[$x][$y]->type->get('img_path').');
	top:'.$pos_y.'px;
	left:'.$pos_x.'px; position: absolute;
	vertical-align: middle;
	text-align: center;
	width: 40px;
	height: 40px;"><input type="checkbox" name="cases['.$x.']['.$y.']" id="'.$region->cases[$x][$y]->type->get('nom').'" onclick="javascript:change_checkbox(\''.$region->cases[$x][$y]->get('id').'\', this);"></div>';
			}
		}
	}
?>