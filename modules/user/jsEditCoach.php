<?php
	require_once('../../database/config.php');
	session_start();
	
?>
<?php

if(isset($_POST)){
	$name 			    = $_POST['name'];
	$email 			    = $_POST['email'];
	$password			= $_POST['password'];
	$club 				= $_POST['club'];
	$id					= $_POST['id'];

	$stmt=$db->prepare("SELECT * FROM users WHERE id=$id LIMIT 1");
	$stmt->execute();
    $user = $stmt->fetch();

	if($user){
		$sql="UPDATE users set name_sensei=?, email=?, password=?, club=? WHERE id=?";
		$stmt = $db->prepare($sql);
        $result=$stmt->execute([$name, $email, $password, $club, $id]);
		if($result){
			echo 'Edited Successfully';
		}
		else{
			echo 'There were errors while saving the data';
		}
	}
	else{
		echo 'Coach is already registered!';
	}
}
else{
	echo 'No data';
}