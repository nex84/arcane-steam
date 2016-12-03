<script language="javascript" type="text/javascript">

function logVisible()
{
	document.getElementById('logIdentificator').style.display = "block";
	document.getElementById('logConnector').style.display = "none";
}

</script>


<div style="float:left;">
<a href="https://www.arcane-steam.com/">Index</a> | <a href="https://www.arcane-steam.com/?action=recherche">Rechercher un joueurs</a> 
</div>

<div style="float:right;">
<?php 
if(isset($_SESSION['id']))
{
	echo 'Bienvenus '.$_SESSION['login'].' - <a href="https://www.arcane-steam.com/?action=logout">Deconnection</a>';
}
else
{
	echo'<div id="logConnector" style="display:block;"><a href="#" onclick="logVisible();">Connection</a></div>';
}
?>

<div id="logIdentificator" style="display:none;">
<form action="" method="post" name="frm">
	Login :
	<input type="text" name="login" class="s" style="width:100px !IMPORTANT" />
	Mot de passe :
	<input type="password" name="password" class="s" style="width:100px !IMPORTANT"/>
	<input type="hidden" name="sub" value="1" />
	<input type="submit" name="Submit" class="s" value="Login" />
</form>
</div>

</div>

<div class="clear"></div>