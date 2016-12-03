
<h2>Rechercher :</h2>
<form action="" method="post" >

Login : <input type="text" id="searchLogin"  /> <input type="submit" value="Rechercher"  /> <br />
<input type="hidden" id="actionSearch" value="1"  />
<i>Utiliser le '*' comme jocker</i>

</form>

<?php

if(isset($_REQUEST['actionSearch']))
{
	if($_REQUEST['searchLogin'] != '')
	{
		echo '<h2>Resultat :</h2>';
		
		$searchLine = str_replace('*','%',$_REQUEST['searchLogin']);
		$query = "SELECT u.id, u.login, u.race, uc.lvl * FROM users u, users_caracts uc WHERE u.id = uc.id_user AND u.login LIKE '".$searchLine."';";
		$c = new database_connector();
		$data = $c->send_sql($query );
		print_r($data);
		if ($data['count'] > 0)
		{
			echo '<div style="float:left; width:33%">Login</div>';
			echo '<div style="float:left; width:33%">Race</div>';
			echo '<div style="float:left; width:33%">lvl</div>';
			echo '<div style="clear:both;"></div>';
			for($i = 1; $i <= $data['count']; $i++)
			{
				echo '<div style="float:left; width:33%">'.$data[$i]['login'].'</div>';
				echo '<div style="float:left; width:33%">'.$data[$i]['race'].'</div>';
				echo '<div style="float:left; width:33%">'.$data[$i]['lvl'].'</div>';
				echo '<div style="clear:both;"></div>';
			}
		}		
	}
}
?>