<?
require_once('./includes/database.inc.php');
function Secure_init()
{
	if (!isset($_SESSION["id_admin"]))
	{
		$_SESSION["id_admin"] = 0;
	}

	if ($_SESSION["id_admin"] == 0 and $_SESSION['INDEX__'] != 1)
	{
		header('Location: ./index.php');
	}
	else
		Secure_log();
}

//Log en SQL toute les actions
function Secure_log()
{
	$db_handler = mysql_connect(DBHOST, DBUSER, DBPWD) or die("erreur de connexion au serveur ");
	
	mysql_select_db(DBNAME, $db_handler) or die("erreur de connexion a la DB");
	
	
 foreach($_SESSION as $cle => $valeur) {
 if (is_array($valeur)) {
 $session .= '<b>'.$cle.' :</b><br />';
 foreach($valeur as $_cle => $_valeur) {
 if (is_array($_valeur)) {
 $session .= '|   <b>'.$_cle.' :</b><br />';
 foreach($_valeur as $__cle => $__valeur) {
 $session .= '|   '.$__cle.' : '.$__valeur.'<br />'."\n";
 }
 $session .= '|   ---------------------------<br />';
 } else {
 $session .= '|   '.$_cle.' : '.$_valeur.'<br>'."\n";
 } }
 $session .= '---------------------------<br /><br />';
 } else {
 $session .= $cle.' : '.$valeur.'<br />'."\n";
 }
 }
 
  foreach($_POST as $cle => $valeur) {
 if (is_array($valeur)) {
 $post .= '<b>'.$cle.' :</b><br />';
 foreach($valeur as $_cle => $_valeur) {
 if (is_array($_valeur)) {
 $post .= '|   <b>'.$_cle.' :</b><br />';
 foreach($_valeur as $__cle => $__valeur) {
 $post .= '|   '.$__cle.' : '.$__valeur.'<br />'."\n";
 }
 $post .= '|   ---------------------------<br />';
 } else {
 $post .= '|   '.$_cle.' : '.$_valeur.'<br>'."\n";
 } }
 $post .= '---------------------------<br /><br />';
 } else {
 $post .= $cle.' : '.$valeur.'<br />'."\n";
 }
 }
 
 	foreach($_GET as $cle => $valeur) {
 		if (is_array($valeur)) {
 			$get .= '<b>'.$cle.' :</b><br />';
 				foreach($valeur as $_cle => $_valeur) {
					if (is_array($_valeur)) {
						$get .= '|   <b>'.$_cle.' :</b><br />';
							foreach($_valeur as $__cle => $__valeur) {
								$get .= '|   '.$__cle.' : '.$__valeur.'<br />'."\n";
 							}
							$get .= '|   ---------------------------<br />';
 					} else {
 						$get .= '|   '.$_cle.' : '.$_valeur.'<br>'."\n";
 					} 
				}
 				$get .= '---------------------------<br /><br />';
 			} else {
 		$get .= $cle.' : '.$valeur.'<br />'."\n";
		}
	 }
	$session = addslashes($session);
	$post = addslashes($post);
	$get = addslashes($get);
 	
	$date = date("d/m/Y")." - ".date("G/i/s");
	
	$stringSql = "INSERT INTO Admin_Log(id_user,session,get,post,date) VALUES('".$_SESSION["id_admin"]."','".addslashes($session)."','".$post."','".$get."','".$date."')";
	$result = mysql_query($stringSql, $db_handler)  or die(mysql_error());
}

//Utiliser pour identifier le user
function Secure_identification($log, $pass)
{
	$db_handler = mysql_connect(DBHOST, DBUSER, DBPWD) or die("erreur de connexion au serveur ");
	
	mysql_select_db(DBNAME, $db_handler) or die("erreur de connexion a la DB");
	
	$stringSql = "SELECT * FROM Admin_Account WHERE login='".addslashes($log)."' AND pass='".addslashes($pass)."';";
	$result = mysql_query($stringSql, $db_handler)  or die(mysql_error());
	
	$data = array();
	$n = 0;
		
	
	while ($row = mysql_fetch_assoc($result))
	{
		$n++;
		foreach ($row as $key => $val)
		{
			$data[$n][$key] = $val;
		}
	}
	$data['count'] = count($data);
	if ($data['count'] > 0)
	{
		$_SESSION["id_admin"] = $data[1]['id'];
		$_SESSION["Succes"] = "OK";
	}
	else
		$_SESSION["Succes"] = "FALSE // ".$log." (".$pass.")";
	Secure_log(); 
	unset($_SESSION["Succes"]);
}

if (!isset($_SESSION["attempLog"]))
	Secure_init();
else
	unset($_SESSION["attempLog"]);
?>