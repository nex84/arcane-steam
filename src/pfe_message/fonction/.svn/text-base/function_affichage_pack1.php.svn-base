<?php

function admistration_box($donne)
{
	//inclusion CSS
	require_once("./css/admin_box.css");
	//recuperation des donne utile
	$liste_box = box::dispatch_box($_SESSION,get_liste);
	?>
	
	<div id="encadrer">
		<div class="titre"><h2>  Bienvennu dans votre administration de boite d'archive </h2> </div>
		<div class="creation"><a href="<?php  echo $PHP_SELF ?>?action=nouveau&moment=1"> Ajouter une boite </a></div>
		<a href="./message_box.php"> <div>fermer </div></a>
		<?php  
				for($i =0; $i < count($liste_box) - 1; $i++)
				{
				   echo '<div class="englobeur">
				   			<div class="nom_box"> '.  $liste_box[$i]['name'] .'  </div>
				   			<a href="'.$PHP_SELF.'?box='.$liste_box[$i]['num'].'&action=edition" class="edtier_box"><div> Editer </div></a>
							<a href="'.$PHP_SELF.'?box='.$liste_box[$i]['num'].'&action=delete" class="delete_box"><div> Suprimer </div></a>
				   		</div>';
				}               
		?>
	</div>
<?php	
}

function admistration_box_form_creation($donne)
{
	//inclusion CSS
	require_once("./css/admin_box.css");
	//recuperation des donne utile
	$liste_box = box::dispatch_box($_SESSION,get_liste);
	?>
	
	<div id="encadrer">
		<div class="titre"><h2>  Creation d'une nouvele boite d'archvie boite d'archive </h2> </div>
		<form method="post" action="<?php $PHP_SELF?>?action=nouveau&moment=2">
		<div class="creation"> <input type="text" name="nom_box" /> </div>
		<div class="creation"> <input type="submit" name="sub" value="crée la boite d'archive" /> </div>
		</form>
	</div>
<?php	
}




?>