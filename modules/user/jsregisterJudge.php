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
	$role				= "judge";

    $stmt=$db->prepare("SELECT * FROM users WHERE role='judge'");
    $stmt->execute();
    $stmt -> fetch();
    $numberofrows = $stmt->rowCount();
    if($numberofrows>=5){
        echo 'Reached the max number of Judges!';
    }
    else{
        $stmt=$db->prepare("SELECT * FROM users WHERE name_sensei=? and email=? and password=? and club=? and role=?");
        $stmt->execute([$name, $email, $password, $club, $role]);
        $user = $stmt->fetch();
    
        if(!$user){
            $sql="INSERT INTO users(name_sensei, email, password, club, role) VALUES(?,?,?,?,?)";
            $stminsert = $db->prepare($sql);
            $result=$stminsert->execute([$name, $email, $password, $club, $role]);
            if($result){
                echo 'Successfully Saved';
            }
            else{
                echo 'There were errors while saving the data';
            }
        }
        else{
            echo 'Coach is already registered!';
        }
    }
}
else{
	echo 'No data';
}