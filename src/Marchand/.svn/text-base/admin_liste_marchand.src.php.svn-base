<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
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
  	
  	<link href="../../css/default.css" rel="stylesheet" type="text/css">	 </link>
  	<link href="../../css/spread.css" rel="stylesheet" type="text/css">	 </link>
  	<link href="../../css/alert.css" rel="stylesheet" type="text/css">	 </link>
  	<link href="../../css/alert_lite.css" rel="stylesheet" type="text/css">	 </link>

  	<link href="../../css/alphacube.css" rel="stylesheet" type="text/css">	 </link>
  	<link href="../../css/debug.css" rel="stylesheet" type="text/css">	 </link>

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

<script type="text/javascript">
 function upadte(id)
 {
 	document.frm.idMarchand.value = id;
	document.frm.submit();
 }
</script>		
	</head>
	<body>
	<form action="admin_crea_marchand.src.php" name="frm" method="post">
		<input type="hidden" id="idMarchand"  name="idMarchand" value="0">
	</form>
		<div id="content">
			<div class="onglets">
					<div class="ongletcadreselect">Liste des marchand</div>
					<div class="ongletcadre"><a href="./admin_crea_marchand.src.php">Cr&eacute;ation de marchand</a></div>
					<div class="ongletcadre"><a href="./admin_stock_marchand.src.php">Creation des stocks</a></div>
					<div class="ongletcadre"><a href="#">Gestion des profit</a></div>
			</div>
			<div class="cadreaveconglet">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				  	<td align="left">
						<form action="" method="post">
							X :<input type="text" name="x" style="width:50px;">
							Y :<input type="text" name="y" style="width:50px;">
							<input type="submit" value="Rechercher">
							<input type="hidden" name="xy" value="1">
						</form>
					</td>
					<td alyoign="right">
						<form action="" method="post">
							<input type="text" name="recherche">
							<input type="submit" value="Rechercher">
							<input type="hidden" name="texte" value="1">
						</form>
					</td>
				  </tr>
				</table>

				<hr />
				<?php
				if (isset($_POST['texte']))
				{
					$search = new marchand_admin();
					$name = addslashes($_POST['recherche']);
					$search->Recherche($name,NULL,NULL);
					$search->affichage();
				}
				else if (isset($_POST['xy']))
				{
					$search = new marchand_admin();
					$y = addslashes($_POST['y']);
					$x = addslashes($_POST['x']);
					$search->Recherche('',$y,$x);
					$search->affichage();
				}
				?>
				<hr />
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

