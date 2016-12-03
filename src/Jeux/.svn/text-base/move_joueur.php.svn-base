<?
@session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
include $anti_path.'includes/fonctions_utilisation_point.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');

$x = $_REQUEST['x'];
$y = $_REQUEST['y'];

$id_JOUEUR = $_REQUEST['joueur_id'];

$sql_check = "SELECT x,y FROM users_position WHERE id_user =".$id_JOUEUR;
$c = new database_connector();
$data = $c->send_sql($sql_check);

if ($data['count'] == 1)
{
	$x_new =  $data[1]['x'];
	$y_new =  $data[1]['y'];
}

$x_new += $x;
$y_new += $y;

$sql_check = "SELECT up.* FROM users_position up, users WHERE up.id_user <> ".$id_JOUEUR."  AND up.z <> 0  AND users.actif = 1 AND users.id = up.id_user AND up.x=".$x_new." AND up.y=".$y_new;
$data = $c->send_sql($sql_check);

$sql_check = "SELECT up.* FROM npc_mob_position up, npc_mob mob WHERE up.z <> 0 AND mob.id = up.id_npc AND up.x=".$x_new." AND up.y=".$y_new;
$data2 = $c->send_sql($sql_check);

$sql_move = "SELECT mov FROM users_caracts_now WHERE id_user=".$id_JOUEUR;
$data3 = $c->send_sql($sql_move);

if ($data['count'] == 0 && $data2['count'] == 0 && $data3[1]['mov'] > 0)
{
	//Delacement
	$sql = "UPDATE users_position  SET x=(x+".$x."), y=(y+".$y.") WHERE id_user =".$id_JOUEUR;
	$data = $c->send_sql($sql);
	depense_mouvement($id_JOUEUR);
	$a =  new joueur_data($_REQUEST['joueur_id'],'caracts_now');
	$a->log_evenment($a->get_nom().' c\'est deplac&eacute;');
	echo 'ok';
}
else
{
	if($data3[1]['mov'] == 0)
	{
		echo 'Vous n\'avez plus de points de mouvement';
	}
	else if($data['count'] != 0){
		$sql = "SELECT login FROM users WHERE id = ".$data[1]['id_user'];
		$data = $c->send_sql($sql);
		echo 'Le joueur '.$data[1]['login'].' est d&eacute;j&agrave; sur cette case' ;
	}
	else if($data2['count'] != 0 ){
		$sql = "SELECT nom FROM npc_mob WHERE id = ".$data2[1]['id_npc'];
		$data = $c->send_sql($sql);
		echo 'Le monstre '.$data[1]['nom'].' grogne...' ;
	}
}


?>