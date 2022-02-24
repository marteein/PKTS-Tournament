<?php
require("database/config.php");

function getUserData($id){
	$array = array();
	$q = mysql_query("SELECT * FROM users WHERE id=".$id);
	while($r=mysql_fetch_assoc($q)){
		$array['id'] = $r['id'];
		$array['email'] = $r['email'];
		$array['password'] = $r['password'];
		$array['name'] = $r['name_sensei'];
		$array['club'] = $r['club'];
		// $array['totalCart'] = $r['totalCart'];
		// $array['cart'] = $r['cart'];
	}
	return $array;
}

function getId($username){
	$q = mysql_query("SELECT * FROM users WHERE id=".$username);
	while($r=mysql_fetch_assoc($q)){
		return $r['i'];
	}
}
?>