<?php 
    include 'modules/head/headJudge.php';
    include 'database/database.php';

    $sqlstatement="SELECT * FROM participants";
	$result= mysqli_query($connect, $sqlstatement);

    if( $_POST["name"] || $_POST["event"] ){
        $name 			    = $_POST['name'];
        $event 			    = $_POST['event'];
        $category			= $_POST['category'];
        $stmt=$db->prepare("SELECT * FROM participants WHERE name_participant=? and kata_kumite=? and category_participant=?");
        $stmt->execute([$name, $event, $category]);
        $scoring = $stmt->fetch(); 
        

?>
<section class="page-section" id="scoringSheet">
    <div class="container">
        <div class="text-center">
            <h2 class="section-subheading text-muted">Participant Scoring</h2>
        </div>
        <div class="row">
        <iframe class="embed-responsive-item" src="https://drive.google.com/file/d/1K04MBNE3yAMKVk3m9xr6S2dByBL_9pit/preview" width="720" height="480" allow="autoplay" allowfullscreen></iframe>
        </div>
    </div>
    <br><br>
    <form>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col">
                <h4>Participant Information</h4>
                <h6>
                <?php 
                    if($scoring){
                        echo 'Name: '.trim(json_encode($scoring[1]),'"');
                        echo '<br>Age: '.trim(json_encode($scoring[2]),'"');
                        echo '<br>Gender: '.trim(json_encode($scoring[3]),'"');
                        echo '<br>Event: '.trim(json_encode($scoring[4]),'"');
                        echo '<br>Category: '.trim(json_encode($scoring[5]),'"');
                        echo '<br>Club: '.trim(json_encode($scoring[6]),'"');
                    }
                    
                }
                ?>
                </h6>
            </div>
            <div class="col col-lg-4">
                <div class="form-group">
                    <input class="form-control" min=0 max=10 id="score_tp" type="number" placeholder="TP"/>
                </div>
                <div class="form-group">
                    <input class="form-control" min=0 max=10 id="score_ap" type="number" placeholder="AP"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Submit" id="SubmitScore">
                </div>
            </div>
        </div>
    </div>
    </form>
</section>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
