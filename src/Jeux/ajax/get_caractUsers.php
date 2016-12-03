<?
session_start();
require_once('../../../includes/functions.inc.php');
$anti_path = return_anti_path();
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

//include($anti_path.'/class/database/database_connector.class.php');
require($anti_path.'/class/joueur/joueur_caract.class.php');
require($anti_path.'/class/joueur/joueur_data.class.php');



echo  '#-'.$_REQUEST["joueur_id"];

$id = $_REQUEST["joueur_id"];

$u = new joueur_data($id);


echo '<h3>['.$u->get_login().']</h3>';

$c = new joueur_caract($id);
$data = $c->get_data();

foreach($data as $key => $value)
{
	$style = "";
	echo '<p>'.$key.'<br />';
	if ($data[$key]['value'] == 0)
	{
		$style = "cara_red";
	}
	elseif ($data[$key]['value'] != $data[$key]['value_max'])
	{
		$style = "cara_orange";
	}
	else
	{
		$style = "cara_vert";
	}
	
	
	echo '<span class="'.$style.'">'.$data[$key]['value'].'/'.$data[$key]['value_max'].'</span>';
	
	echo '</p>';
}


?>
