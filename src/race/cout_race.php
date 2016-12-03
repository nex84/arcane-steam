<?php

///////////////////////////////////
// traitemenbt des donnée 
//inclusion
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path . 'class/race/caract_race.class.php');

//pour les valeur
if($_POST['mode'] == 'valeur')
{
	echo 'in';
	caract_race::gere_race_caract('edite', $_POST);
}
//pour les modificateur
if($_POST['mode'] == 'count_modif')
{
	
	caract_race::gere_race_caract('edite', $_POST);
}
//appelle des valeur
$info = caract_race::gere_race_caract('voir', $_GET['id']);

//formulaire 

//affichage diu tab des stat 
// affichage de celui des cout
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
	<div id="content">
			<div class="onglets">
			<div class="ongletcadre"><a href="./envoie.php">adminsitration des races</a></div>
					<div class="ongletcadreselect">adminsitration des caracteristique</div>
					
                 								
			</div>
			<div class="cadreaveconglet"> 


<div >
<form method="post">
<input type="hidden" name="id_race" value="<?php echo $_GET['id'] ?>">
<input type="hidden" name="mode" value="valeur">
<input type="hidden" name="type" value="caract">
<table>
<tr><td>  <h2>Caracteristique</h2>  <hr /></td></tr>
<tr><td> point de vie : <input type="text" name="1" value="<?php echo $info[1]['valeur']?>"><hr /></td></tr>
<tr><td> Mouvement : <input type="text" name="2" value="<?php echo $info[2]['valeur']?>"><hr /></td></tr>
<tr><td> Vue : <input type="text" name="3" value="<?php echo $info[3]['valeur']?>"><hr /></td></tr>
<tr><td> Dégats : <input type="text" name="4" value="<?php echo $info[4]['valeur']?>"><hr /></td></tr>
<tr><td> Puissance Magique : <input type="text" name="5" value="<?php echo $info[5]['valeur']?>"><hr /></td></tr>
<tr><td> Nombre de sort : <input type="text" name="6" value="<?php echo $info[6]['valeur']?>"><hr /></td></tr>
<tr><td> Defense : <input type="text" name="7" value="<?php echo $info[7]['valeur']?>"><hr /></td></tr>
<tr><td> Attaque : <input type="text" name="8" value="<?php echo $info[8]['valeur']?>"><hr /></td></tr>
<tr><td> Consitution : <input type="text" name="9" value="<?php echo $info[9]['valeur']?>"><hr /></td></tr>
<tr><td> Nombre d'attaque : <input type="text" name="10" value="<?php echo $info[10]['valeur']?>"><hr /></td></tr>
<tr><td><input type="submit" value="go"><hr /></td></tr>
</table>
</form>
<form method="post">
<input type="hidden" name="id_race" value="<?php echo $_GET['id'] ?>">
<input type="hidden" name="type" value="cout">
<input type="hidden" name="mode" value="count_modif">


<table>
<tr><td> <h2> modificateur  </h2><hr /></td></tr>
<tr><td> point de vie : <input type="text" name="1" value="<?php echo $info[1]['modif_cout']?>"><hr /></td></tr>
<tr><td> Mouvement : <input type="text" name="2" value="<?php echo $info[2]['modif_cout']?>"><hr /></td></tr>
<tr><td> Vue : <input type="text" name="3" value="<?php echo $info[3]['modif_cout']?>"><hr /></td></tr>
<tr><td> Dégats : <input type="text" name="4" value="<?php echo $info[4]['modif_cout']?>"><hr /></td></tr>
<tr><td> Puissance Magique : <input type="text" name="5" value="<?php echo $info[5]['modif_cout']?>"><hr /></td></tr>
<tr><td> Nombre de sort : <input type="text" name="6" value="<?php echo $info[6]['modif_cout']?>"><hr /></td></tr>
<tr><td> Defense : <input type="text" name="7" value="<?php echo $info[7]['modif_cout']?>"><hr /></td></tr>
<tr><td> Attaque : <input type="text" name="8" value="<?php echo $info[8]['modif_cout']?>"><hr /></td></tr>
<tr><td> Consitution : <input type="text" name="9" value="<?php echo $info[9]['modif_cout']?>"><hr /></td></tr>
<tr><td> Nombre d'attaque : <input type="text" name="10" value="<?php echo $info[10]['modif_cout']?>"><hr /></td></tr>
<tr><td><input type="submit" value="go"><hr /></td></tr>
</table>
</form>

<?
        	require_once("../footer.php");
		?>
</div>