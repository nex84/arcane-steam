<?
session_start();
require_once('../../includes/functions.inc.php');
$anti_path = return_anti_path();
include $anti_path.'class/database/database_connector.class.php';
require_once($anti_path.'includes/fonctions_respawn.php');
require_once($anti_path.'includes/constant.inc.php');
require_once($anti_path.'includes/request.sql.php');
require_once($anti_path.'crypt/functions.php');

if(!isset($_SESSION['id']))
{
	header("Location:login.php");
}

$_SESSION['c_perso'] = new joueur_data($_SESSION['id'],'caracts_now');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="./style.css" rel="stylesheet" media="all" />

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
<link href="../../css/darkX.css" rel="stylesheet" type="text/css" >	 </link>



<title>~Arcane-steam - Les arcanes de la vapeur[ <? echo $_SESSION['c_perso']->get_login() ?> ]</title>
</head>

<body id="userMain">

<div  id="container_menus" style="height:236;" >
<? 
require_once('./include/header.php'); 
$_SESSION['c_perso']->respawn();
 ?>
</div>

<div id="container_game">
	<div id="zone_caracteristique" style="border:width:125px; float:left;">
	</div>
	<div id="zone_map" style=" float:left; width:550px; height:650px; padding-left:45px; padding-right:15px; padding-top:45px;">
	&nbsp;
	</div>
	<div id="zone_Deplacement" >
		<div id="zone_Deplacement_carre">
		<table width="100%" cellpadding="2" align="center" cellspacing="0" border="0" height="227">
			<tr>
				<td width="33%" align="right"><img src="../../images/autres/NO.png" id="btn_move_down" onclick="move('-1','-1','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
				<td width="33%"><img src="../../images/autres/NN.png" id="btn_move_up" onclick="move('-1','0','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
				<td width="33%"><img src="../../images/autres/NE.png" id="btn_move_down" onclick="move('-1','1','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
			</tr>
			
			<tr>
				<td width="33%" align="right" ><img src="../../images/autres/OO.png" id="btn_move_left" onclick="move('0','-1','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
				<td width="33%"></td>
				<td width="33%" align="right"><img src="../../images/autres/EE.png" id="btn_move_rigth" onclick="move('0','1','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
			</tr>
			
			<tr>
				<td width="33%" align="right" valign="top"><img src="../../images/autres/SO.png" id="btn_move_down" onclick="move('1','-1','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
				<td width="33%"><img src="../../images/autres/SS.png" id="btn_move_down" onclick="move('1','0','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
				<td width="33%" valign="top"><img src="../../images/autres/SE.png" id="btn_move_down" onclick="move('1','1','<? echo $_SESSION['c_perso']->get_id(); ?>')" /></td>
			</tr>
		</table>
		</div>
		<div id="zone_Deplacement_caract">
		<table width="90%" cellpadding="2" align="center" cellspacing="0" border="0">
			<tr>
				<td>
					<div id="caraceristique_ajax"></div>
				</td>
			</tr>
		</table>
		</div>
	</div>
</div>

<script language="javascript" type="text/javascript">
function getmap(j)
{
    //On commence par créer l'objet
	/*
    var _xhr=new HTTPObject();
    //on renseigne ensuite les valeurs qui seront utiles pour le traitement de la saisie
    //Ici par exemple j'ai juste besoin d'un ID pour aller rechercher des valeurs associées
    _xhr.addArg('joueur_id',j);
    //On peut même ajouter des variables locales à l'objet
    //Je suppose ici que à chaque joueur correspond un élément asocié pour afficher les infos de son porso
    //Je stocke en référence l'ID de l'élément HTML ou je dois afficher le résultat du traitement
    _xhr.setVar('container','zone_map');
    //callBack est la fonction à appeler une fois le traitement terminé.
    // Cette valeur peut rester vide si il n'y a pas de retour à afficher
    _xhr.callBack('map_recup');
    //Ici, on fait un appel à la page getperso.php avec la méthode GET
    // L'url appelé ressemble à getjoueur.php?joueur_id=10&perso_id=54
    _xhr.post('Aff_carte.php');
    //On veut indiquer que la recherche est en cours
    //On commence par faire apparaître la zone
	*/
	ajax('joueur_id=' + j, 'Aff_carte.php', 'zone_map');
	
	
    document.getElementById('zone_map').style.display='';
    //Petit message pour faire patienter
    //document.getElementById('zone_map').innerHTML='<img src="images/indicator.gif" alt="load" />Mise à jour de la carte';
	
	
	
	var id = <? echo $_SESSION['c_perso']->get_id(); ?>;
	setTimeout("getmap(id)",30000);
}

var sourieX = 0;
var sourieY = 0;

function position(e)
{
sourieX = (navigator.appName.substring(0,3) == "Net") ? e.pageX : event.x+document.body.scrollLeft;
sourieY = (navigator.appName.substring(0,3) == "Net") ? e.pageY : event.y+document.body.scrollTop;
}


if(navigator.appName.substring(0,3) == "Net")
document.captureEvents(Event.MOUSEMOVE);

document.onmousemove = position;

function caracteristique()
{
	//var win = new Window({className: "dialog", title: "Arcane-Steam // Caractéristique", top:70, left:100, width:800, height:600, url: "http://dev.arcane-steam.com/src/perso/affiche_profil.src.php", showEffectOptions: {duration:1.5}}) 
	//win.show(); 
}

function messagerie()
{
	//var win = new Window({className: "dialog", title: "Arcane-Steam // Messagerie", top:70, left:100, width:800, height:600, url: "http://dev.arcane-steam.com/src/pfe_message/message_box.php", showEffectOptions: {duration:1.5}}) 
	//win.show(); 
}


function getData(j) {
/*
    var _xhr=new HTTPObject();

    _xhr.addArg('joueur_id',j);

    _xhr.setVar('container','zone_caracteristique');

    _xhr.callBack('info_recup');

    _xhr.post('get_caractUsers.php');

    document.getElementById('zone_caracteristique').style.display='';
    document.getElementById('zone_caracteristique').innerHTML='<img src="images/indicator.gif" alt="load" />Mise à jour de vos competence';
	var id = <? echo $_SESSION['c_perso']->get_id(); ?>;*/
	
}


function caracterisiqueAjax() {
    //On commence par créer l'objet
    var _xhr=new HTTPObject();
    _xhr.setVar('container','zone_map');
    _xhr.callBack('caracterisique');
    _xhr.post('./ajax/caracteristique.php');
	
}

function caracterisique(o,v){
	document.getElementById('caraceristique_ajax').innerHTML=o.responseText;
	setTimeout("caracterisiqueAjax()",30000);
}
function getsession() {
    //On commence par créer l'objet
    var _xhr=new HTTPObject();
    _xhr.setVar('container','zone_map');
    _xhr.callBack('checking');
    _xhr.post('./ajax/connected.php');
}

function checking(o,v){
    if(o.responseText == 'ko')
	{
		alert('Votre session a expirée. Vous allez être redirigé vers la page d\'authentification');
		window.location='./login.php';
	}
	setTimeout("getsession()",60000);
}

function move(x,y,j)
{
	document.getElementById('btn_move_up').disabled = true;
	document.getElementById('btn_move_left').disabled = true;
	document.getElementById('btn_move_down').disabled = true;
	document.getElementById('btn_move_rigth').disabled = true;

	setTimeout("ungele()",1000);
	
    var _xhr=new HTTPObject();
    //on renseigne ensuite les valeurs qui seront utiles pour le traitement de la saisie
    //Ici par exemple j'ai juste besoin d'un ID pour aller rechercher des valeurs associées
    _xhr.addArg('x',x);
	_xhr.addArg('y',y);
	_xhr.addArg('joueur_id',j);
    //On peut même ajouter des variables locales à l'objet
    //Je suppose ici que à chaque joueur correspond un élément asocié pour afficher les infos de son porso
    //Je stocke en référence l'ID de l'élément HTML ou je dois afficher le résultat du traitement
    _xhr.setVar('container','zone_map');
    //callBack est la fonction à appeler une fois le traitement terminé.
    // Cette valeur peut rester vide si il n'y a pas de retour à afficher
    _xhr.callBack('move_recup');
    //Ici, on fait un appel à la page getperso.php avec la méthode GET
    // L'url appelé ressemble à getjoueur.php?joueur_id=10&perso_id=54
    _xhr.post('move_joueur.php');
    //On veut indiquer que la recherche est en cours
    //On commence par faire apparaître la zone
    document.getElementById('zone_map').style.display='';
    //Petit message pour faire patienter
    //document.getElementById('zone_map').innerHTML='<img src="images/indicator.gif" alt="load" />Deplacement';
	caracterisiqueAjax();
}

function ungele()
{
	document.getElementById('btn_move_up').disabled = false;
	document.getElementById('btn_move_left').disabled = false;
	document.getElementById('btn_move_down').disabled = false;
	document.getElementById('btn_move_rigth').disabled = false;

}

function info_recup(o,v){
    document.getElementById('zone_caracteristique').innerHTML=o.responseText;
}
function trim (myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

function move_recup(o,v){
	if(trim(o.responseText) == 'ok')
	{
		var id = <? echo $_SESSION['c_perso']->get_id(); ?>;	
		getmap(id);
	}
	else
	{
		var id = <? echo $_SESSION['c_perso']->get_id(); ?>;	
		getmap(id);
		alert('"'+trim(o.responseText)+'"');
	}
}

function map_recup(o,v){
    document.getElementById('zone_map').innerHTML=o.responseText;
}

</script>

<script language="javascript" type="text/javascript">

var id = <? echo $_SESSION['c_perso']->get_id(); ?>;
getData(id);
getmap(id);
caracterisiqueAjax();
getsession();
setTimeout("getData(id)",1000);
//setTimeout("getmap(id)",30000);
setTimeout("getsession()",1000);
</script>

<script language="javascript">
function affWin(urlz,name)
{var win_3 = new Window({url:urlz, width:800, height:450,top:70, left:100,options: {method:"get", asynchronous:false}},{width:800, height:600, okLabel: "close",className:"darkX",title:name});win_3.show();}
</script>
</body>
</html>