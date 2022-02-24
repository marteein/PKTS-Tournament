<?php 
    include 'modules/head/headJudge.php';
    include 'database/database.php';

    $sqlstatement="SELECT * FROM participants";
	$result= mysqli_query($connect, $sqlstatement);
?>

<body id="page-top">
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
                    <li class="nav-item"><a class="nav-link" href="#participantsRegistered">Participants</a></li>
                    <li class="nav-item"><a class="nav-link" href="#register">Judge</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?logout=true">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">HELLO Sensei <?php echo $_SESSION['userlogin']['name_sensei'];?>!</div><br>
            <div class="masthead-heading text-uppercase">Welcome to PKTS Tournament Hub</div>
            <a class="btn btn-primary btn-lg text-uppercase" href="#register">Register Participants Now!</a>
        </div>
    </header>
    <!-- Participants -->
    <script src="js/registerParticipant_Judge.js"></script>
    
    <form id="TheForm" method="post" target="scoring.php" action="scoring.php">
    <input type="hidden" name="name" value="something" />
    <input type="hidden" name="event" value="something" />
    <input type="hidden" name="category" value="something" />
    </form>
    
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
</body>
</html>
