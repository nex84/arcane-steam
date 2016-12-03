

<table border="0" width="550" cellpadding="0" cellspacing="0">

<?
@session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

$vue_JOUEUR = 4; 
$x_JOUEUR = 0;
$y_JOUEUR = 0;
$z_JOUEUR = 0;
$region_JOUEUR = "";

$id_JOUEUR = $_REQUEST['joueur_id'];

//Rapatriment X Y Z REGION Users
$sql_vus = "SELECT users_position.*, users.login, users.id, users.sprite FROM users_position, users WHERE  users.id =  users_position.id_user AND id_user = ".$id_JOUEUR;
$c = new database_connector();
$data3 = $c->send_sql($sql_vus);
if ($data3['count'] == 1)
{
	$x_JOUEUR =  $data3[1]['x'];
	$y_JOUEUR =  $data3[1]['y'];
	$z_JOUEUR =  $data3[1]['z'];
	$region_JOUEUR =  $data3[1]['region'];
}


$sql = "SELECT users.login, users.sprite,users.id , users_position.x, users_position.y, users_position.z, users_position.region FROM users, users_position WHERE users_position.z <> 0 AND users.actif = 1 AND users.id = users_position.id_user AND  users_position.x between ".($x_JOUEUR - $vue_JOUEUR)." and ".($x_JOUEUR + $vue_JOUEUR)." AND ";
$sql.=  "users_position.y between ".($y_JOUEUR - $vue_JOUEUR)." and ".($y_JOUEUR + $vue_JOUEUR)." AND ";
$sql.=  "users_position.z between ".($z_JOUEUR - $vue_JOUEUR)." and ".($z_JOUEUR + $vue_JOUEUR)." AND ";
$sql.=  " users_position.id_user <> " . $data3[1]['id'];

$s = "SELECT n.nom, n.sprite , n.id, np.x, np.y, np.z FROM npc_mob n, npc_mob_position np WHERE n.id = np.id_npc AND np.z <>0";
$s.= " AND  np.x between ".($x_JOUEUR - $vue_JOUEUR)." and ".($x_JOUEUR + $vue_JOUEUR)." AND ";
$s.=  "np.y between ".($y_JOUEUR - $vue_JOUEUR)." and ".($y_JOUEUR + $vue_JOUEUR)." AND ";
$s.=  "np.z between ".($z_JOUEUR - $vue_JOUEUR)." and ".($z_JOUEUR + $vue_JOUEUR)." ";

$data2 = $c->send_sql($s);
$data = $c->send_sql($sql);
for($i = 1; $i <= $data['count']; $i++)
{
	
	$data[$i]['is'] = 'PJ';
}

$cmp = $data['count'];
$data['count'] += $data2['count'];

for($i = $cmp + 1; $i <= ($data['count'] ); $i++)
{
	$data[$i]['y'] = $data2[($i - $cmp)]['y'];
	$data[$i]['x'] = $data2[($i - $cmp)]['x'];
	$data[$i]['z'] = $data2[($i - $cmp)]['z'];
	
	$data[$i]['login'] = $data2[($i - $cmp) ]['nom'];
	$data[$i]['sprite'] = $data2[($i - $cmp)]['sprite'];
	$data[$i]['id'] = $data2[($i - $cmp)]['id'];
	$data[$i]['is'] = 'Monster';
}
$cmp = $data['count'] ;
$data['count'] += 1;
$i = $cmp + 1;

	$data[$i]['y'] = $data3[1]['y'];
	$data[$i]['x'] = $data3[1]['x'];
	$data[$i]['z'] = $data3[1]['z'];
	
	$data[$i]['login'] = $data3[1]['login'];
	$data[$i]['sprite'] = $data3[1]['sprite'];
	$data[$i]['id'] = $data3[1]['id'];
	$data[$i]['is'] = 'MOI';


if ($data['count'] >= 1)
{
	echo '<tr>';
	echo '<td style="background:#C0C0C0; width:50px; height:50px;text-align:center;">y\x</td>';
	for($y =  ($y_JOUEUR - 5); $y <  ($y_JOUEUR + 6); $y++)
		{
			echo '<td style="background:#C0C0C0; width:50px; height:50px; text-align:center;">'.$y.'</td>';
		}
	echo '</tr>';
	for($x = ($x_JOUEUR - 5); $x < ($x_JOUEUR + 6); $x++)
	{
		echo '<tr>';
		echo '<td style="background:#C0C0C0; width:50px; height:50px;text-align:center;">'.$x.'</td>';
		for($y =  ($y_JOUEUR - 5); $y <  ($y_JOUEUR + 6); $y++)
		{
			/*Gestion du FOW - fog of war*/
			
			if($y < (($vue_JOUEUR + 1) + $y_JOUEUR) && $y > ((($vue_JOUEUR + 1) - $y_JOUEUR) * -1))
			{
				if($x < (($vue_JOUEUR + 1) + $x_JOUEUR) && $x > ((($vue_JOUEUR + 1) - $x_JOUEUR) * -1))
					$color = "#FFFFFF";
				else
					$color = "#EEEEEE";
			}
			else
				$color = "#EEEEEE";
			
			/* Fin gestion du FOW */
			
			$isAff = 0;
			for($i = 1; $i < $data['count'] + 1; $i++)
			{
			
				/* On gere le cadre de menu a afficher */
				$urlAction="";
				
				$highlight = "#C0C0C0";
				
				if($data[$i]['x'] == $x_JOUEUR && $data[$i]['y'] == $y_JOUEUR)
				{
					$urlAction="me.php";
					$highlight = "border:solid 1px #ff9900";
				}
				else
				{
					if($data[$i]['is'] == 'PJ'){
						$urlAction="other.php?joueur_id=".$data[$i]['id'];
						$highlight = "";
					}
					else
					{
						$urlAction="monster.php?monster_id=".$data[$i]['id'];
						$highlight = "";
					}
				}
				 
				 if($color == "#FFFFFF")
				 	$url = "background:url('./images/herbe.32932.gif');";
				else
					$url = "background:url('./images/herbe.32932.gif');filter:alpha(opacity=50, style=0, enabled=0);-moz-opacity:0.5;";
				/* Fin gestion cadre menus */
			
				if ($data[$i]['x'] == $x && $data[$i]['y'] == $y)
				{
					//border:solid 1px '.$highlight.'
					
					$js = "affWin('".$urlAction."','".$data[$i]['login']."')";
					
					echo '<td style="'.$url.'cursor:hand;'.$highlight.';" align="center" width="50" height="50" onmouseover="CreateToolTip(this,\''.$data[$i]['login'].' <br />x:'.$x.' - y:'.$y.'\',sourieX,sourieY)" onmouseout="RemoveToolTip()" onClick="'.$js.'"  bgcolor="'.$color.'"><img src="'.$data[$i]['sprite'].'" alt="'.$data[$i]['login'].'"></td>';
					$isAff = 1;
				}
			}
			 
			if ($isAff == 0)
				 echo '<td style="'.$url.' border="#C0C0C0"  width="50" height="50" bgcolor="'.$color.'">&nbsp;</td>';
		
		}
		echo '</tr>';
	}
}

?>
</table>



