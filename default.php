<h1>Bienvenus</h1>
            <p>
            	Ouverture prochaine... <br />
                Open soon...
            </p>
             <h1>News</h1>
             <?
				$c = new database_connector();
				$data = $c->send_sql("SELECT id,date, auteur, titre, corps FROM  news WHERE isPublish=1  ORDER BY id DESC LIMIT 5");
				if ($data['count'] > 0)
				{
					for($i = 1; $i <= $data['count']; $i++)
					{
						echo '<h2>'.$data[$i]['titre'].'</h2>';
						echo '<p><i> le '.$data[$i]['date'].' - '.$data[$i]['auteur'].'</i><br />';
						echo ''.$data[$i]['corps'].'</p><br />';
						echo '<a href="?action=seeNews&amp;idNews='.$data[$i]['id'].'">More ... </a>';
					}
				}
			?>
            <br />
            <br />
            <div style="float:right">
           	 <a href="?action=seeArchive">Toute les News</a>
            </div>
            <div class="clear"></div>
             
             <h1>Acc&eacute;e au jeux</h1>
             <p>
             	Suivez le guide <a href="https://www.arcane-steam.com/src/Jeux/jeux.php">[ici]</a>
             </p>
            