<?php

function find_id($nom)
{
	//users : id, nom
	$querry = "select id from users where login ='". $nom ."'";
	$res = mysql_query($querry);
	$fetch = mysql_fetch_assoc($res);
	return $fetch['id'];
}

function find_nom($id)
{
	//users : id, nom
	$querry = "select login from users where id ='". $id ."'";
	$res = mysql_query($querry);
	$fetch = mysql_fetch_assoc($res);
	return $fetch['nom'];
}


?>