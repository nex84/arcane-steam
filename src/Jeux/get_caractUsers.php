<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

//include($anti_path.'/class/database/database_connector.class.php');
require($anti_path.'/class/joueur/joueur_caract.class.php');
require($anti_path.'/class/joueur/joueur_data.class.php');

$id = $_REQUEST["joueur_id"];

$u = new joueur_data($id);

$str = "";
$str .= '<h3>['.$u->get_login().']</h3>';

$c = new joueur_caract($id);

$data = $c->get_data();
/*
foreach($data as $key => $value)
{
	$style = "";
	if ($key != "")
	{
		$str .=  ''.$key.'<br />';
		if ($value['valeur'] == 0)
		{
			$style = "cara_red";
		}
		elseif ($value['valeur'] != $value['valeur_max'])
		{
			$style = "cara_orange";
		}
		else
		{
			$style = "cara_vert";
		}
		
		
		$str .= '<span class="'.$style.'">'.$value['valeur'].'/'.$value['valeur_max'].'</span>';
		
		$str .=  '<br />';
	}
}
*/
echo $str;
?>
