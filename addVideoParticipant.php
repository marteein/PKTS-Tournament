<?php 
    include 'database/config.php';
    include 'database/database.php';

    $sqlstatement="SELECT * FROM participants";
	$result= mysqli_query($connect, $sqlstatement);

    if(isset($_POST)){
        $id 			    = $_POST['id'];
        $link               = $_POST['link'];
        $stmt=$db->prepare("SELECT * FROM participants WHERE id=?");
        $stmt->execute([$id]);
        $video = $stmt->fetch(); 
        if($video){
            $sql="UPDATE participants set video_link=? WHERE id=?";
            $stmt = $db->prepare($sql);
            $result=$stmt->execute([$link, $id]);
            if($result){
                echo "Video Registered";
            }
            else{
                echo "Error adding the Video";
            }
        }
        else{
            echo "no data";
        }
    }
?>
