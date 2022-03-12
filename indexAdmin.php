<?php 
    include 'modules/head/headAdmin.php';
    include 'database/database.php';
    $sqlstatement="SELECT * FROM participants";
	$result= mysqli_query($connect, $sqlstatement);
?>

<body id="page-top" style="max-width:100%;">
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
                    <li class="nav-item"><a class="nav-link" href="indexAdmin.php">Score Cards</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_addCoach.php">Add a Coach</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_addJudge.php">Add a Judge</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?logout=true">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" style="padding-top: 4%; padding-bottom: 4%;">
    </header>
    <!-- Participants -->
    <section class="page-section bg-light" id="participantsRegistered" style="background-color: grey;">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Score Cards</h2>
                <h3 class="section-subheading text-muted">Scores for different Events and Categories</h3>
            </div>
            
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Kata or Kumite input-->
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <select class="form-control custom-select" id="EventAdmin" onchange="showDiv(this)">
                                    <option value="" disabled selected>Kata or Kumite?*</option>
                                    <option value="Kata">Kata</option>
                                    <option value="Kumite">Kumite</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-group-textarea mb-md-0">
                            <div class="form-group mb-md-0">
                                <!-- Kata Category input-->
                                <select class="form-control custom-select" id="categoriesKata" hidden disabled>
                                    <option value="" disabled selected>Choose Category*</option>
                                    <option value="New Face">New Face Kata</option>
                                    <option value="Novice">Novice Kata</option>
                                    <option value="Intermediate">Intermediate Kata</option>
                                    <option value="Advanced">Advanced Kata</option>
                                    <option value="Master">Master Kata</option>
                                    <option value="Junro">Junro Kata</option>
                                    <option value="Duo">Duo Kata</option>
                                    <option value="Team">Team Kata</option>
                                </select>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Kumite Category input-->
                                <select class="form-control custom-select" id="categoriesKumite" hidden disabled>
                                    <option value="" disabled selected>Choose Category*</option>
                                    <option value="Intermediate">Intermediate Kumite</option>
                                    <option value="Advanced">Advanced Kumite</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-group-textarea mb-md-0">
                            <!-- Kata or Kumite input-->
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <select class="form-control custom-select" id="genderAdmin">
                                    <option value="" disabled selected>Gender*</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-group-textarea mb-md-0">
                            <div class="form-group mb-md-0">
                                <!-- Kata Category input-->
                                <select class="form-control custom-select" id="AgeBracket">
                                    <option value="" disabled selected>Age Bracket*</option>
                                    <option value=5>Below 5</option>
                                    <option value=6>6-7</option>
                                    <option value=8>8-9</option>
                                    <option value=10>10-11</option>
                                    <option value=12>12-13</option>
                                    <option value=14>14-15</option>
                                    <option value=16>16-17</option>
                                    <option value=18>18 and Above</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" data-toggle='modal' data-target='.bd-example-modal-lg' onclick="getScores();">Fetch Score card</button>
                    </div>
                </div>
            
            <br>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="scoreCardLabel">Score Card</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="scoreBody">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Participants -->
    <section class="page-section bg-light" id="participantsRegistered">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Participants</h2>
                <h3 class="section-subheading text-muted">Listed are all the participants for every events and categories.</h3>
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
                        <th>Club</th>
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
                        <td><?php echo $data['club_participant']?></td>
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
                        <th>Club</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </section>

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
    <script src="js/registerParticipant_admin.js"></script>
</body>
</html>
