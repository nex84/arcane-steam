<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	$errorMsg = '';
	if (!isset($_SESSION['id_marchand']))
	{
		$_SESSION['id_marchand'] = 0;	
	}
	if (isset($_REQUEST['idMarchand']))
	{
		$_SESSION['id_marchand'] = $_REQUEST['idMarchand'];
		unset($_REQUEST['idMarchand']);
	}
	
	
	if ($_SESSION['id_marchand'] !=0)
	{
		$search = new marchand_admin($_SESSION['id_marchand']);
		if (!$search->my_isset($_SESSION['id_marchand']))
		{
			$_SESSION['id_marchand'] = 0;
			$errorMsg = '<div class="error">Le marchand ID utiliser n\'existe pas.</div>';			
		}
		else
		{
			if (isset($_GET["action"]))
			{
				if ($_GET["action"] == "ajout")
				{
					$search->load($_SESSION['id_marchand']);
					$search->addItems($_GET["id_item"]);
				}
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Administration</title>
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<script language="javascript">
		function hidePanel(thingId)
		{
			var targetElement;
			targetElement = document.getElementById(thingId) ;
			if (targetElement.style.display == "none")
				{
				targetElement.style.display = "" ;
				} 
			else {
				targetElement.style.display = "none" ;
				}
		}
		
		function rollIn(obj)
		{
			document.getElementById(obj).style.color = "#FFFFFF";
		}
		
		function rollOut(obj)
		{
			document.getElementById(obj).style.color = "#C0C0C0";
		}
		</script>
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
					<div class="ongletcadre"><a href="./admin_liste_marchand.src.php">Liste des marchand</a></div>
					<div class="ongletcadre"><a href="./admin_crea_marchand.src.php">Cr&eacute;ation de marchand</a></div>
					<div class="ongletcadreselect">Creation des stocks</div>
					<div class="ongletcadre"><a href="#">Gestion des profit</a></div>
			</div>
			<div class="cadreaveconglet">
				<form action="" method="post">
					<input type="text" value="<?
						if ($_SESSION['id_marchand'] != 0)
							echo $_SESSION['id_marchand'];
						else
							echo "";
					?>" name="idMarchand" id="idMarchand">
					<input type="submit" name="submit" value="Envoyer">
				</form>
				<?
					if ($errorMsg != '')
						echo $errorMsg;
				?>
				<hr />
				<?
				if ($_SESSION['id_marchand'] != 0)
				{
					$search = new marchand_admin();
					$item = $search->getItems();
				
					foreach($item as $key => $items)
					{
						echo '<h2  id="div_'.$key.'" onMouseOver="rollIn(\'div_'.$key.'\')" onMouseOut="rollOut(\'div_'.$key.'\')" onclick="hidePanel(\''.$key.'\')">'.$key.'</h2>';	
						$index = 0;	
						echo '<div id="'.$key.'">';
						echo '<table border="0" width="100%">';
						while(isset($item[$key][$index]))
						{
							echo '<tr>';
							
							//Si on a un ID on affiche les possibiliter sinon -> on les masques
							if ($_SESSION['id_marchand'] != 0)
							{
								echo '<td width="5%"><a href="?action=ajout&id_item='.$item[$key][$index]['id'].'">[+]</td><td width="25%">';
								echo $item[$key][$index]['nom'].'</td><td width="60%">'.$item[$key][$index]['description']."</td><td  width='10%'>".$item[$key][$index]['prix']."</td>";
							}
							else
							{
								echo '<td colspan="4"></td>';
							}
							$index++;
							echo '</tr>';
						}		
						echo '</table>';
						echo '</div>';
					}

				?>
				<h1>Stock du marchand</h1>
				<?
					$search = new marchand_admin();
					$item = $search->getMarchanStock($_SESSION['id_marchand']);

					foreach($item as $key => $items)
					{
						echo '<h2  id="div_'.$key.'_1" onMouseOver="rollIn(\'div_'.$key.'_1\')" onMouseOut="rollOut(\'div_'.$key.'_1\')" onclick="hidePanel(\''.$key.'_1\')">'.$key.'</h2>';	
						$index = 0;	
						echo '<div id="'.$key.'_1">';
						echo '<table border="0" width="100%">';
						echo '<tr>';
						echo '<td></td>';
						echo '<td>Nom</td>';
						echo '<td>Description</td>';
						echo '<td>Stock</td>';
						echo '</tr>';
						while(isset($item[$key][$index]))
						{
							echo '<tr>';
							echo '<td width="5%"><a href="?action=supression&id_item='.$item[$key][$index]['id'].'">[-]</td><td width="25%">';
						echo $item[$key][$index]['nom'].'</td><td width="60%">'.$item[$key][$index]['description']."</td><td  width='10%'>".$item[$key][$index]['qte']."</td>";
							$index++;
							echo '</tr>';
						}		
						echo '</table>';
						echo '</div>';
					}
				}
				?>
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