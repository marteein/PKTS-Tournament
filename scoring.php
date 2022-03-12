<?php 
    include 'database/config.php';
    include 'database/database.php';

    $sqlstatement="SELECT * FROM participants";
	$result= mysqli_query($connect, $sqlstatement);

    if(isset($_POST)){
        $name 			    = $_POST['name'];
        $event 			    = $_POST['event'];
        $category			= $_POST['category'];
        $stmt=$db->prepare("SELECT * FROM participants WHERE name_participant=? and kata_kumite=? and category_participant=?");
        $stmt->execute([$name, $event, $category]);
        $scoring = $stmt->fetch(); 
        unset($_POST);

?>
<section class="page-section" id="scoringSheet">
    <div class="container">
        <div class="row">
        <iframe class="embed-responsive-item" src="https://drive.google.com/file/d/1K04MBNE3yAMKVk3m9xr6S2dByBL_9pit/preview" width="720" height="480" allow="autoplay" allowfullscreen></iframe>
        </div>
    </div>
    <br><br>
    <form method='POST'>
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
                    <input class="form-control" min=7 max=10 id="score_tp" type="number" placeholder="TP" onchange="setTwoNumberDecimal" step=".2" required/>
                </div>
                <div class="form-group">
                    <input class="form-control" min=7 max=10 id="score_ap" type="number" placeholder="AP" onchange="setTwoNumberDecimal" step=".2" required/>
                </div>
                <div class="form-group">
                    <input type="Submit" class="btn btn-success" id="SubmitScore" value="Submit">
                </div>
            </div>
        </div>
    </div>
    </form>
</section>
<script>

function setTwoNumberDecimal(event) {
    this.value = parseFloat(this.value).toFixed(1);
}
        $(function(){
            $('#SubmitScore').click(function(e){
                var valid = this.form.checkValidity();
                
                if(valid){
                    var ap = $('#score_ap').val();
                    var tp = $('#score_tp').val();
                    console.log(tp);
                    var name = '<?php echo $name;?>';
                    var category = '<?php echo $category;?>';
                    var event = '<?php echo $event;?>';
                }
                e.preventDefault();

                Swal.fire({
                    title: 'Judging',
                    text: 'Are you sure about your Scores? You won\'t be able to change it later.',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        confirmButton: 'order-1',
                        denyButton: 'order-2',
                    }
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: 'modules/user/jsJudgeParticipantAP.php',
                            data: {ap:ap, tp:tp, name:name, category:category, event:event},
                            success:function(data){
                                if(data=="Judging Complete"){
                                    $.ajax({
                                        type: 'POST',
                                        url: 'modules/user/jsJudgeParticipantTP.php',
                                        data: {ap:ap, tp:tp, name:name, category:category, event:event},
                                        success:function(data){
                                            if(data=="Judging Complete"){
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: data,
                                                    text: 'Successfully saved your score',
                                                    showConfirmButton: true
                                                    })
                                                    setTimeout(function(){location.reload();}, 850);
                                            }
                                            else{
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Please Enter the correct information needed',
                                                    showConfirmButton: true
                                                })
                                            }
                                            
                                            
                                        },
                                        error: function(data){
                                            alert('there were errors while doing the operation');
                                        }
                                        
                                    });
                                }
                                else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Please Enter the correct information needed',
                                        showConfirmButton: true
                                    })
                                }
                                
                                
                            },
                            error: function(data){
                                alert('there were errors while doing the operation');
                            }
                            
                        });
                    } 
                    else if (result.isDenied) {
                        Swal.fire('Ok', '', 'success');
                    }
                })
            });
        });
    </script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

    
</body>
</html>
