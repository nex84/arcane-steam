<?php
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/request.sql.php');
	
	$db = new database_connector();
	$alignements = $db->send_sql(select_alignements());
	
	for ($n = 1; $n <= $alignements['count']; $n++)
	{}
	
	if (!isset($_POST["mail"]) || !isset($_POST["passwd"]))
	{
		debug('ERREUR : des informations sont manquantes<br /><a href="admin_inscription.src.php">Retour</a>');
	}
	else
	{
		$user_mail = $_POST["mail"];
		$user_passwd = $_POST["passwd"];
	}
	
	$get_races =  $db->send_sql(select_races());
	for ($n = 1; $n <= $get_races['count']; $n++)
	{}
	
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
<script type="text/javascript" src="../../js/utility.js"> </script>
<script type="text/javascript" src="../../js/tinytip.js"> </script>
<script type="text/javascript" src="../../js/ajax.js"> </script>

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
			<div class="onglets">
					
                    <div class="ongletcadre">Inscription</div>
					<div class="ongletcadreselect">Personnage</div>
					<div class="ongletcadre">Caract&eacute;ristiques</div>				
					<div class="ongletcadre">Termin&eacute;</div>				

			</div>
			<div class="cadreaveconglet">
			<h1>PERSONNAGE</h1>
                
                    <form action="admin_carac.src.php" method="post">

                <table width="100%" border="0" weight="30" cellspacing="0">
                    	<tr>
                        	<td colspan="4">
            		Nom :<br />
                    <input id="nom_perso" name="nom_perso" type="text" size="25" maxlength="25"><br /><br />
                    		</td>
                        </tr>
                        <tr><td>Race :</td><td>
						<?php
							$j = 0;
							for($i=1; $i < $get_races['count'] + 1; $i++)
							{
								if ($j % 3 == 0 && $j != 0)
								{
									echo"</td><td>";
								}
								if ($get_races[$i]["actif"] == "1")
								{
									echo '<input name="race" type="radio" value='.$get_races[$i]["nom"].'><span onmouseover="Tip(\''.addslashes(str_replace(chr(13),'',$get_races[$i]["description"])).'\')" onmouseout="UnTip()">&nbsp;'.$get_races[$i]["nom"].'</span><br />';//'.addslashes(str_replace(chr(13),'',$get_races[$i]["description"])).'
									$j++;
								}
								else
								{
									echo '<input name="race" type="radio" value='.$get_races[$i]["nom"].' disabled="disabled"><span onmouseover="Tip(\''.addslashes(str_replace(chr(13),'',$get_races[$i]["description"])).'\')" onmouseout="UnTip()">&nbsp;'.$get_races[$i]["nom"].'</span><br />';
									$j++;
								}
							}
						?></td>
                        <!--<td>Race :<br />
                        <input name="race" type="radio" value="humain" checked>&nbsp;Humain<br />
                        <input name="race" type="radio" value="nain">&nbsp;Nain<br />
                        <input name="race" type="radio" value="elfe">&nbsp;Elfe<br />
                        </td>
                        <td><br />
                        <input name="race" type="radio" value="ange">&nbsp;Ange<br />
                        <input name="race" type="radio" value="elemental">&nbsp;El&eacute;mental<br />
                        <input name="race" type="radio" value="fee">&nbsp;F&eacute;e<br />
                        </td>
                        <td><br />
                        <input name="race" type="radio" value="gobelin">&nbsp;Gobelin<br />
                        <input name="race" type="radio" value="troll">&nbsp;Tr&ocirc;ll<br />
                        <input name="race" type="radio" value="creature">&nbsp;Cr&eacute;ature mal&eacute;fique<br />
                        </td>
-->                    </tr>
                
                  <tr>
                   	  <td colspan="2">
                      <br />
                      Alignement :<br />
                        <!--<select name="alignement">
                          <option value="LB" selected>Loyal Bon</option>
                            <option value="LN">Loyal Neutre</option>
                            <option value="LM">Loyal Mauvais</option>
                            <option value="NB">Neutre Bon</option>
                            <option value="NN">Neutre</option>
                            <option value="NM">Neutre Mauvais</option>
                            <option value="CB">Chaotique Bon</option>
                            <option value="CN">Chaotique Neutre</option>
                            <option value="CM">Chaotique Mauvais</option>
                        </select><br />-->
                        <select name="alignement">
                        <?php
                        	for ($i = 1; $i <= $alignements['count']; $i++)
							{
						?>
            				<option value="<? echo $alignements[$i]['code_align']; ?>"><? echo $alignements[$i]['nom']; ?></option>
            			<?php
							}
						?>
                        </select>
               	    </td>
                    <td align="right">
                    <input name="user_mail" type="hidden" value="<?php echo $user_mail; ?>">
                    <input name="user_passwd" type="hidden" value="<?php echo md5($user_passwd); ?>">
                    
                    <input name="valid" id="valid" type="submit" value="Suivant &gt;">
                            </td>
                        </tr>
                        
                        </table>
            	</form>
           
				
			</div>
		</div>
		
		<script language="javascript">
		function verif_login(nom) {
    //On commence par créer l'objet
    var _xhr=new HTTPObject();
    _xhr.setVar('login',nom);
    _xhr.callBack('Check');
    _xhr.post('./verif_login.php');
	
}

function Check(o,v){
	if(o.responseText == 'OK')
	{
		document.getElementById('nom_perso').style.border="solid #FF99FF 1px";
		document.getElementById('valid').disabled=false;
	}
	else
	{
		document.getElementById('nom_perso').style.border="solid #FF9999 1px";
		document.getElementById('valid').disabled=true;
	}
}
		</script>
	</body>
</html>
