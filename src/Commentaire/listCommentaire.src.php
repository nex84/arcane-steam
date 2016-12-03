<?php
/*
session_start();
ob_start();
require_once('./includes/functions.inc.php');
$anti_path = return_anti_path();
//include $anti_path.'database/database_connector.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');
*/

if(isset($idNewsToComment))
{

	if(isset($_REQUEST['commentToWarn']))
	{
		if(isset($_SESSION['id']))
		{
			$u = new joueur_data($_SESSION["id"],'caracts_now');
			if($u->get_isAdm() > 0)
			{
				$c = new database_connector();
				$data = $c->send_sql("UPDATE news_comment SET isModerate=1 WHERE id='".addslashes($_REQUEST['commentToWarn'])."';");
			}
		}
	}
	
	$c = new database_connector();
	$data = $c->send_sql("SELECT n.id, n.idNews, n.Date, n.commentaire, n.isModerate, n.idUsers, u.login, u.adm FROM news_comment n, users u WHERE n.idNews = '".$idNewsToComment."' AND n.idUsers = u.id ORDER BY n.id ASC;");
	if ($data['count'] > 0)
	{
		echo '<h2>Commentaire &lt;'.$data['count'].'&gt;</h2>';
		for($i = 1; $i <= $data['count']; $i++)
		{
			echo '<table width="100%" cellpadding="0" cellspacing="0" style="">';
			echo '	<tr class="td_titre">';
			echo '		<td>';
			echo '<a href="./?action=seeUser&amp;idUser='.$data[$i]['idUsers'].'" class="grey">'.$data[$i]['login'].'</a> - '.$data[$i]['Date'].'';
			echo '		</td>		';
			echo '		<td width="50px">';
			if(isset($_SESSION['id']))
			{
				$u = new joueur_data($_SESSION["id"],'caracts_now');
					if($u->get_isAdm() > 0)
					{
							echo'<a href="./?action=seeNews&amp;idNews='.$idNewsToComment.'&amp;commentToWarn='.$data[$i]['id'].'"><img src="./images/warning.gif" alt="moderation" style="border:none;" /></a>';
					}
			}
			else
			{
				echo '&nbsp;';
			}
			echo '		</td>';
			echo '	</tr>';
			echo '	<tr class="td_ligne">';
			echo '		<td colspan="2">';
			if($data[$i]['isModerate'] == 1)
			{
				echo '<i>Ce commentaire a &eacute;t&eacute; moderer...</i>';
			}
			else
			{
				if($data[$i]['adm'] == 1)
					echo '<span style="color:#ff9900 !IMPORTANT;">'.stripslashes($data[$i]['commentaire']).'</span>';
				else
					echo ''.stripslashes($data[$i]['commentaire']).'';
			}
			echo '		</td>';
			echo '	</tr>';
			echo '</table><br/>';
		}
	}
	else
	{
		echo '<h2>Commentaire </h2>';
		echo '<p>Aucun commentaire pour le moment, soyez les premiers a r&eacute;agire.</p>';
	}
}				
			
?>


