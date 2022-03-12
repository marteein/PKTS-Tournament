<?php 
    include 'modules/head/headAdmin.php';
    include 'database/database.php';

    $sqlstatement="SELECT * FROM users WHERE role='coach'";
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
    <!-- Coaches -->
    <section class="page-section bg-light" id="participantsRegistered">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Coaches</h2>
                <h3 class="section-subheading text-muted">Listed are all the Coaches Registered in the event.</h3>
            </div>
            <div class="row">
            <table class="table table-striped" id="coachesTable">
                <thead class='thead-dark'>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Club</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($data= mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $data['name_sensei']?></td>
                        <td><?php echo $data['email']?></td>
                        <td><?php echo $data['password']?></td>
                        <td><?php echo $data['club']?></td>
                        <td>
                            <button type="button" id="editModalButton" class="btn btn-success btn-sm rounded" data-toggle='modal' data-target='#editModal' 
                            data-id="<?php echo $data['id']?>"
                            data-name="<?php echo $data['name_sensei']?>"
                            data-email="<?php echo $data['email']?>"
                            data-password="<?php echo $data['password']?>"
                            data-club="<?php echo $data['club']?>"
                            ><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm rounded"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>	
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Edit Coach's information</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="judgingBody">
                    <form id="addCoachForm">
                        <div class="row align-items-stretch mb-5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- Name input-->
                                    <input class="form-control" id="nameCoachModal" type="text" placeholder="Coach Name*"/>
                                    <input type="text" id="idCoachModal" hidden/>
                                </div><br>
                                <div class="form-group">
                                    <!-- Email address input-->
                                    <input class="form-control" id="emailCoachModal" type="text" placeholder="Coach Email*"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" id="clubCoachModal" type="text" placeholder="Coach's Club*"/>  
                                </div><br>
                                <div class="form-group">
                                    <input class="form-control" id="passwordCoachModal" type="text" placeholder="Coach Password*"/>  
                                </div>
                            </div>
                            <div class="form-group">
                                <br>
                                <input type="submit" class="btn btn-primary" value="Save" id="submitCoachEdit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section class="page-section bg-light" id="Register Coach" style="background-color: grey;">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Add a Coach</h2>
                <h3 class="section-subheading text-muted">Add coaches from different clubs so they can register their participants</h3>
            </div>
            <form id="addCoachForm">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="nameCoach" type="text" placeholder="Coach Name*"/>
                    </div><br>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="emailCoach" type="text" placeholder="Coach Email*"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" id="clubCoach" type="text" placeholder="Coach's Club*"/>  
                    </div><br>
                    <div class="form-group">
                        <input class="form-control" id="passwordCoach" type="text" placeholder="Coach Password*"/>  
                    </div>
                </div>
                <div class="form-group">
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit" id="submitCoach">
                </div>
                <script src="js/registerCoach.js"></script>
            </div>
            </form>
            <br>
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
