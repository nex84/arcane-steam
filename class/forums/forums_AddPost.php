<?php
	require_once('includes/constant.inc.php');
	require_once('includes/functions.inc.php');
	require_once('includes/request.sql.php');
	require_once('class/forums/forums.class.php');
$u = new forums();

if(isset($_REQUEST['titre']) && isset($_REQUEST['post']))
{
	if($_REQUEST['titre'] != "" && $_REQUEST['post'] != "")
	{
		$data = $u->addPost(addslashes($_REQUEST['idForums']), $_SESSION['id'], $_REQUEST['titre'] );
		if($data['count'] > 0)
		{
			$idPost = $data[1]["id"];
			$u->addMessage($idPost, $_SESSION['id'], $_REQUEST['post'] );
			
			header('Location: http://www.arcane-steam.com/?action=forum');
		}
	}
}


echo '<h1>Les forums</h1>';
echo '<br /><br />';
echo 'Bienvenus sur les forums d\'Arcane steam !<br /><br />';

echo '<ul>';

$data = $u->getLink(addslashes($_REQUEST['idForums']));
$index = $data['count'];
for($i = 1; $i <= $index; $i++)
{
	echo '<h1 class="sectionForums"><a href="?action">'. $data[$i]['secNom'].'</a> > <a href="?idForums=' . $data[$i]['catId'] . '">'. $data[$i]['catNom'].'</a> </h1>';//TODO passer en lien 
}
$idPosst = $_REQUEST['idForums'];

if(isset($_SESSION['id']))
{
?>
<form action="" method="post" name="add" id="add" >
Titre du post : <br />
<input type="text" id="titre" name="titre" width="300" maxlength="50" />
<br /><br />
Message (le BBCode est actif.) :  <br />
<textarea id="post" name="post" cols="50">

</textarea>
<br /><br />
<input type="submit" value="Poster" />
</form>
<?php
}
else
{
	
	echo '<h2>Identifiez vous</h2>';
	
	if ($error != "")
	{
		echo '
		<div class="clear"></div>
		<div id="Error">
		'.$error .'
		</div>
		<div class="clear"></div>
		<br />
		';
	}
	
	echo '<form action="" method="post" name="frm">';
	echo '<p>Login :</p>';
	echo '<input type="text" name="login" class="s" /><br />';
	echo '<p>Mot de passe :</p>';
	echo '<input type="password" name="password" class="s" /><br /><br />';
	echo '<!--Recopier le code :<br />';
	echo '<input type="text" name="code" class="s"><br /><br />-->';
	echo '<input type="hidden" name="sub" value="1" />';
	echo '<input type="submit" name="Submit" class="s" value="Login" /><br /><br />';
    echo ' </form>';
}


echo '<hr />';
echo '<a href="?action=createPost&amp;idForums='.$_REQUEST['idForums'].'" class="button"> Crée un post </a>';
echo '<div class="clear"></div>';
?>
<br /><br />