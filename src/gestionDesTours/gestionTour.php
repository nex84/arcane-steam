<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
include $anti_path.'class/joueur/joueur_data.class.php';
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');


function start()
{
	//On recup tous les user
	$db = new database_connector();
	
	$sql = "SELECT id FROM users WHERE actif = 1";
	
	$data = $db->send_sql($sql);
	
	$sql = "SELECT dla, dla_total, last_exec FROM parametrage";
	$conf = $db->send_sql($sql);
	
	$dateNow = time();
	
	if($conf['count'] == 1 && $data['count'] > 1)
	{
		
		$lastExec = $conf[1]['last_exec'];
		$dla = $conf[1]['dla'];
		$dlaTotal = $conf[1]['dla_total'];
		
		$diviseur = $dlaTotal / $dla;
		
		if($dateNow > ($lastExec + ($dla * 60)))
		{
			echo '______________________________________________________________\n';
			echo 'Execution du :: '.date('d/m/Y H:i:s').'\n';
			for($i = 1; $i < $data['count']; $i++)
			{
				echo 'Mise a jour USERS ID :: '.$data[$i]['id'].'\n';
				goUser($data[$i]['id'], $diviseur);
			}		
			
			$sql = "UPDATE parametrage SET last_exec=".time().";";
			echo 'FIN Execution a :: '.date('d/m/Y H:i:s').'\n';
			echo '______________________________________________________________\n';
			$db->send_sql($sql);
		}
	}
}

//mvt, nb_att, nb_sort, HP, malus
//PV - Fct const -> 

function goUser($id, $diviseur){
	$db = new database_connector();
	
	$sql = "SELECT hp, mov, nba, nbs, malus_def FROM users_caracts_now WHERE id_user=".$id;
	
	$data_now = $db->send_sql($sql);
	
	$sql = "SELECT hp, hp_bonux, mov, mov_bonux, nba, nba_bonux, nbs, nbs_bonux, con, con_bonux FROM users_caracts WHERE id_user=".$id;
	
	$data_fix =  $db->send_sql($sql);
	
	if($data_fix['count'] == 1)
	{
		$hp = $data_fix[1]['hp'] + $data_fix[1]['hp_bonux'];
		$mov = $data_fix[1]['mov'] + $data_fix[1]['mov_bonux'];
		$nba = $data_fix[1]['nba'] + $data_fix[1]['nba_bonux'];
		$nbs = $data_fix[1]['nbs'] + $data_fix[1]['nbs_bonux'];
		$con = $data_fix[1]['con'] + $data_fix[1]['con_bonux'];
		if($data_now['count'] == 1)
		{
			$hp_Now = $data_now[1]['hp'];
			$mov_Now = $data_now[1]['mov'];
			$nba_Now = $data_now[1]['nba'];
			$nbs_Now = $data_now[1]['nbs'];
			$malus_def_Now = $data_now[1]['malus_def'];
		}
		
		//HP
		if($hp_Now < $hp)
		{
			$p = $hp / $con;
			$hp_Now += $p;
			if($hp_Now > $hp)
			{
				$hp_Now = $hp;
			}
		}
		//mov
		if($mov_Now < $mov)
		{
			$p = $mov / $diviseur;
			
			if($p < 1)
				$p = 1;
				
			$mov_Now += $p;
			if($mov_Now > $mov)
			{
				$mov_Now = $mov;
			}
		}
		
		//nba
		if($nba_Now < $nba)
		{
			$p = $nba / $diviseur;
			
			if($p  < 1)
				$p = 1;
			$nba_Now += $p;
			if($nba_Now > $nba)
			{
				$nba_Now = $nba;
			}
		}
		
		//nbs 
		if($nbs_Now < $nbs)
		{
			$p = $nbs / $diviseur;
			
			if($p  < 1)
				$p = 1;
			$nbs_Now += $p;
			if($nbs_Now > $nbs)
			{
				$nbs_Now = $nbs;
			}
		}
		
		//malus_def
		if($malus_def_Now > 0)
		{
			$p = $malus_def_Now /  $con;
			
			if($p  < 1)
				$p = 1;
			$p += $con;
			
			$malus_def_Now -= $p;
			if($malus_def_Now < 0)
				$malus_def_Now = 0;
		}
		
		$sql = "UPDATE users_caracts_now SET hp=".$hp_Now.', mov='.$mov_Now.',nba='.$nba_Now.', nbs='.$nbs_Now.', malus_def='.$malus_def_Now.' WHERE id_user='.$id;
		$db->send_sql($sql);
	}
}

start();
?>