<?php 
    include 'modules/head/head.php';
    include 'database/database.php';

    $judgeClub = $_SESSION['userlogin']['club'];
    $sqlstatement="SELECT * FROM participants WHERE club_participant='$judgeClub'";
	$result= mysqli_query($connect, $sqlstatement);
?>

<body id="page-top" style="background-color: cornflowerblue;">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top"><img src="assets/img/top-logo.png" alt="..." style="width: 30%; height: 30%;"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php#participantsRegistered">Participants</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#register">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="#AddVideo">Add Video</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?logout=true">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" style="padding-top: 4%; padding-bottom: 4%;">
        <div class="container">
        </div>
    </header>
    <!-- Participants -->
    <section class="page-section bg-light" id="AddVideo">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Add Video</h2>
                <h3 class="section-subheading text-muted">Update the entry for your club members by adding their Video.</h3>
            </div>
            <div class="row">
            <table class="table table-striped" data-order='[[ 1, "asc" ]]' data-page-length='25' id="participantsTable">
                <thead class='thead-dark'>
                    <tr>
                        <th>Name</th>
                        <th data-class-name="priority">Event</th>
                        <th>Category</th>
                        <th>Gender</th>
                        <th>Age Bracket</th>
                        <th>Video</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($data= mysqli_fetch_assoc($result)){
                    ?>
                    
                    <tr>
                        <td><?php echo $data['name_participant']?></td>
                        <td><?php echo $data['kata_kumite']?></td>
                        <td><?php echo $data['category_participant']?></td>
                        <td><?php echo $data['gender_participant']?></td>
                        <td>
                        <?php 
                            switch (TRUE) {
                                case ($data['age_participant']<=5):
                                    echo "Below 5";
                                    break;
                                case ($data['age_participant']<=7):
                                    echo "6-7";
                                    break;
                                case ($data['age_participant']<=9):
                                    echo "8-9";
                                    break;
                                case ($data['age_participant']<=11):
                                    echo "10-11";
                                    break;
                                case ($data['age_participant']<=13):
                                    echo "12-13";
                                    break;
                                case ($data['age_participant']<=15):
                                    echo "14-15";
                                    break;
                                case ($data['age_participant']<=17):
                                    echo "16-17";
                                    break;
                                case ($data['age_participant']>17):
                                    echo "18 and Above";
                                    break;
                            }
                        ?>
                        </td>
                        <div class="modal fade bd-example-modal-lg" id="addVideoModal<?php echo $data['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel">Participant's Video</h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="addVideoBody">
                                        <h4>Please paste the Google Drive link of the Video</h4>
                                        <input type="text" class="form-control" id="videoLink<?php echo $data['id']?>" placeholder="Paste Google Drive link here!"/><br>
                                        <button class="btn btn-success" onclick="addVideo(<?php echo $data['id']?>)">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td><button class="btn btn-primary" data-toggle='modal' data-target='#viewVideoModal' onclick="viewVideo(<?php echo $data['id']?>);"><i class="fa fa-eye"></i></button>
                            <button class="btn btn-success" data-toggle='modal' data-target='#addVideoModal<?php echo $data['id']?>'><i class="fa fa-edit"></i></button>
                            <?php if($data['video_link']!=''){
                                echo '&nbsp;&nbsp;<i class="fa fa-check" style="color:green"></i>';
                                }?>
                        </td>
                    </tr>	
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Event</th>
                        <th>Category</th>
                        <th>Gender</th>
                        <th>Age Bracket</th>
                        <th>Video</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
        <script src="js/registerParticipant.js"></script>
        <script src="js/ViewAndEditVideo.js"></script>
    </section>
    <div class="modal fade bd-example-modal-lg" id="viewVideoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Participant's Video</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewingBody">
                </div>
            </div>
        </div>
    </div>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Contact Us</h2>
                <h3 class="section-subheading text-muted">Feel free to contact us from any of the links below</h3>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; PKTS Tournament Hub</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-messenger"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <!-- <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of Use</a> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
