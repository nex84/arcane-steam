<script language="javascript">

function changeLvl()
{
//Dialog.alert("<br><br><center>Vous pouvez maintenant changer de niveau.</center><br><br>", {width:300, height:100, okLabel: "close",className:"dialog", ok:function(win) {debug("validate alert panel"); return true;}});

}

function newMail(nb)
{
Dialog.alert("<br><br><center>Vous avez "+nb+" nouveaux messages.</center><br><br>", {width:300, height:100, okLabel: "close",className:"dialog", ok:function(win) {debug("validate alert panel"); return true;}});

}

</script>

<?php
	@session_start();
	require_once('../../includes/constant.inc.php');
	require_once('../../includes/functions.inc.php');
	require_once('../../includes/fonctions_guilde.php');
	require_once('../../includes/fonctions_class.php');
	require_once('../../includes/request.sql.php');
	require_once('../../class/Messagerie/box.class.php');
	
	$u = new joueur_data($_SESSION["id"],'caracts_now');
	
	$donne['id'] = $_SESSION["id"];
	$donne['nom'] = $u->get_login();
	
	$c = new box();
	$c->dispatch_box($donne,'get_non_lu');
	
	$dataMail = mysql_fetch_assoc($c->data);
	
	if($dataMail['nb'] > 0)
	{
		echo '<script language="javascript">';
		echo 'newMail('.$dataMail['nb'].');';
		echo '</script>';
	}
	
?>	



<table width="100%" border="0">
	<tr height="50">
		<td colspan="6"> </td>
	</tr>
  <tr>
    <td rowspan="2" width="120px"  align="center"><div class="avatar" ><img src="<?php echo $u->get_avatar(); ?>" alt="[ Avatar ]" height="100"/></div></td>
    <td colspan="8"  align="center"><center><h1><?php echo $u->get_nom();?></h1></center></td>
    <td  align="center" ><a href="ajax/deco.php"><img src="../../images/deco.png" height="50" width="200" alt="deconnection" title="deconnection"></a></td>
  </tr>
  <tr >
    <td></td>
    <td style="color:#FF9900; " width="6%"  align="center"> Lvl :  <?=$u->get_rang() ?></td>
    <td style="color:#FF9900; " width="16%"  align="center"> <img src="../../images/caract/xp.png" height="40" width="40"> XP :  <?= $u->get_xp(); ?></td>
	 <? 
	 if($u->get_xp_class() > (return_prix_class($u->get_xp_class(),get_class_rang($u->get_idClass()))-1))
	 	 {
		 	echo '<script language="javascript">';
		 	echo 'changeLvl();';
		 	echo '</script>';
		 
   			echo '<td style="color:red; " width="28%" align="center" ><div style="float:left;width:42px;"><img src="../../images/caract/up.png" height="40" width="40" /></div><div style="float:left;width:150px;"><a href="#" onclick="affWin(\'class_up.php\',\' changement de classe\')" > Vous pouvez changer de classe </a></div></td>';
		}
		else 
		{  
			echo '<td style="color:#FF9900; " width="28%"><img src="../../images/caract/xp_class.png" height="40" width="40" />  ' . $u->get_xp_class();
		}
        
        
        
         ?>
        <td style="color:#FF9900; " width="15%" align="center"> <?= $u->get_classe(); ?> </td>
    <td style="color:#FF9900; " width="15%" align="center">  <?= $u->get_race(); ?> </td>
    <td style="color:#FF9900;" width="15%" align="center"><a href="#" onclick="affWin('guilde.php',' Ma page de guilde')"> <?= $u->get_guilde_name(); ?></a></td>
    <td></td>
    <td><img src="../../images/refresh.png" height="60" onClick="getmap(<?= $u->get_id();  ?>)" alt="refresh" title="refresh la carte"> <img src="../../images/chat.png" height="40" onClick="affWin('../../chat/index.php','chat')" alt="chat" title="Entrer dans le chat" >
    <?
		if($u->get_isAdm() > 0)
		{
				echo'<a href="#"  onclick="affWin(\'../adminIndex.php\',\'Administration\')">administration </a>';
		}
	?>
    </td>
  </tr>
</table>
