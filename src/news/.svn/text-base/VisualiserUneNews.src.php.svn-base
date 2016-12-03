
 <?

 
 
 	if(isset($_REQUEST['idNews']))
	{
		$c = new database_connector();
		$data = $c->send_sql("SELECT date, auteur, titre, corps FROM  news WHERE isPublish=1 AND id='".addslashes($_REQUEST['idNews'])."'");
		if ($data['count'] > 0)
		{
			echo '<h1>'.$data[1]['titre'].'</h1>';
			echo '<p>'.$data[1]['corps'].'<br /><br /> <i>par '.$data[1]['auteur'].' le : '.$data[1]['date'].'</i> </p>';
		}
		
		$idNewsToComment = addslashes($_REQUEST['idNews']);
	}
	
	if (isset($_POST['subComment']))
	{
		if (isset($_POST['textNouvelle']) && $_POST['textNouvelle'] !="" && isset($_SESSION['id']) && isset($idNewsToComment))
		{
			$data = $c->send_sql("INSERT INTO news_comment (idNews, idUsers, commentaire) VALUES ('".$idNewsToComment."','".$_SESSION['id']."','".addslashes(str_replace(chr(13),"<br />",$_POST['textNouvelle']))."')");
			
			//echo "INSERT INTO news_comment (idNews, idUsers, commentaire) VALUES ('".$idNewsToComment."','".$_SESSION['id']."','".addslashes($_POST['textNouvelle'])."')";
		}
	}
?>