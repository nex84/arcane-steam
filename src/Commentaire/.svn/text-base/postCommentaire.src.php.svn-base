<?php

if(isset($_SESSION['id']))
{
	echo '<h2>Poster un commentaire</h2>';
	
	echo '<form action="" method="post" name="frm">';
	echo '<textarea id="textNouvelle" name="textNouvelle" rows="5" cols="50" ></textarea><br /><br />';
	echo '<input type="hidden" name="subComment" value="1" />';
	echo '<input type="submit" name="Submit" class="s" value="Envoyez" /><br /><br />';
    echo '</form>';
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


?>