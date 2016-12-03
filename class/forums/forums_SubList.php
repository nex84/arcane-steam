<?php
	require_once('includes/constant.inc.php');
	require_once('includes/functions.inc.php');
	require_once('includes/request.sql.php');
	require_once('class/forums/forums.class.php');
$u = new forums();



echo '<h1>Les forums</h1>';
echo '<br /><br />';
echo 'Bienvenus sur les forums d\'Arcane steam !<br /><br />';

echo '<ul>';

$data = $u->getLink(addslashes($_REQUEST['idForums']));
$index = $data['count'];
for($i = 1; $i <= $index; $i++)
{
	echo '<h1 class="sectionForums">'. $data[$i]['secNom'].' > '. $data[$i]['catNom'].'</h1>';//TODO passer en lien 
}


$data = $u->getListSubject(addslashes($_REQUEST['idForums']));
$index = $data['count'];

for($i = 1; $i <= $index; $i++)
{
	echo '<li>'.$data[$i]['Titre'].'</li>';
}

if($index == 0)
	echo 'Aucun post.';
echo '</ul>';
echo '<hr />';
echo '<a href="?action=createPost&amp;idForums='.$_REQUEST['idForums'].'" class="button"> Crée un post </a>';
echo '<div class="clear"></div>';
?>
<br /><br />