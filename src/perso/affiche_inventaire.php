<?php

	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/functions_inventaire.php');
	require_once('../../includes/request.sql.php');
	$anti_path = return_anti_path();
	include $anti_path.'class/database/database_connector.class.php';
	
	@session_start();

$res = get_inventaire($_SESSION["id"]);


	//debug($data);
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Administration</title>
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
    <script type="text/javascript" src="../../js/wz_tooltip.js"> </script>
	<div id="content">
			
			<div class="cadreaveconglet">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center">&nbsp;</td>
    <td><h1><?php echo $data[1]['nom']; ?></h1></td>
  </tr>
  </table>
  <table width="450" border="0" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;
      <?php if($res["tete"] =="") {?><b>tete</b><?php } ?>
      <br />
      <?php echo '<img src="'.$res["tete_image"].'" alt="'.$res["tete"].'" />' ?>
      </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p><?php if($res["medaillon"] =="") {?><b>medaillon</b><?php } ?><br />
    	<?php echo '<img src="'.$res["medaillon_image"].'" alt="'.$res["medaillon"].'" />' ?>
       </p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p><?php if($res["bras_droite"] =="") {?><b>bras droit</b><?php } ?><br />
	  <?php echo '<img src="'.$res["bras_droite_image"].'" alt="'.$res["bras_droite"].'" />' ?>
	  </p>
      <p>&nbsp; </p></td>
    <td><?php if($res["torse"] =="") {?><b>torse</b><?php } ?><br />
	<?php echo '<img src="'.$res["torse_image"].'" alt="'.$res["torse"].'" />' ?>
	</td>
    <td><?php if($res["bras_gauche"] =="") {?><b>bras gauche </b><?php } ?><br />
	<?php echo '<img src="'.$res["bras_gauche_image"].'" alt="'.$res["bras_gauche"].'" />' ?>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td><?php if($res["bracelet_droite"] =="") {?><b>bracelet droit </b><?php } ?><br />
	<?php echo '<img src="'.$res["bracelet_droite_image"].'" alt="'.$res["bracelet_droite"].'" />' ?>
	</td>
    <td><?php if($res["main_droite"] =="") {?><b>main droite</b><?php } ?><br />
	<?php echo '<img src="'.$res["main_droite_image"].'" alt="'.$res["main_droite"].'" />' ?>
	</td>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p><?php if($res["main_gauche"] =="") {?><b>main gauche </b><?php } ?><br />
	  <?php echo '<img src="'.$res["main_gauche_image"].'" alt="'.$res["main_gauche"].'" />' ?>
	  </p>
      <p>&nbsp;</p></td>
    <td><?php if($res["bracelet_gauche"] =="") {?><b>bracelet gauche</b><?php } ?> <br />
	<?php echo '<img src="'.$res["bracelet_gauche_image"].'" alt="'.$res["bracelet_gauche"].'" />' ?>
	</td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p><?php if($res["bague_droite"] =="") {?><b>bague droite</b><?php } ?><br />
      <?php echo '<img src="'.$res["bague_droite_image"].'" alt="'.$res["bague_droite"].'" />' ?>
      </p>
      <p>&nbsp; </p></td>
    <td>&nbsp;</td>
    <td><?php if($res["bague_gauche"] =="") {?><b>bague gauche </b><?php } ?><br />
	
	<?php echo '<img src="'.$res["bague_gauche_image"].'" alt="'.$res["bague_gauche"].'" />' ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p><?php if($res["ceinture"] =="") {?><b>ceinture</b><?php } ?><br />
	  <?php echo '<img src="'.$res["ceinture_image"].'" alt="'.$res["ceinture"].'" />' ?>
		</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <?php if($res["jambes"] =="") {?><b>jambe droite</b><?php } ?><br />
	  <?php echo '<img src="'.$res["jambes_image"].'" alt="'.$res["jambes"].'" />' ?>
	
      <p>&nbsp; </p></td>
    <td>&nbsp;</td>
    <td>
    <?php if($res["jambes"] =="") {?><b>jambe gauche </b><?php } ?><br />
	<?php echo '<img src="'.$res["jambes_image"].'" alt="'.$res["jambes"].'" />' ?>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td>&nbsp;</td>
    <td>
    <?php if($res["pieds"] =="") {?><b>pied droit </b><?php } ?><br />
	<?php echo '<img src="'.$res["pieds_image"].'" alt="'.$res["pieds"].'" />' ?>
	</td>
    <td>&nbsp;</td>
    <td><p>&nbsp;</p>
      <p>
     <?php if($res["pieds"] =="") {?><b> pied gauche </b><?php } ?><br />
	  <?php echo '<img src="'.$res["pieds_image"].'" alt="'.$res["pieds"].'" />' ?>
	</p>
      <p>&nbsp;</p></td>
    <td>&nbsp;</td>
  </tr>
</table>

  
  
  
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
		<a href="#" onClick="history.go(-1)">Retour</a>
	</td>
  </tr>
</table>
</div>
			
		</div>
		
	</body>
</html>
