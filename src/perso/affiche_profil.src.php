<?php
	@session_start();
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	//if (!isset($_POST["user"]))
	//{
	//	if ($count != $get_caract['count'])
	//	debug('ERREUR : des informations sont manquantes<br /><a href="www.arcane-steam.com">Retour</a>');
	//}
	
	$db = new database_connector();
	//recuperation caracteristique
	$get_users =  $db->send_sql(select_users($_SESSION['id']));
	
	for ($n = 1; $n <= $get_users['count']; $n++)
	{
		//debug($get_users);
	}
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Inscription</title>
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		
		<!--  Prototype Window Class Part -->
    <script type="text/javascript" src="../../js/prototype.js"> </script> 
  	<script type="text/javascript" src="../../js/effects.js"> </script>
  	<script type="text/javascript" src="../../js/window.js"> </script>

  	<script type="text/javascript" src="../../js/window_effects.js"> </script>
  	<script type="text/javascript" src="../../js/debug.js"> </script>
  	
  	<link href="../../css/default.css" rel="stylesheet" type="text/css" >	 </link>
  	<link href="../../css/spread.css" rel="stylesheet" type="text/css" >	 </link>
  	<link href="../../css/alert.css" rel="stylesheet" type="text/css" >	 </link>
  	<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" >	 </link>

  	<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" >	 </link>
  	<link href="../../css/debug.css" rel="stylesheet" type="text/css" >	 </link>

  	<style>
      #myDialogId .myButtonClass {
      padding:3px;
      font-size:20px;
      width:100px;
      }
      #myDialogId .ok_button {
      color:#2F2;
      }
      #myDialogId .cancel_button {
      color:#F88;
      }
  </style>
		
		
		
	</head>
	<body>
	
	<script language="javascript" type="text/javascript">
	function change_mail()
	{
		var win = new Window({className: "dialog", title: "Arcane-Steam // Changement mail", top:70, left:100, width:620, height:500, url: "http://dev.arcane-steam.com/src/perso/admin_change_mail.php", showEffectOptions: {duration:1.5}}) 
		win.show(); 
	}
	</script>
	
	<div id="content">
			
			<div class="cadreaveconglet">
			<h1><?php echo $get_users[1]["nom"];?></h1>
            <br />
					<img src="../Jeux/<?php echo $get_users[1]["sprite"]; ?>" /><br>
                    <b>Mail :</b> <?php echo $get_users[1]["mail"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:change_mail();">[ Modifier ]</a><br>
                    <b>Race :</b> <?php echo $get_users[1]["race"]; ?><br>
                    <b>Classe :</b> <?php echo $get_users[1]["classe"]; ?><br>
					<b>Guilde :</b> <?php echo $get_users[1]["guilde"]; ?><br>
					<b>Alignement :</b> <?php echo $get_users[1]["alignement"]; ?><br>
					<hr/>
					<b>Exp&eacute;rience :</b> <?php echo $get_users[1]["xp"]; ?><br>
					<b>Pi&egrave;ce d'or :</b> <?php echo $get_users[1]["gold"]; ?><br>
                    
					
					
					
                    
                    
                    
				
			</div>
		</div>
		
	</body>
</html>
