<?php
	require_once('../../database/config.php');
	session_start();
	
?>
<?php

if(isset($_POST)){
	$name 			    = $_POST['name'];
	$age 			    = $_POST['age'];
	$gender			    = $_POST['gender'];
	$katakumite 		= $_POST['katakumite'];
	$categorieskata	 	= $_POST['categoriesKata'];
	$categorieskumite	= $_POST['categoriesKumite'];
	$club				= $_SESSION['userlogin']['club'];
	//$tablename 		= mysql_real_escape_string($_POST['email']);
	$stmt=$db->prepare("SELECT * FROM participants WHERE name_participant=? and kata_kumite=? and category_participant=?");
    if($katakumite=='Kata'){
		$stmt->execute([$name, $katakumite, $categorieskata]);
	}
	else if($katakumite=='Kumite'){
		$stmt->execute([$name, $katakumite, $categorieskumite]);
	}
    $user = $stmt->fetch();

	if(!$user && $categorieskata !='Novice' && $categorieskata !='New Face'){
		$sql="INSERT INTO participants(name_participant, age_participant, gender_participant, kata_kumite, category_participant, club_participant) VALUES(?,?,?,?,?,?)";
		$stminsert = $db->prepare($sql);
        if($katakumite=="Kata"){
            $result=$stminsert->execute([$name, $age, $gender, $katakumite, $categorieskata,$club]);
        }
        else{
            $result=$stminsert->execute([$name, $age, $gender, $katakumite, $categorieskumite,$club]);
        }
		
		if($result){
			echo 'Successfully Saved';
		}
		else{
			echo 'There were errors while saving the data';
		}
	}
	else if(!$user && ($categorieskata =='Novice' || $categorieskata =='New Face')){
		if($categorieskata =='Novice'){
			$stmt3=$db->prepare("SELECT * FROM participants WHERE name_participant=? and kata_kumite=? and category_participant in ('Intermediate', 'Advanced', 'Master', 'Junro', 'New Face')");
		}
		else if($categorieskata =='New Face'){
			$stmt3=$db->prepare("SELECT * FROM participants WHERE name_participant=? and kata_kumite=? and category_participant in ('Intermediate', 'Advanced', 'Master', 'Junro', 'Novice')");
		}
		
		$stmt3->execute([$name, $katakumite]);
		$CheckUser = $stmt3->fetch();
		if(!$CheckUser){
			$sql="INSERT INTO participants(name_participant, age_participant, gender_participant, kata_kumite, category_participant, club_participant) VALUES(?,?,?,?,?,?)";
			$stminsert = $db->prepare($sql);
			if($katakumite=="Kata"){
				$result=$stminsert->execute([$name, $age, $gender, $katakumite, $categorieskata,$club]);
			}
			else{
				$result=$stminsert->execute([$name, $age, $gender, $katakumite, $categorieskumite,$club]);
			}
			
			if($result){
				echo 'Successfully Saved';
			}
			else{
				echo 'There were errors while saving the data';
			}
		}
		else{
			echo 'Participant not allowed to be registered in '.$categorieskata.' Kata Category.  Already participating in higher categories.';
		}
		
	}
	else{
		if($katakumite == 'Kata'){
			echo 'Participant already registered in '.$categorieskata.' '.$katakumite.'!';
		}
		else if($katakumite == 'Kumite'){
			echo 'Participant already registered in '.$categorieskumite.' '.$katakumite.'!';
		}
	}
	
	
}
else{
	echo 'No data';
}