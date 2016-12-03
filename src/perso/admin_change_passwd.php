<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	require_once('../../crypt/functions.php');
	
	$db = new database_connector(true);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//FR" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>~Arcane-Steam - Changement de mot de passe</title>
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		
		<!--  Prototype Window Class Part -->
	<script type="text/javascript" src="../../js/Inscription.js"> </script> 	
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
	<link href="../../css/password.css" rel="stylesheet" type="text/css" >	 </link>
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
	  
	  
	#Warning{

		background-color:#FFFFFF;

		border:#FF0000 2px solid;

		padding:5px 5px 5px 5px;

		color:#FF0000;

		font-size:12px;

		width:150px;

		float:right;

}

	
	
      
</style>
		
		
		
	</head>
	<body>
	
	
	
	
    <script type="text/javascript" src="../../js/passwd_meter.js"> </script>
	<div id="content">
			<!--<div class="onglets">
					
                    <div class="ongletcadreselect">Inscription</div>
					<div class="ongletcadre">Personnage</div>
					<div class="ongletcadre">Caract&eacute;ristiques</div>				
					<div class="ongletcadre">Termin&eacute;</div>				

			</div>-->
			<div class="cadreaveconglet">
				<h1>CHANGEMENT DE MOT DE PASSE</h1>
			<?php
		if (isset($_POST["mail"]) && isset($_POST["login"]))
		{
			$res = reset_passwd($_POST["mail"], $_POST["login"]);
			if ($res = 1)
			{
				echo "Votre mot de passe a &eacute;t&eacute; r&eacute;initialis&eacute;.<br /><br />Un mail de contenant votre nouveau mot de passe vous a &eacute;t&eacute; envoy�E�El'adresse mail sp&eacute;cifi&eacute;e.<br />V&eacute;rifiez votre boite de spam, il est possible que le mail de confirmation s'y trouve.<br />";
			}
			elseif ($res = 2)
			{
				debug("L'identifiant saisi n'existe pas ou ne correspond pas &agrave; l'adresse mail saisie...");
			}
			else
			{
				debug("Une erreur est survenue lors de la reg&eacute;n&eacute;ration de votre mot de passe.<br />Veuillez r&eacute;essayer ult&eacute;rieurement...");
			}
		}
		else
		{
	?>
			
			
			
			
			
			
				Vous souhaitez changer de votre mot de passe ?<br /><br />
				
				Veuillez remplir les champs suivants, un mail de confirmation vous sera envoy&eacute; sur l'adresse mail de votre compte ~Arcane-Steam. 
                <br /><form method="post">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td>
            		Ancien mot de passe :<br />
					<input name="old_pass" id="old_pass" type="password" size="25" maxlength="25"><br /><br />
					Nouveau mot de passe :<br />
                    <input name="new_pass" id="new_pass" type="password" size="25" maxlength="25" onChange="ImYourFather('verif_new_pass','new_pass','btn_send')"> <i>25 caract&egrave;res max.</i><br /><br />
                    V&eacute;rification du nouveau mot de passe :<br />
                    <input name="verif_new_pass" id="verif_new_pass" type="password" size="25" maxlength="25" onChange="ImYourFather('verif_new_pass','new_pass','btn_send')"><br /><br />
                    
                    
                    <br /><br />
         <fieldset>
		 <?php dsp_crypt(0,0); ?><br />
	Recopier le code :<br />
	<input type="text" name="code" ></fieldset><br /><br /><br />
                    		</td>
                            <td align="right">
                    <input name="valid" id="btn_send" disabled="disabled" type="submit" value="Suivant &gt;">
					
					
						<p id="Warning">
<b>ATTENTION :</b><br />
Votre identifiant et votre mot de passe sont PERSONNELS.<br />
Ne les divulguez pas.<br />

En aucun cas nous ne vous les demanderons.	<br />
</p>
                            </td>
                        </tr>
					</table>

            	</form>
				
				<?php
					}
				?>

                
			</div>
			
		</div>
		
	</body>
</html>
