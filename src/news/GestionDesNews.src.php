<?php
	@session_start();
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/fonctions_guilde.php');
	require_once('../../includes/fonctions_class.php');
	require_once('../../includes/request.sql.php');
	
	$u = new joueur_data($_SESSION["id"],'caracts_now');
	
	
	
	if(isset($_POST['actionEnCour']))
	{
		if($_POST['actionEnCour'] == "cree")
		{
			$sql = "INSERT INTO news(date, auteur, titre, corps, cat, isPublish) VALUE('".date("d/m/Y G:i")."', '".$u->get_nom()."', '".$_POST['titreNouvelle']."', '".$_POST['textNouvelle']."', 1, 0)";
			$connect = new database_connector();
			
			$data = $connect->send_sql($sql);
			
			$connect->Disconnection();
		}
		
		if($_POST['actionEnCour'] == "update")
		{
			//$sql = "INSERT INTO news(date, auteur, titre, corps, cat, isPublish) VALUE('".date("d/m/Y G:i")."', '".$u->get_nom()."', '".$_POST['titreNouvelle']."', '".$_POST['textNouvelle']."', 1, 0)";
			$sql = "UPDATE news SET titre = '".$_POST['titreNouvelle'] ."', corps = '".$_POST['textNouvelle'] ."' WHERE id='".$idToPublish."';";
			$connect = new database_connector();
			
			$data = $connect->send_sql($sql);
			
			$connect->Disconnection();
		}
	}
	
	$titreAction = "Cr&eacute;&eacute; une nouvelle ";
	$nameOfAction = "cree";
	
	$titre = "";
	$news = "";
	
	if(isset($_REQUEST['action']))
	{
	
		if($_REQUEST['action'] == "publish")
		{
			$idToPublish = $_REQUEST['id'];
			$stateOfPublish = $_REQUEST['state'];
			
			$sql = "UPDATE news SET isPublish = '".$stateOfPublish ."' WHERE id='".$idToPublish."';";
			
			$connect = new database_connector();
			
			$data = $connect->send_sql($sql);
			
			$connect->Disconnection();
		
		}
		
		if($_REQUEST['action'] == "delete")
		{
			$idToDele = $_REQUEST['id'];

			$sql = "DELETE FROM news WHERE id='".$idToDele."';";
			
			$connect = new database_connector();
			
			$data = $connect->send_sql($sql);
			
			$connect->Disconnection();
		
		}
		
		if($_REQUEST['action'] == "update")
		{
			
			$titreAction = "Metre a jour une ";
			$nameOfAction = "update";
			
			
			$idToUpdate = $_REQUEST['id'];
			
			$sql = "SELECT date, auteur, titre, corps, cat, isPublish FROM news WHERE id='".$idToUpdate."';";
			
			$connect = new database_connector();
			
			$data = $connect->send_sql($sql);
			
			$connect->Disconnection();
			
			$titre = $data[1]["titre"];
			$news = $data[1]["corps"];
		
		}
	}
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
 
  	<link href="../../css/default.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/spread.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/alert.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/alphacube.css" rel="stylesheet" type="text/css" />
  	<link href="../../css/debug.css" rel="stylesheet" type="text/css" />
		
	</head>
	<body>
		<div id="content">
			<div class="onglets">
					<div class="ongletcadre"><a href="#">Liste des news</a></div>
			</div>
			<div class="cadreaveconglet">
            	Vous ete loguer sous le nom de : <?php echo $u->get_nom();?>
            <hr />
            
            <table cellpadding="0" cellspacing="0" border="0" width="85%">
            <tr>
            	<td>Titre</td>
                <td>Publier</td>
                <td>Editer</td>
                <td>Supprimer</td>
            </tr>
            
            <?php
				$c = new database_connector();
				$data = $c->send_sql("SELECT id,date, auteur, titre, corps, isPublish FROM  news  ORDER BY id DESC");
				if ($data['count'] > 0)
				{
					for($i = 1; $i <= $data['count']; $i++)
					{
						$uriBase = 'https://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"];
					
						$pub = "";
						if($data[$i]['isPublish'] == 1)
						{
							//s_success.png
							$pub ='<a href="'.$uriBase.'?action=publish&id='.$data[$i]['id'].'&state=0"><img src="../../images/s_success.png" alt="ok" border=0/></a>';
						}
						else
						{
							$pub ='<a href="'.$uriBase.'?action=publish&id='.$data[$i]['id'].'&state=1">-</a>';
						}
						
						
						
						$edit = '<a href="'.$uriBase.'?action=update&id='.$data[$i]['id'].'"><img src="../../images/b_edit.png" alt="editer" border=0 /></a>';
						
						$del = '<a href="'.$uriBase.'?action=delete&id='.$data[$i]['id'].'"><img src="../../images/b_drop.png" alt="delete" border=0/></a>';
						echo '<tr>';
						echo '<td>'.$data[$i]['titre'].'</td>';
						echo '<td>'.$pub.'</td>';
						echo '<td>'.$edit.'</td>';
						echo '<td>'.$del.'</td>';
						echo '</tr>';
					}
				}
			?>
            
            </table>
            
            <hr />

            <?php echo $titreAction; ?> news :
			<hr />
            <form action="" method="post">
			Titre : <input type="text" id="titreNouvelle" name="titreNouvelle" value="<?php echo $titre; ?>"/> <br /><br />
            Corp de la nouvelle : <br />
            <textarea id="textNouvelle" name="textNouvelle" rows="5" cols="50" ><?php echo $news; ?></textarea>
            <br />
            <br />
            <input type="hidden" name="actionEnCour" value="<?php echo $nameOfAction; ?>" />
            <input type="submit" value="Poster" />
            
            </form>
            </div>
		<?
        	require_once("../footer.php");
		?>
			<div style="clear:both;"></div>
		</div>
		<div style="clear:both;"></div>
		<div style="clear:both;"></div>
	</body>
</html>

