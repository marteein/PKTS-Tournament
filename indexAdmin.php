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
                    <li class="nav-item"><a class="nav-link" href="#participantsRegistered">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="#register">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
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
                <h2 class="section-heading text-uppercase">Participants</h2>
                <h3 class="section-subheading text-muted">Listed are all the participants for every events and categories.</h3>
            </div>
            <div class="row" style="overflow-x: auto;">
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
                        <td><?php echo $data['age_participant']?></td>
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
    <!-- Register-->
    <section class="page-section" id="register">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Register Participants</h2>
                <h3 class="section-subheading text-muted">Register the participants from your club</h3>
            </div>
            <div class="row text-center">
                <form method="POST" id="participant_form">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="nameParticipant" type="text" placeholder="Club Member Name*"/>
                            </div><br>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" min=0 id="ageParticipant" type="number" placeholder="Age*"/>
                            </div><br>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <select class="form-control custom-select" id="genderParticipant">
                                    <option value="" disabled selected>Gender*</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Kata or Kumite input-->
                                <div class="form-group mb-md-0">
                                    <!-- Phone number input-->
                                    <select class="form-control custom-select" id="KataKumiteParticipant" onchange="showDiv(this)">
                                        <option value="" disabled selected>Kata or Kumite?*</option>
                                        <option value="Kata">Kata</option>
                                        <option value="Kumite">Kumite</option>
                                    </select>
                                </div><br>
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
                                </div><br>
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
                        <div class="form-group">
                            <br>
                            <input type="submit" class="btn btn-success" value="Submit" id="SubmitParticipant">
                        </div>
                        <script src="js/registerParticipant.js"></script>
                    </div>
                </form>
            </div>
            <!-- <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">E-Commerce</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Responsive Design</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Web Security</h4>
                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
                </div>
            </div> -->
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
</body>
</html>
