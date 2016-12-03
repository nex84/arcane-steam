				<div id="login">
					<span class="Orange">Identification : </span>
					<p>
						Login :<br />
						<input type="text" name="login" class="s" /><br />
						Password :<br />
						<input type="password" name="pass" class="s"/><br /><br />
						<input type="submit" name="submite" value="Loggin" class="s"/>
  <hr />
						<a href="./index.php?action=create">Cr&eacute;&eacute; un compte ?</a>
						<a href="./index.php?action=return">Retrouver vos information ?</a>
					</p>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
<ul>
		<?
			$query = mysql_query("SELECT cat.id as idCat,cat.name as catName, menus.name as menusName,menus.id as idMenus FROM siteGame_menus as menus, siteGame_categorie as cat WHERE cat.status = 1 AND menus.status = 1 AND cat.id = menus.id_cat AND cat.isMembre = '".addslashes($_SESSION["isMembre"])."' AND cat.isModo = '".addslashes($_SESSION["isModo"])."' AND cat.isAdmin = '".addslashes($_SESSION["isAdmin"])."' ORDER BY menus.id_cat");
			if ($query)
			{
				$nb = mysql_num_rows($query);
				if ($nb > 0)
				{
					$last = 0;
					for ($i = 0; $i < $nb; $i++)
					{
						$tab = mysql_fetch_assoc($query);
						if ($tab['idCat'] != $last)
						{
							$last = $tab['idCat'];
							echo '
							<li><span class="titreMenus">'.$tab['catName'].'</span></li>
							<li><a href="./index.php?cat='.$tab['idCat'].'&action='.$tab['idMenus'].'" class="menus">'.$tab['menusName'].'</a></li>
							';
						}
						else
						{
						echo '
						<li><a href="./index.php?cat='.$tab['idCat'].'&action='.$tab['idMenus'].'" class="menus">'.$tab['menusName'].'</a></li>
						';
						}
					}
				}
			}
			else
				echo mysql_error();
		?>
</ul>