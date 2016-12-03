<?php
	require_once('includes/constant.inc.php');
	require_once('includes/functions.inc.php');
	require_once('includes/request.sql.php');
	require_once('class/forums/forums.class.php');
$u = new forums();

$data = $u->getListSection(1);
$index = $data['count'];

echo '<h1>Les forums</h1>';
echo '<br /><br />';
echo 'Bienvenus sur les forums d\'Arcane steam !<br /><br />';

echo '<ul>';

for($i = 1; $i <= $index; $i++)
{
	echo '<li><h1 class="sectionForums">' . $data[$i]['nom'] . '</h1>';
	$data2 = $u->getListCategorie(1, $data[$i]['id']);
	$index2 = $data2['count'];
	echo '<ul>';
	for($j = 1; $j <= $index2; $j++)
	{
		$nPost = 0;
		if($data2[$j]['nbPost'] != '')
			$nPost = $data2[$j]['nbPost'];
			
		echo '<li><a href="?idForums='. $data2[$j]['id'].'">' . $data2[$j]['nom'] . ' - '. $nPost .' post(s)</a></li>';
	}
	echo '</ul></li>';
}

echo '</ul>';


?>