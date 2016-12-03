<?php 
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// fichier inclu

//les classes<br>
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path . 'class/race/race.class.php');


/////////////////////////////////////////////
// Assignation des variables
////////////////////////////////////////////

//pour l'iD
if($_GET['qui'] != "")
{
	$id_race_post = $_GET['qui'];
}

//pour les actions
if($_GET['releve'] != "")
{
	$revele = $_GET['releve']; 
}

/////////////////////////////////////////////
//gestion de l'evenement d'enregistrement
////////////////////////////////////////////
if($_POST['todo'] == 'enregistre')
{
	$info = race::gere_race('enregistre', $_POST);
	unset($revele);
}
/////////////////////////////////////////////
//gestion de l'evenement d'effacement
////////////////////////////////////////////
if($revele == 'delete')
{
	$info = race::gere_race('delete', $id_race_post);
	unset($revele);
}

//$info = race::gere_race('enregistre', $tab);
//var_dump($info);

$liste = race::gere_race('liste');
//print_r($liste);

###############################################
##
##
##      Affichge
##
##
###############################################

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
					<div class="ongletcadreselect">adminsitration des races</div>
					
                 								
			</div>
			<div class="cadreaveconglet"> 
 
 <?php
if($revele == "")
{   ?>
<div align="center" >
<a href="./envoie.php?releve=form" >Ajouter nouveau</a>
<table>
<tr>
<td > nom <hr /></td>
<td>|  effacer  |<hr /></td>
<td> editer |<hr /></td>
<td> caracteristique <hr /></td>
</tr>
<?php
for($i=1; $i< count($liste) - 1; $i++)
{
	echo '<tr>
			<td> '.$liste[$i]['nom'].'<hr /></td>
			<td>|<a href=./envoie.php?releve=form&qui='. $liste[$i]['id'] .'> editer </a><hr /></td>
			<td>|<a href=./envoie.php?releve=delete&qui='. $liste[$i]['id'] .'>  effacer </a>|<hr /></td>
			<td> <a href=./cout_race.php?id='. $liste[$i]['id'] .'>  caracteristique </a><hr /></td>
			
	
	
	</tr>';
}

?>
</table>

</div>



<?php 
}
if($revele == 'form')
{
	$action ='insert';
	if($id_race_post != '')
	{
		$put = race::gere_race('recherche',$id_race_post); 
		$action = 'update';
		
	
		/// chargement de vari	able pour eviter les erreur
		$nom = $put->get_nom();
		$desc = $put->get_description();
		$id = $put->get_id();
		$status = $put->get_status();
	}
	
?>
<div align="center">
<a href="./envoie.php"> Revenir a la liste </a><hr />
<form method ="POST" Onsubmit=""> 

Nom de la race : <input type="texte" name="nom" value="<?php echo $nom?>">
<hr />
<br />
Description de la race : <textarea name="description" cols="20" rows="20"><?php echo $desc?></textarea>
<hr />
<br>
Status : <select name="status">
						<option value="<?php echo $status?>"><?php echo $status?></option>
						<option value="PJ">PJ</option>
						<option value="PNJ">PNJ</option>
</select>

<br>
<input type="hidden" name="action" value="<?php echo $action?>">
<input type="hidden" name="todo" value="enregistre">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="image" value="do_enter">
<input type="submit" value="Valider" name="val">
 


</form>
</div>

<?php } ?>