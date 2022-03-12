<?php 
    include 'database/config.php';
    include 'database/database.php';

    $sqlstatement="SELECT * FROM participants";
	$result= mysqli_query($connect, $sqlstatement);

    if(isset($_POST)){
        $id 			    = $_POST['id'];
        $stmt=$db->prepare("SELECT * FROM participants WHERE id=? AND video_link!=''");
        $stmt->execute([$id]);
        $video = $stmt->fetch(); 
        unset($_POST);
        if($video){
?>

    <div class="container">
        <div class="row">
        <iframe class="embed-responsive-item" src="<?php echo substr(trim(json_encode($video[7]),'"'),0,-17);?>/preview" width="720" height="480" allow="autoplay" allowfullscreen></iframe>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col">
                <h4>Participant Information</h4>
                <h6>
                <?php 
                    
                        echo 'Name: '.trim(json_encode($video[1]),'"');
                        echo '<br>Age: '.trim(json_encode($video[2]),'"');
                        echo '<br>Gender: '.trim(json_encode($video[3]),'"');
                        echo '<br>Event: '.trim(json_encode($video[4]),'"');
                        echo '<br>Category: '.trim(json_encode($video[5]),'"');
                        echo '<br>Club: '.trim(json_encode($video[6]),'"');
                ?>
                </h6>
            </div>
        </div>
    </div>

<?php
    }
    else{
        echo "<h5>No video registered for this participant.</h5>";
    }
}
?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    
</body>
</html>
