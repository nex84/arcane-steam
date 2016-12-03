<h2> Messagerie </h2>
<div style="float:left; width:10px;">&nbsp;</div>
<div style="float:left; width:250px;">Objet du message </div>
<div style="float:left; width:100px;">Expediteur </div>
<div style="clear:both;"></div>
<hr />
<?php
	require_once('../../class/Messagerie/box.class.php');
	$donne['id'] = $_SESSION["id"];
	$donne['nom'] = $u->get_login();
	
	$c = new box();
	$c->getAllMessageInBox($donne);
	
	$mail = $c->getData();
	if($mail['count'] > 0)
	{
		for($i = 1; $i <= $mail['count']; $i++)
		{
			echo '<div style="float:left; width:10px;padding-top:3px;"><img src="../Jeux/images/unread.png" alt="unread" /> </div>';
			echo '<div style="float:left; width:250px;padding-left:5px;">'.$mail[$i]['titre'].'</div>';
			echo '<div style="float:left; width:100px;padding-left:5px;">'.$mail[$i]['login'].' </div>';
			echo '<div style="clear:both;"></div>';
			echo '<hr />';
		}
	}
	
	
?>




