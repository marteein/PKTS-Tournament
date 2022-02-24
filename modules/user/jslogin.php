<?php
session_start();

require_once('../../database/config.php');

$email = $_POST['email'];
$password = $_POST['password'];//sha1($_POST['password']);

$sql="SELECT*FROM users WHERE email = ? AND password = ? LIMIT 1";
$stmtselect = $db->prepare($sql);
$result = $stmtselect->execute([$email, $password]);


if($result){
	$user = $stmtselect->fetch(PDO::FETCH_ASSOC);
	if($stmtselect->rowCount()>0){
		$_SESSION['userlogin'] = $user;
		
		echo 'Welcome to PKTS Tournament Hub';
	}
	else{
		echo 'There is no user for that combo';
	}
}
else{
	echo 'There were errors while connecting to database';
}