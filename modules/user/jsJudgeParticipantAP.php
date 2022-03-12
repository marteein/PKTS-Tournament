<?php
	require_once('../../database/config.php');
	session_start();
	
?>
<?php

if(isset($_POST)){
	$ap 			    = $_POST['ap'];
	$tp 			    = $_POST['tp'];
    $name               = $_POST['name'];
    $event              = $_POST['event'];
    $category           = $_POST['category'];
    $judge              = $_SESSION['userlogin']['email'].'AP';

	$stmt=$db->prepare("SELECT * FROM score_sheet_ap WHERE name_participant=? and kata_kumite=? and category_participant=?");
	$stmt->execute([$name, $event, $category]);
    $user = $stmt->fetch();

	if(!$user){
		$sql="INSERT INTO score_sheet_ap(name_participant, kata_kumite, category_participant, $judge) VALUES(?,?,?,?)";
		$stminsert = $db->prepare($sql);
        $result=$stminsert->execute([$name, $event, $category, $ap]);
		if($result){
			echo 'Judging Complete';
		}
		else{
			echo 'There were errors while saving the data';
		}
		
	}
	else if($user){
		if(trim(json_encode($user[$judge]),'"')>0){
			echo 'You already gave a score for this participant';
		}
		else{
			$sql="UPDATE score_sheet_ap SET $judge=? WHERE name_participant=? and kata_kumite=? and category_participant=?";
			$stminsert = $db->prepare($sql);
			$result=$stminsert->execute([$ap, $name, $event, $category]);
			if($result){
				echo 'Judging Complete';
			}
			else{
				echo 'There were errors while saving the data';
			}
		}
	}
}
else{
	echo 'No data';
}