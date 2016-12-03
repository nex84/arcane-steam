<?

if (!isset($APPLENT))
{
	header('Location: http://arcanis.ath.cx/error/error.php?t=404');
}


if (isset($_REQUEST['action']) && $_REQUEST['action'] == 1)
{
	echo '
	<h1>Test zpeifergh</h1>
	<div class="new">
	<div class="titreNew">Titre de la newwww :</div>
	<div class="TxtNew">
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprr<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
	</div>
	<div class="clear"></div>
	<hr />
	<div class="by">
		Le : xx/xx/xxxx | Categorie : <a href="">Category name</a> | Par : <a href="">Login</a>
	</div>
	<div class="clear"></div>
	</div>
	<h1>Test zpeifergh</h1>
	<div class="new">
	<div class="titreNew">Titre de la newwww :</div>
	<div class="TxtNew">
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprr<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprijtrtj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
		ezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnjezoeprinrtnj<br />
	</div>
	<div class="clear"></div>
	<hr />
	<div class="by">
		Le : xx/xx/xxxx | Categorie : <a href="">Category name</a> | Par : <a href="">Login</a>
	</div>
	<div class="clear"></div>
	</div>'; 
}
else if (!isset($_REQUEST['action']) && isset($_REQUEST['cat']))
{
	echo '<h1>Site map</h1>';
	$query1 = mysql_query("SELECT * FROM siteGame_categorie WHERE id = '".addslashes($_REQUEST['cat'])."'");
	if ($query1)
	{
		$tab = mysql_fetch_assoc($query1);
		echo '
		<div class="new">
		<div class="titreNew">'.$tab['name'].'</div>';
	}
	if (!isset($_REQUEST['action']))
	{
		$query2 = mysql_query("SELECT * FROM siteGame_menus WHERE id_cat = '".addslashes($_REQUEST['cat'])."'");
		echo '<div class="TxtNew"><ul>';
		if ($query2)
		{
			$nb = mysql_num_rows($query2);
			for($i = 0; $i < $nb; $i++)
			{
				$tab1 = mysql_fetch_assoc($query2);
				echo '<li><a href="./index.php?cat='.$_REQUEST['cat'].'&action='.$tab1['id'].'">'.$tab1['name'].'</a></li>';
			}
		}
		echo '</ul></div>';
	}
}
?>