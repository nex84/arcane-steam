<h1>Archive</h1>
 <?
    $c = new database_connector();
    $data = $c->send_sql("SELECT id,date, auteur, titre, corps FROM  news WHERE isPublish=1  ORDER BY id DESC");
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