<?php
    include 'database/config.php';
    include 'database/database.php';
    // $sqlstatement="SELECT * FROM score_sheet_ap
    // LEFT JOIN participants ON score_sheet_ap.name_participant=participants.name_participant AND score_sheet_ap.kata_kumite=participants.kata_kumite AND score_sheet_ap.category_participant=participants.category_participant
    // RIGHT JOIN score_sheet_tp ON score_sheet_tp.name_participant=participants.name_participant AND score_sheet_tp.kata_kumite=participants.kata_kumite AND score_sheet_tp.category_participant=participants.category_participant";
    // $result= mysqli_query($connect, $sqlstatement);

    $event 			    = $_POST['event'];
    $category			= $_POST['category'];
    $age                = $_POST['age'];
    $ageM1              = $age-1;
    $ageP1              = $age+1;
    $gender             = $_POST['gender'];
    if($age<18 && $age>5){
        $stmt=$db->prepare("SELECT * FROM score_sheet_tp
        RIGHT JOIN score_sheet_ap ON score_sheet_ap.name_participant=score_sheet_tp.name_participant and score_sheet_ap.kata_kumite=score_sheet_tp.kata_kumite and score_sheet_ap.category_participant=score_sheet_tp.category_participant
        RIGHT JOIN participants ON participants.name_participant=score_sheet_ap.name_participant and participants.kata_kumite=score_sheet_ap.kata_kumite and participants.category_participant=score_sheet_ap.category_participant 
        WHERE participants.kata_kumite=? and participants.gender_participant=? and participants.category_participant=? and participants.age_participant>? and participants.age_participant<=?");
        $stmt->execute([$event, $gender, $category, $ageM1, $ageP1]); 
    }
    else if($age<=5){
        $stmt=$db->prepare("SELECT * FROM score_sheet_tp
        RIGHT JOIN score_sheet_ap ON score_sheet_ap.name_participant=score_sheet_tp.name_participant and score_sheet_ap.kata_kumite=score_sheet_tp.kata_kumite and score_sheet_ap.category_participant=score_sheet_tp.category_participant
        RIGHT JOIN participants ON participants.name_participant=score_sheet_ap.name_participant and participants.kata_kumite=score_sheet_ap.kata_kumite and participants.category_participant=score_sheet_ap.category_participant 
        WHERE participants.kata_kumite=? and participants.gender_participant=? and participants.category_participant=? and participants.age_participant<=?");
        $stmt->execute([$event, $gender, $category, $age]); 
    }
    else if($age>=18){
        $stmt=$db->prepare("SELECT * FROM score_sheet_tp
        RIGHT JOIN score_sheet_ap ON score_sheet_ap.name_participant=score_sheet_tp.name_participant and score_sheet_ap.kata_kumite=score_sheet_tp.kata_kumite and score_sheet_ap.category_participant=score_sheet_tp.category_participant
        RIGHT JOIN participants ON participants.name_participant=score_sheet_ap.name_participant and participants.kata_kumite=score_sheet_ap.kata_kumite and participants.category_participant=score_sheet_ap.category_participant 
        WHERE participants.kata_kumite=? and participants.gender_participant=? and participants.category_participant=? and participants.age_participant>=?");
        $stmt->execute([$event, $gender, $category, $age]);
        
    }
    //$result= mysqli_query($connect, $sqlstatement);


?>
<script src="js/registerParticipant_scorecard.js"></script>

<div class="row" style="overflow-x: auto;">
    <table class="table cell-border" style="width:95%;" data-order='[[ 0, "asc" ]]' data-page-length='10' id="ScoreTable">
        <thead class='thead-dark'>
            <tr>
                <th rowspan="2">Name</th>
                <th colspan="2">Judge 1</th>
                <th colspan="2">Judge 2</th>
                <th colspan="2">Judge 3</th>
                <th colspan="2">Judge 4</th>
                <th colspan="2">Judge 5</th>
                <th rowspan="2">Total</th>
            </tr>
            <tr>
                <th>TP</th>
                <th>AP</th>
                <th>TP</th>
                <th>AP</th>
                <th>TP</th>
                <th>AP</th>
                <th>TP</th>
                <th>AP</th>
                <th>TP</th>
                <th>AP</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td class="bg-dark text-light"><?php echo $row['name_participant']?></td>
                <td class="bg-light"><?php echo $row['judge_1TP']?></td>
                <td class="bg-light"><?php echo $row['judge_1AP']?></td>
                <td class="bg-dark text-light"><?php echo $row['judge_2TP']?></td>
                <td class="bg-dark text-light"><?php echo $row['judge_2AP']?></td>
                <td class="bg-light"><?php echo $row['judge_3TP']?></td>
                <td class="bg-light"><?php echo $row['judge_3AP']?></td>
                <td class="bg-dark text-light"><?php echo $row['judge_4TP']?></td>
                <td class="bg-dark text-light"><?php echo $row['judge_4AP']?></td>
                <td class="bg-light"><?php echo $row['judge_5TP']?></td>
                <td class="bg-light"><?php echo $row['judge_5AP']?></td>
                <td class="bg-dark text-light" id="<?php echo $row['id']?>"></td>
                <script>
                    var tp1 = parseFloat(<?php echo $row['judge_1TP']?>);
                    var tp2 = parseFloat(<?php echo $row['judge_2TP']?>);
                    var tp3 = parseFloat(<?php echo $row['judge_3TP']?>);
                    var tp4 = parseFloat(<?php echo $row['judge_4TP']?>);
                    var tp5 = parseFloat(<?php echo $row['judge_5TP']?>);

                    var ap1 = parseFloat(<?php echo $row['judge_1AP']?>);
                    var ap2 = parseFloat(<?php echo $row['judge_2AP']?>);
                    var ap3 = parseFloat(<?php echo $row['judge_3AP']?>);
                    var ap4 = parseFloat(<?php echo $row['judge_4AP']?>);
                    var ap5 = parseFloat(<?php echo $row['judge_5AP']?>);

                    var totalTP = (tp1+tp2+tp3+tp4+tp5)-(Math.min(tp1,tp2,tp3,tp4,tp5))-(Math.max(tp1,tp2,tp3,tp4,tp5));
                    var totalAP = (ap1+ap2+ap3+ap4+ap5)-(Math.min(ap1,ap2,ap3,ap4,ap5))-(Math.max(ap1,ap2,ap3,ap4,ap5));
                    var TotalScore = (totalTP*0.70)+(totalAP*0.30);
                    document.getElementById('<?php echo $row['id']?>').innerHTML = TotalScore.toFixed(2);
                </script>
            </tr>	
            <?php } ?>
        </tbody>
    </table>
</div>