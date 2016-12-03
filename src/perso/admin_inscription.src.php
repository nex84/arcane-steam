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
		<title>Inscription</title>
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
			<div class="onglets">
					
                    <div class="ongletcadreselect">Inscription</div>
					<div class="ongletcadre">Personnage</div>
					<div class="ongletcadre">Caract&eacute;ristiques</div>				
					<div class="ongletcadre">Termin&eacute;</div>				

			</div>
			<div class="cadreaveconglet">
			
			
			
			
			
			
			
			<h1>INSCRIPTION</h1>
				
                <form action="admin_perso.src.php" method="post">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                        	<td>
            		Mail :<br />
                    <input name="mail" id="mail" type="text" size="25" maxlength="25" onChange="checkAccess_Phase2()"><br /><br />
                    V&eacute;rification du mail :<br />
                    <input name="verif_mail" id="verif_mail" type="text" size="25" maxlength="25" onChange="checkAccess_Phase2()"><br /><br />
                    Mot de passe du compte&nbsp;:<br />
                    <input name="passwd" id="passwd" type="password" size="25" maxlength="25" onChange="checkAccess_Phase2()" onKeyUp="passwordStrength(this.value)"><br /><br />
                    V&eacute;rification du mot de passe :<br />
                    <input name="verif_passwd" id="verif_passwd"  type="password" size="25" maxlength="25" onChange="checkAccess_Phase2()"><br /><br />
                    <label for="passwordStrength">Complexit&eacute; du mot de passe :</label>
                    <div id="passwordDescription">Mot de passe vide</div>
                    <div id="passwordStrength" class="strength0"></div>
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

En aucun cas nous vous les demanderons.	<br />
</p>
                            </td>
                        </tr>
            	</form>
				



                
			</div>
			
		</div>
		
	</body>
</html>
